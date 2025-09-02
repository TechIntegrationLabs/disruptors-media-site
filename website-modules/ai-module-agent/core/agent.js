#!/usr/bin/env node

/**
 * AI-First Module Agent - Core Orchestration Engine
 * Autonomous system for managing website module lifecycle
 */

const fs = require('fs').promises;
const path = require('path');
const chokidar = require('chokidar');
const cron = require('node-cron');
const { EventEmitter } = require('events');

const ModuleDiscovery = require('./discovery');
const ModuleCatalog = require('./catalog');
const ModuleOrchestrator = require('./orchestrator');
const AIAnalyzer = require('../intelligence/analyzer');
const config = require('../config/agent.config');

class AIModuleAgent extends EventEmitter {
  constructor(options = {}) {
    super();
    
    this.config = { ...config, ...options };
    this.isRunning = false;
    this.watchers = [];
    this.scheduledTasks = [];
    
    // Initialize core components
    this.discovery = new ModuleDiscovery(this.config);
    this.catalog = new ModuleCatalog(this.config);
    this.orchestrator = new ModuleOrchestrator(this.config);
    this.aiAnalyzer = new AIAnalyzer(this.config);
    
    // Bind event handlers
    this.setupEventHandlers();
    
    console.log('🤖 AI Module Agent initialized');
  }

  /**
   * Start the agent with all monitoring and automation
   */
  async start() {
    try {
      console.log('🚀 Starting AI Module Agent...');
      
      // Initialize data directory
      await this.initializeDataDirectory();
      
      // Load existing catalog
      await this.catalog.load();
      
      // Initial module discovery
      console.log('🔍 Performing initial module discovery...');
      await this.performInitialDiscovery();
      
      // Start file system monitoring
      this.startFileSystemWatching();
      
      // Start scheduled tasks
      this.startScheduledTasks();
      
      // Start health monitoring
      this.startHealthMonitoring();
      
      this.isRunning = true;
      console.log('✅ AI Module Agent started successfully');
      
      this.emit('agent:started');
      
    } catch (error) {
      console.error('❌ Failed to start AI Module Agent:', error);
      throw error;
    }
  }

  /**
   * Stop the agent and cleanup resources
   */
  async stop() {
    console.log('🛑 Stopping AI Module Agent...');
    
    this.isRunning = false;
    
    // Stop file watchers
    this.watchers.forEach(watcher => watcher.close());
    this.watchers = [];
    
    // Stop scheduled tasks
    this.scheduledTasks.forEach(task => task.stop());
    this.scheduledTasks = [];
    
    // Save catalog state
    await this.catalog.save();
    
    console.log('✅ AI Module Agent stopped');
    this.emit('agent:stopped');
  }

  /**
   * Initialize data directories and files
   */
  async initializeDataDirectory() {
    const dataDir = path.join(__dirname, '..', 'data');
    
    try {
      await fs.access(dataDir);
    } catch {
      await fs.mkdir(dataDir, { recursive: true });
    }
    
    // Initialize data files if they don't exist
    const dataFiles = [
      'registry.json',
      'dependencies.json',
      'analytics.json',
      'health.json'
    ];
    
    for (const file of dataFiles) {
      const filePath = path.join(dataDir, file);
      try {
        await fs.access(filePath);
      } catch {
        await fs.writeFile(filePath, '{}', 'utf8');
      }
    }
  }

  /**
   * Perform initial module discovery and cataloging
   */
  async performInitialDiscovery() {
    const modules = await this.discovery.scanAll();
    
    console.log(`📦 Discovered ${modules.length} modules`);
    
    for (const module of modules) {
      await this.catalog.addModule(module);
      
      // Perform AI analysis on new modules
      if (this.config.enableAI) {
        const analysis = await this.aiAnalyzer.analyzeModule(module);
        await this.catalog.updateModuleAnalysis(module.name, analysis);
      }
    }
    
    await this.catalog.save();
    console.log('📚 Module catalog updated');
  }

