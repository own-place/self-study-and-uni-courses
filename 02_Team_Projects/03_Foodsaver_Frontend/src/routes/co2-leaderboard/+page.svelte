<script>
    import { onMount } from 'svelte';
    import { goto } from "$app/navigation";
    let leaderboard = [];
  
    // Load backend data when mounting component
    onMount(async () => {
      try {
        const response = await fetch('http://localhost:4001/api/users/co2-leaderboard');
        if (response.ok) {
          const data = await response.json();
          // Sort the data to ensure the user with the most CO2 saved is first
          data.data.sort((a, b) => b.co2_saved - a.co2_saved);
          // Map the data to fit the leaderboard structure
          leaderboard = data.data.map((user, index) => ({
            rank: index + 1,
            username: user.username,
            co2Saved: user.co2_saved, // Display CO2 saved for each user
            avatar: `https://cdn-icons-png.flaticon.com/512/2945/294551${index % 6 + 1}.png`, // Random avatar
            medal:
              index === 0
                ? 'https://cdn.prod.website-files.com/62e3f65d6c8bce4b79deaba9/62ebf1e68130060887a7d337_vecteezy_flat-vector-illustration-of-gold-silver-and-bronze-medal_7892417-modified%20(1)-p-500.png'
                : index === 1
                ? 'https://cdn.prod.website-files.com/62e3f65d6c8bce4b79deaba9/62ebf2b6f07bcb638395d3dc_vecteezy_flat-vector-illustration-of-gold-silver-and-bronze-medal_7892417-modified%20(3).png'
                : index === 2
                ? 'https://cdn.prod.website-files.com/62e3f65d6c8bce4b79deaba9/62ebf2d132aa5102dab01e6e_vecteezy_flat-vector-illustration-of-gold-silver-and-bronze-medal_7892417-modified%20(4)-p-500.png'
                : null,
          }));
        } else {
          console.error('Error fetching leaderboard:', response.statusText);
        }
      } catch (error) {
        console.error('Error fetching leaderboard:', error);
      }
    });
  </script>
  
  <button
  class="px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300"
  on:click={() => goto("/money-leaderboard")}
  >
  See Money
  </button>

  <div class="leaderboard-container">
    <h1 class="leaderboard-title">CO2 Saved Leaderboard</h1>
    <div class="podium">
      <!-- First place: now the first to appear -->
      {#if leaderboard.length > 1}
        <div class="podium-item">
          <img class="medal" src={leaderboard[1].medal} alt={`Medal for rank ${leaderboard[1].rank}`} />
          <span class="points">{leaderboard[1].co2Saved} kg CO2e</span>
          <div class="avatar-container">
            <p>{leaderboard[1].username}</p>
          </div>
          <div class="rank-circle">{leaderboard[1].rank}</div>
        </div>
      {/if}

      <!-- Second place: now the second to appear -->
      {#if leaderboard.length > 0}
        <div class="podium-item center-podium">
          <img class="medal" src={leaderboard[0].medal} alt={`Medal for rank ${leaderboard[0].rank}`} />
          <span class="points">{leaderboard[0].co2Saved} kg CO2e</span>
          <div class="avatar-container">
            <p>{leaderboard[0].username}</p>
          </div>
          <div class="rank-circle">{leaderboard[0].rank}</div>
        </div>
      {/if}
      
    
      <!-- Third place: does not change -->
      {#if leaderboard.length > 2}
        <div class="podium-item">
          <img class="medal" src={leaderboard[2].medal} alt={`Medal for rank ${leaderboard[2].rank}`} />
          <span class="points">{leaderboard[2].co2Saved} kg CO2e</span>
          <div class="avatar-container">
            <p>{leaderboard[2].username}</p>
          </div>
          <div class="rank-circle">{leaderboard[2].rank}</div>
        </div>
      {/if}
    </div>
    
    <table class="ranking-table">
      {#each leaderboard.slice(3) as { rank, username, co2Saved }}
        <tr>
          <td>{rank}</td>
          <td>{username}</td>
          <td class="points">{co2Saved} kg CO2e</td>
        </tr>
      {/each}
    </table>
  </div>
  
  <style>
    .leaderboard-container {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .leaderboard-title {
        font-size: 2.5rem;
        color: green;
        margin-bottom: 2rem;
    }

    .podium {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .podium-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        border-radius: 10px;
        padding: 1rem;
        width: 120px;
        background-color: #ecf0f1;
    }

    .center-podium {
        transform: translateY(-20px);
    }

    .medal {
        margin-bottom: 0.5rem;
        width: 40px;
        height: 40px;
    }

    .points {
        font-size: 1.2rem;
        color: #16a085;
        margin: 0.5rem 0;
    }

    .avatar-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 0.5rem;
    }

    .avatar-container img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 0.5rem;
    }

    .avatar-container p {
        font-size: 1rem;
        color: #333;
        margin: 0;
    }

    .rank-circle {
        position: absolute;
        bottom: -15px;
        width: 30px;
        height: 30px;
        background-color: #7f8c8d;
        color: white;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .ranking-table {
        width: 100%;
        margin-top: 1rem;
        border-collapse: collapse;
    }

    .ranking-table tr {
        border-bottom: 1px solid #ccc;
    }

    .ranking-table td {
        padding: 0.5rem;
        text-align: left;
    }

    .ranking-table img {
        width: 40px;
        border-radius: 50%;
    }
  </style>
