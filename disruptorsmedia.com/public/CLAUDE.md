# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

This is the Disruptors Media full-stack application, consisting of:
- **Frontend**: React 18 SPA with GSAP animations and modern UI (disruptorsmedia.com/)
- **Backend**: Laravel 9 admin panel with comprehensive CMS features (admin.disruptorsmedia.com/)
- **Database**: MySQL for content management
- **API**: RESTful API connecting frontend and backend

## Commands

### Frontend (React)
```bash
# Development
cd disruptorsmedia.com/public
npm install
npm start          # Runs on http://localhost:3000

# Production build
npm run build      # Creates optimized build in build/ directory

# Testing
npm test           # Run React tests
```

### Backend (Laravel)
```bash
# Setup
cd admin.disruptorsmedia.com
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate

# Development
php artisan serve  # Runs on http://localhost:8000

# Database
php artisan migrate:fresh --seed  # Reset and seed database
php artisan migrate:rollback      # Rollback migrations

# Cache clearing
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## Architecture

### Frontend Structure
The React app uses a component-based architecture with:
- **Pages**: Individual route components (Home.js, about.js, services.js, Blog.js, BlogPost.js, etc.)
- **Components**: Reusable UI components (header.js, footer.js, sliders)
- **Routing**: React Router v6 for SPA navigation with blog routing (`/blog`, `/blog/:id`)
- **State**: Component-level state management
- **API Integration**: Fetch API for HTTP requests to Laravel backend
- **Loading System**: Cookie-based loader with counter animation and scramble text effects

Key libraries:
- GSAP (Business license) for animations
- React Slick for carousels
- Lenis for smooth scrolling
- Typeform embed for forms
- React Transition Group for page transitions
- React Helmet for SEO management

### Backend Structure
Laravel follows MVC pattern with:
- **Models**: Eloquent models in app/Models/ for database entities
- **Controllers**: 
  - AdminController: Handles all admin operations
  - HomeController: Handles public API endpoints for frontend
- **Routes**: 
  - web.php: Admin panel routes with authentication
  - api.php: Public API endpoints for frontend consumption
- **Storage**: Local filesystem for media uploads (images, videos)

### API Endpoints
Frontend communicates with backend via these key endpoints:
- `GET /api/homepage-settings` - Homepage content
- `GET /api/header-data` - Header configuration
- `GET /api/featured-clients` - Client logos
- `GET /api/what-we-do-lists` - Services sections (top)
- `GET /api/what-we-do-lists-btm` - Services sections (bottom)
- `GET /api/projects` - Portfolio items
- `GET /api/project-detail/{slug}` - Individual project details
- `GET /api/videos` - Gallery videos
- `GET /api/podcasts` - Podcast episodes
- `GET /api/podcast-content` - Podcast content data
- `GET /api/studios` - Studio information
- `GET /api/website-meta` - SEO metadata
- `GET /api/all-faqs` - FAQ items
- `GET /api/what-we-do-faqs` - Service-specific FAQs
- `GET /api/social-media-links` - Social media URLs
- `GET /api/footer-data` - Footer content
- `GET /api/contact-page` - Contact page content
- `GET /api/about-texts` - About page content
- `GET /api/embed-code` - Embedded code snippets
- `GET /api/seo-analytics` - SEO and analytics scripts
- `GET /api/blog-posts` - Blog posts (implemented in frontend)
- `GET /api/blog-categories` - Blog categories (implemented in frontend)

### Database Schema
Key tables managed through Laravel migrations:
- `admins` - Admin users
- `featured_clients` - Client logos and info
- `portfolios` & `portfolio_images` - Project showcase
- `galleries` - Video gallery
- `podcasts` & `podcast_content` - Podcast episodes and content
- `faqs` & `faq_categories` - FAQ management
- `social_media` - Social links
- `website_meta` - SEO configuration
- `studios` & `studio_galleries` - Studio information and images
- `about_embed_codes` - Embedded content for about page

## Deployment

### Quick Deploy to Netlify (Frontend)
```bash
cd disruptorsmedia.com/public
npm run build
# Then drag & drop build/ folder to Netlify
```

### Environment Variables
Frontend (.env in disruptorsmedia.com/public/):
```
REACT_APP_BASE_URL=http://localhost:8000
```

Backend (.env in admin.disruptorsmedia.com/):
```
APP_URL=http://localhost:8000
DB_DATABASE=disruptors_media
DB_USERNAME=root
DB_PASSWORD=
```

### CORS Configuration
Backend allows all origins in `config/cors.php` with wildcard settings for development.

## Working with Media Assets
- Images stored in Laravel `public/` subdirectories:
  - `featured_clients/` - Client logos
  - `project_gallery_images/` - Portfolio images
  - `galleries/` - Video files
  - `podcast_videos/` & `podcast_posters/` - Podcast media
  - `studio_gallery_images/` - Studio photos
- Laravel manages uploads through AdminController
- Frontend references media via full URLs from API responses

## Component Patterns

### Page Components
All page components follow similar patterns:
- API data fetching on mount via `useEffect`
- Loading states and error handling
- Consistent styling with CSS modules
- GSAP animations for enhanced UX

### Slider Components
Multiple specialized slider components:
- `WhatWeDoSlider.js` - Top services section
- `WhatWeDoSliderBtm.js` - Bottom services section  
- `WorksSlickSlider.js` - Portfolio showcase
- `SwipeSlider.js` - General purpose slider

### Blog System
- Dynamic blog listing with category filtering
- Individual blog post pages with routing
- Placeholder data fallback when API unavailable
- SEO-optimized with meta tags

## Common Tasks

### Adding New API Endpoint
1. Add route in `admin.disruptorsmedia.com/routes/api.php`
2. Create method in `HomeController` to return data
3. Update frontend component to consume new endpoint

### Updating Content
All content is managed through the Laravel admin panel:
- Access admin at `/` route on Laravel backend
- Use admin credentials to login
- Manage all site content through intuitive CMS interface

### Modifying Frontend Components
1. Components are in `disruptorsmedia.com/public/src/`
2. Update component logic/styling
3. Test with `npm start`
4. Build for production with `npm run build`

### Adding New Blog Posts
Blog posts are managed through the Laravel admin but can use placeholder data:
- Backend API endpoints: `/api/blog-posts` and `/api/blog-categories`
- Frontend handles graceful fallback to placeholder content
- Individual posts accessible via `/blog/:id` routing

## Important Notes
- Blog feature is fully integrated with routing and placeholder content
- Frontend expects API responses in specific JSON structure
- Media uploads managed entirely through Laravel backend
- GSAP requires business license for commercial use
- Laravel uses MySQL - ensure database is running before starting backend
- Frontend uses environment variable `REACT_APP_BASE_URL` for API communication
- Cookie-based loading system prevents repeated loader animations
- All components use consistent API URL pattern from environment variables