#!/bin/bash

echo "🚀 Preparing Disruptors Media for Netlify deployment..."

# Change to the React app directory
cd disruptorsmedia.com/public

# Check if node_modules exists, if not install dependencies
if [ ! -d "node_modules" ]; then
    echo "📦 Installing dependencies..."
    npm install
else
    echo "✅ Dependencies already installed"
fi

# Build the production bundle
echo "🔨 Building production bundle..."
npm run build

# Check if build was successful
if [ -d "build" ]; then
    echo "✅ Build successful!"
    echo ""
    echo "📁 Build output location: $(pwd)/build"
    echo ""
    echo "🌐 Next steps for Netlify deployment:"
    echo "1. Go to https://app.netlify.com"
    echo "2. Drag and drop the 'build' folder"
    echo "   OR"
    echo "   Use Netlify CLI: netlify deploy --prod --dir=build"
    echo ""
    echo "⚙️  Environment variables needed in Netlify:"
    echo "   REACT_APP_BASE_URL = https://admin.disruptorsmedia.com"
    echo ""
else
    echo "❌ Build failed. Please check for errors above."
    exit 1
fi

# Create netlify.toml for configuration
cat > netlify.toml << EOF
[[redirects]]
  from = "/*"
  to = "/index.html"
  status = 200

[[headers]]
  for = "/*"
  [headers.values]
    X-Frame-Options = "DENY"
    X-XSS-Protection = "1; mode=block"
    X-Content-Type-Options = "nosniff"

[[headers]]
  for = "/static/*"
  [headers.values]
    Cache-Control = "public, max-age=31536000, immutable"
EOF

echo "✅ Created netlify.toml configuration file"
echo ""
echo "🎉 Ready for Netlify deployment!"