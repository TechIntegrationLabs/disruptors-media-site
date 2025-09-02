/**
 * Module Discovery Service
 * Automatically discovers, scans, and analyzes modules in the filesystem
 */

const fs = require('fs').promises;
const path = require('path');
const glob = require('glob');
const semver = require('semver');

class ModuleDiscovery {
  constructor(config) {
    this.config = config;
    this.moduleCache = new Map();
  }

  /**
   * Scan all watch directories for modules
   */
  async scanAll() {
    console.log('🔍 Starting comprehensive module discovery...');
    
    const allModules = [];
    
    for (const watchDir of this.config.watchDirectories) {
      try {
        const modules = await this.scanDirectory(watchDir);
        allModules.push(...modules);
        console.log(`📦 Found ${modules.length} modules in ${watchDir}`);
      } catch (error) {
        console.warn(`⚠️ Could not scan directory ${watchDir}:`, error.message);
      }
    }
    
    console.log(`🎯 Total modules discovered: ${allModules.length}`);
    return allModules;
  }

  /**
   * Scan a specific directory for modules
   */
  async scanDirectory(dirPath) {
    try {
      await fs.access(dirPath);
    } catch {
      console.warn(`📂 Directory does not exist: ${dirPath}`);
      return [];
    }
    
    const entries = await fs.readdir(dirPath, { withFileTypes: true });
    const modules = [];
    
    for (const entry of entries) {
      if (entry.isDirectory() && !entry.name.startsWith('.') && !entry.name.startsWith('_')) {
        const modulePath = path.join(dirPath, entry.name);
        const module = await this.scanModule(modulePath);
        
        if (module) {
          modules.push(module);
        }
      }
    }
    
    return modules;
  }

  /**
   * Scan a specific module directory
   */
  async scanModule(modulePath) {
    try {
      const moduleName = path.basename(modulePath);
      
      // Check cache first
      const cacheKey = `${modulePath}:${await this.getPathMtime(modulePath)}`;
      if (this.moduleCache.has(cacheKey)) {
        return this.moduleCache.get(cacheKey);
      }
      
      // Verify it's a valid module
      if (!await this.isValidModule(modulePath)) {
        return null;
      }
      
      console.log(`🔍 Scanning module: ${moduleName}`);
      
      const module = {
        name: moduleName,
        path: modulePath,
        type: await this.detectModuleType(modulePath),
        version: await this.getModuleVersion(modulePath),
        description: await this.getModuleDescription(modulePath),
        dependencies: await this.getModuleDependencies(modulePath),
        files: await this.getModuleFiles(modulePath),
        structure: await this.analyzeModuleStructure(modulePath),
        metadata: await this.extractModuleMetadata(modulePath),
        status: 'active',
        createdAt: await this.getModuleCreationDate(modulePath),
        updatedAt: await this.getModuleUpdateDate(modulePath),
        size: await this.getModuleSize(modulePath),
        health: await this.assessModuleHealth(modulePath),
        tags: await this.extractModuleTags(modulePath),
        compatibility: await this.checkModuleCompatibility(modulePath)
      };
      
      // Cache the result
      this.moduleCache.set(cacheKey, module);
      
      return module;
      
    } catch (error) {
      console.error(`❌ Error scanning module ${modulePath}:`, error);
      return null;
    }
  }

  /**
   * Check if a directory contains a valid module
   */
  async isValidModule(modulePath) {
    try {
      // Must have at least a README or package.json
      const hasReadme = await this.fileExists(path.join(modulePath, 'README.md'));
      const hasPackageJson = await this.fileExists(path.join(modulePath, 'package.json'));
      const hasIndex = await this.fileExists(path.join(modulePath, 'index.js')) ||
                      await this.fileExists(path.join(modulePath, 'src', 'index.js'));
      
      return hasReadme || hasPackageJson || hasIndex;
    } catch {
      return false;
    }
  }