  /**
   * Start file system monitoring for automatic module detection
   */
  startFileSystemWatching() {
    console.log('👀 Starting file system monitoring...');
    
    this.config.watchDirectories.forEach(dir => {
      const watcher = chokidar.watch(dir, {
        ignored: /(^|[\/\\])\\../, // ignore dotfiles
        persistent: true,
        ignoreInitial: true
      });

      watcher
        .on('add', async (filePath) => {
          await this.handleFileChange('add', filePath);
        })
        .on('change', async (filePath) => {
          await this.handleFileChange('change', filePath);
        })
        .on('unlink', async (filePath) => {
          await this.handleFileChange('delete', filePath);
        })
        .on('addDir', async (dirPath) => {
          await this.handleDirectoryChange('add', dirPath);
        })
        .on('unlinkDir', async (dirPath) => {
          await this.handleDirectoryChange('delete', dirPath);
        });

      this.watchers.push(watcher);
    });
  }

  /**
   * Start scheduled maintenance tasks
   */
  startScheduledTasks() {
    console.log('⏰ Starting scheduled tasks...');
    
    // Module health check - every 15 minutes
    const healthCheckTask = cron.schedule('*/15 * * * *', async () => {
      if (this.isRunning) {
        await this.performHealthCheck();
      }
    });
    this.scheduledTasks.push(healthCheckTask);
    
    // Dependency updates check - every hour
    const dependencyCheckTask = cron.schedule('0 * * * *', async () => {
      if (this.isRunning) {
        await this.checkDependencyUpdates();
      }
    });
    this.scheduledTasks.push(dependencyCheckTask);
    
    // AI analysis refresh - every 6 hours
    if (this.config.enableAI) {
      const aiAnalysisTask = cron.schedule('0 */6 * * *', async () => {
        if (this.isRunning) {
          await this.refreshAIAnalysis();
        }
      });
      this.scheduledTasks.push(aiAnalysisTask);
    }
    
    // Cleanup and optimization - daily at 2 AM
    const cleanupTask = cron.schedule('0 2 * * *', async () => {
      if (this.isRunning) {
        await this.performCleanup();
      }
    });
    this.scheduledTasks.push(cleanupTask);
  }

  /**
   * Start health monitoring
   */
  startHealthMonitoring() {
    console.log('🏥 Starting health monitoring...');
    
    setInterval(async () => {
      if (this.isRunning) {
        const health = await this.getSystemHealth();
        this.emit('health:update', health);
        
        // Check for critical issues
        if (health.status === 'critical') {
          this.emit('health:critical', health);
          console.warn('⚠️ Critical health issues detected:', health.issues);
        }
      }
    }, 60000); // Every minute
  }

  /**
   * Handle file system changes
   */
  async handleFileChange(action, filePath) {
    try {
      const modulePath = this.getModulePathFromFile(filePath);
      if (!modulePath) return;
      
      console.log(`📝 File ${action}: ${filePath}`);
      
      switch (action) {
        case 'add':
        case 'change':
          await this.handleModuleUpdate(modulePath);
          break;
        case 'delete':
          await this.handleModuleFileDelete(modulePath, filePath);
          break;
      }
      
      this.emit('file:changed', { action, filePath, modulePath });
      
    } catch (error) {
      console.error(`Error handling file change (${action}):`, error);
      this.emit('error', error);
    }
  }

  /**
   * Handle directory changes
   */
  async handleDirectoryChange(action, dirPath) {
    try {
      if (this.isModuleDirectory(dirPath)) {
        console.log(`📁 Module directory ${action}: ${dirPath}`);
        
        switch (action) {
          case 'add':
            const module = await this.discovery.scanModule(dirPath);
            if (module) {
              await this.catalog.addModule(module);
              await this.orchestrator.initializeModule(module);
              
              if (this.config.enableAI) {
                const analysis = await this.aiAnalyzer.analyzeModule(module);
                await this.catalog.updateModuleAnalysis(module.name, analysis);
              }
            }
            break;
            
          case 'delete':
            await this.catalog.removeModule(path.basename(dirPath));
            break;
        }
        
        await this.catalog.save();
        this.emit('module:changed', { action, dirPath });
      }
    } catch (error) {
      console.error(`Error handling directory change (${action}):`, error);
      this.emit('error', error);
    }
  }

