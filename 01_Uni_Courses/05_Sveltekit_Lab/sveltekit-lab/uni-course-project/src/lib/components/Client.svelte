<script>
	import { appointmentStore } from '/Users/luyue/Documents/self-study/sveltekit-lab/uni-course-project/src/lib/components/stores/appointmentStore.js';
</script>

<div>
    <h2 class="text-3xl">Details</h2>
    <div class="bg-orange-50 rounded-lg p-2">
        <table>
            <tbody>
                <tr>
                    <td>Reference nr:</td>
                    <td>{$appointmentStore.starttime}</td>
                </tr>
                <tr>
                    <td>Pet name:</td>
                    <td>{$appointmentStore.name}</td>
                </tr>
                <tr>
                    <td>Breed:</td>
                    <td>{$appointmentStore.breed}</td>
                </tr>
                <tr>
                    <td>State:</td>
                    <td>{$appointmentStore.state}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <h3 class="mt-4 text-xl">Diagnosis</h3>
    <div class="bg-orange-50 rounded-lg p-2">
        Here is the diagnosis...
    </div>
    <h3 class="mt-4 text-xl">Diagnosis</h3>
    <div class="bg-orange-50 rounded-lg p-2">
        <table>
            <tbody>
                <tr>
                    <td>2023-10-09</td>
                    <td>⇲</td>
                </tr>
                <tr>
                    <td>2022-09-22</td>
                    <td>⇲</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>