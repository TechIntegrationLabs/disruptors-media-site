# React Auto-Blog Template

This template contains the complete React implementation of the Auto-Blog Module.

## 📁 Files Included

```
react/
├── components/
│   ├── Blog.js              # Blog listing component
│   ├── Blog.css             # Blog listing styles
│   ├── BlogPost.js          # Individual blog post component
│   └── BlogPost.css         # Blog post styles
├── services/
│   ├── googleSheetsService.js  # Google Sheets API integration
│   └── contentService.js      # Content fetching and processing
└── README.md               # This file
```

## 🚀 Quick Installation

### 1. Copy Files to Your Project
```bash
# Copy components
cp components/* your-project/src/components/

# Copy services
cp services/* your-project/src/services/

# Or copy everything at once
cp -r * your-project/src/
```

### 2. Install Dependencies
```bash
cd your-project
npm install react-router-dom
```

### 3. Environment Variables
Create/update your `.env` file:
```bash
# Required
REACT_APP_GOOGLE_API_KEY=your_google_sheets_api_key
REACT_APP_GOOGLE_SHEET_ID=your_google_sheet_id

# Optional (defaults provided)
REACT_APP_SHEET_GID=0
```

### 4. Add Routes
Update your main App.js or router configuration:
```jsx
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Blog from './components/Blog';
import BlogPost from './components/BlogPost';

function App() {
  return (
    <Router>
      <Routes>
        {/* Your existing routes */}
        <Route path="/blog" element={<Blog />} />
        <Route path="/blog/:id" element={<BlogPost />} />
      </Routes>
    </Router>
  );
}
```

### 5. Add Navigation
Add a blog link to your navigation:
```jsx
import { Link } from 'react-router-dom';

// In your header/navigation component
<Link to="/blog">Blog</Link>
```

## 🎨 Customization

### CSS Variables
The styles use CSS custom properties for easy theming:

```css
/* Add to your main CSS or create a theme file */
:root {
  --blog-primary-color: #ffffff;
  --blog-secondary-color: #999999;
  --blog-background: url('./images/your-bg.jpg') repeat;
  --blog-card-background: rgba(255, 255, 255, 0.05);
  --blog-font-family: 'Your Font', sans-serif;
}
```

### Component Customization
Each component can be customized by:
1. Modifying the CSS files
2. Updating the component JSX structure  
3. Adding new props for configuration
4. Extending with additional features

## 🔧 Configuration Options

### Google Sheets Service
The `googleSheetsService.js` can be configured by updating these constants:

```javascript
const SHEET_ID = 'your_sheet_id'; // Update this
const SHEET_GID = '592360517';     // Update if using different tab
const SHEET_NAME = 'Approved - Blog Deployment Queue'; // Update tab name
const RANGE = 'A1:Z100'; // Adjust range as needed
```

### Content Service
The `contentService.js` includes functions for:
- Converting Google Docs URLs to export URLs
- Fetching and cleaning HTML content
- Optimizing Cloudinary images
- Validating image URLs

## 📱 Responsive Design

The templates include responsive design for:
- Mobile devices (< 768px)
- Tablets (768px - 1024px)  
- Desktop (> 1024px)

## 🔍 Testing

### Test the Components
```jsx
// Test in your development environment
npm start

// Navigate to:
// http://localhost:3000/blog (blog listing)
// http://localhost:3000/blog/1 (individual post)
```

### Debug Mode
Enable debug logging by setting:
```javascript
// In googleSheetsService.js or contentService.js
const DEBUG = true;
```

## 🐛 Troubleshooting

### Common Issues

**Posts not showing:**
- Check API key and sheet ID
- Verify sheet permissions (public viewing)
- Check publish dates (future dates hidden)

**Content not loading:**
- Verify Google Docs are publicly accessible
- Check document URLs in sheet
- Test export URLs directly

**Styling issues:**
- Check CSS file imports
- Verify image paths
- Update CSS custom properties

**Build errors:**
- Ensure all dependencies installed
- Check import paths
- Verify React Router setup

## 📦 Production Build

Before deploying:
1. Test all functionality locally
2. Verify environment variables
3. Build and test production version
4. Check console for any errors

```bash
npm run build
npm run preview # or serve build folder
```

## 🔄 Updates

When updating the module:
1. Backup your customizations
2. Copy new template files
3. Merge your customizations
4. Test thoroughly
5. Deploy updates

## 📞 Support

For issues specific to this template:
1. Check the main documentation
2. Review troubleshooting guides  
3. Test with minimal example
4. Contact development team