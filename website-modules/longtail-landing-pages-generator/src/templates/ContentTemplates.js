import OpenAI from 'openai';
import { marked } from 'marked';
import fs from 'fs-extra';
import path from 'path';

/**
 * Industry-specific content generation templates
 * AI-powered content creation for longtail landing pages
 */
export class ContentTemplates {
  constructor(config = {}) {
    this.config = {
      openaiApiKey: process.env.OPENAI_API_KEY,
      contentStyle: config.contentStyle || 'professional',
      wordCount: config.wordCount || 1500,
      includeSchema: config.includeSchema || true,
      includeFAQ: config.includeFAQ || true,
      includeTestimonials: config.includeTestimonials || true,
      ...config
    };

    this.openai = new OpenAI({ apiKey: this.config.openaiApiKey });
    this.templates = new Map();
    this.industryData = new Map();
    
    this.initializeTemplates();
    this.loadIndustryData();
  }

  initializeTemplates() {
    // Base template structure for all industries
    this.baseTemplate = {
      sections: [
        'hero',
        'value-proposition',
        'benefits',
        'how-it-works',
        'social-proof',
        'features',
        'pricing-cta',
        'faq',
        'conclusion'
      ],
      seoElements: [
        'title',
        'meta-description',
        'h1',
        'h2-tags',
        'schema-markup',
        'internal-links',
        'alt-tags'
      ]
    };
  }

  async loadIndustryData() {
    const industries = [
      'ai-business',
      'ecommerce', 
      'real-estate',
      'healthcare',
      'finance',
      'legal',
      'automotive',
      'education',
      'fitness',
      'beauty',
      'food',
      'travel',
      'technology',
      'construction',
      'manufacturing',
      'consulting',
      'marketing',
      'insurance',
      'retail',
      'saas'
    ];

    for (const industry of industries) {
      this.industryData.set(industry, await this.loadIndustryConfig(industry));
    }
  }

  async loadIndustryConfig(industry) {
    // Industry-specific configuration and data
    const configs = {
      'ai-business': {
        tone: 'innovative, technical, forward-thinking',
        keyTerms: ['artificial intelligence', 'machine learning', 'automation', 'AI solutions'],
        painPoints: ['manual processes', 'inefficiency', 'lack of insights', 'competitive disadvantage'],
        benefits: ['increased efficiency', 'better decision making', 'cost reduction', 'competitive advantage'],
        ctas: ['Get AI Consultation', 'Start Your AI Journey', 'Transform Your Business'],
        schemas: ['TechArticle', 'SoftwareApplication', 'Service'],
        averagePrice: '$5,000 - $50,000',
        testimonialStyle: 'ROI-focused, technical benefits'
      },
      'ecommerce': {
        tone: 'sales-focused, trust-building, results-driven',
        keyTerms: ['online store', 'ecommerce platform', 'digital sales', 'conversion optimization'],
        painPoints: ['low conversion rates', 'cart abandonment', 'poor user experience', 'limited traffic'],
        benefits: ['increased sales', 'better conversion rates', 'improved user experience', 'higher revenue'],
        ctas: ['Start Selling Online', 'Boost Your Sales', 'Get Free Consultation'],
        schemas: ['Product', 'Organization', 'WebSite'],
        averagePrice: '$500 - $10,000',
        testimonialStyle: 'Revenue increase, conversion improvements'
      },
      'real-estate': {
        tone: 'trustworthy, local-focused, professional',
        keyTerms: ['real estate', 'property management', 'home buying', 'investment property'],
        painPoints: ['finding right properties', 'market complexity', 'financing challenges', 'time constraints'],
        benefits: ['expert guidance', 'market insights', 'time savings', 'better deals'],
        ctas: ['Find Your Dream Home', 'Get Property Valuation', 'Schedule Consultation'],
        schemas: ['RealEstateAgent', 'Place', 'Service'],
        averagePrice: 'Commission-based',
        testimonialStyle: 'Successful purchases, smooth transactions'
      },
      'healthcare': {
        tone: 'caring, professional, authoritative',
        keyTerms: ['healthcare services', 'medical care', 'patient care', 'health solutions'],
        painPoints: ['health concerns', 'access to care', 'treatment options', 'recovery time'],
        benefits: ['improved health', 'quality care', 'peace of mind', 'faster recovery'],
        ctas: ['Schedule Appointment', 'Get Health Assessment', 'Contact Our Team'],
        schemas: ['MedicalOrganization', 'Physician', 'MedicalCondition'],
        averagePrice: 'Insurance accepted',
        testimonialStyle: 'Health improvements, quality care experiences'
      }
    };

    return configs[industry] || configs['ai-business']; // Default fallback
  }

