#!/usr/bin/env node

/**
 * Disruptors Media - Context Synchronization Script
 * 
 * This script automatically updates context files and tracks project state
 * to ensure continuity across Claude Code instances.
 */

const fs = require('fs').promises;
const path = require('path');

const DM_ROOT = '/Users/disruptors/Documents/ProjectsD/DisruptorEcosystem/Legacy/sites/fulldisruptorssitewithimages/DM';

class ContextSynchronizer {
  constructor() {
    this.stateFile = path.join(DM_ROOT, 'STATE_TRACKER.json');
    this.agentFile = path.join(DM_ROOT, 'DISRUPTORS_AGENT.md');
  }

  async updateState(updates) {
    try {
      const currentState = await this.getState();
      const newState = { 
        ...currentState, 
        ...updates,
        lastUpdated: new Date().toISOString()
      };
      
      await fs.writeFile(this.stateFile, JSON.stringify(newState, null, 2));
      console.log('✅ State updated successfully');
      return newState;
    } catch (error) {
      console.error('❌ Failed to update state:', error.message);
      throw error;
    }
  }

  async getState() {
    try {
      const data = await fs.readFile(this.stateFile, 'utf8');
      return JSON.parse(data);
    } catch (error) {
      console.warn('⚠️  Could not read state file, creating new one');
      return this.getDefaultState();
    }
  }

  async checkDeploymentStatus() {
    const { exec } = require('child_process');
    const util = require('util');
    const execAsync = util.promisify(exec);

    try {
      // Check frontend (Netlify)
      const frontendCheck = await execAsync('curl -s -o /dev/null -w "%{http_code}" https://frabjous-babka-d9c26b.netlify.app');
      const frontendStatus = frontendCheck.stdout.trim() === '200' ? 'LIVE' : 'DOWN';

      // Check backend (DigitalOcean)  
      const backendCheck = await execAsync('doctl apps get f361de5e-6e4b-42d3-a219-d2461669aafe --output json 2>/dev/null | jq -r ".[0].active_deployment.phase // \\"NONE\\""');
      const backendStatus = backendCheck.stdout.trim() === 'ACTIVE' ? 'LIVE' : 'DEPLOYMENT_FAILED';

      return {
        frontend: { status: frontendStatus },
        backend: { status: backendStatus }
      };
    } catch (error) {
      console.warn('⚠️  Could not check deployment status:', error.message);
      return null;
    }
  }

  async syncContext(sessionData) {
    console.log('🔄 Syncing Disruptors Media context...');

    // Update deployment status
    const deploymentStatus = await this.checkDeploymentStatus();
    if (deploymentStatus) {
      await this.updateState({ deploymentStatus });
    }

    // Add session to history
    if (sessionData) {
      const state = await this.getState();
      const newSession = {
        timestamp: new Date().toISOString(),
        agent: sessionData.agent || 'Claude-Unknown',
        actions: sessionData.actions || [],
        nextAgent: sessionData.nextAgent || 'Continue current tasks'
      };

      state.sessionHistory = state.sessionHistory || [];
      state.sessionHistory.push(newSession);
      
      // Keep only last 10 sessions
      if (state.sessionHistory.length > 10) {
        state.sessionHistory = state.sessionHistory.slice(-10);
      }

      await this.updateState(state);
    }

    console.log('✅ Context synchronization complete');
  }

  getDefaultState() {
    return {
      project: "Disruptors Media Website",
      lastUpdated: new Date().toISOString(),
      version: "1.0",
      deploymentStatus: {
        frontend: { status: "UNKNOWN" },
        backend: { status: "UNKNOWN" },
        database: { status: "READY" }
      },
      currentTasks: {
        priority: "HIGH",
        active: []
      },
      sessionHistory: []
    };
  }
}

// CLI Interface
if (require.main === module) {
  const synchronizer = new ContextSynchronizer();
  
  const command = process.argv[2];
  
  switch (command) {
    case 'status':
      synchronizer.getState().then(state => {
        console.log('📊 Current Disruptors Media State:');
        console.log(`Frontend: ${state.deploymentStatus.frontend.status}`);
        console.log(`Backend: ${state.deploymentStatus.backend.status}`);
        console.log(`Last Updated: ${state.lastUpdated}`);
        console.log(`Active Tasks: ${state.currentTasks.active.length}`);
      });
      break;
      
    case 'sync':
      const sessionData = {
        agent: process.argv[3] || 'Claude-CLI',
        actions: process.argv.slice(4)
      };
      synchronizer.syncContext(sessionData);
      break;
      
    case 'update':
      const updates = JSON.parse(process.argv[3] || '{}');
      synchronizer.updateState(updates);
      break;
      
    default:
      console.log(`
🤖 Disruptors Media Context Synchronizer

Usage:
  node sync-context.js status              # Check current state
  node sync-context.js sync [agent] [actions...]  # Sync with session data
  node sync-context.js update '{"key": "value"}'  # Update state
  
Examples:
  node sync-context.js sync Claude-BlogWork "Implemented image upload" "Fixed API connection"
  node sync-context.js update '{"currentTasks": {"active": [{"task": "New blog images", "status": "IN_PROGRESS"}]}}'
      `);
  }
}

module.exports = ContextSynchronizer;