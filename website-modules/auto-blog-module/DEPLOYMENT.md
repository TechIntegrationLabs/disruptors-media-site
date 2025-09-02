# Deployment Instructions

## Pre-Deployment Checklist

### ✅ Google Services Setup
- [ ] Google Cloud Project created
- [ ] Google Sheets API enabled
- [ ] API key generated and restricted
- [ ] Google Sheet created from template
- [ ] Sheet permissions set to public view
- [ ] Sample blog posts added
- [ ] Google Docs created and shared publicly

### ✅ Content Preparation
- [ ] Featured images optimized and uploaded to CDN
- [ ] Blog content written in Google Docs
- [ ] Sheet populated with at least one test post
- [ ] Publish dates set appropriately

### ✅ Development Setup
- [ ] Code files copied to project
- [ ] Environment variables configured
- [ ] Dependencies installed
- [ ] Routes configured
- [ ] Navigation updated
- [ ] Local testing completed

## 🚀 Deployment Steps

### 1. Environment Configuration

#### Netlify
```bash
# In Netlify dashboard: Site Settings → Environment Variables
REACT_APP_GOOGLE_API_KEY = your_api_key_here
REACT_APP_GOOGLE_SHEET_ID = your_sheet_id_here
REACT_APP_SHEET_GID = your_sheet_gid_here
```

#### Vercel
```bash
# Using Vercel CLI
vercel env add REACT_APP_GOOGLE_API_KEY
vercel env add REACT_APP_GOOGLE_SHEET_ID
vercel env add REACT_APP_SHEET_GID

# Or in Vercel dashboard: Project Settings → Environment Variables
```

#### Custom Hosting
```bash
# Add to your .env.production
REACT_APP_GOOGLE_API_KEY=your_api_key
REACT_APP_GOOGLE_SHEET_ID=your_sheet_id
REACT_APP_SHEET_GID=your_sheet_gid
```

### 2. Build Configuration

#### React (Create React App)
```json
// package.json
{
  "scripts": {
    "build": "react-scripts build",
    "deploy:netlify": "npm run build && netlify deploy --prod --dir=build",
    "deploy:vercel": "npm run build && vercel --prod"
  }
}
```

#### Next.js
```javascript
// next.config.js
/** @type {import('next').NextConfig} */
const nextConfig = {
  images: {
    domains: [
      'res.cloudinary.com',
      'docs.google.com',
      'via.placeholder.com'
    ],
  },
  env: {
    GOOGLE_API_KEY: process.env.NEXT_PUBLIC_GOOGLE_API_KEY,
    GOOGLE_SHEET_ID: process.env.NEXT_PUBLIC_GOOGLE_SHEET_ID,
  }
}

module.exports = nextConfig
```

### 3. Routing Configuration

#### SPA Routing (Netlify/Vercel)
Create `public/_redirects` (Netlify) or `vercel.json` (Vercel):

```bash
# Netlify _redirects
/blog/* /index.html 200
/*      /index.html 200
```

```json
// Vercel vercel.json
{
  "routes": [
    {
      "src": "/blog/[^/]+",
      "dest": "/index.html"
    },
    {
      "src": "/(.*)",
      "dest": "/index.html"
    }
  ]
}
```

### 4. Performance Optimization

#### Asset Optimization
```bash
# Optimize images
npm install -g imagemin-cli
imagemin src/assets/images/* --out-dir=build/static/media --plugin=pngquant --plugin=mozjpeg

# Bundle analysis
npm install -g webpack-bundle-analyzer
npx webpack-bundle-analyzer build/static/js/*.js
```

#### Caching Headers
```toml
# netlify.toml
[[headers]]
  for = "/static/*"
  [headers.values]
    Cache-Control = "public, max-age=31536000, immutable"

[[headers]]
  for = "*.js"
  [headers.values]
    Cache-Control = "public, max-age=31536000"
```

## 🔐 Security Configuration

### API Key Security

#### Restrict API Key
In Google Cloud Console:
1. Go to Credentials
2. Edit your API key
3. Add HTTP referrers (websites):
   - `https://yourdomain.com/*`
   - `https://*.netlify.app/*` (for Netlify)
   - `https://*.vercel.app/*` (for Vercel)

#### Environment Variables
- Never commit `.env` files
- Use platform-specific environment variable systems
- Rotate API keys regularly
- Monitor API usage for unusual activity

