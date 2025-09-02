import axios from 'axios';
import { GoogleAdsApi } from 'google-ads-api';
import OpenAI from 'openai';
import fs from 'fs-extra';
import path from 'path';
import { createObjectCsvWriter } from 'csv-writer';
import winston from 'winston';

/**
 * Advanced Keyword Research Automation System
 * Combines multiple data sources for comprehensive longtail keyword discovery
 */
export class KeywordResearcher {
  constructor(config = {}) {
    this.config = {
      googleAdsApiKey: process.env.GOOGLE_ADS_API_KEY,
      googleApiKey: process.env.GOOGLE_API_KEY,
      openaiApiKey: process.env.OPENAI_API_KEY,
      semrushApiKey: process.env.SEMRUSH_API_KEY,
      ahrefsApiKey: process.env.AHREFS_API_KEY,
      ubersuggestApiKey: process.env.UBERSUGGEST_API_KEY,
      outputDir: config.outputDir || './output/keywords',
      maxKeywords: config.maxKeywords || 1000,
      minSearchVolume: config.minSearchVolume || 10,
      maxDifficulty: config.maxDifficulty || 30,
      languages: config.languages || ['en'],
      locations: config.locations || ['US'],
      ...config
    };

    this.openai = new OpenAI({ apiKey: this.config.openaiApiKey });
    this.logger = this.setupLogger();
    this.keywordSources = [];
    this.results = new Map();
  }

  setupLogger() {
    return winston.createLogger({
      level: 'info',
      format: winston.format.combine(
        winston.format.timestamp(),
        winston.format.json()
      ),
      transports: [
        new winston.transports.File({ filename: 'logs/keyword-research.log' }),
        new winston.transports.Console()
      ]
    });
  }

  /**
   * Main keyword research orchestrator
   * @param {Object} params - Research parameters
   * @returns {Array} Comprehensive keyword list with metrics
   */
  async researchKeywords(params) {
    const {
      seedKeywords,
      industry,
      location,
      competitor,
      contentType = 'landing-page'
    } = params;

    this.logger.info('Starting keyword research', { params });

    try {
      // Initialize research sources
      await this.initializeResearchSources();

      // Execute multi-source keyword discovery
      const keywordSets = await Promise.allSettled([
        this.researchGoogleKeywordPlanner(seedKeywords, location),
        this.researchSemrush(seedKeywords, location),
        this.researchAhrefs(seedKeywords, location),
        this.researchUbersuggest(seedKeywords, location),
        this.researchGoogleSuggest(seedKeywords),
        this.researchAnswerThePublic(seedKeywords),
        this.researchAIGenerated(seedKeywords, industry, contentType),
        this.researchCompetitorKeywords(competitor),
        this.researchGoogleTrends(seedKeywords, location)
      ]);

      // Process and merge results
      const mergedKeywords = this.mergeKeywordSources(keywordSets);
      
      // Apply filters and scoring
      const filteredKeywords = this.filterAndScoreKeywords(mergedKeywords, params);
      
      // Generate keyword variations
      const expandedKeywords = await this.generateKeywordVariations(filteredKeywords, industry);
      
      // Final processing and export
      const finalResults = this.processKeywordResults(expandedKeywords, params);
      
      // Save results
      await this.saveResults(finalResults, params);
      
      this.logger.info('Keyword research completed', { 
        totalKeywords: finalResults.length,
        industry,
        location 
      });

      return finalResults;
    } catch (error) {
      this.logger.error('Keyword research failed', { error: error.message });
      throw error;
    }
  }

  async initializeResearchSources() {
    this.keywordSources = [
      {
        name: 'Google Keyword Planner',
        enabled: !!this.config.googleAdsApiKey,
        weight: 1.0
      },
      {
        name: 'Semrush',
        enabled: !!this.config.semrushApiKey,
        weight: 0.9
      },
      {
        name: 'Ahrefs',
        enabled: !!this.config.ahrefsApiKey,
        weight: 0.9
      },
      {
        name: 'Ubersuggest',
        enabled: !!this.config.ubersuggestApiKey,
        weight: 0.8
      },
      {
        name: 'Google Suggest',
        enabled: true,
        weight: 0.7
      },
      {
        name: 'Answer The Public',
        enabled: true,
        weight: 0.6
      },
      {
        name: 'AI Generated',
        enabled: !!this.config.openaiApiKey,
        weight: 0.8
      }
    ];
  }

