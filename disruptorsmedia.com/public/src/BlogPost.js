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

      // If post has Google Docs ID, try to fetch full content
      let fullPost = { ...foundPost };
      if (foundPost.googleDocsId || foundPost.postUrl || foundPost.content?.includes('docs.google.com')) {
        try {
          const googleDocsUrl = foundPost.googleDocsId || foundPost.postUrl || foundPost.content;
          console.log('Attempting to fetch Google Docs content from:', googleDocsUrl);
          const docContent = await fetchGoogleDocsContent(googleDocsUrl);
          if (docContent && docContent.html) {
            fullPost.content = docContent.html;
            if (docContent.title) fullPost.title = docContent.title;
          }
        } catch (err) {
          console.error('Could not fetch Google Docs content:', err);
          // Use fallback content if available
          const fallbackPost = getFallbackPosts().find(p => p.id === parseInt(id));
          if (fallbackPost) {
            fullPost = { ...fullPost, ...fallbackPost };
          }
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
      title: "Why Content Creation Services Are Your Business's Secret Weapon for Growth",
      content: `
        <h2>The Power of Professional Content Creation</h2>
        <p>In today's digital landscape, content isn't just king—it's the entire kingdom. Yet, many businesses struggle to maintain a consistent content strategy that drives real results. That's where professional content creation services become your secret weapon for sustainable growth.</p>
        
        <h2>Why Content Creation Matters More Than Ever</h2>
        <p>The statistics are compelling: businesses that blog receive 55% more website visitors and generate 67% more leads than those that don't. But here's the catch—creating high-quality, consistent content requires expertise, time, and resources that many businesses simply don't have.</p>
        
        <h3>The Content Consistency Challenge</h3>
        <p>Most businesses start strong with content creation but quickly face common obstacles:</p>
        <ul>
          <li><strong>Time constraints</strong> - Your team is already stretched thin with core business activities</li>
          <li><strong>Expertise gaps</strong> - Writing compelling content requires specific skills</li>
          <li><strong>Strategy alignment</strong> - Random content won't move the needle</li>
          <li><strong>Resource allocation</strong> - Hiring full-time writers is expensive</li>
        </ul>
        
        <h2>How Professional Content Services Transform Your Business</h2>
        <p>When you partner with content creation experts, you're not just outsourcing writing—you're investing in a growth engine that works 24/7 to attract, engage, and convert your ideal customers.</p>
        
        <h3>1. Strategic Content Planning</h3>
        <p>Professional services begin with understanding your business goals, target audience, and competitive landscape. This strategic foundation ensures every piece of content serves a purpose in your growth journey.</p>
        
        <h3>2. Consistent Quality & Voice</h3>
        <p>Maintaining brand consistency across all content touchpoints is crucial. Professional writers develop and maintain your unique brand voice, ensuring every piece reinforces your market position.</p>
        
        <h3>3. SEO-Optimized Content That Ranks</h3>
        <p>Creating content that both humans and search engines love is an art and science. Professional services combine keyword research, user intent analysis, and engaging storytelling to boost your organic visibility.</p>
        
        <h3>4. Multi-Channel Content Strategy</h3>
        <p>From blog posts and social media to email campaigns and video scripts, professional services create cohesive content across all channels, maximizing your reach and impact.</p>
        
        <blockquote>
          "Companies that prioritize content marketing experience 6x higher conversion rates than those that don't. It's not about creating more content—it's about creating the right content."
        </blockquote>
        
        <h2>The ROI of Professional Content Creation</h2>
        <p>Investing in professional content services delivers measurable returns:</p>
        <ul>
          <li><strong>Increased organic traffic</strong> - Quality content attracts more qualified visitors</li>
          <li><strong>Higher engagement rates</strong> - Professional content keeps audiences coming back</li>
          <li><strong>Improved conversion rates</strong> - Strategic content guides buyers through their journey</li>
          <li><strong>Enhanced brand authority</strong> - Consistent thought leadership builds trust</li>
        </ul>
        
        <h2>Making the Strategic Decision</h2>
        <p>The question isn't whether you need content—it's whether you're creating content that actually drives business growth. Professional content creation services transform your marketing from a cost center to a revenue generator.</p>
        
        <p>Ready to unlock your business's growth potential? The secret weapon of successful businesses isn't just having content—it's having the right content, created by professionals who understand both your industry and the art of persuasion.</p>
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