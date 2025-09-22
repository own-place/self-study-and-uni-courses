import adapter from '@sveltejs/adapter-auto';
import { vitePreprocess } from '@sveltejs/vite-plugin-svelte';
import { sveltePreprocess } from 'svelte-preprocess';

/** @type {import('@sveltejs/kit').Config} */
const config = {
	kit: {
		adapter: adapter(),
	},
	preprocess: [
		vitePreprocess(),
		sveltePreprocess({
			scss: true,       // Enable SCSS support
			postcss: true,    // Enable PostCSS support
			typescript: true, // Enable TypeScript support
		}),
	],
};

export default config;