  /**
   * Google Keyword Planner integration
   */
  async researchGoogleKeywordPlanner(seedKeywords, location) {
    if (!this.config.googleAdsApiKey) return [];

    try {
      const client = new GoogleAdsApi({
        client_id: this.config.googleClientId,
        client_secret: this.config.googleClientSecret,
        developer_token: this.config.googleDeveloperToken
      });

      const keywordPlanIdeaService = client.getService('KeywordPlanIdeaService');
      
      const request = {
        customer_id: this.config.googleCustomerId,
        language: { language_code: 'en' },
        geo_target_constants: [`geoTargetConstants/${this.getLocationId(location)}`],
        keyword_plan_network: 'GOOGLE_SEARCH',
        keyword_seed: {
          keywords: seedKeywords.map(keyword => ({ text: keyword }))
        }
      };

      const response = await keywordPlanIdeaService.generateKeywordIdeas(request);
      
      return this.processGoogleKeywordPlannerResults(response);
    } catch (error) {
      this.logger.error('Google Keyword Planner research failed', { error: error.message });
      return [];
    }
  }

  /**
   * Semrush API integration
   */
  async researchSemrush(seedKeywords, location) {
    if (!this.config.semrushApiKey) return [];

    const results = [];
    
    for (const keyword of seedKeywords) {
      try {
        const response = await axios.get('https://api.semrush.com/', {
          params: {
            type: 'phrase_related',
            key: this.config.semrushApiKey,
            phrase: keyword,
            database: this.getSemrushDatabase(location),
            export_columns: 'Ph,Nq,Cp,Co,Nr,Td',
            export_format: 'api'
          }
        });

        const keywordData = this.parseSemrushResponse(response.data);
        results.push(...keywordData);
        
        // Rate limiting
        await new Promise(resolve => setTimeout(resolve, 100));
      } catch (error) {
        this.logger.warn('Semrush keyword failed', { keyword, error: error.message });
      }
    }

    return results;
  }

  /**
   * Ahrefs API integration
   */
  async researchAhrefs(seedKeywords, location) {
    if (!this.config.ahrefsApiKey) return [];

    const results = [];
    
    for (const keyword of seedKeywords) {
      try {
        const response = await axios.get('https://apiv2.ahrefs.com', {
          headers: {
            'Authorization': `Bearer ${this.config.ahrefsApiKey}`,
            'Accept': 'application/json'
          },
          params: {
            target: keyword,
            country: this.getAhrefsCountryCode(location),
            mode: 'phrase',
            output: 'json'
          }
        });

        const keywordData = this.parseAhrefsResponse(response.data);
        results.push(...keywordData);
        
        await new Promise(resolve => setTimeout(resolve, 100));
      } catch (error) {
        this.logger.warn('Ahrefs keyword failed', { keyword, error: error.message });
      }
    }

    return results;
  }

  /**
   * Ubersuggest API integration
   */
  async researchUbersuggest(seedKeywords, location) {
    if (!this.config.ubersuggestApiKey) return [];

    const results = [];
    
    for (const keyword of seedKeywords) {
      try {
        const response = await axios.get('https://app.neilpatel.com/api/suggestions', {
          params: {
            keyword: keyword,
            locId: this.getUbersuggestLocationId(location),
            language: 'en'
          },
          headers: {
            'X-API-KEY': this.config.ubersuggestApiKey
          }
        });

        const keywordData = this.parseUbersuggestResponse(response.data);
        results.push(...keywordData);
        
        await new Promise(resolve => setTimeout(resolve, 100));
      } catch (error) {
        this.logger.warn('Ubersuggest keyword failed', { keyword, error: error.message });
      }
    }

    return results;
  }

  /**
   * Google Suggest scraping
   */
  async researchGoogleSuggest(seedKeywords) {
    const results = [];
    
    for (const keyword of seedKeywords) {
      try {
        // Get autocomplete suggestions
        const suggestions = await this.getGoogleAutocompleteSuggestions(keyword);
        
        // Process suggestions into keyword objects
        const keywordData = suggestions.map(suggestion => ({
          keyword: suggestion,
          searchVolume: null, // Will be estimated later
          competition: null,
          cpc: null,
          source: 'Google Suggest',
          intent: this.analyzeSearchIntent(suggestion),
          longtail: suggestion.split(' ').length > 3
        }));
        
        results.push(...keywordData);
      } catch (error) {
        this.logger.warn('Google Suggest failed', { keyword, error: error.message });
      }
    }

    return results;
  }

