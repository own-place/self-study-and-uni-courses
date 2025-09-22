<script>
    // Agrega aquí cualquier lógica si se necesita
</script>

<div>
    <div class="header z-50">Tips & Tricks</div>
    <div class="container">
        <a href="makeUseOfIngredients" class="card-link">
            <div class="card">
                <img
                    src="https://y4c5c8s9.rocketcdn.me/wp-content/uploads/2023/06/How-to-start-a-zero-waste-lifestyle.jpg"
                    alt="Make the most use of ingredients"
                />
                <div class="card-title">Make the MOST use of the Ingredients</div>
            </div>
        </a>
        <a href="reuseFoodLeftOvers" class="card-link">
            <div class="card">
                <img
                    src="https://www.cityofsydney.nsw.gov.au/-/jssmedia/corporate/images/programs/environmental-support-funding/food-scraps-trial/14220kg-foodscrapstrial-45.jpg?mw=640"
                    alt="Reusing your leftovers"
                />
                <div class="card-title">Reusing your food leftovers</div>
            </div>
        </a>
        <a href="storingFood" class="card-link">
            <div class="card">
                <img
                    src="https://media.istockphoto.com/id/1307979766/nl/foto/netjes-georganiseerde-transparante-bussen-voor-het-bakken-van-ingredi%C3%ABnten.jpg?s=612x612&w=0&k=20&c=Gl72Z5Upo8hpA937y_tlUJBN01FwDmcEy6r5Ssal-DM="
                    alt="Storing food tips"
                />
                <div class="card-title">Storing food tips</div>
            </div>
        </a>
        <a href="saveYourMoney" class="card-link">
            <div class="card">
                <img
                    src="https://carlosdegramos.com/wp-content/uploads/2024/08/Take-our-NMNT-2-week-food-budget-challenge-and-eat-for-55-a-week-1024x538.jpg"
                    alt="Save your money"
                />
                <div class="card-title">Save YOUR money!</div>
            </div>
        </a>
    </div>
    <!-- Leafs picture -->
    <img
        class="LeafBackgroundRemoved9 w-72 h-60 left-[-80.30px] top-[800px] absolute origin-top-left rotate-[0.0deg] rounded-xl -z-10"
        src="../../../leaf-background2.png"
        alt="Leaf Background"
    />

    <img
        class="LeafBackgroundRemoved9 w-72 h-60 right-[-90px] top-[250px] absolute origin-top-left rotate-[270deg] rounded-xl -z-10"
        src="../../../leaf-background1.png"
        alt="Leaf Background"
    />
</div>

<style>
    .container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
        margin: 2rem auto;
        padding: 1rem;
        max-width: 1200px;
    }

    .card-link {
        text-decoration: none;
    }

    .card {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 100%;
        aspect-ratio: 16 / 9;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    .card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-title {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
        text-align: center;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
        padding: 0.5rem;
        background: rgba(0, 0, 0, 0.4);
        border-radius: 5px;
    }

    .header {
        font-size: 2rem;
        color: #2e962e;
        text-align: center;
        margin: 1rem auto;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .header {
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 1rem;
        }
    }

    @media (min-width: 1024px) {
        .card {
            max-width: 400px;
        }
    }
</style>
