@extends('frontend.layouts.app')

@section('content')
    {{--<div class="project-title" style="color: #ffffff">
        <h1 class="main-title" style="color: #ffffff">Strengthening Workers' Access to Pertinent<br>Nutrition Opportunities (SWAPNO)</h1>
        <div class="project-duration" style="color: #ffffff">Project Duration</div>
        <div class="project-duration" style="color: #ffffff"><strong>January 2025-Dec 2027</strong></div>
    </div>--}}

    <div class="project-title">
        <div class="project-title-content">
            <h1 class="main-title">
                Strengthening Workers' Access to Pertinent<br>
                Nutrition Opportunities (SWAPNO)
            </h1>
            <div class="project-duration">Project Duration</div>
            <div class="project-duration font-weight-bold">January 2025 - Dec 2027</div>
        </div>
    </div>



    <div class="chart-section my-5">
        <div class="row g-4">
            <!-- Column 1: Monthly Sales -->
            <div class="col-lg-4">
                <div class="chart-card h-100 p-4 border rounded bg-white shadow-sm">
                    <h3 class="chart-title">Monthly FPS Sales</h3>
                        <div class="chart-controls mb-3">
                            {!! Form::select('fps_month', $months, $defaultMonth, ['id' => 'fps_month', 'class' => 'form-control form-select']) !!}
                            {!! Form::select('fps_year', $years, $defaultYear, ['id' => 'fps_year', 'class' => 'form-control form-select']) !!}
                        </div>
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
            <div class="col-lg-4">
                <div class="chart-card h-100 p-4 border rounded bg-white shadow-sm">
                    <h3 class="chart-title">Category Wise Sales</h3>

                    <div class="chart-controls mb-3">
                        {!! Form::select('organization_id', $organizations, $defaultOrgId, ['id' => 'organization_id', 'class' => 'form-control form-select','style'=>'width:50%']) !!}
                        {!! Form::select('month', $months, $defaultMonth, ['id' => 'sales_month', 'class' => 'form-control form-select','style'=>'width:25%']) !!}
                        {!! Form::select('years', $years, $defaultYear, ['id' => 'sales_year', 'class' => 'form-control form-select','style'=>'width:25%']) !!}
                    </div>

                    <div class="pie-chart-container">
                        <canvas id="pieChart"></canvas>
                        <input type="hidden" id="default-org" value="{{ $defaultOrgId }}">
                        <input type="hidden" id="default-month" value="{{ $defaultMonth }}">
                        <input type="hidden" id="default-year" value="{{ $defaultYear }}">

                    </div>
                </div>
            </div>

            @php
                $colorClasses = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
            @endphp

            <div class="col-lg-4">
                <div class="chart-card h-100 p-4 border rounded bg-white shadow-sm">
                    <h3 class="chart-title mb-3">Quarterly Milestone</h3>
                    <div class="chart-controls mb-3">
                        {!! Form::select('milestone_type_id', $milestoneTypes, $defaultMilestone, ['id' => 'milestone_type_id', 'class' => 'form-control form-select']) !!}
                        {!! Form::select('milestone_year', $years, $defaultYear, ['id' => 'milestone_year', 'class' => 'form-control form-select']) !!}
                    </div>

                    <div id="milestone-list-wrapper" style="position: relative; min-height: 100px;"> <div id="milestone-loader" class="text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div id="milestone-list">
                            @foreach ($milestones as $index => $item)
                                <div class="p-3 text-start border rounded shadow-sm mb-2 bg-light border-start border-3
