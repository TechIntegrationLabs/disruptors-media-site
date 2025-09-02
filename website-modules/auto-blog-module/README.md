# Auto-Blog Module

A comprehensive, reusable automated blog system that integrates Google Sheets for content management with Google Docs for article content and Cloudinary for image optimization.

## 🚀 Quick Start

This module provides a complete automated blog solution that can be deployed to any website. Content is managed through Google Sheets, articles are written in Google Docs, and images are optimized through Cloudinary.

### Key Features

- ✅ **Google Sheets Integration** - Content management and scheduling
- ✅ **Google Docs Content** - Rich text articles with formatting
- ✅ **Cloudinary Images** - Optimized image delivery
- ✅ **Automated Scheduling** - Posts appear based on publish dates
- ✅ **Transparent Design** - Background-friendly styling
- ✅ **Mobile Responsive** - Works on all devices
- ✅ **SEO Optimized** - Proper meta tags and structure

## 📁 Module Structure

```
auto-blog-module/
├── README.md                    # This file
├── docs/                       
│   ├── architecture.md          # System architecture
│   ├── google-sheets-setup.md   # Sheets configuration
│   ├── implementation-guide.md  # Step-by-step setup
│   └── customization.md         # Styling and branding
├── templates/
│   ├── react/                   # React implementation
│   ├── vanilla-js/              # Pure JavaScript version
│   └── wordpress/               # WordPress implementation
├── examples/
│   ├── basic-blog/              # Simple blog setup
│   ├── advanced-blog/           # Full-featured blog
│   └── client-examples/         # Real client implementations
└── assets/
    ├── css/                     # Styling templates
    ├── images/                  # Default images and icons
    └── scripts/                 # Utility scripts
```

## 🎯 Use Cases

- **Client Websites** - Automated blog for business websites
- **Marketing Agencies** - Scalable content solution
- **Content Creators** - Easy publishing workflow
- **Small Businesses** - Professional blog without technical complexity

## 🛠 Technology Stack

- **Frontend**: React, JavaScript, CSS
- **Content Management**: Google Sheets API
- **Content Storage**: Google Docs
- **Image Optimization**: Cloudinary
- **Deployment**: Netlify, Vercel, or any static host

## 📊 Google Sheets Template

The system uses a specific Google Sheets structure for content management:

### Sheet Name: "Approved - Blog Deployment Queue"
### Required Columns:

| Column | Description | Example |
|--------|-------------|---------|
| Title | Blog post title | "Why Content Creation Services Are Your Business's Secret Weapon for Growth" |
| Content | Google Docs URL | `https://docs.google.com/document/d/[DOC_ID]/edit?usp=sharing` |
| Image | Cloudinary URL | `https://res.cloudinary.com/[CLOUD]/image/upload/v[VERSION]/[IMAGE].png` |
| Post Date | Publish date (MM/DD/YYYY) | "8/30/2025" |

## 🔧 Quick Implementation

### 1. Copy the Template Files
```bash
# Copy React components
cp templates/react/* your-site/src/
```

### 2. Set Up Environment Variables
```bash
# Add to your .env file
REACT_APP_GOOGLE_API_KEY=your_google_api_key
REACT_APP_GOOGLE_SHEET_ID=your_sheet_id
```

### 3. Update Your Routes
```jsx
// Add to your React Router
<Route path="/blog" element={<Blog />} />
<Route path="/blog/:id" element={<BlogPost />} />
```

### 4. Add Navigation Link
```jsx
// Add to your header/navigation
<Link to="/blog">Blog</Link>
```

## 🎨 Customization

The module is designed to be highly customizable:

- **Styling**: Modify CSS variables for colors, fonts, spacing
- **Layout**: Adjust grid layouts and component structure
- **Content**: Customize Google Sheets columns for your needs
- **Images**: Use your own image CDN or local storage

## 📖 Documentation

For detailed implementation guides, see the `docs/` folder:

- [Architecture Overview](docs/architecture.md)
- [Google Sheets Setup](docs/google-sheets-setup.md) 
- [Implementation Guide](docs/implementation-guide.md)
- [Customization Options](docs/customization.md)

## 🔧 Support

This module was developed and tested for Disruptors Media. For support or customization requests, contact the development team.

## 📝 License

This module is proprietary to Disruptors Media and licensed for use with client projects.