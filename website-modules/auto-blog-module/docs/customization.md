# Customization Guide

## Overview

The Auto-Blog Module is designed to be highly customizable to match any brand or design system. This guide covers all customization options from basic styling to advanced functionality.

## 🎨 Visual Customization

### CSS Custom Properties

The module uses CSS custom properties (variables) for easy theming. Override these in your main stylesheet:

```css
:root {
  /* Colors */
  --blog-primary-color: #ffffff;
  --blog-secondary-color: #999999;
  --blog-accent-color: #ff6b6b;
  --blog-text-color: #e0e0e0;
  --blog-background: url('./images/your-bg.jpg') repeat;
  --blog-card-background: rgba(255, 255, 255, 0.05);
  --blog-card-hover-background: rgba(255, 255, 255, 0.1);
  
  /* Typography */
  --blog-font-family: 'Your Font', sans-serif;
  --blog-title-font: 'Your Title Font', serif;
  --blog-title-size: 2.5rem;
  --blog-subtitle-size: 1.3rem;
  --blog-text-size: 1.1rem;
  --blog-small-text-size: 0.95rem;
  
  /* Spacing */
  --blog-container-padding: 40px;
  --blog-card-gap: 40px;
  --blog-content-width: 1400px;
  --blog-border-radius: 12px;
  
  /* Effects */
  --blog-blur-amount: 10px;
  --blog-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
  --blog-transition: 0.3s ease;
}
```

### Brand Colors

#### Example: Corporate Blue Theme
```css
:root {
  --blog-primary-color: #2563eb;
  --blog-secondary-color: #64748b;
  --blog-accent-color: #3b82f6;
  --blog-card-background: rgba(37, 99, 235, 0.1);
  --blog-background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
}
```

#### Example: Warm Creative Theme
```css
:root {
  --blog-primary-color: #f59e0b;
  --blog-secondary-color: #78716c;
  --blog-accent-color: #f97316;
  --blog-card-background: rgba(245, 158, 11, 0.1);
  --blog-background: radial-gradient(ellipse at center, #292524 0%, #1c1917 100%);
}
```

### Typography Customization

#### Custom Font Integration
```css
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

:root {
  --blog-font-family: 'Inter', sans-serif;
  --blog-title-font: 'Inter', sans-serif;
}

/* Override specific elements */
.blog-post-title {
  font-family: var(--blog-title-font);
  font-weight: 700;
  letter-spacing: -0.02em;
}

.blog-post-body {
  font-family: var(--blog-font-family);
  line-height: 1.7;
}
```

### Layout Customization

#### Grid Layout Options
```css
/* 2-column layout */
.blog-grid {
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
}

/* 3-column layout */
.blog-grid {
  grid-template-columns: repeat(3, 1fr);
  gap: 40px;
}

/* Masonry-style layout */
.blog-grid {
  columns: 3;
  column-gap: 40px;
}

.blog-card {
  display: inline-block;
  width: 100%;
  margin-bottom: 40px;
  break-inside: avoid;
}
```

#### Card Styles
```css
/* Minimal card style */
.blog-card {
  background: transparent;
  border: 1px solid var(--blog-secondary-color);
  backdrop-filter: none;
}

/* Glass morphism effect */
.blog-card {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

/* Solid color cards */
.blog-card {
  background: var(--blog-card-background);
  backdrop-filter: none;
  box-shadow: var(--blog-shadow);
}
```

## 🔧 Functional Customization

### Component Configuration

#### Blog Listing Component
```jsx
// Blog.js customization options
const BlogConfig = {
  postsPerPage: 9,           // Number of posts to show
  showExcerpt: true,         // Show/hide excerpt
  showAuthor: true,          // Show/hide author info
  showReadTime: true,        // Show/hide read time
  showCategories: true,      // Show/hide category filter
  defaultCategory: 'all',    // Default category selection
  loadingText: 'Loading posts...',
  emptyStateText: 'No posts found.',
};
```

#### Blog Post Component
```jsx
// BlogPost.js customization options
const BlogPostConfig = {
  showBackButton: true,      // Show/hide back to blog button
  showShareButtons: true,    // Show/hide social share
  showRelatedPosts: true,    // Show/hide related posts section
  showTableOfContents: false, // Show/hide TOC for long posts
  enableComments: false,     // Enable comment system
  showPublishDate: true,     // Show/hide publish date
  showLastModified: false,   // Show/hide last modified date
};
```

### Google Sheets Customization

#### Custom Column Mapping
```javascript
// In googleSheetsService.js
const columnIndices = {
  title: headers.findIndex(h => h.toLowerCase() === 'title'),
  content: headers.findIndex(h => h.toLowerCase() === 'content'),
  image: headers.findIndex(h => h.toLowerCase() === 'featured_image'),
  postDate: headers.findIndex(h => h.toLowerCase() === 'publish_date'),
  
  // Additional custom columns
  category: headers.findIndex(h => h.toLowerCase() === 'category'),
  author: headers.findIndex(h => h.toLowerCase() === 'author'),
  tags: headers.findIndex(h => h.toLowerCase() === 'tags'),
  metaDescription: headers.findIndex(h => h.toLowerCase() === 'meta_description'),
  featured: headers.findIndex(h => h.toLowerCase() === 'featured'),
  status: headers.findIndex(h => h.toLowerCase() === 'status'),
};
```