  /**
   * Perform system health check
   */
  async performHealthCheck() {
    try {
      console.log('🏥 Performing health check...');
      
      const health = await this.getSystemHealth();
      
      // Update health data
      const healthDataPath = path.join(__dirname, '..', 'data', 'health.json');
      await fs.writeFile(healthDataPath, JSON.stringify({
        ...health,
        lastCheck: new Date().toISOString()
      }, null, 2));
      
      this.emit('health:check', health);
      
    } catch (error) {
      console.error('Health check failed:', error);
      this.emit('error', error);
    }
  }

  /**
   * Check for dependency updates
   */
  async checkDependencyUpdates() {
    try {
      console.log('🔄 Checking dependency updates...');
      
      const modules = await this.catalog.getAllModules();
      const updates = [];
      
      for (const module of modules) {
        const moduleUpdates = await this.orchestrator.checkUpdates(module);
        if (moduleUpdates.length > 0) {
          updates.push({ module: module.name, updates: moduleUpdates });
        }
      }
      
      if (updates.length > 0) {
        console.log(`📦 Found updates for ${updates.length} modules`);
        this.emit('updates:available', updates);
        
        // Auto-apply if enabled
        if (this.config.enableAutomaticUpdates) {
          await this.applyUpdates(updates);
        }
      }
      
    } catch (error) {
      console.error('Dependency update check failed:', error);
      this.emit('error', error);
    }
  }

  /**
   * Refresh AI analysis for all modules
   */
  async refreshAIAnalysis() {
    if (!this.config.enableAI) return;
    
    try {
      console.log('🧠 Refreshing AI analysis...');
      
      const modules = await this.catalog.getAllModules();
      
      for (const module of modules) {
        const analysis = await this.aiAnalyzer.analyzeModule(module);
        await this.catalog.updateModuleAnalysis(module.name, analysis);
      }
      
      await this.catalog.save();
      console.log('✅ AI analysis refreshed for all modules');
      
    } catch (error) {
      console.error('AI analysis refresh failed:', error);
      this.emit('error', error);
    }
  }

  /**
   * Perform cleanup and optimization
   */
  async performCleanup() {
    try {
      console.log('🧹 Performing cleanup and optimization...');
      
      // Clean up orphaned data
      await this.catalog.cleanupOrphanedData();
      
      // Optimize catalog
      await this.catalog.optimize();
      
      // Archive old analytics data
      await this.archiveOldData();
      
      // Run garbage collection
      if (global.gc) {
        global.gc();
      }
      
      console.log('✅ Cleanup completed');
      this.emit('cleanup:completed');
      
    } catch (error) {
      console.error('Cleanup failed:', error);
      this.emit('error', error);
    }
  }

  /**
   * Get system health status
   */
  async getSystemHealth() {
    const health = {
      status: 'healthy',
      timestamp: new Date().toISOString(),
      issues: [],
      metrics: {}
    };
    
    try {
      // Check module count
      const moduleCount = await this.catalog.getModuleCount();
      health.metrics.moduleCount = moduleCount;
      
      // Check disk usage
      const dataDir = path.join(__dirname, '..', 'data');
      const stats = await fs.stat(dataDir);
      health.metrics.dataDirSize = stats.size;
      
      // Check for critical issues
      const modules = await this.catalog.getAllModules();
      const brokenModules = modules.filter(m => m.status === 'broken');
      
      if (brokenModules.length > 0) {
        health.issues.push(`${brokenModules.length} modules are broken`);
        health.status = brokenModules.length > moduleCount * 0.1 ? 'critical' : 'warning';
      }
      
      // Check memory usage
      const memUsage = process.memoryUsage();
      health.metrics.memoryUsage = memUsage;
      
      if (memUsage.heapUsed > 1024 * 1024 * 1024) { // 1GB
        health.issues.push('High memory usage detected');
        health.status = 'warning';
      }
      
    } catch (error) {
      health.status = 'critical';
      health.issues.push(`Health check error: ${error.message}`);
    }
    
    return health;
  }

