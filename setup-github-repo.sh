#!/bin/bash

echo "🐙 Setting up GitHub repository structure for Disruptors Media..."

# Create .gitignore for the root
cat > .gitignore << 'EOF'
# Dependencies
node_modules/
vendor/

# Environment files
.env
.env.local
.env.production

# Build outputs
build/
dist/
*.log

# IDE
.vscode/
.idea/

# OS
.DS_Store
Thumbs.db

# Laravel specific
storage/logs/
storage/framework/
bootstrap/cache/
public/hot

# Uploaded files
public/uploads/
public/galleries/
public/podcast_videos/
public/portfolios/
EOF

# Create README.md
cat > README.md << 'EOF'
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
EOF

echo "✅ Created .gitignore and README.md"

# Initialize git repository
if [ ! -d ".git" ]; then
    git init
    echo "✅ Initialized git repository"
fi

echo ""
echo "📋 Next steps:"
echo "1. Create a new repository on GitHub"
echo "2. Add remote: git remote add origin https://github.com/YOUR_USERNAME/disruptors-media.git"
echo "3. Add files: git add ."
echo "4. Commit: git commit -m 'Initial commit: Disruptors Media site with blog'"
echo "5. Push: git push -u origin main"