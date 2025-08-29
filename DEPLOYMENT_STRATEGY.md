# Disruptors Media Deployment Strategy

## Overview
This document outlines the deployment strategy for the Disruptors Media website and admin panel.

## Architecture
- **Frontend**: React 18 SPA (disruptorsmedia.com)
- **Admin Backend**: Laravel 9 CMS (admin.disruptorsmedia.com)
- **Database**: MySQL
- **Storage**: Local filesystem for media uploads

## Deployment Options

### Option 1: Vercel + DigitalOcean (Recommended)
**Frontend → Vercel**
- Deploy React app as static site
- Automatic HTTPS and CDN
- Environment variables for API URL
- Preview deployments for branches

**Backend → DigitalOcean App Platform**
- Deploy Laravel app with PHP buildpack
- Managed MySQL database
- Automatic SSL certificates
- Environment variables management

### Option 2: Netlify + Railway
**Frontend → Netlify**
- Drop folder deployment or Git integration
- Form handling and serverless functions
- Split testing capabilities

**Backend → Railway**
- One-click Laravel deployment
- Integrated MySQL database
- Simple scaling options

### Option 3: Single DigitalOcean Deployment
**Both Apps → DigitalOcean App Platform**
- Monorepo with two app specifications
- Shared environment variables
- Single deployment pipeline
- Cost-effective for smaller scale

## Pre-Deployment Checklist

### Frontend (React)
- [ ] Build production bundle: `npm run build`
- [ ] Update `.env` with production API URL
- [ ] Test all API endpoints
- [ ] Optimize images and assets
- [ ] Configure CORS for API calls

### Backend (Laravel)
- [ ] Set up production `.env` file
- [ ] Run database migrations
- [ ] Configure file storage permissions
- [ ] Set up CORS for frontend domain
- [ ] Enable production error handling
- [ ] Configure mail settings

## Quick Start Deployments

### Deploy Frontend to Netlify (Immediate)
1. Build the React app:
   ```bash
   cd disruptorsmedia.com/public
   npm install
   npm run build
   ```

2. Deploy to Netlify:
   - Option A: Drag & drop the `build` folder to Netlify
   - Option B: Use Netlify CLI:
     ```bash
     npm install -g netlify-cli
     netlify deploy --prod --dir=build
     ```

### Deploy Frontend to Vercel
1. Install Vercel CLI:
   ```bash
   npm install -g vercel
   ```

2. Deploy:
   ```bash
   cd disruptorsmedia.com
   vercel
   ```

### Deploy Backend to DigitalOcean
1. Create App Platform app
2. Connect GitHub repository
3. Configure build settings:
   - Build Command: `composer install --optimize-autoloader --no-dev`
   - Run Command: `php artisan serve --host=0.0.0.0 --port=8080`

## Environment Variables

### Frontend (.env)
```
REACT_APP_BASE_URL=https://api.disruptorsmedia.com
```

### Backend (.env)
```
APP_NAME="Disruptors Media Admin"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://admin.disruptorsmedia.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=disruptors_db
DB_USERNAME=your-username
DB_PASSWORD=your-password

CORS_ALLOWED_ORIGINS=https://disruptorsmedia.com
```

## Post-Deployment Tasks
1. Configure DNS records
2. Set up SSL certificates
3. Configure CDN for assets
4. Set up monitoring and alerts
5. Configure backup strategy
6. Test all functionality

## Adding Blog Feature
The blog components have been created and integrated:
- `/blog` - Blog listing page with categories
- `/blog/:id` - Individual blog posts
- Placeholder data included for testing
- API endpoints ready to connect when backend is updated

To activate with real data:
1. Create blog tables in admin database
2. Add blog management to Laravel admin
3. Create API endpoints in Laravel
4. Update React components to use real endpoints