import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import './Blog.css';
import { fetchBlogPostsFromSheet, fetchBlogPostsFromCSV } from './googleSheetsService';

const apiUrl = process.env.REACT_APP_BASE_URL;

const Blog = () => {
  const [posts, setPosts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [categories, setCategories] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState('all');

  useEffect(() => {
    fetchPosts();
    fetchCategories();
  }, []);

  const fetchPosts = async () => {
    try {
      // First try to fetch from Google Sheets API
      let sheetsPosts = await fetchBlogPostsFromSheet();
      
      if (sheetsPosts && sheetsPosts.length > 0) {
        setPosts(sheetsPosts);
        setLoading(false);
        return;
      }
      
      // If API fails, try CSV method
      sheetsPosts = await fetchBlogPostsFromCSV();
      
      if (sheetsPosts && sheetsPosts.length > 0) {
        setPosts(sheetsPosts);
        setLoading(false);
        return;
      }
      
      // Fallback to Laravel API
      const response = await fetch(`${apiUrl}/api/blog-posts`);
      const data = await response.json();
      setPosts(data);
      setLoading(false);
    } catch (error) {
      console.error('Error fetching posts:', error);
      // Use placeholder data if all methods fail
      setPosts(placeholderPosts);
      setLoading(false);
    }
  };

  const fetchCategories = async () => {
    try {
      const response = await fetch(`${apiUrl}/api/blog-categories`);
      const data = await response.json();
      setCategories(data);
    } catch (error) {
      console.error('Error fetching categories:', error);
      setCategories(placeholderCategories);
    }
  };

  const placeholderCategories = [
    { id: 'all', name: 'All' },
    { id: 'technology', name: 'Technology' },
    { id: 'marketing', name: 'Marketing' },
    { id: 'design', name: 'Design' },
    { id: 'strategy', name: 'Strategy' },
    { id: 'branding', name: 'Branding' },
    { id: 'systems', name: 'Systems' }
  ];

  // Single blog post dated from last Friday
  const placeholderPosts = [
    {
      id: 7,
      title: 'How Creative Branding & Strategy Transforms Small Businesses Into Market Leaders',
      excerpt: 'Discover how strategic branding can elevate your small business and create market leadership through creative positioning. Learn the proven strategies that turn small businesses into industry leaders through innovative branding approaches.',
      image: '/images/blog/creative-branding-storytelling.png',
      category: 'branding',
      author: 'Disruptors Media',
      date: '2025-08-29',
      readTime: '8 min read'
    }
  ];

  const filteredPosts = selectedCategory === 'all' 
    ? posts 
    : posts.filter(post => post.category === selectedCategory);

  if (loading) {
    return (
      <div className="blog-loading">
        <div className="loader"></div>
      </div>
    );
  }

  return (
    <div className="blog-page">
      {/* Hero Section */}
      <section className="blog-hero">
        <div className="container">
          <h1 className="blog-title">Insights & Ideas</h1>
          <p className="blog-subtitle">
            Explore our latest thoughts on technology, design, and digital disruption
          </p>
        </div>
      </section>

      {/* Category Filter */}
      <section className="blog-filter">
        <div className="container">
          <div className="filter-tabs">
            {categories.map(category => (
              <button
                key={category.id}
                className={`filter-tab ${selectedCategory === category.id ? 'active' : ''}`}
                onClick={() => setSelectedCategory(category.id)}
              >
                {category.name}
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* Blog Grid */}
      <section className="blog-grid-section">
        <div className="container">
          <div className="blog-grid">
            {filteredPosts.map(post => (
              <article key={post.id} className="blog-card">
                <Link to={`/blog/${post.id}`} className="blog-card-link">
                  <div className="blog-card-image">
                    <img src={post.image} alt={post.title} />
                    <div className="blog-card-category">{post.category}</div>
                  </div>
                  <div className="blog-card-content">
                    <h3 className="blog-card-title">{post.title}</h3>
                    <p className="blog-card-excerpt">{post.excerpt}</p>
                    <div className="blog-card-meta">
                      <span className="blog-card-author">{post.author}</span>
                      <span className="blog-card-date">{formatDate(post.date)}</span>
                      <span className="blog-card-read-time">{post.readTime}</span>
                    </div>
                  </div>
                </Link>
              </article>
            ))}
          </div>
        </div>
      </section>

      {/* Newsletter Section */}
      <section className="blog-newsletter">
        <div className="container">
          <div className="newsletter-content">
            <h2>Stay Updated</h2>
            <p>Get the latest insights delivered to your inbox</p>
            <form className="newsletter-form" onSubmit={(e) => e.preventDefault()}>
              <input 
                type="email" 
                placeholder="Enter your email" 
                className="newsletter-input"
              />
              <button type="submit" className="newsletter-button">Subscribe</button>
            </form>
          </div>
        </div>
      </section>
    </div>
  );
};

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString(undefined, options);
};

export default Blog;