  /**
   * AI-powered keyword generation
   */
  async researchAIGenerated(seedKeywords, industry, contentType) {
    if (!this.config.openaiApiKey) return [];

    try {
      const prompt = `Generate 50 longtail keywords for ${industry} industry targeting ${contentType} content.
      
Base keywords: ${seedKeywords.join(', ')}

Requirements:
- 4+ words per keyword
- Commercial intent
- Industry-specific terminology
- Problem-solving focused
- Location-based variations
- Buyer journey stages (awareness, consideration, decision)

Format as JSON array with keyword strings only.`;

      const response = await this.openai.chat.completions.create({
        model: 'gpt-4',
        messages: [{ role: 'user', content: prompt }],
        temperature: 0.7,
        max_tokens: 2000
      });

      const keywords = JSON.parse(response.choices[0].message.content);
      
      return keywords.map(keyword => ({
        keyword: keyword.toLowerCase(),
        searchVolume: null,
        competition: null,
        cpc: null,
        source: 'AI Generated',
        intent: this.analyzeSearchIntent(keyword),
        longtail: keyword.split(' ').length > 3,
        aiGenerated: true
      }));
    } catch (error) {
      this.logger.error('AI keyword generation failed', { error: error.message });
      return [];
    }
  }

  /**
   * Competitor keyword analysis
   */
  async researchCompetitorKeywords(competitor) {
    if (!competitor || !this.config.semrushApiKey) return [];

    try {
      const response = await axios.get('https://api.semrush.com/', {
        params: {
          type: 'domain_organic',
          key: this.config.semrushApiKey,
          domain: competitor,
          database: 'us',
          export_columns: 'Ph,Po,Pp,Pd,Nq,Cp,Ur,Tr,Tc,Co,Nr,Td',
          export_format: 'api',
          limit: 500
        }
      });

      return this.parseSemrushDomainResponse(response.data);
    } catch (error) {
      this.logger.error('Competitor analysis failed', { competitor, error: error.message });
      return [];
    }
  }

  /**
   * Google Trends integration
   */
  async researchGoogleTrends(seedKeywords, location) {
    const results = [];
    
    for (const keyword of seedKeywords) {
      try {
        // Get related queries from Google Trends
        const relatedQueries = await this.getGoogleTrendsRelatedQueries(keyword, location);
        
        const keywordData = relatedQueries.map(query => ({
          keyword: query.query,
          searchVolume: query.value,
          competition: null,
          cpc: null,
          source: 'Google Trends',
          intent: this.analyzeSearchIntent(query.query),
          longtail: query.query.split(' ').length > 3,
          trending: query.type === 'rising'
        }));
        
        results.push(...keywordData);
      } catch (error) {
        this.logger.warn('Google Trends failed', { keyword, error: error.message });
      }
    }

    return results;
  }

  /**
   * Merge and deduplicate keywords from multiple sources
   */
  mergeKeywordSources(keywordSets) {
    const keywordMap = new Map();
    
    keywordSets.forEach((result, index) => {
      if (result.status === 'fulfilled' && result.value) {
        result.value.forEach(keywordObj => {
          const keyword = keywordObj.keyword.toLowerCase().trim();
          
          if (keywordMap.has(keyword)) {
            // Merge data from multiple sources
            const existing = keywordMap.get(keyword);
            keywordMap.set(keyword, this.mergeKeywordData(existing, keywordObj));
          } else {
            keywordMap.set(keyword, keywordObj);
          }
        });
      }
    });
    
    return Array.from(keywordMap.values());
  }

  mergeKeywordData(existing, newData) {
    return {
      ...existing,
      searchVolume: newData.searchVolume || existing.searchVolume,
      competition: newData.competition || existing.competition,
      cpc: newData.cpc || existing.cpc,
      sources: [...(existing.sources || [existing.source]), newData.source].filter(Boolean),
      sourceCount: (existing.sourceCount || 1) + 1,
      confidence: Math.min(100, (existing.confidence || 50) + 10)
    };
  }

