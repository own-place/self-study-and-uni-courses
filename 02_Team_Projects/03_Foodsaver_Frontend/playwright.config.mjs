import { defineConfig } from '@playwright/test';

export default defineConfig({
  testDir: './src/tests/system',
  use: {
    baseURL: 'http://localhost:5173', // Update to the correct base URL
    headless: true, // Run tests in headless mode
  },
  webServer: {
    command: 'npm run dev', // Command to start your server
    port: 5173, // Port your server is running on
    timeout: 120 * 1000, // Timeout to wait for the server to start
    reuseExistingServer: !process.env.CI, // Reuse server if already running
  },
});
