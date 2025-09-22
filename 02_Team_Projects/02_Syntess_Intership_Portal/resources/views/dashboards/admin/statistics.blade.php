<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex flex-wrap mt-10 mb-20 pt-7 bg-gray-100">
        <div class="w-full">
            <h1 class="text-xl font-bold mb-4">Applications Statistics</h1>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <form method="GET" action="{{ route('admin.statistics') }}" class="mb-4">
                <label for="year" class="font-semibold">Select Year:</label>
                <select name="year" id="year" class="ml-2 p-2 border rounded" onchange="this.form.submit()">
                    @for($i = $startYear; $i <= Carbon\Carbon::now()->year; $i++)
                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </form>

            <div style="width: 75%; margin: auto;">
                <canvas id="applicationsChart"></canvas>
            </div>

            <div id="details" class="w-fit mt-6">
                <h2 class="text-xl font-semibold">Application Details</h2>
                <p class="font-semibol mb-4">Click on the month you want to see more information about.</p>
                <table class="min-w-full bg-white text-sm">
                    <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Date</th>
                    </tr>
                    </thead>
                    <tbody id="detailsList"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap bg-purple-100">
        <h1 class="text-xl font-bold mb-4">Applications Per Internship</h1>
        <div style="width: 75%; margin: auto;">
            <canvas id="internshipsChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('applicationsChart').getContext('2d');
            const applicationsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($months),
                    datasets: [{
                        label: 'Number of Applications',
                        data: @json($counts),
                        backgroundColor: 'rgba(128, 0, 128, 0.2)',
                        borderColor: 'rgba(128, 0, 128, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true,
                                drawBorder: false,
                                color: 'rgba(0,0,0,0.37)',
                                lineWidth: 1
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    onClick: (e) => {
                        const activePoints = applicationsChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, false);
                        if (activePoints.length > 0) {
                            const firstPoint = activePoints[0];
                            const monthIndex = firstPoint.index + 1;
                            const detailsList = document.getElementById('detailsList');
                            detailsList.innerHTML = '';
                            const details = @json($details);
                            if (details[String(monthIndex).padStart(2, '0')]) {
                                details[String(monthIndex).padStart(2, '0')].forEach(app => {
                                    const row = document.createElement('tr');
                                    row.innerHTML = `<td class="py-2 px-4 border-b">${app.first_name} ${app.last_name}</td><td class="py-2 px-4 border-b">${new Date(app.created_at).toLocaleDateString()}</td>`;
                                    detailsList.appendChild(row);
                                });
                            } else {
                                const row = document.createElement('tr');
                                row.innerHTML = `<td class="py-2 px-4 border-b" colspan="2">No applications found for this month.</td>`;
                                detailsList.appendChild(row);
                            }
                        }
                    }
                }
            });

            const ctxInternships = document.getElementById('internshipsChart').getContext('2d');
            const internshipsChart = new Chart(ctxInternships, {
                type: 'bar',
                data: {
                    labels: @json($applicationsPerInternship).map(app => app.title),
                    datasets: [{
                        label: 'Number of Applications',
                        data: @json($applicationsPerInternship).map(app => app.count),
                        backgroundColor: 'rgba(128, 0, 128, 0.6)',
                        borderColor: 'rgba(128, 0, 128, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true,
                                drawBorder: false,
                                color: 'rgba(0,0,0,0.37)',
                                lineWidth: 1
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-main-dashboard-user>