### Content Security Policy
```html
<!-- Add to index.html -->
<meta http-equiv="Content-Security-Policy" content="
  default-src 'self';
  script-src 'self' 'unsafe-inline' https://www.googletagmanager.com;
  style-src 'self' 'unsafe-inline' https://fonts.googleapis.com;
  font-src 'self' https://fonts.gstatic.com;
  img-src 'self' data: https: blob:;
  connect-src 'self' https://sheets.googleapis.com https://docs.google.com https://res.cloudinary.com;
">
```

## 📊 Monitoring & Analytics

### Performance Monitoring
```javascript
// Add to your analytics
const trackPageLoad = () => {
  if ('performance' in window) {
    const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
    gtag('event', 'timing_complete', {
      name: 'page_load',
      value: loadTime
    });
  }
};
```

### Error Tracking
```javascript
// Add error boundary
class BlogErrorBoundary extends React.Component {
  constructor(props) {
    super(props);
    this.state = { hasError: false };
  }

  static getDerivedStateFromError(error) {
    return { hasError: true };
  }

  componentDidCatch(error, errorInfo) {
    console.error('Blog module error:', error, errorInfo);
    // Log to error tracking service
    if (window.Sentry) {
      window.Sentry.captureException(error);
    }
  }

  render() {
    if (this.state.hasError) {
      return (
        <div className="blog-error">
          <h2>Something went wrong with the blog.</h2>
          <button onClick={() => window.location.reload()}>
            Reload Page
          </button>
        </div>
      );
    }

    return this.props.children;
  }
}
```

## 🧪 Testing

### Pre-Deployment Testing
```bash
# Build and test locally
npm run build
npx serve -s build

# Test blog functionality
# 1. Visit /blog - should show post list
# 2. Click on post - should show full content
# 3. Check mobile responsiveness
# 4. Test with slow network (Chrome DevTools)
# 5. Verify images load correctly
# 6. Check console for errors
```

### Automated Testing
```javascript
// Example test with Jest/React Testing Library
import { render, screen } from '@testing-library/react';
import { MemoryRouter } from 'react-router-dom';
import Blog from './Blog';

test('renders blog posts', async () => {
  render(
    <MemoryRouter>
      <Blog />
    </MemoryRouter>
  );
  
  expect(screen.getByText('Insights & Ideas')).toBeInTheDocument();
  
  // Wait for posts to load
  await screen.findByText('Loading posts...');
});
```

## 🔄 Post-Deployment

### Verification Checklist
- [ ] Blog listing page loads without errors
- [ ] Individual blog posts display content
- [ ] Images load and display correctly
- [ ] Navigation works properly
- [ ] Mobile layout is responsive
- [ ] No console errors
- [ ] Google Analytics tracking works (if enabled)
- [ ] Page load times are acceptable (< 3s)

### Content Management Training
Provide client with:
1. Access to Google Sheet
2. Instructions for adding new posts
3. Google Docs formatting guidelines
4. Image optimization recommendations
5. Publishing schedule best practices

### Ongoing Maintenance
- Monitor API usage limits
- Check for broken links monthly
- Update dependencies quarterly
- Review and optimize performance
- Backup content regularly

## 🐛 Troubleshooting

### Common Deployment Issues

#### Build Failures
```bash
# Clear cache and reinstall
rm -rf node_modules package-lock.json
npm install
npm run build
```

#### Environment Variable Issues
```javascript
// Debug environment variables
console.log('API Key present:', !!process.env.REACT_APP_GOOGLE_API_KEY);
console.log('Sheet ID present:', !!process.env.REACT_APP_GOOGLE_SHEET_ID);
```

#### API Access Issues
- Check API key restrictions
- Verify sheet permissions
- Test API endpoints directly
- Check CORS configuration

#### Content Not Loading
- Verify Google Docs are public
- Check document URLs in sheet
- Test export URLs manually
- Review network requests in DevTools

## 📞 Support

### Client Handoff
Provide client with:
1. Login credentials for relevant services
2. Documentation links
3. Support contact information
4. Emergency troubleshooting guide
5. Content update procedures

### Developer Handoff
Document for future developers:
1. Project structure explanation
2. Custom modifications made
3. Environment setup instructions
4. Testing procedures
5. Update/maintenance schedule