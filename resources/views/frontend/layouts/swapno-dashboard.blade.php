
@extends('frontend.layouts.app')

@section('content')
    <div class="container-fluid p-4">

        <!-- Filter Form -->
        <div class="filter-container mb-4">
            <form method="GET" action="{{ route('swapno-dashboard') }}" class="filter-form">
                <div class="filter-inputs">
                    <select name="month" class="form-select">
                        <option value="">All Months</option>
                        @foreach($months as $month)
                            <option value="{{ $month }}" {{ $defaultMonth == $month ? 'selected' : '' }}>
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>

                    <select name="year" class="form-select">
                        <option value="">All Years</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $defaultYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Apply
                    </button>

                    @if(request()->has('month') || request()->has('year'))
                        <a href="{{ route('swapno-dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <h1 class="overview-title">Key Performance Indicator</h1>

        {{--<div class="grid-container mb-4">
            @if(isset($totalNumbers->factory_onboarded))
                <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #9c27b0, #673ab7);">
                    <div class="kpi-title fw-bold text-white">Factories Onboarded</div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="kpi-number text-white">{{$totalNumbers->factory_onboarded ?? 0}}</div>
                        <i class="fas fa-industry kpi-icon"></i>
                    </div>
                    <div class="kpi-trend text-white">
                        <i class="fas fa-arrow-up"></i> Key progress indicator
                    </div>
                </div>
            @endif

            @if(isset($totalNumbers->fps_inaugurated))
                <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #2196f3, #03a9f4);">
                    <div class="kpi-title fw-bold text-white">FPS Inaugurated</div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="kpi-number text-white">{{$totalNumbers->fps_inaugurated ?? 0}}</div>
                        <i class="fas fa-building kpi-icon"></i>
                    </div>
                    <div class="kpi-trend text-white">
                        <i class="fas fa-chart-line"></i> Operational units
                    </div>
                </div>
            @endif

                @if(isset($totalNumbers->nic_formed))
                    <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #009688, #4caf50);">
                        <div class="kpi-title fw-bold text-white">NIC Formed</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="kpi-number text-white">{{$totalNumbers->nic_formed ?? 0}}</div>
                            <i class="fas fa-users kpi-icon"></i>
                        </div>
                        <div class="kpi-trend text-white">
                            <i class="fas fa-network-wired"></i> Committees established
                        </div>
                    </div>
                @endif

                @if(isset($totalNumbers->nic_meeting_conducted))
                    <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #ff9800, #ff5722);">
                        <div class="kpi-title fw-bold text-white">NIC Meetings Conducted</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="kpi-number text-white">{{$totalNumbers->nic_meeting_conducted ?? 0}}</div>
                            <i class="fas fa-calendar-alt kpi-icon"></i>
                        </div>
                        <div class="kpi-trend text-white">
                            <i class="fas fa-clock"></i> Engagement metric
                        </div>
                    </div>
                @endif

                @if(isset($totalNumbers->stakeholder_conducted))
                    <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #3f51b5, #607d8b);">
                        <div class="kpi-title fw-bold text-white">Stakeholder Workshops</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="kpi-number text-white">{{$totalNumbers->stakeholder_conducted ?? 0}}</div>
                            <i class="fas fa-handshake kpi-icon"></i>
                        </div>
                        <div class="kpi-trend text-white">
                            <i class="fas fa-comments"></i> Collaboration events
                        </div>
                    </div>
                @endif

                @if(isset($totalNumbers->participants_attend))
                    <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #ff5722, #e91e63);">
                        <div class="kpi-title fw-bold text-white">Workshop Participants</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="kpi-number text-white">{{$totalNumbers->participants_attend ?? 0}}</div>
                            <i class="fas fa-user-friends kpi-icon"></i>
                        </div>
                        <div class="kpi-trend text-white">
                            <i class="fas fa-users"></i> Total attendees
                        </div>
                    </div>
                @endif

                @php
                    $icons = [
                        'fa-user-friends',
                        'fa-users',
                        'fa-chart-line',
                        'fa-chart-pie',
                        'fa-briefcase',
                        'fa-trophy',
                        'fa-star',
                        'fa-award',
                        'fa-lightbulb',
                        'fa-gem'
                    ];

                    $gradients = [
                        'linear-gradient(135deg, #ff5722, #e91e63)',
                        'linear-gradient(135deg, #3f51b5, #2196f3)',
                        'linear-gradient(135deg, #4caf50, #8bc34a)',
                        'linear-gradient(135deg, #9c27b0, #673ab7)',
                        'linear-gradient(135deg, #00bcd4, #009688)',
                        'linear-gradient(135deg, #ff9800, #ff5722)',
                        'linear-gradient(135deg, #607d8b, #795548)',
                        'linear-gradient(135deg, #e91e63, #f44336)'
                    ];
                @endphp

                @if(count($particulars)>0)
                    @foreach($particulars as $key => $particular)
                        @php
                            $randomIcon = $icons[array_rand($icons)];
                            $randomGradient = $gradients[array_rand($gradients)];
                        @endphp

                        <div class="kpi-card-colorful" style="background: {{ $randomGradient }};">
                            <div class="kpi-title fw-bold text-white">{{$particular['name']}}</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="kpi-number text-white">{{$particular['total'] ?? 0}}</div>
                                <i class="fas {{ $randomIcon }} kpi-icon"></i>
                            </div>
                            <div class="kpi-trend text-white">
                                <i class="fas fa-users"></i> {{Str::headline($particular['group'])}}
                            </div>
                        </div>
                    @endforeach
                @endif
        </div>--}}

        <div class="row">
            <!-- Static KPIs Column with light blue background -->
            <div class="col-md-6" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h4 class="mb-4 text-primary" style="border-bottom: 2px solid #007bff; padding-bottom: 8px;">
                    <i class="fas fa-chart-pie mr-2"></i> Core Metrics
                </h4>
                <div class="grid-container mb-4">
                    @if(isset($totalNumbers->factory_onboarded))
                        <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #9c27b0, #673ab7);">
                            <div class="kpi-title fw-bold text-white">Factories Onboarded</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="kpi-number text-white">{{$totalNumbers->factory_onboarded ?? 0}}</div>
                                <i class="fas fa-industry kpi-icon"></i>
                            </div>
                            <div class="kpi-trend text-white">
                                <i class="fas fa-arrow-up"></i> Key progress indicator
                            </div>
                        </div>
                    @endif

                    @if(isset($totalNumbers->fps_inaugurated))
                        <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #2196f3, #03a9f4);">
                            <div class="kpi-title fw-bold text-white">FPS Inaugurated</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="kpi-number text-white">{{$totalNumbers->fps_inaugurated ?? 0}}</div>
                                <i class="fas fa-building kpi-icon"></i>
                            </div>
                            <div class="kpi-trend text-white">
                                <i class="fas fa-chart-line"></i> Operational units
                            </div>
                        </div>
                    @endif

                    @if(isset($totalNumbers->nic_formed))
                        <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #009688, #4caf50);">
                            <div class="kpi-title fw-bold text-white">NIC Formed</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="kpi-number text-white">{{$totalNumbers->nic_formed ?? 0}}</div>
                                <i class="fas fa-users kpi-icon"></i>
                            </div>
                            <div class="kpi-trend text-white">
                                <i class="fas fa-network-wired"></i> Committees established
                            </div>
                        </div>
                    @endif

                    @if(isset($totalNumbers->nic_meeting_conducted))
                        <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #ff9800, #ff5722);">
                            <div class="kpi-title fw-bold text-white">NIC Meetings Conducted</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="kpi-number text-white">{{$totalNumbers->nic_meeting_conducted ?? 0}}</div>
                                <i class="fas fa-calendar-alt kpi-icon"></i>
                            </div>
                            <div class="kpi-trend text-white">
                                <i class="fas fa-clock"></i> Engagement metric
                            </div>
                        </div>
                    @endif

                    @if(isset($totalNumbers->stakeholder_conducted))
                        <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #3f51b5, #607d8b);">
                            <div class="kpi-title fw-bold text-white">Stakeholder Workshops</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="kpi-number text-white">{{$totalNumbers->stakeholder_conducted ?? 0}}</div>
                                <i class="fas fa-handshake kpi-icon"></i>
                            </div>
                            <div class="kpi-trend text-white">
                                <i class="fas fa-comments"></i> Collaboration events
                            </div>
                        </div>
                    @endif

                    @if(isset($totalNumbers->participants_attend))
                        <div class="kpi-card-colorful" style="background: linear-gradient(135deg, #ff5722, #e91e63);">
                            <div class="kpi-title fw-bold text-white">Workshop Participants</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="kpi-number text-white">{{$totalNumbers->participants_attend ?? 0}}</div>
                                <i class="fas fa-user-friends kpi-icon"></i>
                            </div>
                            <div class="kpi-trend text-white">
                                <i class="fas fa-users"></i> Total attendees
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Dynamic KPIs Column with light green background -->
            <div class="col-md-6" style="background-color: #f0fff0; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h4 class="mb-4 text-success" style="border-bottom: 2px solid #28a745; padding-bottom: 8px;">
                    <i class="fas fa-random mr-2"></i> Dynamic Metrics
                </h4>
                <div class="grid-container mb-4">
                    @php
                        $icons = [
                            'fa-user-friends',
                            'fa-users',
                            'fa-chart-line',
                            'fa-chart-pie',
                            'fa-briefcase',
                            'fa-trophy',
                            'fa-star',
                            'fa-award',
                            'fa-lightbulb',
                            'fa-gem'
                        ];

                        $gradients = [
                            'linear-gradient(135deg, #ff5722, #e91e63)',
                            'linear-gradient(135deg, #3f51b5, #2196f3)',
                            'linear-gradient(135deg, #4caf50, #8bc34a)',
                            'linear-gradient(135deg, #9c27b0, #673ab7)',
                            'linear-gradient(135deg, #00bcd4, #009688)',
                            'linear-gradient(135deg, #ff9800, #ff5722)',
                            'linear-gradient(135deg, #607d8b, #795548)',
                            'linear-gradient(135deg, #e91e63, #f44336)'
                        ];
                    @endphp

                    @if(count($particulars)>0)
                        @foreach($particulars as $key => $particular)
                            @php
                                $randomIcon = $icons[array_rand($icons)];
                                $randomGradient = $gradients[array_rand($gradients)];
                            @endphp

                            <div class="kpi-card-colorful" style="background: {{ $randomGradient }};">
                                <div class="kpi-title fw-bold text-white">{{$particular['name']}}</div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="kpi-number text-white">{{$particular['total'] ?? 0}}</div>
                                    <i class="fas {{ $randomIcon }} kpi-icon"></i>
                                </div>
                                <div class="kpi-trend text-white">
                                    <i class="fas fa-users"></i> {{Str::headline($particular['group'])}}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            No dynamic metrics available
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <div class="budget-section">
            @php
                $firstOrganizationName = collect($groupedKpis)->keys()->first() ?? null;
                $activeOrg = $firstOrganizationName ? Str::slug($firstOrganizationName) : '';
            @endphp
            <h3 class="mb-4">Factory wise kpi </h3>

            <div class="company-tabs">
                @foreach($Organization as $org)
                    @php
                        $orgSlug = Str::slug($org->name);
                    @endphp
                    <button class="company-tab {{ $orgSlug === $activeOrg ? 'active' : '' }}"
                            data-company="{{ $orgSlug }}">
                        {{ $org->name }}
                    </button>
                @endforeach
            </div>


            @php
                $groupTitles = [
                    'capacity_building_training' => 'Capacity Building Training',
                    'sbcc_approach' => 'SBCC Approach',
                    'promotional_campaign' => 'Promotional Campaign',
                    'fps_sales_performance' => 'FPS Sales Performance',
                ];
                $tableColors = [
                    'capacity_building_training' => 'table-header-blue',
                    'sbcc_approach' => 'table-header-green',
                    'promotional_campaign' => 'table-header-lime',
                    'fps_sales_performance' => 'table-header-purple',
                ];
            @endphp

            @foreach($groupedKpis as $organization => $groupData)
                @php
                    $orgSlug = Str::slug($organization);
                @endphp
                <div class="company-content {{ $orgSlug === $activeOrg ? 'active' : '' }}" id="company-{{ $orgSlug }}">
                    <h4 class="text-center">{{ $organization }}</h4>
                    <div class="row g-4">
                        @foreach ($groupData as $groupKey => $indicators)
                            <div class="col-lg-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="{{ $tableColors[$groupKey] ?? '' }}">
                                        <tr>
                                            <th>S/N</th>
                                            <th>{{ $groupTitles[$groupKey] ?? ucfirst(str_replace('_', ' ', $groupKey)) }}</th>
                                            <th>Numbers</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-striped">
                                        @foreach ($indicators as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}.</td>
                                                <td>{{ $item['kpi_name'] }}</td>
                                                <td class="text-center">{{ $item['kpi_value'] ?? 0 }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

@push('CustomStyle')
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 15px;
        }

        .kpi-card-colorful {
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .kpi-card-colorful:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.15);
        }

        .kpi-title {
            font-size: 18px;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .kpi-number {
            font-size: 32px;
            font-weight: 700;
        }

        .kpi-icon {
            font-size: 40px;
            opacity: 0.2;
            /*position: absolute;*/
            right: 20px;
            bottom: 20px;
        }

        .kpi-trend {
            font-size: 12px;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <style>
        /* Body and General Styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Animation Keyframes */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInFromBottom {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.03); }
            100% { transform: scale(1); }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .kpi-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #28a745;
            transition: all 0.3s ease;
        }

        .kpi-card:hover .kpi-number {
            color: #218838;
            animation: pulse 1s ease infinite;
        }

        .kpi-card:hover .arrow-icon {
            transform: translateX(5px);
            color: #28a745;
        }

        /* Staggered animations for KPI cards */
        .kpi-card-flexible:nth-child(1) { animation-delay: 0.1s; }
        .kpi-card-flexible:nth-child(2) { animation-delay: 0.2s; }
        .kpi-card-flexible:nth-child(3) { animation-delay: 0.3s; }
        .kpi-card-flexible:nth-child(4) { animation-delay: 0.4s; }
        .kpi-card-flexible:nth-child(5) { animation-delay: 0.5s; }
        .kpi-card-flexible:nth-child(6) { animation-delay: 0.6s; }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: stretch;
        }

        /* Table Header Styles */
        .table-header-blue {
            background-color: #4285f4;
            color: white;
            animation: slideInFromTop 0.5s ease-out;
        }

        .table-header-green {
            background-color: #28a745;
            color: white;
            animation: slideInFromTop 0.5s ease-out;
        }

        .table-header-lime {
            background-color: #8bc34a;
            color: white;
            animation: slideInFromTop 0.5s ease-out;
        }

        .table-header-purple {
            background-color: #6f42c1;
            color: white;
            animation: slideInFromTop 0.5s ease-out;
        }

        /* Table row animations */
        .table-striped tr {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }

        .table-striped tr:nth-child(1) { animation-delay: 0.1s; }
        .table-striped tr:nth-child(2) { animation-delay: 0.2s; }
        .table-striped tr:nth-child(3) { animation-delay: 0.3s; }
        .table-striped tr:nth-child(4) { animation-delay: 0.4s; }
        .table-striped tr:nth-child(5) { animation-delay: 0.5s; }
        .table-striped tr:nth-child(6) { animation-delay: 0.6s; }
        .table-striped tr:nth-child(7) { animation-delay: 0.7s; }
        .table-striped tr:nth-child(8) { animation-delay: 0.8s; }
        .table-striped tr:nth-child(9) { animation-delay: 0.9s; }
        .table-striped tr:nth-child(10) { animation-delay: 1.0s; }
        .table-striped tr:nth-child(11) { animation-delay: 1.1s; }

        /* Budget Section Styles */
        .budget-section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 30px;
            animation: slideInFromBottom 0.5s ease-out;
        }

        /* Company Tabs Styles */
        .company-tabs {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease-out;
        }

        .company-tab {
            padding: 8px 16px;
            background: white;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
            transform-origin: center;
        }

        .company-tab:hover {
            background: #e9ecef;
            transform: scale(1.05);
        }

        .company-tab.active {
            background: #28a745;
            color: white;
            animation: bounceIn 0.5s ease-out;
        }

        .company-content {
            display: none;
        }

        .company-content.active {
            display: block;
            animation: fadeIn 0.5s ease-out;
        }

        /* Title Styles */
        .overview-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
            animation: slideInFromTop 0.5s ease-out;
        }

        /* Loading animation for initial load */
        @keyframes loadingPulse {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        .filter-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .filter-form {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .filter-inputs {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-inputs .form-select {
            flex: 1;
            min-width: 150px;
        }

        .filter-inputs .btn {
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .filter-inputs {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-inputs .btn {
                width: 100%;
            }
        }
    </style>
@endpush
@push('CustomJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const companyTabs = document.querySelectorAll('.company-tab');
            const companyContents = document.querySelectorAll('.company-content');

            companyTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const companyId = this.getAttribute('data-company');

                    // Remove active class from all tabs
                    companyTabs.forEach(t => t.classList.remove('active'));

                    // Add active class to clicked tab
                    this.classList.add('active');

                    // Hide all company content sections
                    companyContents.forEach(content => {
                        content.classList.remove('active');
                    });

                    // Show the selected company content
                    const targetContent = document.getElementById(`company-${companyId}`);
                    if (targetContent) {
                        targetContent.classList.add('active');
                    }
                });
            });

            // Intersection Observer for scroll animations
            const animateOnScroll = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            };

            const observer = new IntersectionObserver(animateOnScroll, {
                threshold: 0.1
            });

            document.querySelectorAll('.kpi-card-flexible, .table-striped tr').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
@endpush
