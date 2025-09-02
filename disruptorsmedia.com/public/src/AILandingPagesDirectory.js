import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { longtailKeywords, categories, getAllCategories, getKeywordsByCategory } from './longtailKeywords';
import './AILandingPagesDirectory.css';

const AILandingPagesDirectory = () => {
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [searchQuery, setSearchQuery] = useState('');

  // Filter keywords based on selected category and search query
  const filteredKeywords = longtailKeywords.filter(keyword => {
    const matchesCategory = selectedCategory === 'all' || keyword.category === selectedCategory;
    const matchesSearch = keyword.keyword.toLowerCase().includes(searchQuery.toLowerCase()) ||
                         keyword.title.toLowerCase().includes(searchQuery.toLowerCase());
    return matchesCategory && matchesSearch;
  });

  // Sort by search volume (highest first)
  const sortedKeywords = filteredKeywords.sort((a, b) => b.searchVolume - a.searchVolume);

  const allCategories = getAllCategories();

  // Calculate total search volume
  const totalSearchVolume = filteredKeywords.reduce((sum, keyword) => sum + keyword.searchVolume, 0);

  return (
    <div className="ai-directory-page">
      {/* Hero Section */}
      <section className="directory-hero">
        <div className="container">
          <div className="hero-content">
            <h1 className="hero-title">AI Business Solutions Directory</h1>
            <p className="hero-subtitle">
              Comprehensive guides for implementing AI in small businesses. 
              Access 50+ targeted resources covering every aspect of AI transformation.
            </p>
            
            <div className="hero-stats">
              <div className="stat">
                <span className="stat-number">50+</span>
                <span className="stat-label">AI Solutions</span>
              </div>
              <div className="stat">
                <span className="stat-number">{totalSearchVolume.toLocaleString()}</span>
                <span className="stat-label">Monthly Searches</span>
              </div>
              <div class="stat">
                <span className="stat-number">5</span>
                <span className="stat-label">Categories</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Search and Filter Section */}
      <section className="directory-filters">
        <div className="container">
          <div className="filters-row">
            {/* Search Bar */}
            <div className="search-container">
              <input
                type="text"
                placeholder="Search AI solutions..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="search-input"
              />
              <div className="search-icon">🔍</div>
            </div>

            {/* Category Filter */}
            <div className="category-filter">
              <button
                className={`filter-btn ${selectedCategory === 'all' ? 'active' : ''}`}
                onClick={() => setSelectedCategory('all')}
              >
                All Solutions ({longtailKeywords.length})
              </button>
              {allCategories.map(category => {
                const count = getKeywordsByCategory(category.slug).length;
                return (
                  <button
                    key={category.slug}
                    className={`filter-btn ${selectedCategory === category.slug ? 'active' : ''}`}
                    onClick={() => setSelectedCategory(category.slug)}
                  >
                    {category.icon} {category.name} ({count})
                  </button>
                );
              })}
            </div>
          </div>

          <div className="results-summary">
            Showing {sortedKeywords.length} AI solution{sortedKeywords.length !== 1 ? 's' : ''} 
            {selectedCategory !== 'all' && ` in ${categories[selectedCategory].name}`}
            {searchQuery && ` matching "${searchQuery}"`}
          </div>
        </div>
      </section>

      {/* Category Spotlight */}
      {selectedCategory === 'all' && !searchQuery && (
        <section className="category-spotlight">
          <div className="container">
            <h2>Browse by Category</h2>
            <div className="categories-grid">
              {allCategories.map(category => {
                const categoryKeywords = getKeywordsByCategory(category.slug);
                const totalVolume = categoryKeywords.reduce((sum, kw) => sum + kw.searchVolume, 0);
                
                return (
                  <div 
                    key={category.slug} 
                    className="category-card"
                    onClick={() => setSelectedCategory(category.slug)}
                  >
                    <div className="category-icon" style={{color: category.color}}>
                      {category.icon}
                    </div>
                    <h3>{category.name}</h3>
                    <p>{category.description}</p>
                    <div className="category-stats">
                      <span>{categoryKeywords.length} Solutions</span>
                      <span>{totalVolume.toLocaleString()} Monthly Searches</span>
                    </div>
                    <button className="category-btn" style={{borderColor: category.color}}>
                      Explore →
                    </button>
                  </div>
                );
              })}
            </div>
          </div>
        </section>
      )}

      {/* Solutions Grid */}
      <section className="solutions-grid-section">
        <div className="container">
          {sortedKeywords.length === 0 ? (
            <div className="no-results">
              <h3>No solutions found</h3>
              <p>Try adjusting your search or filter criteria.</p>
            </div>
          ) : (
            <div className="solutions-grid">
              {sortedKeywords.map(keyword => {
                const category = categories[keyword.category];
                return (
                  <div key={keyword.id} className="solution-card">
                    <Link to={`/ai/${keyword.slug}`} className="solution-link">
                      <div className="solution-header">
                        <div className="solution-category" style={{backgroundColor: category.color}}>
                          <span className="category-icon">{category.icon}</span>
                          <span className="category-name">{category.name}</span>
                        </div>
                        <div className="solution-stats">
                          <span className="search-volume">{keyword.searchVolume.toLocaleString()}/mo</span>
                        </div>
                      </div>
                      
                      <div className="solution-content">
                        <h3 className="solution-title">{keyword.title}</h3>
                        <p className="solution-description">{keyword.metaDescription}</p>
                        
                        <div className="solution-meta">
                          <div className="meta-item">
                            <span className="meta-label">Difficulty:</span>
                            <span className={`meta-value difficulty-${keyword.difficulty.toLowerCase()}`}>
                              {keyword.difficulty}
                            </span>
                          </div>
                          <div className="meta-item">
                            <span className="meta-label">Timeline:</span>
                            <span className="meta-value">{keyword.timeToImplement}</span>
                          </div>
                        </div>
                      </div>
                      
                      <div className="solution-footer">
                        <span className="read-more">Read Full Guide →</span>
                      </div>
                    </Link>
                  </div>
                );
              })}
            </div>
          )}
        </div>
      </section>

      {/* Popular Keywords Section */}
      {selectedCategory === 'all' && !searchQuery && (
        <section className="popular-keywords">
          <div className="container">
            <h2>Most Searched AI Solutions</h2>
            <p>Start with these high-demand AI implementations that businesses are actively seeking.</p>
            <div className="popular-grid">
              {longtailKeywords
                .sort((a, b) => b.searchVolume - a.searchVolume)
                .slice(0, 6)
                .map(keyword => {
                  const category = categories[keyword.category];
                  return (
                    <Link 
                      key={keyword.id} 
                      to={`/ai/${keyword.slug}`} 
                      className="popular-item"
                    >
                      <div className="popular-icon" style={{color: category.color}}>
                        {category.icon}
                      </div>
                      <div className="popular-content">
                        <h4>{keyword.keyword}</h4>
                        <span className="popular-volume">{keyword.searchVolume.toLocaleString()} monthly searches</span>
                      </div>
                    </Link>
                  );
                })}
            </div>
          </div>
        </section>
      )}

      {/* CTA Section */}
      <section className="directory-cta">
        <div className="container">
          <div className="cta-content">
            <h2>Need Help Implementing AI in Your Business?</h2>
            <p>
              Our AI implementation experts have helped hundreds of small businesses 
              successfully adopt AI solutions. Get personalized guidance and avoid costly mistakes.
            </p>
            <div className="cta-buttons">
              <Link to="/contact" className="cta-primary">Schedule Free Consultation</Link>
              <Link to="/services" className="cta-secondary">View Our Services</Link>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default AILandingPagesDirectory;