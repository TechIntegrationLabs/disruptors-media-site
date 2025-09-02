# 🚀 Disruptors Media - Development Workflow

## 🎯 **Quick Start for Any Claude Code Instance**

### Immediate Actions (30 seconds)
1. **Read context**: `/DM/DISRUPTORS_AGENT.md` (project state)
2. **Check workspace**: `/WORKSPACE_INSTRUCTIONS.md` (rules)
3. **Verify location**: Ensure you're in `/DM/` directory
4. **Update status**: Run `node sync-context.js status`

### Current Project Status
- **Frontend**: ✅ LIVE at https://frabjous-babka-d9c26b.netlify.app
- **Backend**: 🔄 Needs redeploy (failed DigitalOcean deployment)
- **Priority**: Blog images implementation + backend fix

## 🛠️ **Development Environment Setup**

### Prerequisites
- Node.js 18+
- PHP 8.0+ with Composer
- DigitalOcean CLI (`doctl`)
- Netlify CLI

### Local Development Commands
```bash
# Frontend (React 18)
cd /Users/disruptors/Documents/ProjectsD/DisruptorEcosystem/Legacy/sites/fulldisruptorssitewithimages/DM/disruptorsmedia.com/public
npm install
npm start    # Runs on http://localhost:3000

# Backend (Laravel 9)
cd /Users/disruptors/Documents/ProjectsD/DisruptorEcosystem/Legacy/sites/fulldisruptorssitewithimages/DM/admin.disruptorsmedia.com
composer install
cp .env.example .env
php artisan key:generate
php artisan serve    # Runs on http://localhost:8000
```

## 📝 **Blog Images Implementation Guide**

The user wants to add images to blog posts. The blog feature is already built in React - just needs image functionality.

### Option 1: Laravel File Storage (Recommended)
```php
// In Laravel AdminController
public function uploadBlogImage(Request $request) {
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);
    
    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $imagePath = $image->storeAs('blog_images', $imageName, 'public');
    
    return response()->json([
        'success' => true,
        'url' => asset('storage/' . $imagePath)
    ]);
}
```

```javascript
// In React BlogPost.js component
const uploadImage = async (file) => {
  const formData = new FormData();
  formData.append('image', file);
  
  const response = await fetch(`${process.env.REACT_APP_BASE_URL}/upload-blog-image`, {
    method: 'POST',
    body: formData
  });
  
  const data = await response.json();
  return data.url;
};
```

### Option 2: Vercel Blob Integration
```javascript
// Install: npm install @vercel/blob
import { upload } from '@vercel/blob/client';

const uploadToVercel = async (file) => {
  const blob = await upload(file.name, file, {
    access: 'public',
    handleUploadUrl: '/api/blog/upload-image',
  });
  return blob.url;
};
```

### Option 3: GitHub-based Images
```
/DM/disruptorsmedia.com/public/images/blog/
├── 2025/
│   ├── 01/
│   │   ├── post-1-hero.jpg
│   │   └── post-1-content.png
│   └── 02/
│       └── post-2-featured.jpg
```

## 🚀 **Deployment Workflow**

### Frontend Deployment (Working)
```bash
cd /DM/disruptorsmedia.com/public
npm run build
netlify deploy --prod --dir=build
```

### Backend Deployment (Needs Fix)
```bash
# Check current status
doctl apps get f361de5e-6e4b-42d3-a219-d2461669aafe

# Redeploy if needed
doctl apps create --spec /DM/simple-backend-app.yaml

# Or update existing
doctl apps update f361de5e-6e4b-42d3-a219-d2461669aafe --spec /DM/simple-backend-app.yaml
```

### Database Status Check
```bash
doctl databases get 66054882-b34e-420e-878c-a6b25e939833
```

## 🔄 **Context Management System**

### Before Starting Work
```bash
# Check current project state
node /DM/sync-context.js status

# Read agent context
cat /DM/DISRUPTORS_AGENT.md
```

### During Work
```bash
# Update project state
node /DM/sync-context.js update '{"currentTasks": {"active": [{"task": "Blog images", "status": "IN_PROGRESS"}]}}'
```

### After Completing Work
```bash
# Log your session
node /DM/sync-context.js sync "Claude-BlogWork" "Implemented image upload" "Fixed API endpoints" "Updated frontend components"
```

### Update Agent Context
Edit `/DM/DISRUPTORS_AGENT.md` with:
- Last completed task
- Current status  
- Next priority actions
- Any issues encountered

## 🧪 **Testing Workflow**

### Frontend Testing
```bash
cd /DM/disruptorsmedia.com/public
npm test                    # Jest tests
npm run build              # Production build test
curl -I https://frabjous-babka-d9c26b.netlify.app    # Live site test
```

### Backend Testing  
```bash
cd /DM/admin.disruptorsmedia.com
php artisan test           # PHPUnit tests
php artisan migrate:fresh  # Database test
```

### Full Stack Testing
1. Start both local servers
2. Test API endpoints from React
3. Verify image upload functionality
4. Check database connections

## 🐛 **Troubleshooting**

### Common Issues

**Backend Deployment Fails**
```bash
# Check app logs
doctl apps logs f361de5e-6e4b-42d3-a219-d2461669aafe --type build

# Check database connection
doctl databases connection 66054882-b34e-420e-878c-a6b25e939833
```

**Frontend API Connection Issues**
- Verify `REACT_APP_BASE_URL` in environment
- Check CORS settings in Laravel
- Test API endpoints directly with curl

**Context Loss Between Sessions**
- Always read `/DM/DISRUPTORS_AGENT.md` first
- Check `/DM/STATE_TRACKER.json` for current state
- Run `node sync-context.js status`

## 📊 **Progress Tracking**

### Project Completion Status
- ✅ Frontend: 100% (Live and functional)
- 🔄 Backend: 80% (Coded but deployment failed)  
- 🎯 Blog Images: 0% (User priority request)
- 🔗 Full Stack: 60% (API integration pending)

### Current Priorities (High to Low)
1. **Blog Images Implementation** (User request)
2. **Backend Deployment Fix** (Technical debt)
3. **API Integration** (Connect frontend to backend)
4. **Custom Domain Setup** (admin.disruptorsmedia.com)
5. **Database Migration** (Import existing data)

## 🎯 **Success Criteria**

### Blog Images Feature (User Goal)
- [ ] User can upload images in blog posts
- [ ] Images are properly stored and served
- [ ] Frontend displays images correctly
- [ ] Admin panel has image management

### Full Deployment (Technical Goal)  
- [ ] Backend successfully deployed on DigitalOcean
- [ ] Frontend connected to backend API
- [ ] Database migrations completed
- [ ] Custom domains configured

### Context Continuity (Process Goal)
- [ ] Any Claude instance can immediately understand project state
- [ ] No confusion about which files to work on
- [ ] Development continues seamlessly across sessions
- [ ] All work is properly tracked and documented

---

**🚀 Ready to work on Disruptors Media? Follow this checklist:**
- [ ] Read `/DM/DISRUPTORS_AGENT.md` 
- [ ] Run `node sync-context.js status`
- [ ] Understand current priority (Blog Images + Backend Fix)
- [ ] Work only in `/DM/` directory
- [ ] Update context files when done