  /**
   * Generate complete landing page content for a keyword
   */
  async generateLandingPageContent(keyword, industry, options = {}) {
    const industryConfig = this.industryData.get(industry) || this.industryData.get('ai-business');
    
    const contentRequest = {
      keyword,
      industry,
      config: industryConfig,
      sections: options.sections || this.baseTemplate.sections,
      wordCount: options.wordCount || this.config.wordCount,
      style: options.style || this.config.contentStyle,
      location: options.location,
      competitor: options.competitor
    };

    try {
      const content = await this.generateSectionContent(contentRequest);
      const seoElements = await this.generateSEOElements(contentRequest);
      
      return {
        keyword,
        industry,
        content,
        seo: seoElements,
        metadata: {
          generatedAt: new Date().toISOString(),
          wordCount: this.countWords(Object.values(content).join(' ')),
          readingTime: this.calculateReadingTime(Object.values(content).join(' ')),
          difficulty: 'beginner', // Could be dynamic
          contentType: 'landing-page'
        }
      };
    } catch (error) {
      throw new Error(`Content generation failed: ${error.message}`);
    }
  }

  async generateSectionContent(request) {
    const { keyword, industry, config, sections } = request;
    const content = {};

    for (const section of sections) {
      try {
        content[section] = await this.generateSection(section, request);
      } catch (error) {
        console.warn(`Failed to generate section ${section}:`, error.message);
        content[section] = this.getFallbackContent(section, keyword, industry);
      }
    }

    return content;
  }

  async generateSection(sectionType, request) {
    const { keyword, industry, config } = request;
    
    const sectionPrompts = {
      'hero': this.getHeroPrompt(keyword, industry, config),
      'value-proposition': this.getValuePropositionPrompt(keyword, industry, config),
      'benefits': this.getBenefitsPrompt(keyword, industry, config),
      'how-it-works': this.getHowItWorksPrompt(keyword, industry, config),
      'social-proof': this.getSocialProofPrompt(keyword, industry, config),
      'features': this.getFeaturesPrompt(keyword, industry, config),
      'pricing-cta': this.getPricingCTAPrompt(keyword, industry, config),
      'faq': this.getFAQPrompt(keyword, industry, config),
      'conclusion': this.getConclusionPrompt(keyword, industry, config)
    };

    const prompt = sectionPrompts[sectionType];
    
    if (!prompt) {
      throw new Error(`Unknown section type: ${sectionType}`);
    }

    const response = await this.openai.chat.completions.create({
      model: 'gpt-4',
      messages: [{ role: 'user', content: prompt }],
      temperature: 0.7,
      max_tokens: 1000
    });

    return response.choices[0].message.content.trim();
  }

  // Section-specific prompt generators
  getHeroPrompt(keyword, industry, config) {
    return `Write a compelling hero section for a landing page targeting "${keyword}" in the ${industry} industry.

Tone: ${config.tone}
Key terms to include: ${config.keyTerms.join(', ')}

Include:
- Attention-grabbing headline with keyword
- Subheadline explaining value
- Primary CTA button
- Trust indicators/social proof hint

Format as HTML with appropriate heading tags. Make it conversion-focused and benefit-driven.`;
  }

  getValuePropositionPrompt(keyword, industry, config) {
    return `Create a value proposition section for "${keyword}" targeting ${industry} businesses.

Address these pain points: ${config.painPoints.join(', ')}
Highlight these benefits: ${config.benefits.join(', ')}
Tone: ${config.tone}

Structure:
- Clear problem identification
- Unique solution explanation  
- Quantifiable benefits where possible
- Differentiation from competitors

Format as HTML with proper headings and bullet points.`;
  }

  getBenefitsPrompt(keyword, industry, config) {
    return `Write a benefits section showcasing why someone should choose "${keyword}" services for ${industry}.

Key benefits to highlight: ${config.benefits.join(', ')}
Tone: ${config.tone}

Include:
- 5-7 specific benefits
- Each benefit should have a title and 2-3 sentence explanation
- Use benefit-focused language (what's in it for them)
- Include relevant icons/visual suggestions in HTML comments

Format as HTML with benefit cards or list structure.`;
  }

