# Deployment Guide - Disruptors Media

## GitHub Repository
- **URL**: https://github.com/TechIntegrationLabs/disruptors-media-site
- **Branch**: master

## Frontend Deployment (Netlify)

### Option 1: Automatic Deployment from GitHub
1. Go to https://app.netlify.com
2. Click "Add new site" → "Import an existing project"
3. Connect to GitHub and select: `TechIntegrationLabs/disruptors-media-site`
4. Configure build settings:
   - **Base directory**: `disruptorsmedia.com/public`
   - **Build command**: `npm run build`
   - **Publish directory**: `disruptorsmedia.com/public/build`
   - **Node version**: 18 (set in Environment Variables)

### Option 2: Manual Deployment
1. Build locally:
   ```bash
   cd disruptorsmedia.com/public
   npm install
   npm run build
   ```
2. Drag and drop the `build` folder to Netlify

### Required Environment Variables (Netlify)
```
REACT_APP_BASE_URL = https://admin.disruptorsmedia.com
```

### Custom Domain Setup (Netlify)
1. Go to Site settings → Domain management
2. Add custom domain: `disruptorsmedia.com`
3. Configure DNS records at your domain registrar

## Backend Deployment (DigitalOcean)

### Prerequisites
- DigitalOcean account
- Domain configured for `admin.disruptorsmedia.com`

### Option 1: App Platform (Recommended)
1. Go to DigitalOcean App Platform
2. Create new app from GitHub
3. Select repository: `TechIntegrationLabs/disruptors-media-site`
4. Configure app:
   - **Type**: Web Service
   - **Branch**: master
   - **Source Directory**: `/admin.disruptorsmedia.com`
   - **Build Command**: `composer install --no-dev`
   - **Run Command**: `php artisan serve --host=0.0.0.0 --port=8080`

### Option 2: Traditional VPS Deployment
1. Create Ubuntu 22.04 Droplet
2. SSH into server and install dependencies:
   ```bash
   sudo apt update
   sudo apt install nginx mysql-server php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml composer
   ```

3. Clone repository:
   ```bash
   cd /var/www
   git clone https://github.com/TechIntegrationLabs/disruptors-media-site.git
   cd disruptors-media-site/admin.disruptorsmedia.com
   ```

4. Setup Laravel:
   ```bash
   composer install --no-dev
   cp .env.example .env
   php artisan key:generate
   # Edit .env with database credentials
   php artisan migrate
   ```

5. Configure Nginx (create `/etc/nginx/sites-available/admin.disruptorsmedia.com`):
   ```nginx
   server {
       listen 80;
       server_name admin.disruptorsmedia.com;
       root /var/www/disruptors-media-site/admin.disruptorsmedia.com/public;
       
       index index.php index.html;
       
       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }
       
       location ~ \.php$ {
           include snippets/fastcgi-php.conf;
           fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
       }
   }
   ```

6. Enable site and restart services:
   ```bash
   sudo ln -s /etc/nginx/sites-available/admin.disruptorsmedia.com /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl restart nginx
   ```

### Required Environment Variables (Backend)
```env
APP_NAME="Disruptors Media Admin"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://admin.disruptorsmedia.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=disruptors_media
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# Add other Laravel environment variables as needed
```

### Database Setup
1. Create MySQL database:
   ```sql
   CREATE DATABASE disruptors_media;
   CREATE USER 'disruptors_user'@'localhost' IDENTIFIED BY 'secure_password';
   GRANT ALL PRIVILEGES ON disruptors_media.* TO 'disruptors_user'@'localhost';
   FLUSH PRIVILEGES;
   ```

2. Import existing data (if available):
   ```bash
   mysql -u disruptors_user -p disruptors_media < admin.disruptorsmedia.com/backup.sql
   ```

## SSL Configuration
- **Netlify**: Automatic SSL via Let's Encrypt
- **DigitalOcean**: Use Certbot for Let's Encrypt:
  ```bash
  sudo apt install certbot python3-certbot-nginx
  sudo certbot --nginx -d admin.disruptorsmedia.com
  ```

## Post-Deployment Checklist
- [ ] Frontend accessible at https://disruptorsmedia.com
- [ ] Backend accessible at https://admin.disruptorsmedia.com
- [ ] API endpoints working (test from frontend)
- [ ] File uploads working (check permissions)
- [ ] Database migrations completed
- [ ] SSL certificates active
- [ ] Environment variables configured
- [ ] Error logging enabled
- [ ] Backup strategy implemented

## Monitoring
- Set up uptime monitoring for both domains
- Configure error tracking (e.g., Sentry)
- Set up log aggregation
- Monitor server resourcescc