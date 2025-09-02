# Google Sheets Setup Guide

## Overview

The Auto-Blog Module uses Google Sheets as its content management system. This guide covers setting up the Google Sheet template, configuring API access, and managing content workflow.

## 📋 Sheet Template Setup

### 1. Create New Google Sheet

1. Go to [Google Sheets](https://sheets.google.com)
2. Create a new blank spreadsheet
3. Name it: `[Client Name] - Blog Content Management`

### 2. Configure Sheet Tabs

#### Main Tab: "Approved - Blog Deployment Queue"
This is the primary tab that the website reads from.

**Required Columns (in exact order):**

| Column | Header | Data Type | Description | Example |
|--------|--------|-----------|-------------|---------|
| A | Title | Text | Blog post title | "Why Content Creation Services Are Your Business's Secret Weapon for Growth" |
| B | Content | URL | Google Docs edit link | `https://docs.google.com/document/d/1IoDqiM9nO6ycXS47mZ6hVhMULyRSfnpbKuzNopJmccQ/edit?usp=sharing` |
| C | Image | URL | Cloudinary image URL | `https://res.cloudinary.com/dvcvxhzmt/image/upload/v1756745542/Why_Content_Creation_Services_Are_Your_Business_s_Secret_Weapon_tmuc2n.png` |
| D | Post Date | Date | Publish date (MM/DD/YYYY) | "8/30/2025" |

#### Optional Tab: "Content Pipeline"
Use for draft/planning content before moving to approved queue.

**Columns:**
- Title
- Content (Draft Google Doc)
- Image (Placeholder or draft)
- Target Date
- Status (Draft/Review/Approved)
- Notes

### 3. Sheet Configuration

#### Row 1: Headers
```
A1: Title
B1: Content  
C1: Image
D1: Post Date
```

#### Data Rows (Starting Row 2)
Each row represents one blog post.

#### Example Data:
```
Row 2:
A2: Why Content Creation Services Are Your Business's Secret Weapon for Growth
B2: https://docs.google.com/document/d/1IoDqiM9nO6ycXS47mZ6hVhMULyRSfnpbKuzNopJmccQ/edit?usp=sharing
C2: https://res.cloudinary.com/dvcvxhzmt/image/upload/v1756745542/Why_Content_Creation_Services_Are_Your_Business_s_Secret_Weapon_tmuc2n.png
D2: 8/30/2025
```

## 🔐 Google API Setup

### 1. Enable Google Sheets API

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create new project or select existing
3. Enable "Google Sheets API"
4. Create API credentials (API Key)
5. Copy the API key for later use

### 2. Sheet Permissions

#### For API Access:
1. Open your Google Sheet
2. Click "Share" button
3. Set permission to "Anyone with the link can view"
4. Copy the sheet ID from the URL

**Sheet URL Format:**
```
https://docs.google.com/spreadsheets/d/[SHEET_ID]/edit#gid=0
```

#### Extract Sheet ID:
From URL: `https://docs.google.com/spreadsheets/d/1KWGeHUOjKtYINSqeneEF8U9hKjEs3U1UTUPaff6OWpA/edit#gid=592360517`

- **Sheet ID**: `1KWGeHUOjKtYINSqeneEF8U9hKjEs3U1UTUPaff6OWpA`
- **Tab GID**: `592360517` (for "Approved - Blog Deployment Queue" tab)

## 📝 Content Creation Workflow

### 1. Blog Post Creation Process

#### Step 1: Create Google Doc
1. Create new Google Doc
2. Write blog post content with formatting
3. Set sharing to "Anyone with the link can view"
4. Copy the edit URL

#### Step 2: Prepare Image
1. Upload image to Cloudinary (or client's CDN)
2. Copy optimized image URL
3. Recommended size: 1200x600px for featured images

#### Step 3: Add to Sheet
1. Open Google Sheet
2. Add new row in "Approved - Blog Deployment Queue"
3. Fill in all required columns
4. Set future date for scheduled publishing

### 2. Content Management Best Practices

#### Scheduling Posts
- Use consistent date format: MM/DD/YYYY
- Schedule posts for optimal timing
- Leave gaps between posts for consistent publishing

#### Content Quality
- Ensure Google Docs are properly formatted
- Use headings (H1, H2, H3) for structure
- Include images within docs if needed
- Proofread before setting live date

#### Image Management
- Use consistent image sizes
- Optimize images before uploading
- Use descriptive filenames
- Maintain brand consistency

## 🔧 Technical Configuration

### Environment Variables
```bash
# Required for website
REACT_APP_GOOGLE_API_KEY=your_google_sheets_api_key
REACT_APP_GOOGLE_SHEET_ID=your_sheet_id
REACT_APP_SHEET_GID=your_sheet_tab_gid
```

### Sheet API Endpoints

#### Primary (API Method):
```
https://sheets.googleapis.com/v4/spreadsheets/{SHEET_ID}/values/{SHEET_NAME}!A1:Z100?key={API_KEY}
```

#### Fallback (CSV Method):
```
https://docs.google.com/spreadsheets/d/{SHEET_ID}/export?format=csv&gid={GID}
```

## 🎛 Advanced Configuration

### Custom Columns (Optional)

You can extend the basic template with additional columns:

| Column | Purpose | Example |
|--------|---------|---------|
| E | Category | "Marketing", "Technology", "Design" |
| F | Author | "John Smith", "Marketing Team" |
| G | Tags | "SEO, Content Marketing, Growth" |
| H | Meta Description | "Learn how content creation..." |
| I | Featured | "Yes/No" for homepage highlighting |
| J | Status | "Draft", "Review", "Published" |

### Multiple Sheet Support

For larger operations, you can create multiple sheets:

1. **Content Calendar**: Editorial planning
2. **Approved Queue**: Ready-to-publish content  
3. **Published Archive**: Historical posts
4. **Performance Tracking**: Analytics and metrics

## 🚨 Troubleshooting

### Common Issues

#### API Not Working
- Verify API key is correct
- Check sheet permissions (public viewing)
- Ensure sheet ID is accurate
- Confirm tab name matches code

#### Content Not Appearing
- Check publish date (future dates won't show)
- Verify Google Doc is publicly accessible
- Confirm image URLs are working
- Check for required column data

#### Formatting Issues
- Ensure consistent column headers
- Check for empty rows in data
- Verify date format consistency
- Remove special characters from URLs

### Testing Your Setup

1. **API Test**: Use browser to visit API URL directly
2. **CSV Test**: Download CSV export to verify data
3. **Content Test**: Open Google Doc URLs in incognito mode
4. **Image Test**: Open image URLs directly in browser

## 📊 Content Analytics

### Tracking Performance

Add additional columns for tracking:
- View Count
- Engagement Rate
- Social Shares
- Conversion Metrics

### Reporting Dashboard

Consider creating a separate sheet tab for:
- Monthly publish schedule
- Content performance metrics
- Editorial calendar overview
- Author assignment tracking

## 🔄 Maintenance

### Regular Tasks

#### Weekly:
- Review upcoming posts
- Check for broken links
- Update publish dates if needed
- Quality check new content

#### Monthly:
- Archive old content
- Review performance metrics
- Update content calendar
- Backup sheet data

#### Quarterly:
- Review API usage
- Update documentation
- Optimize content workflow
- Plan content strategy