  /**
   * Filter and score keywords based on criteria
   */
  filterAndScoreKeywords(keywords, params) {
    return keywords
      .filter(keyword => {
        // Basic filters
        if (keyword.keyword.length < 5) return false;
        if (keyword.searchVolume && keyword.searchVolume < this.config.minSearchVolume) return false;
        if (keyword.competition && keyword.competition > this.config.maxDifficulty) return false;
        
        // Industry relevance (basic keyword matching)
        const industryTerms = this.getIndustryTerms(params.industry);
        const hasIndustryRelevance = industryTerms.some(term => 
          keyword.keyword.includes(term.toLowerCase())
        );
        
        return hasIndustryRelevance;
      })
      .map(keyword => ({
        ...keyword,
        score: this.calculateKeywordScore(keyword, params)
      }))
      .sort((a, b) => b.score - a.score)
      .slice(0, this.config.maxKeywords);
  }

  calculateKeywordScore(keyword, params) {
    let score = 0;
    
    // Search volume (30% weight)
    if (keyword.searchVolume) {
      score += Math.min(30, (keyword.searchVolume / 1000) * 10);
    } else {
      score += 10; // Default score for unknown volume
    }
    
    // Competition (20% weight) - lower is better
    if (keyword.competition) {
      score += Math.max(0, 20 - (keyword.competition / 5));
    } else {
      score += 15; // Assume medium competition
    }
    
    // Commercial intent (25% weight)
    score += this.getIntentScore(keyword.intent) * 0.25;
    
    // Longtail bonus (10% weight)
    if (keyword.longtail) {
      score += 10;
    }
    
    // Source reliability (10% weight)
    score += (keyword.sourceCount || 1) * 2;
    
    // AI relevance (5% weight)
    if (keyword.aiGenerated) {
      score += 5;
    }
    
    return Math.round(score * 10) / 10;
  }

  getIntentScore(intent) {
    const intentScores = {
      'commercial': 100,
      'transactional': 90,
      'navigational': 40,
      'informational': 60
    };
    
    return intentScores[intent] || 50;
  }

  /**
   * Generate keyword variations using AI
   */
  async generateKeywordVariations(keywords, industry) {
    if (!this.config.openaiApiKey) return keywords;

    const topKeywords = keywords.slice(0, 20);
    const variations = [];
    
    try {
      const prompt = `Create keyword variations for these ${industry} industry keywords:
      
${topKeywords.map(k => k.keyword).join('\n')}

Generate variations using:
- Location modifiers (city, state, near me)
- Service modifiers (services, solutions, companies)  
- Problem modifiers (problems, issues, help)
- Comparison modifiers (vs, compared to, alternative)
- Time modifiers (2024, best, top)

Return as JSON array with 3-5 variations per keyword.`;

      const response = await this.openai.chat.completions.create({
        model: 'gpt-3.5-turbo',
        messages: [{ role: 'user', content: prompt }],
        temperature: 0.5,
        max_tokens: 1500
      });

      const generatedVariations = JSON.parse(response.choices[0].message.content);
      
      generatedVariations.forEach(variation => {
        variations.push({
          keyword: variation.toLowerCase(),
          searchVolume: null,
          competition: null,
          cpc: null,
          source: 'AI Variation',
          intent: this.analyzeSearchIntent(variation),
          longtail: variation.split(' ').length > 3,
          score: 50,
          isVariation: true
        });
      });
    } catch (error) {
      this.logger.error('Keyword variation generation failed', { error: error.message });
    }
    
    return [...keywords, ...variations];
  }

  /**
   * Process final keyword results
   */
  processKeywordResults(keywords, params) {
    return keywords.map(keyword => ({
      ...keyword,
      url: this.generateKeywordUrl(keyword.keyword),
      title: this.generatePageTitle(keyword.keyword, params.industry),
      metaDescription: this.generateMetaDescription(keyword.keyword, params.industry),
      category: this.categorizeKeyword(keyword.keyword, params.industry),
      priority: this.getKeywordPriority(keyword.score),
      difficulty: this.estimateKeywordDifficulty(keyword),
      contentLength: this.suggestContentLength(keyword.intent),
      lastUpdated: new Date().toISOString()
    }));
  }

  generateKeywordUrl(keyword) {
    return keyword
      .toLowerCase()
      .replace(/[^a-z0-9\s]/g, '')
      .replace(/\s+/g, '-')
      .replace(/^-+|-+$/g, '');
  }

  generatePageTitle(keyword, industry) {
    const templates = [
      `${this.titleCase(keyword)} - ${this.titleCase(industry)} Services`,
      `Best ${this.titleCase(keyword)} for ${this.titleCase(industry)}`,
      `${this.titleCase(keyword)} Solutions | ${this.titleCase(industry)}`,
      `Professional ${this.titleCase(keyword)} Services`,
      `${this.titleCase(keyword)} - Complete Guide & Solutions`
    ];
    
    return templates[Math.floor(Math.random() * templates.length)];
  }

