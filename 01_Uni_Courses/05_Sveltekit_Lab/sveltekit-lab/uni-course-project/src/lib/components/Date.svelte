<script>
	import { onMount } from 'svelte';
	import { dateStore } from './stores/dateStore.js';

	const previousDay = () => {
		dateStore.update((value) => {
			value.doy--;
			if (value.day > 1) {
				value.day--;
			} else {
				value.month--;
				switch (value.month) {
					case 2:
						value.day = 29;
						break;
					case 4:
					case 6:
					case 9:
					case 11:
						value.day = 30;
						break;
					default:
						value.day = 31;
						break;
				}
			}
			return value;
		});
	};

	const nextDay = () => {
    dateStore.update((value) => {
        value.doy++;
        
        let daysInMonth;
        if (value.month === 2) {
            daysInMonth = 29;
        } else if ([4, 6, 9, 11].includes(value.month)) {
            daysInMonth = 30;
        } else {
            daysInMonth = 31;
        }

        if (value.day < daysInMonth) {
            value.day++;
        } else {
            value.day = 1;
            value.month++;
        }

        return value;
    });
};
</script>

<div>
	<p class="text-lg">
		Schedule for:
		<button class="text-lg mx-2" on:click={() => previousDay()}>←</button>
		{$dateStore.day}/{$dateStore.month} [{$dateStore.doy}]
		<button class="text-lg mx-2" on:click={() => nextDay()}>→</button>
	</p>
</div>