#### Advanced Filtering
```javascript
// Custom post filtering logic
const shouldInclude = (row, columnIndices) => {
  const publishDate = new Date(row[columnIndices.postDate] || '');
  const today = new Date();
  const status = row[columnIndices.status] || '';
  const featured = row[columnIndices.featured] || '';
  
  // Your custom logic
  return publishDate <= today && 
         status.toLowerCase() === 'published' &&
         row[columnIndices.title]?.trim();
};
```

### Content Processing

#### Custom Content Cleanup
```javascript
// In contentService.js
const cleanupGoogleDocsHTML = (html) => {
  let cleaned = html;
  
  // Your custom cleanup rules
  cleaned = cleaned.replace(/class="c\d+"/g, ''); // Remove Google Docs classes
  cleaned = cleaned.replace(/<p[^>]*><span[^>]*><\/span><\/p>/g, ''); // Remove empty paragraphs
  
  // Add custom styling classes
  cleaned = cleaned.replace(/<h1[^>]*>/g, '<h1 class="custom-h1">');
  cleaned = cleaned.replace(/<h2[^>]*>/g, '<h2 class="custom-h2">');
  cleaned = cleaned.replace(/<p[^>]*>/g, '<p class="custom-paragraph">');
  
  // Custom transformations
  cleaned = cleaned.replace(/\[HIGHLIGHT\](.*?)\[\/HIGHLIGHT\]/g, '<mark class="custom-highlight">$1</mark>');
  cleaned = cleaned.replace(/\[BUTTON\](.*?)\[\/BUTTON\]/g, '<button class="custom-button">$1</button>');
  
  return cleaned;
};
```

#### Image Processing
```javascript
// Custom image optimization
const getOptimizedImageUrl = (url, width = 800, height = 600, quality = 'auto') => {
  if (!url) return '/images/blog/placeholder.png';
  
  // Cloudinary transformations
  if (url.includes('cloudinary.com')) {
    const transformations = [
      `w_${width}`,
      `h_${height}`,
      `c_fill`,
      `q_${quality}`,
      `f_auto`,
      'dpr_auto' // Automatic device pixel ratio
    ].join(',');
    
    return url.replace('/upload/', `/upload/${transformations}/`);
  }
  
  // Other CDN optimizations
  if (url.includes('your-cdn.com')) {
    return `${url}?w=${width}&h=${height}&q=${quality}`;
  }
  
  return url;
};
```

## 🎯 Client-Specific Customizations

### Law Firm Theme
```css
:root {
  --blog-primary-color: #1f2937;
  --blog-secondary-color: #6b7280;
  --blog-accent-color: #d59e0b;
  --blog-font-family: 'Playfair Display', serif;
  --blog-card-background: rgba(31, 41, 55, 0.9);
}

.blog-card {
  border-left: 4px solid var(--blog-accent-color);
}

.blog-post-category {
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 0.1em;
}
```

### Creative Agency Theme
```css
:root {
  --blog-primary-color: #ec4899;
  --blog-secondary-color: #a855f7;
  --blog-accent-color: #06b6d4;
  --blog-font-family: 'Space Grotesk', sans-serif;
  --blog-card-background: linear-gradient(135deg, rgba(236, 72, 153, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%);
}

.blog-card:hover {
  transform: rotate(1deg) scale(1.02);
}
```

### Tech Startup Theme
```css
:root {
  --blog-primary-color: #10b981;
  --blog-secondary-color: #374151;
  --blog-accent-color: #3b82f6;
  --blog-font-family: 'JetBrains Mono', monospace;
  --blog-card-background: rgba(16, 185, 129, 0.1);
  --blog-border-radius: 4px;
}

.blog-card {
  border: 1px solid var(--blog-primary-color);
}

.blog-post-title::before {
  content: '> ';
  color: var(--blog-primary-color);
}
```

## 🔌 Advanced Features

### Search Functionality
```jsx
// Add to Blog component
const [searchTerm, setSearchTerm] = useState('');

const filteredPosts = posts.filter(post => 
  post.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
  post.excerpt.toLowerCase().includes(searchTerm.toLowerCase())
);

// In JSX
<input 
  type="text"
  placeholder="Search posts..."
  value={searchTerm}
  onChange={(e) => setSearchTerm(e.target.value)}
  className="blog-search"
/>
```