border-{{ $colorClasses[$index % count($colorClasses)] }} milestone-item"> {{-- Add milestone-item class --}}
                                    <small class="text-muted d-block">
                                        {{ $item->name }}
                                    </small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="chart-card h-100 p-4 border rounded bg-white shadow-sm">
                    <h3 class="chart-title">Upcoming Events</h3>

                    {{-- Example with an imaginary 'event->description' --}}
                    <ul class="list-group list-group-flush">
                        @foreach($events as $event)
                            <li class="list-group-item px-0 d-flex justify-content-between align-items-start mb-xl-4 event-item"
                                data-bs-toggle="popover"
                                data-bs-trigger="hover focus"
                                data-bs-placement="top"
                                data-bs-content="{{ $event->description ?? 'No description available.' }}"
                                title="{{ $event->name }}">
                                <div>
                                    <h6 class="mb-1 fw-semibold">
                                        {{$event->name}}
                                    </h6>
                                    @if($event->event_date)
                                        <small class="text-muted">{{date('F j, Y',strtotime($event->event_date))}}</small>
                                    @endif
                                </div>
                                <span class="badge bg-success rounded-pill">New</span>
                            </li>
                        @endforeach
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
            const defaultMonth = document.getElementById('default-sales_month').value;
            const defaultYear = document.getElementById('default-year').value;

            // Set default selected in dropdowns
            document.getElementById('organization_id').value = defaultOrgId;
            document.getElementById('sales_month').value = defaultMonth;
            document.getElementById('sales_year').value = defaultMonth;

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
            const sales_month = document.getElementById('sales_month').value;
            const sales_year = document.getElementById('sales_year').value;

            if (!orgId || !sales_month) return;

            fetch(`/report/product-sales?organization_id=${orgId}&month=${sales_month}&year=${sales_year}`)
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
        document.getElementById('sales_month').addEventListener('change', loadChartData);
        document.getElementById('sales_year').addEventListener('change', loadChartData);
        // Load initially
        document.addEventListener('DOMContentLoaded', loadChartData);
    </script>

    <script>
        // Monthly Bar Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: @json($datasets)
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

        // Add event listeners for month and year select
        document.getElementById('fps_month').addEventListener('change', updateChart);
        document.getElementById('fps_year').addEventListener('change', updateChart);

        function updateChart() {
            const fps_month = document.getElementById('fps_month').value;
            const fps_year = document.getElementById('fps_year').value;

            // Show loading state
            monthlyChart.data.labels = ['Loading...'];
            monthlyChart.data.datasets = [{
                label: 'Loading',
                data: [0],
                backgroundColor: '#cccccc'
            }];
            monthlyChart.update();

            // Fetch new data
            fetch(`/report/org-fps-bar?month=${fps_month}&year=${fps_year}`)
                .then(response => response.json())
                .then(data => {
                    // Update chart with new data
                    monthlyChart.data.labels = data.labels;
                    monthlyChart.data.datasets = data.datasets;
                    monthlyChart.update();
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show error state
                    monthlyChart.data.labels = ['Error loading data'];
                    monthlyChart.data.datasets = [{
                        label: 'Error',
                        data: [0],
                        backgroundColor: '#ffcccc'
                    }];
                    monthlyChart.update();
                });
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const milestoneTypeSelect = document.getElementById('milestone_type_id');
            const milestoneYearSelect = document.getElementById('milestone_year');
            const milestoneListContainer = document.getElementById('milestone-list');

            const loadMilestones = () => {
                const milestoneTypeId = milestoneTypeSelect?.value;
                const milestoneYear = milestoneYearSelect?.value || '';

                if (!milestoneTypeId || !milestoneListContainer) return;

                milestoneListContainer.classList.add('is-loading');

                setTimeout(() => {
                    fetch(`/get-milestones?milestone_type_id=${milestoneTypeId}&year=${milestoneYear}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.text();
                        })
                        .then(html => {
                            milestoneListContainer.innerHTML = html;
                            milestoneListContainer.classList.remove('is-loading');
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            milestoneListContainer.classList.remove('is-loading');
                        });
                }, 150);
            };

            if (milestoneTypeSelect) {
                milestoneTypeSelect.addEventListener('change', loadMilestones);
            }

            if (milestoneYearSelect) {
                milestoneYearSelect.addEventListener('change', loadMilestones);
            }
        });
    </script>

@endpush

@push('CustomStyle')

    <style>

        #milestone-list {
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        #milestone-list.is-loading {
            opacity: 0;
            transform: translateY(10px);
            pointer-events: none;
        }

        .milestone-item {
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /*.project-title {
            position: relative;
            background: url('/assets/swapno-bg.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            !*padding: 80px 20px;*!
            padding: 250px 20px;
            text-align: center;
            border-radius: 10px;
            overflow: hidden;
        }

        .project-title::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.63); !* Dark overlay with 40% opacity *!
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
        }*/

        .project-title {
            position: relative;
            background: url('/assets/swapno-bg.jpg') no-repeat center center;
            background-size: cover;
            color: #ffffff;
            padding: 250px 20px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            border-radius: 10px;
            overflow: hidden;
        }

        .project-title::before {
            content: '';
            position: absolute;
            inset: 0;
            /*background-color: rgba(0, 0, 0, 0.6); !* full section dark overlay *!*/
            z-index: 0;
        }

        .project-title-content {
            position: relative;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.5); /* Local background for text block */
            width: 100%;
            padding: 10px 10px;
            text-align: center;
            top: 245px;
        }

        .main-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .project-duration {
            font-size: 1.25rem;
            color: #ffffff;
        }

        .chart-container {
            position: relative;
            min-height: 300px;
        }

        .loading-chart {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
    </style>

@endpush
