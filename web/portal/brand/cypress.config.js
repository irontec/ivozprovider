import { defineConfig } from 'cypress';
import pactCypressPlugin from '@pactflow/pact-cypress-adapter/dist/plugin';
import fs from 'fs';

export default defineConfig({
  e2e: {
    setupNodeEvents(on, config) {
      pactCypressPlugin(on, config, fs);
    },
  },
  video: false,
  env: {
    APP_DOMAIN: 'http://localhost:3000/brand/',
    headersBlocklist: ['access-control-allow-origin'],
  },
});