### Tag System
```jsx
// Extract tags from posts
const allTags = [...new Set(posts.flatMap(post => post.tags || []))];

// Tag filter component
const TagFilter = ({ selectedTags, onTagChange }) => (
  <div className="tag-filter">
    {allTags.map(tag => (
      <button
        key={tag}
        className={`tag ${selectedTags.includes(tag) ? 'active' : ''}`}
        onClick={() => onTagChange(tag)}
      >
        {tag}
      </button>
    ))}
  </div>
);
```

### Reading Progress Bar
```jsx
// Add to BlogPost component
const [readingProgress, setReadingProgress] = useState(0);

useEffect(() => {
  const updateReadingProgress = () => {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const progress = (scrollTop / docHeight) * 100;
    setReadingProgress(progress);
  };

  window.addEventListener('scroll', updateReadingProgress);
  return () => window.removeEventListener('scroll', updateReadingProgress);
}, []);

// In JSX
<div 
  className="reading-progress" 
  style={{ width: `${readingProgress}%` }}
/>
```

### Social Sharing
```jsx
const ShareButtons = ({ post, url }) => {
  const shareData = {
    title: post.title,
    text: post.excerpt,
    url: url
  };

  const handleShare = async (platform) => {
    if (platform === 'native' && navigator.share) {
      await navigator.share(shareData);
    } else {
      const urls = {
        twitter: `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareData.title)}&url=${encodeURIComponent(shareData.url)}`,
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareData.url)}`,
        linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(shareData.url)}`
      };
      window.open(urls[platform], '_blank');
    }
  };

  return (
    <div className="share-buttons">
      <button onClick={() => handleShare('twitter')}>Twitter</button>
      <button onClick={() => handleShare('facebook')}>Facebook</button>
      <button onClick={() => handleShare('linkedin')}>LinkedIn</button>
    </div>
  );
};
```

## 📱 Mobile Optimizations

### Touch-Friendly Design
```css
@media (max-width: 768px) {
  .blog-card {
    min-height: 44px; /* Minimum touch target size */
  }
  
  .blog-filter-tab {
    padding: 12px 20px; /* Larger touch targets */
  }
  
  .blog-post-content {
    font-size: 1.2rem; /* Larger text for readability */
    line-height: 1.8;
  }
}
```

### Progressive Web App Features
```javascript
// Add to your service worker
const CACHE_NAME = 'blog-cache-v1';
const urlsToCache = [
  '/blog',
  '/static/css/main.css',
  '/static/js/main.js'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});
```

## 🔍 SEO Customizations

### Meta Tags
```jsx
// In BlogPost component
import { Helmet } from 'react-helmet';

<Helmet>
  <title>{post.title} | Your Site Name</title>
  <meta name="description" content={post.excerpt} />
  <meta property="og:title" content={post.title} />
  <meta property="og:description" content={post.excerpt} />
  <meta property="og:image" content={post.image} />
  <meta property="og:type" content="article" />
  <script type="application/ld+json">
    {JSON.stringify({
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "headline": post.title,
      "description": post.excerpt,
      "image": post.image,
      "datePublished": post.date,
      "author": {
        "@type": "Organization",
        "name": post.author
      }
    })}
  </script>
</Helmet>
```

### URL Structure
```jsx
// Custom URL generation
const generatePostURL = (post) => {
  const date = new Date(post.date);
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const slug = post.title
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-|-$/g, '');
  
  return `/blog/${year}/${month}/${slug}`;
};
```

## 🔧 Performance Optimizations

### Image Lazy Loading
```jsx
const LazyImage = ({ src, alt, ...props }) => {
  const [imageSrc, setImageSrc] = useState(null);
  const [imageRef, setImageRef] = useState();

  useEffect(() => {
    let observer;
    
    if (imageRef && imageSrc !== src) {
      if (IntersectionObserver) {
        observer = new IntersectionObserver(
          entries => {
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                setImageSrc(src);
                observer.unobserve(imageRef);
              }
            });
          },
          { threshold: 0.1 }
        );
        observer.observe(imageRef);
      } else {
        setImageSrc(src);
      }
    }
    
    return () => {
      if (observer && observer.unobserve) {
        observer.unobserve(imageRef);
      }
    };
  }, [src, imageSrc, imageRef]);

  return (
    <div ref={setImageRef}>
      {imageSrc && <img src={imageSrc} alt={alt} {...props} />}
    </div>
  );
};
```

## 📊 Analytics Integration

### Custom Event Tracking
```javascript
// Track blog engagement
const trackBlogEvent = (action, category, label, value) => {
  if (window.gtag) {
    window.gtag('event', action, {
      event_category: category,
      event_label: label,
      value: value
    });
  }
  
  // Custom analytics
  if (window.analytics) {
    window.analytics.track(action, {
      category,
      label,
      value,
      url: window.location.href
    });
  }
};

// Usage in components
const handlePostClick = (post) => {
  trackBlogEvent('click', 'Blog Post', post.title, post.id);
};
```

This customization guide provides comprehensive options for adapting the Auto-Blog Module to any client's needs while maintaining the core functionality and performance.