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

# Testing
vendor/bin/phpunit                # Run PHPUnit tests

# Cache clearing
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## Architecture

### Frontend Structure
The React app uses a component-based architecture with:
- **Pages**: Individual route components (Home.js, about.js, services.js, etc.)
- **Components**: Reusable UI components (header.js, footer.js, sliders)
- **Routing**: React Router v6 for SPA navigation
- **State**: Component-level state management
- **API Integration**: Axios for HTTP requests to Laravel backend

Key libraries:
- GSAP (Business license) for animations
- React Slick for carousels
- Lenis for smooth scrolling
- Typeform embed for forms

### Backend Structure
Laravel follows MVC pattern with:
- **Models**: Eloquent models in app/Models/ for database entities
- **Controllers**: AdminController handles all admin operations
- **Routes**: 
  - web.php: Admin panel routes with authentication
  - api.php: Public API endpoints for frontend consumption
- **Storage**: Local filesystem for media uploads (images, videos)

### API Endpoints
Frontend communicates with backend via these key endpoints:
- `GET /api/homepage-settings` - Homepage content
- `GET /api/header-data` - Header configuration
- `GET /api/featured-clients` - Client logos
- `GET /api/what-we-do-lists` - Services sections
- `GET /api/projects` - Portfolio items
- `GET /api/videos` - Gallery videos
- `GET /api/podcasts` - Podcast episodes
- `GET /api/website-meta` - SEO metadata

### Database Schema
Key tables managed through Laravel migrations:
- `admins` - Admin users
- `featured_clients` - Client logos and info
- `portfolios` & `portfolio_images` - Project showcase
- `galleries` - Video gallery
- `podcasts` - Podcast episodes
- `faqs` & `faq_categories` - FAQ management
- `social_media` - Social links
- `website_meta` - SEO configuration

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
REACT_APP_BASE_URL=http://localhost:8000/api
```

Backend (.env in admin.disruptorsmedia.com/):
```
APP_URL=http://localhost:8000
DB_DATABASE=disruptors_media
DB_USERNAME=root
DB_PASSWORD=
```

### CORS Configuration
Backend must allow frontend origin in:
- `config/cors.php`
- Add frontend URL to allowed origins

## Working with Media Assets
- Images stored in `public/` subdirectories:
  - `featured_clients/` - Client logos
  - `project_gallery_images/` - Portfolio images
  - `galleries/` - Video files
  - `podcast_videos/` & `podcast_posters/` - Podcast media
- Laravel manages uploads through AdminController
- Frontend references media via full URLs from API

## Common Tasks

### Adding New API Endpoint
1. Add route in `admin.disruptorsmedia.com/routes/api.php`
2. Create method in `HomeController` to return data
3. Update frontend to consume new endpoint

### Updating Content
All content is managed through the Laravel admin panel:
- Access admin at `/` route
- Use admin credentials to login
- Manage all site content through intuitive CMS interface

### Modifying Frontend Components
1. Components are in `disruptorsmedia.com/public/src/`
2. Update component logic/styling
3. Test with `npm start`
4. Build for production with `npm run build`

## Important Notes
- Blog feature is already integrated in frontend (`/blog` routes)
- Frontend expects API responses in specific JSON structure
- Media uploads have no size validation - implement if needed
- GSAP requires business license for commercial use
- Laravel uses MySQL - ensure database is running before starting backend