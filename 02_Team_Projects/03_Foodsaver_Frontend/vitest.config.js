import { defineConfig } from 'vitest/config';

export default defineConfig({
  test: {
    environment: 'jsdom', // Use jsdom to simulate the browser environment
    globals: true, // If you want to use global variables like `describe`, `test`, etc.
    alias: {
      '@testing-library/svelte': '@testing-library/svelte',
    },
    transformMode: {
      web: [/\.svelte$/], // Transform .svelte files
    },
  },
});