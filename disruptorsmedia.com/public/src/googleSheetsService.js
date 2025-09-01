// Google Sheets API Service
// This service fetches blog posts from Google Sheets and filters by post date

const SHEET_ID = '1KWGeHUOjKtYINSqeneEF8U9hKjEs3U1UTUPaff6OWpA';
const SHEET_GID = '592360517'; // Specific sheet tab
const API_KEY = process.env.REACT_APP_GOOGLE_API_KEY || '';
const RANGE = 'A1:Z100'; // Adjust based on your data range

export const fetchBlogPostsFromSheet = async () => {
  try {
    // If no API key, return empty array
    if (!API_KEY) {
      console.warn('Google Sheets API key not configured. Using placeholder data.');
      return [];
    }

    const url = `https://sheets.googleapis.com/v4/spreadsheets/${SHEET_ID}/values/${RANGE}?key=${API_KEY}`;
    
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error('Failed to fetch sheet data');
    }

    const data = await response.json();
    const rows = data.values || [];
    
    if (rows.length === 0) {
      return [];
    }

    // First row contains headers
    const headers = rows[0];
    const blogPosts = [];
    
    // Find column indices based on actual Google Sheet headers
    const columnIndices = {
      title: headers.findIndex(h => h.toLowerCase() === 'title'),
      postUrl: headers.findIndex(h => h.toLowerCase().includes('post url')),
      client: headers.findIndex(h => h.toLowerCase() === 'client'),
      status: headers.findIndex(h => h.toLowerCase() === 'status'),
      primaryKeyword: headers.findIndex(h => h.toLowerCase().includes('primary keyword')),
      secondaryKeyword: headers.findIndex(h => h.toLowerCase().includes('secondary keyword')),
      targetUrl: headers.findIndex(h => h.toLowerCase().includes('target url')),
      publishDate: headers.findIndex(h => h.toLowerCase().includes('publish date')),
      contentType: headers.findIndex(h => h.toLowerCase().includes('content type')),
      platform: headers.findIndex(h => h.toLowerCase() === 'platform'),
      approved: headers.findIndex(h => h.toLowerCase().includes('approved'))
    };

    // Process each row (skip header row)
    for (let i = 1; i < rows.length; i++) {
      const row = rows[i];
      
      // Skip empty rows
      if (!row || row.length === 0) continue;

      // Parse the publish date
      const publishDateStr = row[columnIndices.publishDate] || '';
      const publishDate = new Date(publishDateStr);
      const today = new Date();
      today.setHours(0, 0, 0, 0);

      // Only include posts with publish dates up to today and approved status
      const isApproved = row[columnIndices.approved]?.toLowerCase() === 'yes' || 
                        row[columnIndices.approved]?.toLowerCase() === 'true';
      
      if (publishDate <= today && publishDateStr && isApproved) {
        // Extract excerpt from title or keywords
        const title = row[columnIndices.title] || '';
        const primaryKeyword = row[columnIndices.primaryKeyword] || '';
        const secondaryKeyword = row[columnIndices.secondaryKeyword] || '';
        
        // Create excerpt from keywords or truncate title
        let excerpt = '';
        if (primaryKeyword || secondaryKeyword) {
          excerpt = `Learn about ${primaryKeyword}${secondaryKeyword ? ' and ' + secondaryKeyword : ''} in this comprehensive guide.`;
        } else {
          excerpt = title.length > 150 ? title.substring(0, 150) + '...' : title;
        }

        // Determine category from content type or keywords
        let category = 'general';
        const contentType = (row[columnIndices.contentType] || '').toLowerCase();
        if (contentType.includes('tech')) category = 'technology';
        else if (contentType.includes('market')) category = 'marketing';
        else if (contentType.includes('design')) category = 'design';
        else if (contentType.includes('brand')) category = 'branding';
        else if (contentType.includes('strategy')) category = 'strategy';
        else if (contentType.includes('system')) category = 'systems';

        const blogPost = {
          id: i,
          title: title,
          excerpt: excerpt,
          postUrl: row[columnIndices.postUrl] || '',
          category: category,
          author: row[columnIndices.client] || 'Disruptors Media',
          date: publishDateStr,
          image: '/images/blog/placeholder.png', // You can add image URLs to the sheet later
          readTime: '5 min read',
          primaryKeyword: primaryKeyword,
          secondaryKeyword: secondaryKeyword,
          targetUrl: row[columnIndices.targetUrl] || ''
        };

        // Only add if we have at least a title
        if (blogPost.title && blogPost.title.trim() !== '') {
          blogPosts.push(blogPost);
        }
      }
    }

    // Sort by date (newest first)
    blogPosts.sort((a, b) => new Date(b.date) - new Date(a.date));

    return blogPosts;

  } catch (error) {
    console.error('Error fetching blog posts from Google Sheets:', error);
    return [];
  }
};

