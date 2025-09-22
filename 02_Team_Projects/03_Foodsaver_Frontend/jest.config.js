export default {
    preset: 'ts-jest/presets/default-esm', // For TypeScript and ES Modules
    testEnvironment: 'jest-environment-jsdom', // Set the test environment to JSDOM
    transform: {
      '^.+\\.svelte$': 'svelte-jester', // Transform Svelte files
      '^.+\\.js$': 'babel-jest',        // Transform JavaScript files
      '^.+\\.ts$': 'ts-jest',           // Transform TypeScript files
    },
    moduleFileExtensions: ['js', 'ts', 'svelte'],
    globals: {
      'ts-jest': {
        useESM: true,
      },
    },
  };
  