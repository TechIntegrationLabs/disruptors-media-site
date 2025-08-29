# Deployment Instructions for Disruptors Media

## Quick Deploy Options

### Option 1: Deploy Frontend to Netlify (Immediate)

1. **Via Netlify Web Interface (Easiest)**:
   - Open https://app.netlify.com
   - Click "Add new site" → "Deploy manually"
   - Drag and drop this folder: `/disruptorsmedia.com/public/build`
   - Your site will be live in seconds!

2. **Via GitHub Integration**:
   - Open https://app.netlify.com
   - Click "Import from Git"
   - Connect to GitHub and select: `disruptors-media-site`
   - Build settings:
     - Base directory: `disruptorsmedia.com/public`
     - Build command: `npm run build`
     - Publish directory: `disruptorsmedia.com/public/build`
   - Click "Deploy site"

### Option 2: Deploy to DigitalOcean

Since you have DigitalOcean MCP configured, you can:

1. **Create App Platform App**:
   ```bash
   # Connect to your DigitalOcean account via MCP
   # Create new app from GitHub repository
   ```

2. **Configure Apps**:
   - **Frontend App**:
     - Source: GitHub repo
     - Branch: main
     - Source Directory: `/disruptorsmedia.com/public`
     - Build Command: `npm install && npm run build`
     - Static Site

   - **Backend App**:
     - Source: GitHub repo
     - Branch: main
     - Source Directory: `/admin.disruptorsmedia.com`
     - Build Command: `composer install`
     - Run Command: `php artisan serve --host=0.0.0.0 --port=8080`
     - Add MySQL database component

## Current Status

✅ **Frontend Ready**:
- Build completed at: `disruptorsmedia.com/public/build`
- Blog feature integrated at `/blog`
- Environment configured for API

✅ **Backend Ready**:
- Laravel admin panel
- Database migrations ready
- API endpoints configured

✅ **GitHub Repository**:
- URL: https://github.com/TechIntegrationLabs/disruptors-media-site
- All code pushed and ready

## Next Steps

1. **Deploy Frontend** (5 minutes):
   - Use Netlify drag & drop for immediate deployment
   - Configure custom domain later

2. **Deploy Backend** (30 minutes):
   - Use DigitalOcean App Platform
   - Configure database and environment variables
   - Update frontend API URL to match backend

3. **Configure DNS**:
   - Point `disruptorsmedia.com` to Netlify
   - Point `admin.disruptorsmedia.com` to DigitalOcean

## Environment Variables

### Frontend (Netlify)
```
REACT_APP_BASE_URL=https://your-backend-url.ondigitalocean.app
```

### Backend (DigitalOcean)
```
APP_URL=https://your-backend-url.ondigitalocean.app
DB_CONNECTION=mysql
DB_HOST=${db.HOSTNAME}
DB_PORT=${db.PORT}
DB_DATABASE=${db.DATABASE}
DB_USERNAME=${db.USERNAME}
DB_PASSWORD=${db.PASSWORD}
```