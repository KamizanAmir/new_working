@extends('voyager::master')

@section('content')
<div class="row">
    <!-- First Chart Card -->
    <div class="col-md-6">
        <div class="card modern-chart-card">
            <div class="card-header">
                <h5 class="card-title">Training Plan Data</h5>
            </div>
            <div class="card-body">
                <!-- Chart Canvas -->
                <canvas id="trainingPlanChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Second Chart Card (Add your new chart details here) -->
    <div class="col-md-6">
        <div class="card modern-chart-card">
            <div class="card-header">
                <h5 class="card-title">Current Completion Data</h5>
            </div>
            <div class="card-body">
                <!-- Second Chart Canvas -->
                <canvas id="secondChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// First chart
fetch('/training-plan-chart-data')
    .then(response => response.json())
    .then(data => {
        var ctx = document.getElementById('trainingPlanChart').getContext('2d');
        var trainingPlanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.months,
                datasets: [{
                    label: '# of Trainings',
                    data: data.data,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    barThickness: 50 // Set this to the desired thickness of your bars
                }]
            },
            options: {
                
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total of Trainings'
                        },
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        ticks: {
                            autoSkip: true,
                            maxRotation: 0,
                            // maxTicksLimit: 10 // Increased to display up to 12 months
                        },
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }

                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Training Plan Chart'
                    },
                    tooltip: {
                        // Customize tooltip (you can add more properties as needed)
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        bodyColor: '#333',
                        borderColor: 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        borderRadius: 10,
                        titleColor: '#000',
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    backgroundColor: 'rgba(255, 99, 132, 0.4)'
                }
            }

        });

    });

// Second chart initialization goes here
// Example:
// fetch('/second-chart-data')
//     .then(response => response.json())
//     .then(data => {
//         var ctx = document.getElementById('secondChart').getContext('2d');
//         var secondChart = new Chart(ctx, {
//             type: 'bar', // Change the type as needed
//             data: {
//                 labels: data.labels, // Adjust based on your data
//                 datasets: [{
//                     label: 'Dataset Label',
//                     data: data.values, // Adjust based on your data
//                     backgroundColor: 'rgba(54, 162, 235, 0.2)',
//                     borderColor: 'rgba(54, 162, 235, 1)',
//                     borderWidth: 1
//                 }]
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true
//                     }
//                 }
//             }
//         });
//     });
</script>
@stop

@section('css')
<style>
/* Add some global styles for the cards */
.card.modern-chart-card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    border-radius: 10px;
    overflow: hidden;
    margin-left: 20px; /* Space for larger screens */
}

/* Chart specific styles */
#trainingPlanChart {
    background: linear-gradient(180deg, rgba(255, 99, 132, 0.2) 0%, rgba(255, 99, 132, 0.02) 100%);
    border-radius: 10px;
}

/* Adjust the margin for the entire row if needed */
.row {
    margin-right: 0;
    margin-left: 0;
}
@media (max-width: 575px) {
    .card-body {
        min-height: 200px; // Adjust this value as needed to give the chart enough room
    }
}
/* Responsive adjustments */
@media (max-width: 991px) {
    .card.modern-chart-card {
        margin-left: 10px; /* Less space for medium screens */
    }
}

@media (max-width: 767px) {
    .card.modern-chart-card {
        margin-left: 5px; /* Even less space for small screens */
    }
}

@media (max-width: 575px) {
    .card.modern-chart-card {
        margin-left: 0; /* No space for extra small screens, full width */
        margin-bottom: 10px; /* Add some space below the card */
    }
    .row {
        margin-right: -15px;
        margin-left: -15px;
    }
}

/* You can add more styles as needed */
</style>
@stop

@section('javascript')
<!-- Any additional JavaScript can be added here -->
@stop
