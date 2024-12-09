<script>
	import "../app.css";
</script>

<div class="flex flex-col h-screen justify-between">
	<nav class="bg-blue-300 shadow">
		<div class="flex items-left">
			<a href="/" class="nav-item"><h1 class="text-xl lg:text-2xl font-semibold">&nbsp;Pre - Exam</h1></a>
		</div>
	</nav>

	<main>
		<slot />
	</main>

	<footer class="bg-blue-300">
		<p class="text-center">I'm preparing for the exam</p>
	</footer>
</div>

<style>
</style>