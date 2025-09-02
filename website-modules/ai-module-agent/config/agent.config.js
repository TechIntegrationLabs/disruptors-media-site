/**
 * AI Module Agent Configuration
 * Central configuration for the AI-First Module Agent system
 */

const path = require('path');

module.exports = {
  // Core Agent Settings
  agent: {
    name: 'AI-Module-Agent',
    version: '1.0.0',
    environment: process.env.NODE_ENV || 'development',
    debug: process.env.DEBUG === 'true',
    logLevel: process.env.LOG_LEVEL || 'info'
  },

  // File System Monitoring
  watchDirectories: [
    path.resolve(__dirname, '../../'),  // /website-modules/
    // Add more directories to watch
  ],
  
  scanInterval: '*/5 * * * *', // Every 5 minutes (cron format)
  
  ignorePatterns: [
    'node_modules/**',
    '.git/**',
    '**/*.log',
    '**/dist/**',
    '**/build/**',
    '**/.cache/**',
    '**/coverage/**',
    '**/.nyc_output/**',
    '**/tmp/**',
    '**/temp/**'
  ],

  // AI Integration Settings
  enableAI: process.env.ENABLE_AI !== 'false',
  ai: {
    provider: process.env.AI_PROVIDER || 'openai',
    model: process.env.AI_MODEL || 'gpt-4',
    apiKey: process.env.OPENAI_API_KEY,
    maxTokens: 2000,
    temperature: 0.3,
    
    prompts: {
      codeReview: `
        Analyze this code and provide:
        1. Code quality score (0-100)
        2. Security issues (if any)
        3. Performance suggestions
        4. Best practice recommendations
        5. Maintainability assessment
        
        Return response in JSON format with scores and detailed feedback.
      `,
      
      moduleAnalysis: `
        Analyze this module and provide:
        1. Purpose and functionality description
        2. Quality assessment
        3. Improvement suggestions
        4. Usage recommendations
        5. Compatibility notes
        6. Documentation quality
        
        Focus on making this module more reusable and maintainable.
      `,
      
      optimization: `
        Suggest optimizations for this code:
        1. Performance improvements
        2. Bundle size reduction
        3. Memory usage optimization
        4. Runtime efficiency
        5. Code organization
        
        Provide specific, actionable recommendations.
      `,
      
      documentation: `
        Generate comprehensive documentation for this module:
        1. Overview and purpose
        2. Installation instructions
        3. Usage examples
        4. API reference
        5. Configuration options
        6. Troubleshooting guide
        
        Format as clear, professional Markdown.
      `
    }
  },

  // Module Creation Templates
  templates: {
    'react': {
      name: 'React Component Module',
      files: {
        'package.json': 'templates/react/package.json.template',
        'README.md': 'templates/react/README.md.template',
        'src/index.js': 'templates/react/src/index.js.template',
        'src/Component.jsx': 'templates/react/src/Component.jsx.template',
        'src/Component.css': 'templates/react/src/Component.css.template',
        'tests/Component.test.js': 'templates/react/tests/Component.test.js.template',
        'docs/usage.md': 'templates/react/docs/usage.md.template',
        'examples/basic.html': 'templates/react/examples/basic.html.template'
      }
    },
    
    'nextjs': {
      name: 'Next.js Module',
      files: {
        'package.json': 'templates/nextjs/package.json.template',
        'README.md': 'templates/nextjs/README.md.template',
        'components/index.js': 'templates/nextjs/components/index.js.template',
        'pages/index.js': 'templates/nextjs/pages/index.js.template',
        'lib/utils.js': 'templates/nextjs/lib/utils.js.template',
        'styles/globals.css': 'templates/nextjs/styles/globals.css.template',
        'next.config.js': 'templates/nextjs/next.config.js.template'
      }
    },
    
    'wordpress': {
      name: 'WordPress Plugin/Theme Module',
      files: {
        'README.md': 'templates/wordpress/README.md.template',
        'functions.php': 'templates/wordpress/functions.php.template',
        'style.css': 'templates/wordpress/style.css.template',
        'index.php': 'templates/wordpress/index.php.template',
        'includes/class-main.php': 'templates/wordpress/includes/class-main.php.template',
        'assets/js/script.js': 'templates/wordpress/assets/js/script.js.template',
        'assets/css/style.css': 'templates/wordpress/assets/css/style.css.template'
      }
    },
    
    'vanilla': {
      name: 'Vanilla JavaScript Module',
      files: {
        'package.json': 'templates/vanilla/package.json.template',
        'README.md': 'templates/vanilla/README.md.template',
        'src/index.js': 'templates/vanilla/src/index.js.template',
        'src/module.js': 'templates/vanilla/src/module.js.template',
        'src/styles.css': 'templates/vanilla/src/styles.css.template',
        'tests/module.test.js': 'templates/vanilla/tests/module.test.js.template',
        'examples/basic.html': 'templates/vanilla/examples/basic.html.template',
        'docs/api.md': 'templates/vanilla/docs/api.md.template'
      }
    }
  },

  // Testing & Validation
  testing: {
    frameworks: ['jest', 'vitest', 'cypress', 'playwright'],
    coverage: {
      minimum: 70,
      target: 80,
      statements: 75,
      branches: 70,
      functions: 80,
      lines: 75
    },
    
    qualityGates: {
      codeComplexity: 10,
      duplicateCode: 5,
      maintainabilityIndex: 70,
      technicalDebt: 30 // max minutes
    },
    
    linting: {
      enabled: true,
      config: 'eslint-config-standard',
      rules: {
        'max-complexity': ['error', 10],
        'max-lines': ['warn', 300],
        'max-params': ['error', 4],
        'no-console': ['warn']
      }
    }
  },

  // Dependency Management
  dependencies: {
    autoUpdate: process.env.AUTO_UPDATE_DEPS !== 'false',
    updateSchedule: '0 2 * * 1', // Mondays at 2 AM
    
    security: {
      scanEnabled: true,
      autoFix: false,
      alertThreshold: 'moderate'
    },
    
    compatibility: {
      nodeVersions: ['16', '18', '20'],
      browsers: ['> 1%', 'last 2 versions', 'not dead'],
      frameworks: {
        react: '^18.0.0',
        next: '^13.0.0',
        vue: '^3.0.0'
      }
    }
  },

  // Documentation Generation
  documentation: {
    enabled: true,
    autoGenerate: true,
    formats: ['markdown', 'html', 'json'],
    
    sections: {
      overview: true,
      installation: true,
      quickStart: true,
      apiReference: true,
      examples: true,
      configuration: true,
      troubleshooting: true,
      changelog: true
    },
    
    templates: {
      readme: 'templates/docs/README.md.template',
      api: 'templates/docs/api.md.template',
      guide: 'templates/docs/guide.md.template'
    }
  },

  // Deployment & Integration
  deployment: {
    enabled: process.env.ENABLE_DEPLOYMENT !== 'false',
    autoDeployment: process.env.AUTO_DEPLOY === 'true',
    
    targets: {
      npm: {
        enabled: process.env.NPM_PUBLISH === 'true',
        registry: process.env.NPM_REGISTRY || 'https://registry.npmjs.org/',
        access: 'public'
      },
      
      github: {
        enabled: process.env.GITHUB_INTEGRATION === 'true',
        createReleases: true,
        tagVersions: true,
        updateReadme: true
      },
      
      cdn: {
        enabled: false,
        provider: 'jsdelivr',
        baseUrl: 'https://cdn.jsdelivr.net/gh/'
      }
    },
    
    validation: {
      runTests: true,
      checkLinting: true,
      validateDocs: true,
      scanSecurity: true
    },
    
    rollback: {
      enabled: true,
      conditions: ['test_failure', 'deployment_error', 'health_check_fail']
    }
  },

  // Monitoring & Analytics
  monitoring: {
    enabled: true,
    metrics: {
      performance: true,
      usage: true,
      errors: true,
      health: true
    },
    
    alerts: {
      email: process.env.ALERT_EMAIL,
      slack: process.env.SLACK_WEBHOOK,
      discord: process.env.DISCORD_WEBHOOK
    },
    
    retention: {
      metrics: '30d',
      logs: '7d',
      analytics: '90d'
    }
  },

  // Health Checks
  health: {
    interval: 60000, // 1 minute
    checks: [
      'module_status',
      'dependency_health',
      'test_status',
      'build_status',
      'deployment_status',
      'performance_metrics'
    ],
    
    thresholds: {
      responseTime: 1000, // ms
      errorRate: 0.05, // 5%
      availability: 0.99 // 99%
    }
  },

  // Cache & Performance
  cache: {
    enabled: true,
    ttl: 300000, // 5 minutes
    maxSize: 100, // MB
    
    strategies: {
      moduleAnalysis: 'memory',
      aiResults: 'disk',
      dependencies: 'memory',
      documentation: 'disk'
    }
  },

  // Security
  security: {
    scanDependencies: true,
    scanCode: true,
    
    rules: {
      noSecrets: true,
      validateInputs: true,
      sanitizeOutputs: true,
      encryptSensitive: true
    },
    
    compliance: {
      gdpr: false,
      hipaa: false,
      soc2: false
    }
  },

  // Integrations
  integrations: {
    github: {
      enabled: process.env.GITHUB_TOKEN ? true : false,
      token: process.env.GITHUB_TOKEN,
      org: process.env.GITHUB_ORG || 'disruptors-media',
      autoCreateRepos: false,
      syncIssues: true
    },
    
    jira: {
      enabled: false,
      url: process.env.JIRA_URL,
      email: process.env.JIRA_EMAIL,
      token: process.env.JIRA_TOKEN
    },
    
    slack: {
      enabled: process.env.SLACK_TOKEN ? true : false,
      token: process.env.SLACK_TOKEN,
      channel: process.env.SLACK_CHANNEL || '#dev-automation',
      notifications: ['deployments', 'errors', 'health']
    }
  },

  // Performance Optimization
  performance: {
    bundleAnalysis: true,
    sizeTracking: true,
    loadTimeMonitoring: true,
    
    thresholds: {
      bundleSize: '500kb',
      loadTime: '2s',
      firstContentfulPaint: '1.5s'
    },
    
    optimization: {
      minification: true,
      compression: true,
      treeshaking: true,
      codeSplitting: true
    }
  },

  // Development
  development: {
    hotReload: true,
    sourceMap: true,
    debugMode: process.env.NODE_ENV === 'development',
    
    devServer: {
      port: process.env.DEV_PORT || 3000,
      host: process.env.DEV_HOST || 'localhost',
      https: false
    }
  }
};