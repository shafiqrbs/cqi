<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWAPNO Project</title>
    <link rel="icon" type="image/png" href="{{asset('assets/logo.jpeg')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #10b981;
            --tertiary-color: #f59e0b;
            --quaternary-color: #ec4899;
            --red-color: #dc2626;
            --light-bg: #f8fafc;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header-section {
            background: white;
            padding: 2rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0891b2, #10b981);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .funded-badge {
            background-color: var(--red-color);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 4px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .project-title {
            text-align: center;
            margin: 3rem 0;
        }

        .project-duration {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .main-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .goal-cards {
            margin: 3rem 0;
        }

        .goal-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .goal-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--red-color), #f97316);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .goal-icon::before {
            content: '🎯';
            font-size: 1.8rem;
        }

        .goal-text {
            font-size: 1.1rem;
            color: #475569;
            line-height: 1.6;
        }

        .chart-section {
            margin: 3rem 0;
        }

        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            height: 100%;
        }

        .chart-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.5rem;
        }

        .chart-controls {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .chart-dropdown {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            background: white;
            color: #374151;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .pie-chart-container {
            position: relative;
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pie-legend {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-left: 2rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .legend-text {
            color: #64748b;
            font-size: 0.9rem;
        }

        .legend-value {
            color: #1e293b;
            font-weight: 600;
            margin-left: auto;
        }

        .cta-section {
            text-align: center;
            margin: 3rem 0;
        }

        .cta-button {
            background-color: #960535FF;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            background-color: #710026FF;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(16, 185, 129, 0.3);
        }

        @media (max-width: 768px) {
            .main-title {
                font-size: 2rem;
            }

            .logo {
                width: 60px;
                height: 60px;
            }

            .funded-badge {
                font-size: 1rem;
                padding: 0.4rem 1rem;
            }
        }

    </style>
    <style>
        .goal-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60px;            /* Set fixed height */
            width: 60px;             /* Set fixed width */
            background-color: #f8f9fa; /* Optional background */
            border-radius: 50%;      /* Optional: makes it circular */
            margin: 0 auto;          /* Center the whole div horizontally if needed */
        }
        .goal-icon i {
            font-size: 24px;         /* Size of the icon */
            color: #0d6efd;          /* Optional color */
        }
    </style>

</head>
<body>
<!-- Header Section -->
<div class="header-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="logo-container">
                    <div class="logo">
                        <a href="{{route('home')}}">
                            <img width="160%" src="{{asset('assets/logo.jpeg')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="text-muted mb-2">Funded By</div>
{{--                <div class="funded-badge">Auchan | Foundation</div>--}}
                <a href="{{route('home')}}">
                    <img width="40%" src="{{asset('assets/logo-auchon.jpeg')}}" alt="">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Project Title Section -->
<div class="container">
    <div class="project-title">
        <h1 class="main-title">Strengthening Workers' Access to Pertinent<br>Nutrition Opportunities (SWAPNO)</h1>
        <div class="project-duration">Project Duration</div>
        <div class="project-duration"><strong>January 2025-Dec 2027</strong></div>

    </div>
    {{--<div class="goal-cards">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="goal-card">
                    <div class="goal-icon"></div>
                    <div class="goal-text">
                        SWAPNO is a factory driven model to improve nutrition knowledge of workers and to increase availability and accessibility to nutritious and safe food.
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="goal-card">
                    <div class="goal-icon"></div>
                    <div class="goal-text">
                        Increased investment by the businesses in improving nutrition and wellbeing of their workers and communities
                    </div>
                </div>
            </div>
        </div>
    </div>--}}


    <!-- Charts Section -->
{{--
    <div class="chart-section">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="chart-card">
                    <h3 class="chart-title">Monthly FPS Sales</h3>
                    <div class="chart-controls">
                        <select class="chart-dropdown">
                            <option>Metric</option>
                            <option>Revenue</option>
                            <option>Units</option>
                        </select>
                        <select class="chart-dropdown">
                            <option>Today</option>
                            <option>This Week</option>
                            <option>This Month</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="chart-card">
                    <h3 class="chart-title">Product Wise Sales</h3>
                    <div class="chart-controls">
                        <select class="chart-dropdown">
                            <option>Metric</option>
                            <option>Revenue</option>
                            <option>Units</option>
                        </select>
                        <select class="chart-dropdown">
                            <option>Today</option>
                            <option>This Week</option>
                            <option>This Month</option>
                        </select>
                    </div>
                    <div class="pie-chart-container">
                        <canvas id="pieChart"></canvas>
                        --}}
{{--<div class="pie-legend">
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #60a5fa;"></div>
                                <span class="legend-text">Category 1</span>
                                <span class="legend-value">$50,000.00</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #34d399;"></div>
                                <span class="legend-text">Category 2</span>
                                <span class="legend-value">$25,000.00</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #f472b6;"></div>
                                <span class="legend-text">Category 3</span>
                                <span class="legend-value">$15,000.00</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #fbbf24;"></div>
                                <span class="legend-text">Category 4</span>
                                <span class="legend-value">$10,000.00</span>
                            </div>
                        </div>--}}{{--

                    </div>
                </div>
            </div>
        </div>
    </div>
--}}

    <div class="chart-section my-5">
        <div class="row g-4">
            <!-- Column 1: Monthly Sales -->
            <div class="col-lg-4">
                <div class="chart-card h-100 p-4 border rounded bg-white shadow-sm">
                    <h3 class="chart-title">Monthly FPS Sales</h3>
                    {{--<div class="chart-controls mb-3">
                        <select class="chart-dropdown form-select">
                            <option>Metric</option>
                            <option>Revenue</option>
                            <option>Units</option>
                        </select>
                        <select class="chart-dropdown form-select">
                            <option>Today</option>
                            <option>This Week</option>
                            <option>This Month</option>
                        </select>
                    </div>--}}
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Column 2: Headers only, same design -->
            <div class="col-lg-4">
                <div class="chart-card h-100 p-4 border rounded bg-white shadow-sm d-flex flex-column justify-content-center text-center">
                    <div class="p-4 text-center border rounded bg-white shadow-sm h-100">
                        <h4 class="fw-bold mb-2">Training Participants</h4>
                        <div class="display-5 fw-semibold text-primary">2,000</div>
                        <small class="text-muted">workers</small>
                    </div>
                    <div class="p-4 text-center border rounded bg-white shadow-sm h-100">
                        <h4 class="fw-bold mb-2">Total Reach</h4>
                        <div class="display-5 fw-semibold text-success">15,000</div>
                        <small class="text-muted">workers</small>
                    </div>
                </div>
            </div>

            <!-- Column 3: Product Wise Sales -->
            <div class="col-lg-4">
                <div class="chart-card h-100 p-4 border rounded bg-white shadow-sm d-flex flex-column justify-content-center text-center">
                    <div class="p-4 text-center border rounded bg-white shadow-sm h-100">
                        <h4 class="fw-bold mb-2">Goals</h4>
                        <small class="text-muted">SWAPNO is a factory driven model to improve nutrition knowledge of workers and to increase availability and accessibility to nutritious and safe food.</small>
                    </div>
                    <div class="p-4 text-center border rounded bg-white shadow-sm h-100">
                        <h4 class="fw-bold mb-2">Objectives</h4>
                        <small class="text-muted">Increased investment by the businesses in improving nutrition and wellbeing of their workers and communities</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chart-section my-5">
        <div class="row g-4">
            <!-- Column 1: Monthly Sales -->
            <div class="col-lg-4">
                <div class="chart-card h-100 p-4 border rounded bg-white shadow-sm">
                    <h3 class="chart-title">Product Wise Sales</h3>
                    {{--<div class="chart-controls mb-3">
                        <select class="chart-dropdown form-select">
                            <option>Metric</option>
                            <option>Revenue</option>
                            <option>Units</option>
                        </select>
                        <select class="chart-dropdown form-select">
                            <option>Today</option>
                            <option>This Week</option>
                            <option>This Month</option>
                        </select>
                    </div>--}}
                    <div class="pie-chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="chart-card h-100 p-4 border rounded bg-white shadow-sm">

                    <h3 class="chart-title">Quarterly Milestone</h3>

                    <div class="p-2 text-left border rounded bg-light shadow-sm position-relative mb-xl-4">
                        <small class="text-muted d-block">
                            Successfully inaugurated 03 Fair Price Shop (FPS) in 3 factories.
                        </small>
                    </div>

                    <div class="p-2 text-left border rounded bg-light shadow-sm position-relative mb-xl-4">
                        <small class="text-muted d-block">
                            Formally three NICs announced by the factory management.
                        </small>
                    </div>

                    <div class="p-2 text-left mb-xl-4 border rounded bg-light shadow-sm position-relative">
                        <small class="text-muted d-block">
                            Completed baseline survey in 2 factories (Russel Garments and TM Jeans).
                        </small>
                    </div>

                    <div class="p-2 text-left  mb-xl-4 border rounded bg-light shadow-sm position-relative">
                        <small class="text-muted d-block">
                            Formal Visit has been paid at GLP operated school in Badda to overview the present operations and facilities.
                        </small>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="chart-card h-100 p-4 border rounded bg-white shadow-sm">
                    <h3 class="chart-title">Upcoming Events</h3>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-start mb-xl-4">
                            <div>
                                <h6 class="mb-1 fw-semibold">
                                    Complete the Baseline Survey for Phase II
                                </h6>
{{--                                <small class="text-muted">July 10, 2025 • Auditorium A</small>--}}
                            </div>
{{--                            <span class="badge bg-success rounded-pill">New</span>--}}
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-start mb-xl-4">
                            <div>
                                <h6 class="mb-1 fw-semibold">
                                    Inaugurate the 4th Fair Price Shop at Zasstex
                                </h6>
{{--                                <small class="text-muted">July 15, 2025 • Hall B</small>--}}
                            </div>
{{--                            <span class="badge bg-info rounded-pill">Soon</span>--}}
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-start mb-xl-4">
                            <div>
                                <h6 class="mb-1 fw-semibold">
                                    Organize Auchan kick-off meeting
                                </h6>
{{--                                <small class="text-muted">July 20, 2025 • Conference Room</small>--}}
                            </div>
{{--                            <span class="badge bg-warning text-dark rounded-pill">Reminder</span>--}}
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1 fw-semibold">
                                    Upgrade & Complete Project Dashboard
                                </h6>
{{--                                <small class="text-muted">July 20, 2025 • Conference Room</small>--}}
                            </div>
{{--                            <span class="badge bg-warning text-dark rounded-pill">Reminder</span>--}}
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </div>


    <!-- CTA Section -->
    <div class="cta-section">
        <a href="{{route('swapno-dashboard')}}" class="cta-button">More Details about Factories</a>
        <a href="{{route('swapno-summary')}}" class="cta-button">Swapno Summary</a>
        <a href="{{route('swapno-gallery')}}" class="cta-button">Swapno Gallery</a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Monthly Bar Chart
    const chartLabels = @json($labels);
    const chartDatasets = @json($datasets);

    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyChart = new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: chartDatasets
            /*datasets: [
                {
                    label: 'Category 1',
                    data: category1Data,
                    backgroundColor: '#60a5fa',
                    borderRadius: 4,
                    barThickness: 30
                },
                {
                    label: 'Category 2',
                    data: category2Data,
                    backgroundColor: '#34d399',
                    borderRadius: 4,
                    barThickness: 30
                }
            ]*/
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                }
            },
            /*scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + 'tk';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }*/
        }
    });

    // Pie Chart
    const pieLabels = @json($pieLabels);
    const pieData = @json($pieData);
    const pieColors = @json($pieColors);

    const pieCtx = document.getElementById('pieChart').getContext('2d');

    const pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            // labels: ['Category 1', 'Category 2', 'Category 3', 'Category 4'],
            labels: pieLabels,
            datasets: [{
                // data: [50, 25, 15, 10],
                data: pieData,
                // backgroundColor: ['#60a5fa', '#34d399', '#f472b6', '#fbbf24'],
                backgroundColor: pieColors,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: true },
                datalabels: {
                    color: '#000',
                    font: {
                        weight: 'bold'
                    },
                    formatter: (value, context) => {
                        const label = context.chart.data.labels[context.dataIndex];
                        return `${label}: ${value}`;
                    }
                }
            },
            cutout: '50%' // for doughnut effect
        },
        plugins: [ChartDataLabels]
    });

</script>
</body>
</html>
