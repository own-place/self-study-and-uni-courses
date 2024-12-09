<script>
    export let data;
    const products = data.products;
</script>

<h1>{data.title}</h1>
{#each products as product}
    <div>
        <h2>{product.title}</h2>
        <p>{product.description}</p>
        <hr />
    </div>
{/each}