  getHowItWorksPrompt(keyword, industry, config) {
    return `Create a "How It Works" process section for ${keyword} services in ${industry}.

Tone: ${config.tone}
Industry context: ${industry}

Structure as 3-5 step process:
- Each step should be clear and actionable
- Focus on ease and simplicity
- Address common concerns
- End with results/outcome

Format as HTML with step-by-step layout and appropriate headings.`;
  }

  getSocialProofPrompt(keyword, industry, config) {
    return `Generate social proof content for ${keyword} landing page targeting ${industry}.

Testimonial style: ${config.testimonialStyle}
Tone: ${config.tone}

Include:
- 3 realistic testimonials with names, titles, companies
- Statistics/numbers where relevant
- Awards or certifications mention
- Client logos suggestion

Make testimonials specific to ${keyword} and ${industry} context.
Format as HTML with testimonial cards.`;
  }

  getFeaturesPrompt(keyword, industry, config) {
    return `Create a features section for ${keyword} services targeting ${industry} industry.

Key terms: ${config.keyTerms.join(', ')}
Tone: ${config.tone}

Include:
- 6-8 key features
- Each feature should have title, description, and benefit
- Focus on features that solve ${industry} specific problems
- Use industry-appropriate terminology

Format as HTML with feature grid or list layout.`;
  }

  getPricingCTAPrompt(keyword, industry, config) {
    return `Write a pricing and call-to-action section for ${keyword} services in ${industry}.

Average pricing context: ${config.averagePrice}
Suggested CTAs: ${config.ctas.join(', ')}
Tone: ${config.tone}

Include:
- Value-based pricing presentation
- Multiple CTA options
- Risk reversal (guarantees, free trials, etc.)
- Urgency/scarcity elements
- Contact information

Format as HTML with pricing cards or CTA-focused layout.`;
  }

  getFAQPrompt(keyword, industry, config) {
    return `Generate frequently asked questions for ${keyword} landing page targeting ${industry}.

Address pain points: ${config.painPoints.join(', ')}
Highlight benefits: ${config.benefits.join(', ')}
Tone: ${config.tone}

Create 8-10 FAQs covering:
- Service details and process
- Pricing and payment
- Timeline and results
- Industry-specific concerns
- Technical questions
- Getting started

Format as HTML with collapsible FAQ structure.`;
  }

  getConclusionPrompt(keyword, industry, config) {
    return `Write a compelling conclusion section for ${keyword} landing page in ${industry}.

CTAs available: ${config.ctas.join(', ')}
Tone: ${config.tone}

Include:
- Summary of key benefits
- Final persuasive argument
- Strong call-to-action
- Contact information
- Next steps clarity

Format as HTML with final CTA emphasis and contact details.`;
  }

  async generateSEOElements(request) {
    const { keyword, industry, config } = request;
    
    const seoElements = {
      title: await this.generateTitle(keyword, industry, config),
      metaDescription: await this.generateMetaDescription(keyword, industry, config),
      h1: await this.generateH1(keyword, industry),
      h2Tags: await this.generateH2Tags(keyword, industry),
      schemaMarkup: await this.generateSchemaMarkup(keyword, industry, config),
      internalLinks: this.generateInternalLinks(keyword, industry),
      altTags: this.generateAltTags(keyword, industry)
    };

    return seoElements;
  }

  async generateTitle(keyword, industry, config) {
    const prompt = `Generate 3 SEO-optimized title tag options for a landing page targeting "${keyword}" in ${industry}.

Requirements:
- Include target keyword naturally
- 50-60 characters max
- Include industry relevance
- Compelling and click-worthy
- Professional tone matching: ${config.tone}

Return as JSON array of title options.`;

    const response = await this.openai.chat.completions.create({
      model: 'gpt-3.5-turbo',
      messages: [{ role: 'user', content: prompt }],
      temperature: 0.5,
      max_tokens: 200
    });

    const titles = JSON.parse(response.choices[0].message.content);
    return titles[0]; // Return the best option
  }

