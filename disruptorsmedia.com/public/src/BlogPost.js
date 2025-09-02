import React, { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import './BlogPost.css';
import { fetchBlogPostsFromSheet, fetchBlogPostsFromCSV } from './googleSheetsService';
import { fetchGoogleDocsContent, getOptimizedImageUrl } from './contentService';

const apiUrl = process.env.REACT_APP_BASE_URL;

const BlogPost = () => {
  const { id } = useParams();
  const [post, setPost] = useState(null);
  const [relatedPosts, setRelatedPosts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const fetchPost = async () => {
    try {
      setLoading(true);
      
      // Try to fetch from Google Sheets/CSV first
      let posts = [];
      try {
        posts = await fetchBlogPostsFromSheet();
        if (!posts || posts.length === 0) {
          posts = await fetchBlogPostsFromCSV();
        }
      } catch (err) {
        console.log('Using fallback data');
        posts = getFallbackPosts();
      }

      if (!posts || posts.length === 0) {
        posts = getFallbackPosts();
      }

      const foundPost = posts.find(p => p.id.toString() === id);
      
      if (!foundPost) {
        setError('Post not found');
        return;
      }

      // If post has Google Docs ID, fetch full content
      let fullPost = { ...foundPost };
      if (foundPost.googleDocsId) {
        try {
          const docContent = await fetchGoogleDocsContent(foundPost.googleDocsId);
          if (docContent && docContent.content) {
            fullPost.content = docContent.content;
            if (docContent.title) fullPost.title = docContent.title;
          }
        } catch (err) {
          console.log('Could not fetch Google Docs content, using fallback');
        }
      }

      setPost(fullPost);
    } catch (err) {
      console.error('Error fetching post:', err);
      setError('Error loading post');
    } finally {
      setLoading(false);
    }
  };

  const fetchRelatedPosts = async () => {
    try {
      let posts = [];
      try {
        posts = await fetchBlogPostsFromSheet();
        if (!posts || posts.length === 0) {
          posts = await fetchBlogPostsFromCSV();
        }
      } catch (err) {
        posts = getFallbackPosts();
      }

      if (!posts || posts.length === 0) {
        posts = getFallbackPosts();
      }

      // Get 2 random related posts (excluding current post)
      const otherPosts = posts.filter(p => p.id.toString() !== id);
      const shuffled = otherPosts.sort(() => 0.5 - Math.random());
      setRelatedPosts(shuffled.slice(0, 2));
    } catch (err) {
      console.error('Error fetching related posts:', err);
    }
  };

  useEffect(() => {
    if (id) {
      fetchPost();
      fetchRelatedPosts();
    }
  }, [id]);

  const getFallbackPosts = () => [
    {
      id: 1,
      title: "The Future of AI in Digital Marketing",
      content: `
        <h2>Introduction</h2>
        <p>Artificial Intelligence is revolutionizing the digital marketing landscape at an unprecedented pace. From automated content creation to predictive analytics, AI tools are becoming essential for modern marketing strategies.</p>
        
        <h2>Key Areas of Impact</h2>
        <p>AI is transforming several critical areas of digital marketing:</p>
        <ul>
          <li><strong>Content Generation</strong> - Automated blog posts, social media content, and email campaigns</li>
          <li><strong>Customer Segmentation</strong> - Advanced targeting based on behavior patterns</li>
          <li><strong>Predictive Analytics</strong> - Forecasting customer lifetime value and churn rates</li>
          <li><strong>Personalization</strong> - Dynamic website content and product recommendations</li>
        </ul>
        
        <h2>Implementation Strategies</h2>
        <p>To successfully integrate AI into your marketing workflow, consider these approaches:</p>
        <ol>
          <li>Start with simple automation tools for repetitive tasks</li>
          <li>Invest in data quality and collection systems</li>
          <li>Train your team on AI tool capabilities and limitations</li>
          <li>Measure ROI and iterate on your AI implementations</li>
        </ol>
        
        <blockquote>
          "AI doesn't replace marketers—it amplifies their capabilities and allows them to focus on strategy and creativity."
        </blockquote>
        
        <h2>Looking Forward</h2>
        <p>The future of AI in marketing will be characterized by even more sophisticated personalization, real-time optimization, and seamless integration across all customer touchpoints.</p>
      `,
      excerpt: "Discover how AI is transforming digital marketing strategies and what it means for businesses in 2024.",
      author: "Marketing Team",
      date: "2024-01-15",
      category: "Technology",
      tags: ["AI", "Digital Marketing", "Automation"],
      readTime: "5 min",
      image: "/images/ai-marketing.jpg"
    },
    {
      id: 2,
      title: "Building Effective Brand Stories",
      content: `
        <h2>The Power of Narrative</h2>
        <p>Every successful brand has a compelling story at its core. These narratives connect with audiences on an emotional level and create lasting impressions that go far beyond product features or pricing.</p>
        
        <h2>Elements of Great Brand Stories</h2>
        <p>Effective brand storytelling incorporates several key elements:</p>
        
        <h3>Authenticity</h3>
        <p>Your story must be genuine and reflect real values. Customers can easily detect inauthentic messaging, which can damage trust and credibility.</p>
        
        <h3>Emotional Connection</h3>
        <p>The best brand stories evoke emotions—whether it's inspiration, nostalgia, excitement, or empathy. Emotional connections drive purchase decisions more than rational arguments.</p>
        
        <h3>Clear Purpose</h3>
        <p>Define why your brand exists beyond making profit. What problem do you solve? What change do you want to create in the world?</p>
        
        <blockquote>
          "People don't buy what you do; they buy why you do it."
        </blockquote>
        
        <h2>Crafting Your Narrative</h2>
        <p>Follow this framework to develop your brand story:</p>
        <ol>
          <li><strong>Origin</strong> - How and why did your brand start?</li>
          <li><strong>Challenge</strong> - What obstacles have you overcome?</li>
          <li><strong>Values</strong> - What principles guide your decisions?</li>
          <li><strong>Impact</strong> - How do you make a difference?</li>
          <li><strong>Future</strong> - Where are you headed next?</li>
        </ol>
      `,
      excerpt: "Learn how to craft compelling brand narratives that resonate with your target audience.",
      author: "Creative Team",
      date: "2024-01-12",
      category: "Branding",
      tags: ["Branding", "Storytelling", "Content Strategy"],
      readTime: "4 min",
      image: "/images/brand-story.jpg"
    }
  ];

  const copyLink = () => {
    navigator.clipboard.writeText(window.location.href);
  };

  if (loading) {
    return (
      <div className="blog-post-page">
        <div className="container">
          <div style={{ padding: '2rem', textAlign: 'center' }}>
            Loading...
          </div>
        </div>
      </div>
    );
  }

  if (error || !post) {
    return (
      <div className="blog-post-page">
        <div className="container">
          <div style={{ padding: '2rem', textAlign: 'center' }}>
            <h2>Post not found</h2>
            <Link to="/blog">← Back to Blog</Link>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="blog-post-page">
      <div className="container">
        <header className="blog-post-header">
          <Link to="/blog" className="back-to-blog">
            ← Back to Blog
          </Link>
          
          <h1 className="blog-post-title">{post.title}</h1>
          
          <div className="blog-post-meta">
            {post.category && (
              <div className="meta-item">
                <span className="category-tag">{post.category}</span>
              </div>
            )}
            {post.author && (
              <div className="meta-item">
                <span>By {post.author}</span>
              </div>
            )}
            {post.date && (
              <div className="meta-item">
                <span>{new Date(post.date).toLocaleDateString()}</span>
              </div>
            )}
            {post.readTime && (
              <div className="meta-item">
                <span>{post.readTime} read</span>
              </div>
            )}
          </div>
        </header>

        <main className="blog-post-content">
          <div 
            dangerouslySetInnerHTML={{ 
              __html: post.content || post.excerpt || 'Content not available.' 
            }} 
          />
        </main>

        <footer className="action-bar">
          <button onClick={copyLink} className="action-button">
            🔗 Copy Link
          </button>
          <Link to="/blog" className="action-button">
            📚 More Articles
          </Link>
        </footer>

        {relatedPosts.length > 0 && (
          <section className="related-posts">
            <h3>Related Articles</h3>
            <div className="related-posts-grid">
              {relatedPosts.map(relatedPost => (
                <Link
                  key={relatedPost.id}
                  to={`/blog/${relatedPost.id}`}
                  className="related-post-card"
                >
                  <div className="related-post-title">{relatedPost.title}</div>
                  <div className="related-post-excerpt">
                    {relatedPost.excerpt?.substring(0, 100)}...
                  </div>
                </Link>
              ))}
            </div>
          </section>
        )}
      </div>
    </div>
  );
};

export default BlogPost;