  generateMetaDescription(keyword, industry) {
    const templates = [
      `Discover professional ${keyword} solutions for ${industry}. Get expert guidance, proven strategies, and results that drive your business forward.`,
      `Looking for ${keyword}? Our ${industry} specialists provide comprehensive solutions with proven results. Contact us for a free consultation.`,
      `Expert ${keyword} services for ${industry} businesses. Increase efficiency, reduce costs, and achieve better results with our proven solutions.`
    ];
    
    return templates[Math.floor(Math.random() * templates.length)];
  }

  categorizeKeyword(keyword, industry) {
    const categories = {
      'service': ['services', 'solutions', 'help', 'support', 'assistance'],
      'product': ['software', 'tool', 'platform', 'system', 'app'],
      'comparison': ['vs', 'compared', 'alternative', 'versus', 'better'],
      'location': ['near me', 'local', 'city', 'area'],
      'problem': ['problems', 'issues', 'challenges', 'pain', 'struggle'],
      'guide': ['how to', 'guide', 'tutorial', 'steps', 'process']
    };
    
    for (const [category, terms] of Object.entries(categories)) {
      if (terms.some(term => keyword.includes(term))) {
        return category;
      }
    }
    
    return 'general';
  }

  getKeywordPriority(score) {
    if (score >= 80) return 'high';
    if (score >= 60) return 'medium';
    return 'low';
  }

  estimateKeywordDifficulty(keyword) {
    // Simple difficulty estimation based on keyword characteristics
    let difficulty = 50; // Base difficulty
    
    if (keyword.longtail) difficulty -= 15;
    if (keyword.sourceCount > 2) difficulty += 10;
    if (keyword.competition) difficulty = keyword.competition;
    
    return Math.max(10, Math.min(100, difficulty));
  }

  suggestContentLength(intent) {
    const lengthMap = {
      'informational': '1500-3000 words',
      'commercial': '1000-2000 words', 
      'transactional': '800-1500 words',
      'navigational': '500-1000 words'
    };
    
    return lengthMap[intent] || '1000-2000 words';
  }

  /**
   * Save research results to multiple formats
   */
  async saveResults(keywords, params) {
    const timestamp = new Date().toISOString().split('T')[0];
    const filename = `keyword-research-${params.industry}-${timestamp}`;
    
    // Ensure output directory exists
    await fs.ensureDir(this.config.outputDir);
    
    // Save as JSON
    await fs.writeJson(
      path.join(this.config.outputDir, `${filename}.json`),
      {
        metadata: {
          industry: params.industry,
          location: params.location,
          generatedAt: new Date().toISOString(),
          totalKeywords: keywords.length,
          config: this.config
        },
        keywords
      },
      { spaces: 2 }
    );
    
    // Save as CSV
    const csvWriter = createObjectCsvWriter({
      path: path.join(this.config.outputDir, `${filename}.csv`),
      header: [
        { id: 'keyword', title: 'Keyword' },
        { id: 'searchVolume', title: 'Search Volume' },
        { id: 'competition', title: 'Competition' },
        { id: 'cpc', title: 'CPC' },
        { id: 'score', title: 'Score' },
        { id: 'intent', title: 'Intent' },
        { id: 'category', title: 'Category' },
        { id: 'priority', title: 'Priority' },
        { id: 'difficulty', title: 'Difficulty' },
        { id: 'url', title: 'URL' },
        { id: 'title', title: 'Page Title' },
        { id: 'metaDescription', title: 'Meta Description' }
      ]
    });
    
    await csvWriter.writeRecords(keywords);
    
    this.logger.info('Results saved', { 
      json: `${filename}.json`,
      csv: `${filename}.csv`,
      totalKeywords: keywords.length 
    });
  }

  // Helper methods
  analyzeSearchIntent(keyword) {
    const commercialTerms = ['buy', 'price', 'cost', 'cheap', 'discount', 'deal'];
    const informationalTerms = ['how', 'what', 'why', 'guide', 'tutorial'];
    const navigationalTerms = ['login', 'contact', 'about', 'company'];
    
    if (commercialTerms.some(term => keyword.includes(term))) return 'commercial';
    if (informationalTerms.some(term => keyword.includes(term))) return 'informational';
    if (navigationalTerms.some(term => keyword.includes(term))) return 'navigational';
    
    return 'commercial'; // Default for longtail keywords
  }

