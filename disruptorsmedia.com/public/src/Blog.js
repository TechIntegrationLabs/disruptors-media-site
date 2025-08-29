import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import './Blog.css';

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
      const response = await fetch(`${apiUrl}/api/blog-posts`);
      const data = await response.json();
      setPosts(data);
      setLoading(false);
    } catch (error) {
      console.error('Error fetching posts:', error);
      // Use placeholder data if API fails
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
    { id: 'strategy', name: 'Strategy' }
  ];

  const placeholderPosts = [
    {
      id: 1,
      title: 'The Future of Digital Disruption',
      excerpt: 'Exploring how emerging technologies are reshaping industries and creating new opportunities for innovation.',
      image: 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Blog+Post+1',
      category: 'technology',
      author: 'Disruptors Media',
      date: '2024-01-15',
      readTime: '5 min read'
    },
    {
      id: 2,
      title: 'Mastering Content Marketing in 2024',
      excerpt: 'Learn the latest strategies and techniques for creating compelling content that drives engagement and conversions.',
      image: 'https://via.placeholder.com/800x600/2a2a2a/ffffff?text=Blog+Post+2',
      category: 'marketing',
      author: 'Disruptors Media',
      date: '2024-01-12',
      readTime: '7 min read'
    },
    {
      id: 3,
      title: 'Design Thinking for Business Growth',
      excerpt: 'How design thinking principles can transform your approach to problem-solving and innovation.',
      image: 'https://via.placeholder.com/800x600/3a3a3a/ffffff?text=Blog+Post+3',
      category: 'design',
      author: 'Disruptors Media',
      date: '2024-01-10',
      readTime: '6 min read'
    },
    {
      id: 4,
      title: 'Building Resilient Business Strategies',
      excerpt: 'Discover how to create adaptable strategies that help your business thrive in uncertain times.',
      image: 'https://via.placeholder.com/800x600/4a4a4a/ffffff?text=Blog+Post+4',
      category: 'strategy',
      author: 'Disruptors Media',
      date: '2024-01-08',
      readTime: '8 min read'
    },
    {
      id: 5,
      title: 'AI and the Creative Industry',
      excerpt: 'Understanding the impact of artificial intelligence on creative processes and content creation.',
      image: 'https://via.placeholder.com/800x600/5a5a5a/ffffff?text=Blog+Post+5',
      category: 'technology',
      author: 'Disruptors Media',
      date: '2024-01-05',
      readTime: '6 min read'
    },
    {
      id: 6,
      title: 'The Power of Visual Storytelling',
      excerpt: 'How to use visual content to create memorable brand experiences and connect with your audience.',
      image: 'https://via.placeholder.com/800x600/6a6a6a/ffffff?text=Blog+Post+6',
      category: 'design',
      author: 'Disruptors Media',
      date: '2024-01-03',
      readTime: '5 min read'
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