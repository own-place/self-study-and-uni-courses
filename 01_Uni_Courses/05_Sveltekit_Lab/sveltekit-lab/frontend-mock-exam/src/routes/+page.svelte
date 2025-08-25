<script>
	import Pets from "$lib/components/Pets.svelte";
</script>

<div class="container w-full mx-auto">
    <section class="mt-3 lg:mt-6">
		<h2 class="text-4xl lg:text-6xl">
			A<span class="inline-block bg-blue-100 rounded-lg">ll pets&nbsp;</span>
		</h2>
	</section>
    <section class="flex flex-col lg:flex-row mt-3 lg:mt-6">
        <div class="basis-4/6 bg-gray-100 rounded-lg p-10 lg:mr-8">
            <Pets />
        </div>
    </section>
</div>