  async generateMetaDescription(keyword, industry, config) {
    const prompt = `Write an SEO meta description for "${keyword}" landing page targeting ${industry}.

Requirements:
- Include target keyword
- 150-160 characters max
- Compelling call-to-action
- Highlight key benefit
- Professional tone: ${config.tone}
- Include primary CTA: ${config.ctas[0]}`;

    const response = await this.openai.chat.completions.create({
      model: 'gpt-3.5-turbo',
      messages: [{ role: 'user', content: prompt }],
      temperature: 0.3,
      max_tokens: 100
    });

    return response.choices[0].message.content.trim();
  }

  async generateH1(keyword, industry) {
    return `${this.titleCase(keyword)} - ${this.titleCase(industry)} Solutions`;
  }

  async generateH2Tags(keyword, industry) {
    const h2Tags = [
      `Why Choose Our ${this.titleCase(keyword)} Services?`,
      `How Our ${this.titleCase(keyword)} Process Works`,
      `Benefits of Professional ${this.titleCase(keyword)}`,
      `${this.titleCase(industry)} ${this.titleCase(keyword)} Features`,
      `Get Started with ${this.titleCase(keyword)} Today`,
      `Frequently Asked Questions About ${this.titleCase(keyword)}`
    ];

    return h2Tags;
  }

  async generateSchemaMarkup(keyword, industry, config) {
    const schemas = {
      Organization: {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Your Business Name",
        "description": `Professional ${keyword} services for ${industry}`,
        "url": "https://yourdomain.com",
        "contactPoint": {
          "@type": "ContactPoint",
          "telephone": "+1-XXX-XXX-XXXX",
          "contactType": "customer service"
        }
      },
      Service: {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": `${this.titleCase(keyword)} Services`,
        "description": `Professional ${keyword} solutions for ${industry} businesses`,
        "provider": {
          "@type": "Organization",
          "name": "Your Business Name"
        },
        "serviceType": keyword,
        "areaServed": "United States"
      },
      FAQ: {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
          {
            "@type": "Question",
            "name": `What is ${keyword}?`,
            "acceptedAnswer": {
              "@type": "Answer",
              "text": `${keyword} refers to professional services that help ${industry} businesses achieve their goals through specialized solutions.`
            }
          }
        ]
      }
    };

    // Return schemas based on industry config
    const relevantSchemas = config.schemas || ['Organization', 'Service'];
    const schemaMarkup = {};
    
    relevantSchemas.forEach(schemaType => {
      if (schemas[schemaType]) {
        schemaMarkup[schemaType] = schemas[schemaType];
      }
    });