// Helper function to check if a post should be visible based on its date
export const isPostVisible = (postDate) => {
  const today = new Date();
  today.setHours(0, 0, 0, 0);
  
  const postDateObj = new Date(postDate);
  postDateObj.setHours(0, 0, 0, 0);
  
  return postDateObj <= today;
};

// Alternative: Direct public CSV export (no API key needed)
export const fetchBlogPostsFromCSV = async () => {
  try {
    // Google Sheets public CSV export URL (use specific sheet tab)
    const csvUrl = `https://docs.google.com/spreadsheets/d/${SHEET_ID}/export?format=csv&gid=${SHEET_GID}`;
    
    const response = await fetch(csvUrl);
    if (!response.ok) {
      throw new Error('Failed to fetch CSV data');
    }

    const csvText = await response.text();
    const rows = parseCSV(csvText);
    
    if (rows.length === 0) {
      return [];
    }

    // Process similar to above
    const headers = rows[0];
    const blogPosts = [];
    
    // Find column indices based on actual Google Sheet headers
    const columnIndices = {
      title: headers.findIndex(h => h.toLowerCase() === 'title'),
      postUrl: headers.findIndex(h => h.toLowerCase().includes('post url')),
      client: headers.findIndex(h => h.toLowerCase() === 'client'),
      status: headers.findIndex(h => h.toLowerCase() === 'status'),
      primaryKeyword: headers.findIndex(h => h.toLowerCase().includes('primary keyword')),
      secondaryKeyword: headers.findIndex(h => h.toLowerCase().includes('secondary keyword')),
      targetUrl: headers.findIndex(h => h.toLowerCase().includes('target url')),
      publishDate: headers.findIndex(h => h.toLowerCase().includes('publish date')),
      contentType: headers.findIndex(h => h.toLowerCase().includes('content type')),
      platform: headers.findIndex(h => h.toLowerCase() === 'platform'),
      approved: headers.findIndex(h => h.toLowerCase().includes('approved'))
    };

    // Process each row
    for (let i = 1; i < rows.length; i++) {
      const row = rows[i];
      if (!row || row.length === 0) continue;

      const publishDateStr = row[columnIndices.publishDate] || '';
      const publishDate = new Date(publishDateStr);
      const today = new Date();
      today.setHours(0, 0, 0, 0);

      // Only include posts with publish dates up to today and approved status
      const isApproved = row[columnIndices.approved]?.toLowerCase() === 'yes' || 
                        row[columnIndices.approved]?.toLowerCase() === 'true';
      
      if (publishDate <= today && publishDateStr && isApproved) {
        // Extract excerpt from title or keywords
        const title = row[columnIndices.title] || '';
        const primaryKeyword = row[columnIndices.primaryKeyword] || '';
        const secondaryKeyword = row[columnIndices.secondaryKeyword] || '';
        
        // Create excerpt from keywords or truncate title
        let excerpt = '';
        if (primaryKeyword || secondaryKeyword) {
          excerpt = `Learn about ${primaryKeyword}${secondaryKeyword ? ' and ' + secondaryKeyword : ''} in this comprehensive guide.`;
        } else {
          excerpt = title.length > 150 ? title.substring(0, 150) + '...' : title;
        }

        // Determine category from content type or keywords
        let category = 'general';
        const contentType = (row[columnIndices.contentType] || '').toLowerCase();
        if (contentType.includes('tech')) category = 'technology';
        else if (contentType.includes('market')) category = 'marketing';
        else if (contentType.includes('design')) category = 'design';
        else if (contentType.includes('brand')) category = 'branding';
        else if (contentType.includes('strategy')) category = 'strategy';
        else if (contentType.includes('system')) category = 'systems';

        const blogPost = {
          id: i,
          title: title,
          excerpt: excerpt,
          postUrl: row[columnIndices.postUrl] || '',
          category: category,
          author: row[columnIndices.client] || 'Disruptors Media',
          date: publishDateStr,
          image: '/images/blog/placeholder.png',
          readTime: '5 min read',
          primaryKeyword: primaryKeyword,
          secondaryKeyword: secondaryKeyword,
          targetUrl: row[columnIndices.targetUrl] || ''
        };

        if (blogPost.title && blogPost.title.trim() !== '') {
          blogPosts.push(blogPost);
        }
      }
    }

    blogPosts.sort((a, b) => new Date(b.date) - new Date(a.date));
    return blogPosts;

  } catch (error) {
    console.error('Error fetching blog posts from CSV:', error);
    return [];
  }
};

// Simple CSV parser
function parseCSV(csvText) {
  const lines = csvText.split('\n');
  const result = [];
  
  for (const line of lines) {
    const row = [];
    let current = '';
    let inQuotes = false;
    
    for (let i = 0; i < line.length; i++) {
      const char = line[i];
      
      if (char === '"') {
        inQuotes = !inQuotes;
      } else if (char === ',' && !inQuotes) {
        row.push(current.trim());
        current = '';
      } else {
        current += char;
      }
    }
    
    row.push(current.trim());
    result.push(row);
  }
  
  return result;
}