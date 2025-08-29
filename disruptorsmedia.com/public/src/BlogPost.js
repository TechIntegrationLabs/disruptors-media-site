import React, { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import './BlogPost.css';

const apiUrl = process.env.REACT_APP_BASE_URL;

const BlogPost = () => {
  const { id } = useParams();
  const [post, setPost] = useState(null);
  const [loading, setLoading] = useState(true);
  const [relatedPosts, setRelatedPosts] = useState([]);

  useEffect(() => {
    fetchPost();
    fetchRelatedPosts();
    window.scrollTo(0, 0);
  }, [id]);

  const fetchPost = async () => {
    try {
      const response = await fetch(`${apiUrl}/api/blog-posts/${id}`);
      const data = await response.json();
      setPost(data);
      setLoading(false);
    } catch (error) {
      console.error('Error fetching post:', error);
      // Use placeholder data if API fails
      setPost(getPlaceholderPost(id));
      setLoading(false);
    }
  };

  const fetchRelatedPosts = async () => {
    try {
      const response = await fetch(`${apiUrl}/api/blog-posts/${id}/related`);
      const data = await response.json();
      setRelatedPosts(data);
    } catch (error) {
      console.error('Error fetching related posts:', error);
      setRelatedPosts(getPlaceholderRelatedPosts());
    }
  };

  const getPlaceholderPost = (postId) => ({
    id: postId,
    title: 'The Future of Digital Disruption',
    content: `
      <p>In today's rapidly evolving digital landscape, disruption has become the norm rather than the exception. Industries that once seemed untouchable are being transformed overnight by innovative technologies and forward-thinking companies.</p>
      
      <h2>Understanding Digital Disruption</h2>
      <p>Digital disruption refers to the change that occurs when new digital technologies and business models affect the value proposition of existing goods and services. It's a phenomenon that has reshaped entire industries, from transportation with Uber to hospitality with Airbnb.</p>
      
      <blockquote>
        "The greatest danger in times of turbulence is not the turbulence itself, but to act with yesterday's logic." - Peter Drucker
      </blockquote>
      
      <h2>Key Technologies Driving Disruption</h2>
      <p>Several technologies are at the forefront of digital disruption:</p>
      <ul>
        <li><strong>Artificial Intelligence and Machine Learning:</strong> Automating complex tasks and providing insights from vast amounts of data</li>
        <li><strong>Internet of Things (IoT):</strong> Connecting physical devices to create smart ecosystems</li>
        <li><strong>Blockchain:</strong> Revolutionizing trust and transparency in digital transactions</li>
        <li><strong>5G Networks:</strong> Enabling faster, more reliable connectivity for emerging technologies</li>
      </ul>
      
      <h2>Preparing for the Future</h2>
      <p>To thrive in this era of disruption, businesses must:</p>
      <ol>
        <li>Embrace a culture of continuous innovation</li>
        <li>Invest in digital transformation initiatives</li>
        <li>Focus on customer-centric solutions</li>
        <li>Build agile and adaptable organizational structures</li>
        <li>Foster partnerships with technology innovators</li>
      </ol>
      
      <p>The future belongs to those who can anticipate change and adapt quickly. By understanding the forces of digital disruption and positioning themselves strategically, businesses can turn potential threats into opportunities for growth and innovation.</p>
    `,
    featuredImage: 'https://via.placeholder.com/1200x600/1a1a1a/ffffff?text=Blog+Post+Featured+Image',
    category: 'Technology',
    author: {
      name: 'Disruptors Media Team',
      avatar: 'https://via.placeholder.com/100x100/333/fff?text=DM',
      bio: 'Leading digital transformation and innovation strategies.'
    },
    date: '2024-01-15',
    readTime: '8 min read',
    tags: ['Digital Transformation', 'Innovation', 'Technology', 'Business Strategy']
  });

  const getPlaceholderRelatedPosts = () => [
    {
      id: 2,
      title: 'AI and the Creative Industry',
      excerpt: 'Understanding the impact of artificial intelligence on creative processes.',
      image: 'https://via.placeholder.com/400x300/2a2a2a/ffffff?text=Related+Post+1',
      category: 'Technology',
      date: '2024-01-12'
    },
    {
      id: 3,
      title: 'Building Resilient Business Strategies',
      excerpt: 'How to create adaptable strategies for uncertain times.',
      image: 'https://via.placeholder.com/400x300/3a3a3a/ffffff?text=Related+Post+2',
      category: 'Strategy',
      date: '2024-01-10'
    },
    {
      id: 4,
      title: 'The Power of Visual Storytelling',
      excerpt: 'Creating memorable brand experiences through visual content.',
      image: 'https://via.placeholder.com/400x300/4a4a4a/ffffff?text=Related+Post+3',
      category: 'Design',
      date: '2024-01-08'
    }
  ];

  const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
  };

  if (loading) {
    return (
      <div className="blog-loading">
        <div className="loader"></div>
      </div>
    );
  }

  if (!post) {
    return (
      <div className="blog-error">
        <h2>Post not found</h2>
        <Link to="/blog">Back to Blog</Link>
      </div>
    );
  }

  return (
    <div className="blog-post-page">
      {/* Hero Section */}
      <section className="blog-post-hero">
        <div className="blog-post-hero-image">
          <img src={post.featuredImage} alt={post.title} />
          <div className="blog-post-hero-overlay"></div>
        </div>
        <div className="blog-post-hero-content">
          <div className="container">
            <Link to="/blog" className="back-to-blog">← Back to Blog</Link>
            <div className="blog-post-category">{post.category}</div>
            <h1 className="blog-post-title">{post.title}</h1>
            <div className="blog-post-meta">
              <span>{formatDate(post.date)}</span>
              <span>•</span>
              <span>{post.readTime}</span>
            </div>
          </div>
        </div>
      </section>

      {/* Content Section */}
      <section className="blog-post-content-section">
        <div className="container">
          <div className="blog-post-layout">
            {/* Main Content */}
            <article className="blog-post-content">
              <div 
                className="blog-post-body"
                dangerouslySetInnerHTML={{ __html: post.content }}
              />
              
              {/* Tags */}
              {post.tags && post.tags.length > 0 && (
                <div className="blog-post-tags">
                  <h3>Tags:</h3>
                  <div className="tags-list">
                    {post.tags.map((tag, index) => (
                      <span key={index} className="tag">{tag}</span>
                    ))}
                  </div>
                </div>
              )}
              
              {/* Author Box */}
              <div className="blog-post-author">
                <img src={post.author.avatar} alt={post.author.name} />
                <div className="author-info">
                  <h4>{post.author.name}</h4>
                  <p>{post.author.bio}</p>
                </div>
              </div>
            </article>

            {/* Sidebar */}
            <aside className="blog-post-sidebar">
              {/* Share Section */}
              <div className="sidebar-section share-section">
                <h3>Share This Post</h3>
                <div className="share-buttons">
                  <button className="share-button" onClick={() => window.open(`https://twitter.com/intent/tweet?url=${window.location.href}&text=${post.title}`, '_blank')}>
                    Twitter
                  </button>
                  <button className="share-button" onClick={() => window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${window.location.href}`, '_blank')}>
                    LinkedIn
                  </button>
                  <button className="share-button" onClick={() => navigator.clipboard.writeText(window.location.href)}>
                    Copy Link
                  </button>
                </div>
              </div>

              {/* Newsletter */}
              <div className="sidebar-section newsletter-section">
                <h3>Stay Updated</h3>
                <p>Get the latest insights delivered to your inbox</p>
                <form className="sidebar-newsletter-form" onSubmit={(e) => e.preventDefault()}>
                  <input 
                    type="email" 
                    placeholder="Your email" 
                    className="sidebar-newsletter-input"
                  />
                  <button type="submit" className="sidebar-newsletter-button">Subscribe</button>
                </form>
              </div>
            </aside>
          </div>
        </div>
      </section>

      {/* Related Posts */}
      {relatedPosts.length > 0 && (
        <section className="related-posts-section">
          <div className="container">
            <h2 className="related-posts-title">Related Articles</h2>
            <div className="related-posts-grid">
              {relatedPosts.map(relatedPost => (
                <Link 
                  key={relatedPost.id} 
                  to={`/blog/${relatedPost.id}`}
                  className="related-post-card"
                >
                  <div className="related-post-image">
                    <img src={relatedPost.image} alt={relatedPost.title} />
                  </div>
                  <div className="related-post-content">
                    <span className="related-post-category">{relatedPost.category}</span>
                    <h3>{relatedPost.title}</h3>
                    <p>{relatedPost.excerpt}</p>
                    <span className="related-post-date">{formatDate(relatedPost.date)}</span>
                  </div>
                </Link>
              ))}
            </div>
          </div>
        </section>
      )}
    </div>
  );
};

export default BlogPost;