    return schemaMarkup;
  }

  generateInternalLinks(keyword, industry) {
    return [
      {
        anchor: `${industry} services`,
        url: `/${industry}-services`,
        context: 'Explore our comprehensive range of services'
      },
      {
        anchor: 'contact us',
        url: '/contact',
        context: 'Get in touch for a consultation'
      },
      {
        anchor: 'case studies',
        url: '/case-studies',
        context: 'See our success stories'
      },
      {
        anchor: 'about us',
        url: '/about',
        context: 'Learn more about our company'
      }
    ];
  }

  generateAltTags(keyword, industry) {
    return [
      `${industry} ${keyword} services illustration`,
      `Professional ${keyword} process diagram`,
      `${industry} business success with ${keyword}`,
      `Team providing ${keyword} consultation`,
      `${keyword} results and benefits chart`
    ];
  }

  getFallbackContent(section, keyword, industry) {
    const fallbacks = {
      'hero': `<h1>Professional ${this.titleCase(keyword)} Services</h1><p>Transform your ${industry} business with our expert ${keyword} solutions.</p><button>Get Started Today</button>`,
      'value-proposition': `<h2>Why Choose Our ${this.titleCase(keyword)} Services?</h2><p>We provide comprehensive ${keyword} solutions specifically designed for ${industry} businesses.</p>`,
      'benefits': `<h2>Benefits of Our ${this.titleCase(keyword)} Services</h2><ul><li>Increased efficiency</li><li>Better results</li><li>Expert guidance</li><li>Proven success</li></ul>`,
      'conclusion': `<h2>Ready to Get Started?</h2><p>Contact us today to learn how our ${keyword} services can benefit your ${industry} business.</p><button>Contact Us Now</button>`
    };

    return fallbacks[section] || `<h2>${this.titleCase(section)}</h2><p>Content for ${keyword} in ${industry} industry.</p>`;
  }

  // Utility methods
  countWords(text) {
    return text.split(/\s+/).filter(word => word.length > 0).length;
  }

  calculateReadingTime(text) {
    const wordsPerMinute = 200;
    const words = this.countWords(text);
    const minutes = Math.ceil(words / wordsPerMinute);
    return `${minutes} min read`;
  }

  titleCase(str) {
    return str.replace(/\w\S*/g, txt => 
      txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()
    );
  }

  /**
   * Generate content for multiple keywords at once
   */
  async generateBulkContent(keywords, industry, options = {}) {
    const results = [];
    const concurrency = options.concurrency || 3;
    
    // Process keywords in batches to avoid API rate limits
    for (let i = 0; i < keywords.length; i += concurrency) {
      const batch = keywords.slice(i, i + concurrency);
      
      const batchPromises = batch.map(keyword => 
        this.generateLandingPageContent(keyword, industry, options)
      );
      
      try {
        const batchResults = await Promise.allSettled(batchPromises);
        
        batchResults.forEach((result, index) => {
          if (result.status === 'fulfilled') {
            results.push(result.value);
          } else {
            console.error(`Failed to generate content for ${batch[index]}:`, result.reason);
          }
        });
        
        // Brief pause between batches
        if (i + concurrency < keywords.length) {
          await new Promise(resolve => setTimeout(resolve, 1000));
        }
      } catch (error) {
        console.error('Batch processing failed:', error);
      }
    }
    
    return results;
  }

  /**
   * Save generated content to files
   */
  async saveContent(content, outputDir) {
    await fs.ensureDir(outputDir);
    
    const filename = content.keyword.replace(/[^a-z0-9]/gi, '-').toLowerCase();
    const filepath = path.join(outputDir, `${filename}.json`);
    
    await fs.writeJson(filepath, content, { spaces: 2 });
    
    // Also save as markdown for easy editing
    const markdownContent = this.convertToMarkdown(content);
    await fs.writeFile(
      path.join(outputDir, `${filename}.md`), 
      markdownContent
    );
    
    return filepath;
  }

  convertToMarkdown(content) {
    const { keyword, industry, content: sections, seo, metadata } = content;
    
    let markdown = `# ${seo.title}\n\n`;
    markdown += `**Keyword:** ${keyword}\n`;
    markdown += `**Industry:** ${industry}\n`;
    markdown += `**Generated:** ${metadata.generatedAt}\n`;
    markdown += `**Reading Time:** ${metadata.readingTime}\n\n`;
    
    // Add meta description
    markdown += `**Meta Description:** ${seo.metaDescription}\n\n`;
    
    // Add content sections
    Object.entries(sections).forEach(([sectionName, sectionContent]) => {
      markdown += `## ${this.titleCase(sectionName.replace('-', ' '))}\n\n`;
      markdown += `${sectionContent}\n\n`;
    });
    
    return markdown;
  }

  /**
   * Get content template for specific industry
   */
  getIndustryTemplate(industry) {
    return this.industryData.get(industry) || this.industryData.get('ai-business');
  }

  /**
   * Validate generated content quality
   */
  validateContent(content) {
    const issues = [];
    
    // Check word count
    if (content.metadata.wordCount < 500) {
      issues.push('Content too short - minimum 500 words recommended');
    }
    
    // Check keyword presence
    const fullText = Object.values(content.content).join(' ').toLowerCase();
    if (!fullText.includes(content.keyword.toLowerCase())) {
      issues.push('Target keyword not found in content');
    }
    
    // Check required sections
    const requiredSections = ['hero', 'value-proposition', 'benefits'];
    const missingSections = requiredSections.filter(section => 
      !content.content[section] || content.content[section].length < 50
    );
    
    if (missingSections.length > 0) {
      issues.push(`Missing or insufficient sections: ${missingSections.join(', ')}`);
    }
    
    // Check SEO elements
    if (!content.seo.title || content.seo.title.length > 60) {
      issues.push('Title tag missing or too long');
    }
    
    if (!content.seo.metaDescription || content.seo.metaDescription.length > 160) {
      issues.push('Meta description missing or too long');
    }
    
    return {
      isValid: issues.length === 0,
      issues,
      score: Math.max(0, 100 - (issues.length * 15))
    };
  }
}