  /**
   * Detect module type based on structure and files
   */
  async detectModuleType(modulePath) {
    const packageJsonPath = path.join(modulePath, 'package.json');
    
    try {
      const packageJson = JSON.parse(await fs.readFile(packageJsonPath, 'utf8'));
      
      // Check dependencies for framework clues
      const deps = { ...packageJson.dependencies, ...packageJson.devDependencies };
      
      if (deps.react || deps['react-dom']) {
        if (deps.next || deps['next.js']) {
          return 'nextjs';
        }
        return 'react';
      }
      
      if (deps.wordpress || await this.fileExists(path.join(modulePath, 'functions.php'))) {
        return 'wordpress';
      }
      
      if (deps.vue || deps['vue-cli']) {
        return 'vue';
      }
      
      if (deps.angular || deps['@angular/core']) {
        return 'angular';
      }
      
    } catch {
      // No package.json, check file structure
    }
    
    // Check for specific file patterns
    const files = await this.getModuleFiles(modulePath);
    
    if (files.some(f => f.endsWith('.php'))) {
      return 'wordpress';
    }
    
    if (files.some(f => f.endsWith('.jsx') || f.endsWith('.tsx'))) {
      return 'react';
    }
    
    if (files.some(f => f.endsWith('.vue'))) {
      return 'vue';
    }
    
    return 'vanilla';
  }

  /**
   * Get module version from package.json or README
   */
  async getModuleVersion(modulePath) {
    try {
      const packageJsonPath = path.join(modulePath, 'package.json');
      const packageJson = JSON.parse(await fs.readFile(packageJsonPath, 'utf8'));
      return packageJson.version || '1.0.0';
    } catch {
      // Try to extract from README
      try {
        const readmePath = path.join(modulePath, 'README.md');
        const readme = await fs.readFile(readmePath, 'utf8');
        const versionMatch = readme.match(/version[:\s]+([0-9]+\.[0-9]+\.[0-9]+)/i);
        return versionMatch ? versionMatch[1] : '1.0.0';
      } catch {
        return '1.0.0';
      }
    }
  }