  getIndustryTerms(industry) {
    const industryTermsMap = {
      'ai-business': ['ai', 'artificial intelligence', 'machine learning', 'automation', 'chatbot', 'neural'],
      'ecommerce': ['ecommerce', 'online store', 'shopping', 'retail', 'marketplace'],
      'real-estate': ['real estate', 'property', 'home', 'house', 'apartment', 'rental'],
      'healthcare': ['healthcare', 'medical', 'health', 'clinic', 'hospital', 'doctor'],
      'finance': ['finance', 'financial', 'investment', 'loan', 'banking', 'insurance'],
      'legal': ['legal', 'lawyer', 'attorney', 'law', 'court', 'litigation'],
      'automotive': ['automotive', 'car', 'vehicle', 'auto', 'truck', 'motorcycle'],
      'education': ['education', 'school', 'learning', 'course', 'training', 'university'],
      // Add more industries as needed
    };
    
    return industryTermsMap[industry] || [industry];
  }

  titleCase(str) {
    return str.replace(/\w\S*/g, txt => 
      txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()
    );
  }

  // API helper methods (simplified implementations)
  async getGoogleAutocompleteSuggestions(keyword) {
    // Placeholder implementation - would use Google Suggest API
    return [
      `${keyword} services`,
      `${keyword} companies`,
      `${keyword} near me`,
      `${keyword} solutions`,
      `best ${keyword}`
    ];
  }

  getLocationId(location) {
    const locationMap = {
      'US': '2840',
      'UK': '2826',
      'CA': '2124'
    };
    return locationMap[location] || '2840';
  }

  getSemrushDatabase(location) {
    const dbMap = {
      'US': 'us',
      'UK': 'uk', 
      'CA': 'ca'
    };
    return dbMap[location] || 'us';
  }

  getAhrefsCountryCode(location) {
    return location.toLowerCase();
  }

  getUbersuggestLocationId(location) {
    const locationMap = {
      'US': '2840',
      'UK': '2826',
      'CA': '2124'
    };
    return locationMap[location] || '2840';
  }

  // Response parser methods (simplified)
  processGoogleKeywordPlannerResults(response) {
    return response.results?.map(result => ({
      keyword: result.text,
      searchVolume: result.keyword_idea_metrics?.avg_monthly_searches || null,
      competition: result.keyword_idea_metrics?.competition || null,
      cpc: result.keyword_idea_metrics?.high_top_of_page_bid_micros / 1000000 || null,
      source: 'Google Keyword Planner'
    })) || [];
  }

  parseSemrushResponse(data) {
    // Parse Semrush CSV response format
    const lines = data.split('\n').slice(1); // Skip header
    return lines.map(line => {
      const [keyword, volume, cpc, competition] = line.split(';');
      return {
        keyword,
        searchVolume: parseInt(volume) || null,
        cpc: parseFloat(cpc) || null,
        competition: parseFloat(competition) || null,
        source: 'Semrush'
      };
    }).filter(item => item.keyword);
  }

  parseAhrefsResponse(data) {
    return data.keywords?.map(item => ({
      keyword: item.keyword,
      searchVolume: item.search_volume || null,
      competition: item.keyword_difficulty || null,
      cpc: item.cpc || null,
      source: 'Ahrefs'
    })) || [];
  }

  parseUbersuggestResponse(data) {
    return data.suggestions?.map(item => ({
      keyword: item.keyword,
      searchVolume: item.search_volume || null,
      competition: item.competition || null,
      cpc: item.cpc || null,
      source: 'Ubersuggest'
    })) || [];
  }

  parseSemrushDomainResponse(data) {
    const lines = data.split('\n').slice(1);
    return lines.map(line => {
      const columns = line.split(';');
      return {
        keyword: columns[0],
        position: parseInt(columns[1]) || null,
        searchVolume: parseInt(columns[4]) || null,
        cpc: parseFloat(columns[5]) || null,
        competition: parseFloat(columns[11]) || null,
        source: 'Semrush Competitor'
      };
    }).filter(item => item.keyword);
  }

  async getGoogleTrendsRelatedQueries(keyword, location) {
    // Placeholder - would integrate with Google Trends API
    return [
      { query: `${keyword} 2024`, value: 100, type: 'rising' },
      { query: `best ${keyword}`, value: 80, type: 'top' },
      { query: `${keyword} services`, value: 60, type: 'top' }
    ];
  }
}