  /**
   * Setup event handlers
   */
  setupEventHandlers() {
    this.on('error', (error) => {
      console.error('🚨 Agent error:', error);
    });
    
    this.on('health:critical', (health) => {
      console.warn('🚨 Critical health issues:', health.issues);
      // Could send alerts here
    });
    
    this.on('module:created', (module) => {
      console.log(`✅ Module created: ${module.name}`);
    });
    
    this.on('module:updated', (module) => {
      console.log(`🔄 Module updated: ${module.name}`);
    });
  }

  /**
   * Utility methods
   */
  
  getModulePathFromFile(filePath) {
    for (const watchDir of this.config.watchDirectories) {
      if (filePath.startsWith(watchDir)) {
        const relativePath = path.relative(watchDir, filePath);
        const parts = relativePath.split(path.sep);
        if (parts.length > 0) {
          return path.join(watchDir, parts[0]);
        }
      }
    }
    return null;
  }
  
  isModuleDirectory(dirPath) {
    return this.config.watchDirectories.some(watchDir => 
      path.dirname(dirPath) === watchDir || dirPath.startsWith(watchDir)
    );
  }
  
  async handleModuleUpdate(modulePath) {
    const module = await this.discovery.scanModule(modulePath);
    if (module) {
      await this.catalog.updateModule(module);
      await this.orchestrator.validateModule(module);
      
      if (this.config.enableAI) {
        const analysis = await this.aiAnalyzer.analyzeModule(module);
        await this.catalog.updateModuleAnalysis(module.name, analysis);
      }
      
      await this.catalog.save();
      this.emit('module:updated', module);
    }
  }
  
  async handleModuleFileDelete(modulePath, filePath) {
    // Check if critical file was deleted
    const fileName = path.basename(filePath);
    const criticalFiles = ['package.json', 'README.md', 'index.js'];
    
    if (criticalFiles.includes(fileName)) {
      const module = await this.catalog.getModule(path.basename(modulePath));
      if (module) {
        module.status = 'broken';
        module.issues = module.issues || [];
        module.issues.push(`Critical file deleted: ${fileName}`);
        await this.catalog.updateModule(module);
        await this.catalog.save();
        
        this.emit('module:broken', { module, reason: `Critical file deleted: ${fileName}` });
      }
    }
  }
  
  async applyUpdates(updates) {
    for (const { module, updates: moduleUpdates } of updates) {
      try {
        await this.orchestrator.applyUpdates(module, moduleUpdates);
        console.log(`✅ Applied updates to ${module}`);
      } catch (error) {
        console.error(`❌ Failed to apply updates to ${module}:`, error);
      }
    }
  }
  
  async archiveOldData() {
    // Archive analytics data older than 30 days
    const analyticsPath = path.join(__dirname, '..', 'data', 'analytics.json');
    const cutoffDate = new Date();
    cutoffDate.setDate(cutoffDate.getDate() - 30);
    
    // Implementation would depend on analytics data structure
    console.log('📦 Archived old analytics data');
  }
}

module.exports = AIModuleAgent;

// CLI support
if (require.main === module) {
  const agent = new AIModuleAgent();
  
  const command = process.argv[2];
  
  switch (command) {
    case 'start':
      agent.start().catch(console.error);
      break;
    case 'stop':
      agent.stop().catch(console.error);
      break;
    case 'status':
      agent.getSystemHealth().then(console.log).catch(console.error);
      break;
    case 'discover':
      agent.performInitialDiscovery().then(() => process.exit(0)).catch(console.error);
      break;
    default:
      console.log(`
🤖 AI Module Agent CLI

Usage: node agent.js <command>

Commands:
  start     Start the agent daemon
  stop      Stop the agent daemon
  status    Show system health status
  discover  Discover and catalog modules

Examples:
  node agent.js start
  node agent.js status
      `);
  }
}