  /**
   * Get module description
   */
  async getModuleDescription(modulePath) {
    try {
      // Try package.json first
      const packageJsonPath = path.join(modulePath, 'package.json');
      const packageJson = JSON.parse(await fs.readFile(packageJsonPath, 'utf8'));
      if (packageJson.description) {
        return packageJson.description;
      }
    } catch {}
    
    try {
      // Try README.md
      const readmePath = path.join(modulePath, 'README.md');
      const readme = await fs.readFile(readmePath, 'utf8');
      
      // Extract first paragraph or heading
      const lines = readme.split('\n').filter(line => line.trim());
      for (const line of lines) {
        if (!line.startsWith('#') && line.length > 20) {
          return line.replace(/[*_`]/g, '').trim();
        }
      }
      
      // Get first heading that's not title
      const headingMatch = readme.match(/^#{2,3}\s+(.+)$/m);
      if (headingMatch) {
        return headingMatch[1];
      }
    } catch {}
    
    return `Module: ${path.basename(modulePath)}`;
  }

  /**
   * Get module dependencies
   */
  async getModuleDependencies(modulePath) {
    try {
      const packageJsonPath = path.join(modulePath, 'package.json');
      const packageJson = JSON.parse(await fs.readFile(packageJsonPath, 'utf8'));
      
      return {
        production: packageJson.dependencies || {},
        development: packageJson.devDependencies || {},
        peer: packageJson.peerDependencies || {},
        optional: packageJson.optionalDependencies || {}
      };
    } catch {
      return {
        production: {},
        development: {},
        peer: {},
        optional: {}
      };
    }
  }

  /**
   * Get all files in module
   */
  async getModuleFiles(modulePath, relativePath = '') {
    const files = [];
    
    try {
      const entries = await fs.readdir(path.join(modulePath, relativePath), { withFileTypes: true });
      
      for (const entry of entries) {
        const entryPath = path.join(relativePath, entry.name);
        
        // Skip common ignored directories
        if (entry.isDirectory() && this.shouldIgnoreDirectory(entry.name)) {
          continue;
        }
        
        if (entry.isFile()) {
          files.push(entryPath);
        } else if (entry.isDirectory()) {
          const subFiles = await this.getModuleFiles(modulePath, entryPath);
          files.push(...subFiles);
        }
      }
    } catch (error) {
      console.warn(`Could not read directory ${path.join(modulePath, relativePath)}:`, error.message);
    }
    
    return files;
  }

  /**
   * Analyze module structure
   */
  async analyzeModuleStructure(modulePath) {
    const files = await this.getModuleFiles(modulePath);
    const structure = {
      hasReadme: false,
      hasPackageJson: false,
      hasTests: false,
      hasDocumentation: false,
      hasExamples: false,
      hasTemplates: false,
      hasAssets: false,
      hasSrc: false,
      hasComponents: false,
      hasServices: false,
      hasStyles: false,
      hasConfig: false,
      directories: [],
      fileTypes: {}
    };
    
    // Analyze files
    for (const file of files) {
      const ext = path.extname(file).toLowerCase();
      const fileName = path.basename(file).toLowerCase();
      const dirName = path.dirname(file);
      
      // Track file types
      structure.fileTypes[ext] = (structure.fileTypes[ext] || 0) + 1;
      
      // Check for specific files
      if (fileName === 'readme.md') structure.hasReadme = true;
      if (fileName === 'package.json') structure.hasPackageJson = true;
      
      // Check for directories/patterns
      if (file.includes('test') || file.includes('spec')) structure.hasTests = true;
      if (file.includes('doc') || file.includes('documentation')) structure.hasDocumentation = true;
      if (file.includes('example')) structure.hasExamples = true;
      if (file.includes('template')) structure.hasTemplates = true;
      if (file.includes('asset') || file.includes('image') || file.includes('media')) structure.hasAssets = true;
      if (file.includes('src')) structure.hasSrc = true;
      if (file.includes('component')) structure.hasComponents = true;
      if (file.includes('service')) structure.hasServices = true;
      if (ext === '.css' || ext === '.scss' || ext === '.sass' || ext === '.less') structure.hasStyles = true;
      if (fileName.includes('config') || fileName.includes('setting')) structure.hasConfig = true;
      
      // Track unique directories
      if (dirName && dirName !== '.' && !structure.directories.includes(dirName)) {
        structure.directories.push(dirName);
      }
    }
    
    return structure;
  }

  /**
   * Extract module metadata
   */
  async extractModuleMetadata(modulePath) {
    const metadata = {
      framework: null,
      category: 'utility',
      tags: [],
      author: null,
      license: null,
      homepage: null,
      repository: null,
      keywords: []
    };
    
    try {
      const packageJsonPath = path.join(modulePath, 'package.json');
      const packageJson = JSON.parse(await fs.readFile(packageJsonPath, 'utf8'));
      
      metadata.author = packageJson.author;
      metadata.license = packageJson.license;
      metadata.homepage = packageJson.homepage;
      metadata.repository = packageJson.repository;
      metadata.keywords = packageJson.keywords || [];
      
    } catch {}
    
    // Try to extract category from path or README
    const moduleName = path.basename(modulePath).toLowerCase();
    if (moduleName.includes('blog')) metadata.category = 'content';
    if (moduleName.includes('auth')) metadata.category = 'authentication';
    if (moduleName.includes('pay')) metadata.category = 'payment';
    if (moduleName.includes('ui') || moduleName.includes('component')) metadata.category = 'ui';
    if (moduleName.includes('api')) metadata.category = 'api';
    if (moduleName.includes('util')) metadata.category = 'utility';
    
    return metadata;
  }

  /**
   * Assess module health
   */
  async assessModuleHealth(modulePath) {
    const health = {
      score: 100,
      status: 'healthy',
      issues: [],
      warnings: []
    };
    
    const structure = await this.analyzeModuleStructure(modulePath);
    
    // Check for essential files
    if (!structure.hasReadme) {
      health.issues.push('Missing README.md file');
      health.score -= 20;
    }
    
    if (!structure.hasPackageJson) {
      health.warnings.push('Missing package.json file');
      health.score -= 10;
    }
    
    if (!structure.hasTests) {
      health.warnings.push('No test files found');
      health.score -= 15;
    }
    
    if (!structure.hasDocumentation && !structure.hasReadme) {
      health.issues.push('No documentation found');
      health.score -= 25;
    }
    
    // Check for outdated dependencies
    try {
      const deps = await this.getModuleDependencies(modulePath);
      const outdatedDeps = await this.checkOutdatedDependencies(deps);
      if (outdatedDeps.length > 0) {
        health.warnings.push(`${outdatedDeps.length} dependencies may be outdated`);
        health.score -= Math.min(outdatedDeps.length * 5, 20);
      }
    } catch {}
    
    // Determine status
    if (health.score >= 80) health.status = 'healthy';
    else if (health.score >= 60) health.status = 'warning';
    else health.status = 'critical';
    
    return health;
  }

  /**
   * Extract module tags from content
   */
  async extractModuleTags(modulePath) {
    const tags = [];
    
    try {
      const readmePath = path.join(modulePath, 'README.md');
      const readme = await fs.readFile(readmePath, 'utf8');
      
      // Extract tags from badges
      const badgeMatches = readme.match(/!\[([^\]]+)\]/g) || [];
      badgeMatches.forEach(badge => {
        const tag = badge.match(/!\[([^\]]+)\]/)?.[1];
        if (tag && tag.length < 20) {
          tags.push(tag.toLowerCase());
        }
      });
      
      // Extract from content
      const commonTags = ['react', 'vue', 'angular', 'typescript', 'javascript', 'css', 'sass', 'responsive', 'mobile', 'api', 'cms', 'blog', 'ecommerce', 'authentication', 'payment', 'ui', 'component', 'library', 'framework', 'utility', 'tool'];
      
      commonTags.forEach(tag => {
        if (readme.toLowerCase().includes(tag) && !tags.includes(tag)) {
          tags.push(tag);
        }
      });
      
    } catch {}
    
    return [...new Set(tags)];
  }

  /**
   * Check module compatibility
   */
  async checkModuleCompatibility(modulePath) {
    const compatibility = {
      frameworks: [],
      browsers: [],
      nodeVersions: [],
      platforms: []
    };
    
    try {
      const packageJsonPath = path.join(modulePath, 'package.json');
      const packageJson = JSON.parse(await fs.readFile(packageJsonPath, 'utf8'));
      
      // Check engines
      if (packageJson.engines) {
        if (packageJson.engines.node) {
          compatibility.nodeVersions.push(packageJson.engines.node);
        }
      }
      
      // Check browserslist
      if (packageJson.browserslist) {
        compatibility.browsers = Array.isArray(packageJson.browserslist) 
          ? packageJson.browserslist 
          : [packageJson.browserslist];
      }
      
      // Infer from dependencies
      const deps = { ...packageJson.dependencies, ...packageJson.devDependencies };
      
      if (deps.react) compatibility.frameworks.push('react');
      if (deps.vue) compatibility.frameworks.push('vue');
      if (deps.angular) compatibility.frameworks.push('angular');
      if (deps.next) compatibility.frameworks.push('nextjs');
      
    } catch {}
    
    return compatibility;
  }

  /**
   * Utility methods
   */
  
  async fileExists(filePath) {
    try {
      await fs.access(filePath);
      return true;
    } catch {
      return false;
    }
  }
  
  async getPathMtime(filePath) {
    try {
      const stats = await fs.stat(filePath);
      return stats.mtime.getTime();
    } catch {
      return 0;
    }
  }
  
  async getModuleCreationDate(modulePath) {
    try {
      const stats = await fs.stat(modulePath);
      return stats.birthtime.toISOString();
    } catch {
      return new Date().toISOString();
    }
  }
  
  async getModuleUpdateDate(modulePath) {
    try {
      const stats = await fs.stat(modulePath);
      return stats.mtime.toISOString();
    } catch {
      return new Date().toISOString();
    }
  }
  
  async getModuleSize(modulePath) {
    try {
      const files = await this.getModuleFiles(modulePath);
      let totalSize = 0;
      
      for (const file of files) {
        try {
          const stats = await fs.stat(path.join(modulePath, file));
          totalSize += stats.size;
        } catch {}
      }
      
      return totalSize;
    } catch {
      return 0;
    }
  }
  
  shouldIgnoreDirectory(dirName) {
    const ignoredDirs = [
      'node_modules',
      '.git',
      '.svn',
      'dist',
      'build',
      'coverage',
      '.nyc_output',
      '.cache',
      'tmp',
      'temp'
    ];
    
    return ignoredDirs.includes(dirName) || dirName.startsWith('.');
  }
  
  async checkOutdatedDependencies(dependencies) {
    // Simplified check - in real implementation would use npm outdated or similar
    const outdated = [];
    
    for (const [name, version] of Object.entries(dependencies.production)) {
      // Check if version is very old (simplified)
      if (version.startsWith('^0.') || version.startsWith('~0.')) {
        outdated.push({ name, version, type: 'major' });
      }
    }
    
    return outdated;
  }
}

module.exports = ModuleDiscovery;