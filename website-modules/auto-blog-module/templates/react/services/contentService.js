// Content Service for fetching blog content from Google Docs

// Extract document ID from Google Docs URL
export const extractGoogleDocId = (url) => {
  if (!url) return null;
  const match = url.match(/\/document\/d\/([a-zA-Z0-9-_]+)/);
  return match ? match[1] : null;
};

// Convert Google Docs edit URL to export URL
export const getGoogleDocsExportUrl = (url, format = 'html') => {
  const docId = extractGoogleDocId(url);
  if (!docId) return null;
  return `https://docs.google.com/document/d/${docId}/export?format=${format}`;
};

// Fetch and process Google Docs content
export const fetchGoogleDocsContent = async (url) => {
  try {
    const exportUrl = getGoogleDocsExportUrl(url, 'html');
    if (!exportUrl) {
      throw new Error('Invalid Google Docs URL');
    }

    const response = await fetch(exportUrl);
    if (!response.ok) {
      throw new Error(`Failed to fetch content: ${response.status}`);
    }

    const html = await response.text();
    
    // Extract body content and clean it up for blog display
    const bodyMatch = html.match(/<body[^>]*>([\s\S]*?)<\/body>/i);
    if (!bodyMatch) {
      throw new Error('Could not extract body content from document');
    }

    let content = bodyMatch[1];
    
    // Clean up the HTML for better blog display
    content = cleanupGoogleDocsHTML(content);
    
    return {
      html: content,
      plainText: html.replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').trim()
    };
    
  } catch (error) {
    console.error('Error fetching Google Docs content:', error);
    throw error;
  }
};

// Clean up Google Docs HTML for blog display
const cleanupGoogleDocsHTML = (html) => {
  let cleaned = html;
  
  // Remove empty paragraphs at the start
  cleaned = cleaned.replace(/^(<p[^>]*><span[^>]*><\/span><\/p>\s*)+/, '');
  
  // Remove Google Docs specific classes but keep basic styling
  cleaned = cleaned.replace(/class="c\d+"/g, '');
  
  // Convert Google Docs headings to proper blog headings
  cleaned = cleaned.replace(/<h1[^>]*>/g, '<h1 class="blog-main-title">');
  cleaned = cleaned.replace(/<h2[^>]*>/g, '<h2 class="blog-section-title">');
  cleaned = cleaned.replace(/<h3[^>]*>/g, '<h3 class="blog-subsection-title">');
  
  // Clean up paragraphs
  cleaned = cleaned.replace(/<p[^>]*>/g, '<p class="blog-paragraph">');
  
  // Clean up spans (remove most of them, keep content)
  cleaned = cleaned.replace(/<span[^>]*>/g, '<span>');
  
  // Remove excessive empty paragraphs
  cleaned = cleaned.replace(/(<p[^>]*><span><\/span><\/p>\s*){2,}/g, '<br><br>');
  
  // Fix HTML entities
  cleaned = cleaned.replace(/&#39;/g, "'");
  cleaned = cleaned.replace(/&quot;/g, '"');
  cleaned = cleaned.replace(/&amp;/g, '&');
  
  return cleaned;
};

// Validate image URL (mainly for Cloudinary)
export const validateImageUrl = async (url) => {
  try {
    if (!url) return false;
    
    const response = await fetch(url, { method: 'HEAD' });
    return response.ok && response.headers.get('content-type')?.startsWith('image/');
  } catch (error) {
    console.error('Error validating image URL:', error);
    return false;
  }
};

// Get optimized image URL (for Cloudinary)
export const getOptimizedImageUrl = (url, width = 800, height = 600) => {
  if (!url) return '/images/blog/placeholder.png';
  
  // If it's a Cloudinary URL, we can add transformations
  if (url.includes('cloudinary.com')) {
    // Insert transformation parameters
    return url.replace('/upload/', `/upload/w_${width},h_${height},c_fill,q_auto,f_auto/`);
  }
  
  return url;
};