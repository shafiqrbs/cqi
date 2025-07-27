@extends('frontend.layouts.app')

@section('content')
    <div class="project-title" style="color: #ffffff">
        <h1 class="main-title" style="color: #ffffff">Strengthening Workers' Access to Pertinent<br>Nutrition Opportunities (SWAPNO)</h1>
        <div class="project-duration" style="color: #ffffff">Project Duration</div>
        <div class="project-duration" style="color: #ffffff"><strong>January 2025-Dec 2027</strong></div>
    </div>


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
                    <h3 class="chart-title">Category Wise Sales</h3>

                    <div class="chart-controls mb-3">
                        {!! Form::select('organization_id', $organizations, $defaultOrgId, ['id' => 'organization_id', 'class' => 'form-control form-select']) !!}
                        {!! Form::select('month', $months, $defaultMonth, ['id' => 'month', 'class' => 'form-control form-select']) !!}

                    </div>

                    <div class="pie-chart-container">
                        <canvas id="pieChart"></canvas>
                        <input type="hidden" id="default-org" value="{{ $defaultOrgId }}">
                        <input type="hidden" id="default-month" value="{{ $defaultMonth }}">

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
@endsection

@push('CustomJs')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const defaultOrgId = document.getElementById('default-org').value;
            const defaultMonth = document.getElementById('default-month').value;

            // Set default selected in dropdowns
            document.getElementById('organization_id').value = defaultOrgId;
            document.getElementById('month').value = defaultMonth;

            // Load chart immediately
            loadChartData();
        });



        let pieChart;
        const pieCtx = document.getElementById('pieChart').getContext('2d');

        // Render chart
        function renderChart(labels, data) {
            if (pieChart) pieChart.destroy();

            pieChart = new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            '#60a5fa', '#34d399', '#f472b6', '#fbbf24',
                            '#8b5cf6', '#f87171', '#22d3ee', '#a3e635'
                        ],
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
                            font: { weight: 'bold' },
                            formatter: (value, context) => {
                                const label = context.chart.data.labels[context.dataIndex];
                                return `${label}: ${value}`;
                            }
                        }
                    },
                    cutout: '50%'
                },

                // plugins: [ChartDataLabels]
                plugins: {
                    datalabels: {
                        display: false // <- hide labels inside pie
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label;
                                const value = context.raw;
                                return `${label}: ${value}`;
                            }
                        }
                    }
                }

            });
        }

        // Fetch chart data
        function loadChartData() {
            const orgId = document.getElementById('organization_id').value;
            const month = document.getElementById('month').value;

            if (!orgId || !month) return;

            fetch(`/report/product-sales?organization_id=${orgId}&month=${month}`)
                .then(res => res.json())
                .then(data => {
                    const labels = data.map(item => item.label);
                    const values = data.map(item => parseFloat(item.value));
                    renderChart(labels, values);
                })
                .catch(err => {
                    console.error('Error loading chart data:', err);
                });
        }

        // Trigger on change
        document.getElementById('organization_id').addEventListener('change', loadChartData);
        document.getElementById('month').addEventListener('change', loadChartData);
        // Load initially
        document.addEventListener('DOMContentLoaded', loadChartData);


        // Monthly Bar Chart
        const chartLabels = @json($labels);
        const chartDatasets = @json($datasets);

        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: chartDatasets
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
                }
            }
        });

    </script>

@endpush

@push('CustomStyle')

    <style>
        .project-title {
            position: relative;
            background: url('/assets/p-area.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 80px 20px;
            text-align: center;
            border-radius: 10px;
            overflow: hidden;
        }

        .project-title::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.63); /* Dark overlay with 40% opacity */
            z-index: 0;
        }

        .project-title > * {
            position: relative;
            z-index: 1;
        }

        .main-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .project-duration {
            font-size: 1.2rem;
        }
    </style>

@endpush
