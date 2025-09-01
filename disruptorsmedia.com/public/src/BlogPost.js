import React, { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import './BlogPost.css';
import { fetchBlogPostsFromSheet, fetchBlogPostsFromCSV } from './googleSheetsService';

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
      // First try to fetch from Google Sheets API
      let sheetsPosts = await fetchBlogPostsFromSheet();
      let sheetPost = sheetsPosts.find(p => p.id.toString() === id);
      
      if (sheetPost) {
        setPost(sheetPost);
        setLoading(false);
        return;
      }
      
      // If API fails, try CSV method
      sheetsPosts = await fetchBlogPostsFromCSV();
      sheetPost = sheetsPosts.find(p => p.id.toString() === id);
      
      if (sheetPost) {
        setPost(sheetPost);
        setLoading(false);
        return;
      }
      
      // Fallback to Laravel API
      const response = await fetch(`${apiUrl}/api/blog-posts/${id}`);
      const data = await response.json();
      setPost(data);
      setLoading(false);
    } catch (error) {
      console.error('Error fetching post:', error);
      // Use placeholder data if all methods fail
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

  const getPlaceholderPost = (postId) => {
    const posts = {
      5: {
        title: 'AI and the Creative Industry',
        featuredImage: '/images/blog/ai-creative-industry.png',
        category: 'Technology',
        content: `
          <p>Artificial Intelligence is revolutionizing the creative industry, transforming how we approach design, content creation, and artistic expression. This collaboration between human creativity and machine intelligence is opening new possibilities we never imagined.</p>
          
          <img src="/images/blog/ai-creative-industry.png" alt="AI and Creative Industry" style="width: 100%; margin: 20px 0; border-radius: 8px;" />
          
          <h2>The Human-AI Creative Partnership</h2>
          <p>Rather than replacing human creativity, AI serves as a powerful collaborator, enhancing our creative capabilities and enabling new forms of artistic expression.</p>
          
          <h2>Key Applications in Creative Fields</h2>
          <ul>
            <li><strong>Design Automation:</strong> AI assists in generating design variations and optimizing layouts</li>
            <li><strong>Content Generation:</strong> From copywriting to visual assets, AI helps scale creative output</li>
            <li><strong>Personalization:</strong> Creating tailored creative experiences for different audiences</li>
            <li><strong>Creative Analysis:</strong> Understanding what resonates with audiences through data-driven insights</li>
          </ul>
          
          <p>The future of creativity lies in understanding how to harness AI as a creative partner, amplifying human imagination and efficiency.</p>
        `,
        tags: ['AI', 'Creativity', 'Technology', 'Innovation']
      },
      3: {
        title: 'Design Thinking for Business Growth',
        featuredImage: '/images/blog/design-thinking-growth.png',
        category: 'Design',
        content: `
          <p>Design thinking is more than just a creative process—it's a strategic approach that can transform how businesses solve problems and drive growth.</p>
          
          <img src="/images/blog/design-thinking-growth.png" alt="Design Thinking for Business Growth" style="width: 100%; margin: 20px 0; border-radius: 8px;" />
          
          <h2>The Design Thinking Framework</h2>
          <p>This human-centered approach follows five key stages: Empathize, Define, Ideate, Prototype, and Test.</p>
          
          <h2>Business Growth Applications</h2>
          <ul>
            <li><strong>Customer Experience:</strong> Understanding and improving customer journeys</li>
            <li><strong>Product Innovation:</strong> Creating solutions that truly meet market needs</li>
            <li><strong>Process Optimization:</strong> Redesigning workflows for efficiency</li>
            <li><strong>Strategic Planning:</strong> Approaching business challenges with creative solutions</li>
          </ul>
          
          <p>By adopting design thinking principles, businesses can create more innovative solutions and stronger connections with their customers.</p>
        `,
        tags: ['Design Thinking', 'Business Growth', 'Innovation', 'Strategy']
      },
      7: {
        title: 'How Creative Branding & Strategy Transforms Small Businesses Into Market Leaders',
        featuredImage: '/images/blog/creative-branding-storytelling.png',
        category: 'Branding',
        content: `
          <p>In today's competitive marketplace, small businesses need more than just great products—they need powerful branding that sets them apart and positions them as market leaders.</p>
          
          <img src="/images/blog/creative-branding-storytelling.png" alt="Creative Branding Strategy" style="width: 100%; margin: 20px 0; border-radius: 8px;" />
          
          <h2>The Power of Strategic Branding</h2>
          <p>Creative branding goes beyond logos and color schemes. It's about crafting a compelling narrative that resonates with your target audience and differentiates you from competitors.</p>
          
          <h2>Key Elements of Transformative Branding</h2>
          <ul>
            <li><strong>Brand Positioning:</strong> Defining your unique place in the market</li>
            <li><strong>Visual Identity:</strong> Creating memorable and consistent visual elements</li>
            <li><strong>Brand Voice:</strong> Developing a distinctive communication style</li>
            <li><strong>Customer Experience:</strong> Ensuring every touchpoint reflects your brand values</li>
          </ul>
          
          <p>When done right, creative branding and strategy can transform small businesses into industry leaders and trusted authorities in their field.</p>
        `,
        tags: ['Branding', 'Strategy', 'Small Business', 'Market Leadership']
      },
      8: {
        title: 'The Power of Systems & Automations for Creatives Who Want More Time to Create',
        featuredImage: '/images/blog/systems-automations-creatives.png',
        category: 'Systems',
        content: `
          <p>As a creative professional, your time is your most valuable asset. Yet many creatives find themselves bogged down by administrative tasks, client management, and repetitive processes that drain their energy and stifle their creativity.</p>
          
          <img src="/images/blog/systems-automations-creatives.png" alt="Systems and Automations for Creatives" style="width: 100%; margin: 20px 0; border-radius: 8px;" />
          
          <h2>The Creative's Dilemma</h2>
          <p>Many talented creatives struggle to balance their artistic pursuits with the business side of their work. Systems and automation can be the key to reclaiming your creative time.</p>
          
          <h2>Essential Systems Every Creative Needs</h2>
          <ul>
            <li><strong>Client Onboarding:</strong> Streamlined processes for new client intake</li>
            <li><strong>Project Management:</strong> Organized workflows from concept to completion</li>
            <li><strong>Communication:</strong> Automated updates and client communication</li>
            <li><strong>Financial Management:</strong> Invoicing, payments, and expense tracking</li>
          </ul>
          
          <p>By implementing smart systems and automation, you can free up dozens of hours each week to focus on what you do best—creating amazing work.</p>
        `,
        tags: ['Systems', 'Automation', 'Productivity', 'Creative Business']
      },
      9: {
        title: 'How a 360 Marketing Agency Builds Revenue Streams You Never Knew Existed',
        featuredImage: '/images/blog/360-marketing-revenue-streams.png',
        category: 'Marketing',
        content: `
          <p>Traditional marketing agencies are evolving into comprehensive 360-degree marketing powerhouses, uncovering revenue opportunities that most businesses never realize exist.</p>
          
          <img src="/images/blog/360-marketing-revenue-streams.png" alt="360 Marketing Revenue Streams" style="width: 100%; margin: 20px 0; border-radius: 8px;" />
          
          <h2>Beyond Traditional Marketing Services</h2>
          <p>A true 360 marketing approach looks at every aspect of your business ecosystem to identify untapped revenue potential and growth opportunities.</p>
          
          <h2>Hidden Revenue Streams</h2>
          <ul>
            <li><strong>Data Monetization:</strong> Turning customer insights into profitable strategies</li>
            <li><strong>Partnership Opportunities:</strong> Strategic collaborations that create new income sources</li>
            <li><strong>Content Repurposing:</strong> Maximizing the value of every piece of content created</li>
            <li><strong>Community Building:</strong> Creating engaged audiences that drive long-term value</li>
          </ul>
          
          <p>By taking a holistic approach to marketing, businesses can discover multiple revenue streams they never knew existed, creating sustainable growth and competitive advantages.</p>
        `,
        tags: ['Marketing', 'Revenue Streams', 'Business Growth', '360 Marketing']
      }
    };
    
    const defaultPost = {
      id: postId,
      title: 'The Future of Digital Disruption',
      content: `
        <p>In today's rapidly evolving digital landscape, disruption has become the norm rather than the exception. Industries that once seemed untouchable are being transformed overnight by innovative technologies and forward-thinking companies.</p>
        
        <h2>Understanding Digital Disruption</h2>
        <p>Digital disruption refers to the change that occurs when new digital technologies and business models affect the value proposition of existing goods and services.</p>
        
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
    };
    
    const selectedPost = posts[postId] || defaultPost;
    return {
      ...selectedPost,
      id: postId,
      author: {
        name: 'Disruptors Media Team',
        avatar: 'https://via.placeholder.com/100x100/333/fff?text=DM',
        bio: 'Leading digital transformation and innovation strategies.'
      }
    };
  };

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
              {post.author && (
                <div className="blog-post-author">
                  <img src={post.author.avatar} alt={post.author.name} />
                  <div className="author-info">
                    <h4>{post.author.name}</h4>
                    <p>{post.author.bio}</p>
                  </div>
                </div>
              )}
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