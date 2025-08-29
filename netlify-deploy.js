const { execSync } = require('child_process');
const path = require('path');

console.log('🚀 Deploying Disruptors Media to Netlify...');

const buildDir = path.join(__dirname, 'disruptorsmedia.com/public/build');

try {
  // Create a new Netlify site with a unique name
  const siteName = `disruptors-media-${Date.now()}`;
  console.log(`Creating new site: ${siteName}`);
  
  // Deploy to Netlify
  const command = `netlify deploy --prod --dir="${buildDir}" --site="${siteName}"`;
  console.log(`Running: ${command}`);
  
  const output = execSync(command, { encoding: 'utf8', stdio: 'inherit' });
  
  console.log('✅ Deployment successful!');
} catch (error) {
  console.error('❌ Deployment failed:', error.message);
  
  // Alternative: Manual deployment instructions
  console.log('\n📋 Alternative: Manual deployment instructions:');
  console.log('1. Go to https://app.netlify.com');
  console.log('2. Log in with your account');
  console.log('3. Drag and drop the following folder:');
  console.log(`   ${buildDir}`);
  console.log('4. Your site will be live in seconds!');
}