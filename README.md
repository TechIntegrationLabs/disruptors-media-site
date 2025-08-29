# Disruptors Media Full Stack Application

## Structure
- `disruptorsmedia.com/` - React frontend application
- `admin.disruptorsmedia.com/` - Laravel admin backend

## Quick Start

### Frontend
```bash
cd disruptorsmedia.com/public
npm install
npm run build
```

### Backend
```bash
cd admin.disruptorsmedia.com
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## Deployment
See `DEPLOYMENT_STRATEGY.md` for detailed deployment instructions.
