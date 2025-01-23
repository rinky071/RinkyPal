<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-5 mt-3">
                    <div class="card">
                        <div class="card-header card-footer p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">Property</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0">Total Property</p>
                                <h4 class="mb-0">{{ $propertyCounts }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Agent wise --}}
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-5 mt-3">
                    <div class="card">
                        <div class="card-header card-footer p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">Agent</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0">Total Agents</p>
                                <h4 class="mb-0">{{ $totalAgentsCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

{{-- Total Enquries --}}
<div class="col-xl-4 col-sm-6 mb-xl-0 mb-5 mt-3">
    <div class="card">
        <div class="card-header card-footer p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">Enquries</i>
            </div>
            <div class="text-end pt-1">
                <p class="text-sm mb-0">Total Enquries</p>
                <h4 class="mb-0">{{ $totalEnquriesCount }}</h4>
            </div>
        </div>
    </div>
</div>
{{-- pie chart start --}}
<div class="col-md-5">
    <canvas id="combinedChart"></canvas>
</div>
    {{-- Pie Charts End --}}
    {{-- bar charts start --}}
    <div class="col-lg-6 col-md-6 mt-4 mb-4">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">insert_chart</i>
                </div>
                <h4 class="card-title">City State VS Zone</h4>
            </div>
            <div class="card-body">
                <canvas id="multiBarChart"></canvas>
            </div>
        </div>
    </div>
    {{-- bar charts end --}}
    

   



</div>

            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        var propertyCount = <?php echo $propertyCounts; ?>;
        var agentsCount = <?php echo $totalAgentsCount; ?>;
        var enquiriesCount = <?php echo $totalEnquriesCount; ?>;

        var combinedData = {
            labels: ["Properties", "Agents", "Enquiries"],
            datasets: [{
                data: [propertyCount, agentsCount, enquiriesCount],
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"]
            }]
        };

        // Get the combinedChart canvas element
        var combinedChartCanvas = document.getElementById('combinedChart').getContext('2d');

        // Create combined pie chart
        var combinedPieChart = new Chart(combinedChartCanvas, {
            type: 'pie',
            data: combinedData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Combined Property, Agent, and Enquiry Data'
                }
            }
        });
   </script>
   
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('multiBarChart').getContext('2d');
        var multiBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['City States', 'Zones'],
                datasets: [{
                    label: 'Count',
                    data: [{{ $cityStateCounts }}, {{ $zoneCounts }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
</x-layout>
