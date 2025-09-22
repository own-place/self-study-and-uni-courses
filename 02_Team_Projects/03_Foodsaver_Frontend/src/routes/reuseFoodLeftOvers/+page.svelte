<script>
    import "../../app.css"; // Importar los estilos
  
    let tips = []; // Inicializamos como un arreglo vacío para almacenar los tips obtenidos
    let error = null; // Variable para manejar errores
    let loading = false; // Variable para manejar el estado de carga
    let category = "Reuse Food Leftovers"; 
    const encodedCategory = encodeURIComponent(category);
    // Función para obtener los tips desde el backend
    async function fetchTips() {
        loading = true; // Establecer que estamos cargando los datos
        try {
          const response = await fetch(`http://localhost:3016/tips/${encodedCategory}`);
            const data = await response.json();
            if (response.ok) {
                tips = data;
            } else {
                console.error("Error fetching tips:", data.error);
                error = "Failed to fetch tips.";
            }
        } catch (err) {
            error = err.message; // Manejo de errores
        } finally {
            loading = false; // Terminar el estado de carga
        }
    }
  
    // Llamar a fetchTips al cargar la página
    fetchTips();
  </script>
  
  <div>
    <div class="container">
        <div class="header">Tips & Tricks</div>
        <!-- Imagen de fondo que ocupa todo el ancho -->
        <div class="card-background">
            <div class="card-title">Reuse Food Leftovers</div>
        </div>
  
        <!-- Manejo de errores y renderización de tips -->
        {#if error}
            <div class="text-red-500">{error}</div>
        {:else if tips.length === 0 && loading}
            <div class="text-gray-500">Loading tips...</div>
        {:else if tips.length === 0 && !loading}
            <div class="text-gray-500">No tips loaded yet.</div>
        {:else}
            {#each tips as tip, i}
                <div class="tip">
                    <h2>{tip.title}</h2>
                    <p>{tip.description}</p>
                </div>
                {#if i < tips.length - 1}
                    <hr class="divider" />
                {/if}
            {/each}
        {/if}
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
    /* Estilos principales */
    .container {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
    }
  
    .header {
        position: absolute;
        top: 8rem;
        left: 1rem;
        font-size: 2rem;
        color: #00ff08;
        transform: rotate(-10deg);
        padding: 0.5rem 1rem;
        border-radius: 5px;
    }
  
    .card-background {
        width: 100%;
        height: 300px;
        background-image: url("https://www.cityofsydney.nsw.gov.au/-/jssmedia/corporate/images/programs/environmental-support-funding/food-scraps-trial/14220kg-foodscrapstrial-45.jpg?mw=640");
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: rgb(0, 0, 0);
    }
  
    .card-title {
        font-size: 2rem;
        padding: 10px;
        background: rgb(252, 252, 252, 0.5);
        border-radius: 5px;
    }
  
    /* Diseño de los tips */
    .tip {
        margin: 20px 0;
        padding: 10px 0;
    }
  
    .tip h2 {
        margin: 0 0 10px;
        color: #000;
        font-size: 1.2rem;
        font-weight: bold;
    }
  
    .tip p {
        margin: 0;
        font-size: 1rem;
        color: #000;
    }
  
    .divider {
        border: none;
        border-top: 1px solid #ddd;
        margin: 10px 0;
    }
  
    /* Media Queries para pantallas más pequeñas (móviles) */
    @media (max-width: 768px) {
        .header {
            top: 5rem;
            font-size: 1.5rem;
            left: 0.5rem;
        }
  
        .card-title {
            font-size: 1.5rem;
        }
  
        .tip h2 {
            font-size: 1rem;
        }
  
        .tip p {
            font-size: 0.9rem;
        }
  
        .divider {
            margin: 5px 0;
        }
    }
  
    @media (min-width: 1024px) {
        .container {
            max-width: 100%;
        }
  
        .header {
            top: 8rem;
            font-size: 2rem;
            left: 1rem;
        }
  
        .card-title {
            font-size: 2rem;
        }
  
        .tip h2 {
            font-size: 1.2rem;
        }
  
        .tip p {
            font-size: 1rem;
        }
    }
  </style>