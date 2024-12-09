<script>
	import "../app.css";
</script>

<div class="flex flex-col h-screen justify-between">
	<nav class="bg-blue-300 shadow">
		<div class="flex items-left">
			<a href="/" class="nav-item"><h1 class="text-xl font-semibold">🐶 Veterinarian</h1></a>
			<a href="/appointments" class="nav-item ml-3"><h1 class="text-xl">Appointments</h1></a>
			<!-- <a href="/dates" class="nav-item ml-3"><h1 class="text-xl">Dates</h1></a> -->
		</div>
	</nav>

	<main>
		<slot />
	</main>

	<footer class="bg-blue-300">
		<p class="text-center">Made with ❤️ </p>
	</footer>
</div>

<style>
</style>
