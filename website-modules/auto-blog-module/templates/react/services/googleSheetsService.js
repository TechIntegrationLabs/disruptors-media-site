// Google Sheets API Service
// This service fetches blog posts from Google Sheets and filters by post date

const SHEET_ID = '1KWGeHUOjKtYINSqeneEF8U9hKjEs3U1UTUPaff6OWpA';
const SHEET_GID = '592360517'; // Specific sheet tab
const SHEET_NAME = 'Approved - Blog Deployment Queue'; // Specific sheet name for API
const API_KEY = process.env.REACT_APP_GOOGLE_API_KEY || '';
const RANGE = 'A1:Z100'; // Adjust based on your data range

export const fetchBlogPostsFromSheet = async () => {
  try {
    // If no API key, return empty array
    if (!API_KEY) {
      console.warn('Google Sheets API key not configured. Using CSV fallback.');
      return [];
    }

    const url = `https://sheets.googleapis.com/v4/spreadsheets/${SHEET_ID}/values/${SHEET_NAME}!${RANGE}?key=${API_KEY}`;
    
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
    
    console.log('Google Sheets Headers:', headers);
    console.log('Total rows:', rows.length);
    
    // Find column indices based on your actual Google Sheet headers
    const columnIndices = {
      title: headers.findIndex(h => h.toLowerCase() === 'title'),
      content: headers.findIndex(h => h.toLowerCase() === 'content'),
      image: headers.findIndex(h => h.toLowerCase() === 'image'),
      postDate: headers.findIndex(h => h.toLowerCase().includes('post date'))
    };
    
    console.log('Column indices:', columnIndices);

    // Process each row (skip header row)
    for (let i = 1; i < rows.length; i++) {
      const row = rows[i];
      
      // Skip empty rows
      if (!row || row.length === 0 || !row[columnIndices.title] || row[columnIndices.title].trim() === '') continue;

      // Parse the post date (your sheet uses "Post Date" column)
      const postDateStr = row[columnIndices.postDate] || '';
      
      // Show ALL posts regardless of date for now (since your post is 8/30/2025)
      // You can modify this logic later to only show past posts
      const shouldInclude = true; // Show all posts with titles
      
      if (shouldInclude) {
        const title = row[columnIndices.title] || '';
        const contentUrl = row[columnIndices.content] || '';
        const imageUrl = row[columnIndices.image] || '/images/blog/creative-branding-storytelling.png';
        
        // Create excerpt from title
        const excerpt = title.length > 150 ? title.substring(0, 150) + '...' : 
                       `Explore insights and strategies to help grow your business through effective ${title.toLowerCase().includes('content') ? 'content creation' : 'marketing'} approaches.`;

        // Determine category from title content
        let category = 'marketing';
        const titleLower = title.toLowerCase();
        if (titleLower.includes('tech') || titleLower.includes('digital')) category = 'technology';
        else if (titleLower.includes('design') || titleLower.includes('visual')) category = 'design';
        else if (titleLower.includes('brand') || titleLower.includes('identity')) category = 'branding';
        else if (titleLower.includes('strategy') || titleLower.includes('strategic')) category = 'strategy';
        else if (titleLower.includes('system') || titleLower.includes('automation')) category = 'systems';

        const blogPost = {
          id: i,
          title: title,
          excerpt: excerpt,
          postUrl: contentUrl,
          category: category,
          author: 'Disruptors Media',
          date: postDateStr || new Date().toISOString().split('T')[0],
          image: imageUrl,
          readTime: '5 min read',
          content: contentUrl // Store the Google Docs link
        };

        console.log('Adding blog post:', blogPost);
        blogPosts.push(blogPost);
      }
    }

    console.log('Final blog posts:', blogPosts);

    // Sort by date (newest first) - handle both date strings and Date objects
    blogPosts.sort((a, b) => {
      const dateA = new Date(a.date);
      const dateB = new Date(b.date);
      return dateB - dateA;
    });

    return blogPosts;

  } catch (error) {
    console.error('Error fetching blog posts from Google Sheets API:', error);
    // Fall back to CSV method
    return await fetchBlogPostsFromCSV();
  }
};

// Helper function to check if a post should be visible based on its date
export const isPostVisible = (postDate) => {
  if (!postDate) return true; // Show posts without dates
  
  const today = new Date();
  today.setHours(23, 59, 59, 999); // Include today's posts
  
  const postDateObj = new Date(postDate);
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

    // Process CSV data similar to API method
    const headers = rows[0];
    const blogPosts = [];
    
    console.log('CSV Headers:', headers);
    console.log('CSV Total rows:', rows.length);
    
    // Find column indices based on your actual sheet headers
    const columnIndices = {
      title: headers.findIndex(h => h.toLowerCase() === 'title'),
      content: headers.findIndex(h => h.toLowerCase() === 'content'),
      image: headers.findIndex(h => h.toLowerCase() === 'image'),
      postDate: headers.findIndex(h => h.toLowerCase().includes('post date'))
    };
    
    console.log('CSV Column indices:', columnIndices);

    // Process each row
    for (let i = 1; i < rows.length; i++) {
      const row = rows[i];
      if (!row || row.length === 0 || !row[columnIndices.title] || row[columnIndices.title].trim() === '') continue;

      const postDateStr = row[columnIndices.postDate] || '';
      
      // Show ALL posts regardless of date for now (since your post is 8/30/2025)
      // You can modify this logic later to only show past posts
      const shouldInclude = true; // Show all posts with titles
      
      if (shouldInclude) {
        const title = row[columnIndices.title] || '';
        const contentUrl = row[columnIndices.content] || '';
        const imageUrl = row[columnIndices.image] || '/images/blog/creative-branding-storytelling.png';
        
        // Create excerpt from title
        const excerpt = title.length > 150 ? title.substring(0, 150) + '...' : 
                       `Explore insights and strategies to help grow your business through effective ${title.toLowerCase().includes('content') ? 'content creation' : 'marketing'} approaches.`;

        // Determine category from title content
        let category = 'marketing';
        const titleLower = title.toLowerCase();
        if (titleLower.includes('tech') || titleLower.includes('digital')) category = 'technology';
        else if (titleLower.includes('design') || titleLower.includes('visual')) category = 'design';
        else if (titleLower.includes('brand') || titleLower.includes('identity')) category = 'branding';
        else if (titleLower.includes('strategy') || titleLower.includes('strategic')) category = 'strategy';
        else if (titleLower.includes('system') || titleLower.includes('automation')) category = 'systems';

        const blogPost = {
          id: i,
          title: title,
          excerpt: excerpt,
          postUrl: contentUrl,
          category: category,
          author: 'Disruptors Media',
          date: postDateStr || new Date().toISOString().split('T')[0],
          image: imageUrl,
          readTime: '5 min read',
          content: contentUrl
        };

        blogPosts.push(blogPost);
      }
    }

    blogPosts.sort((a, b) => {
      const dateA = new Date(a.date);
      const dateB = new Date(b.date);
      return dateB - dateA;
    });

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
    if (!line.trim()) continue; // Skip empty lines
    
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