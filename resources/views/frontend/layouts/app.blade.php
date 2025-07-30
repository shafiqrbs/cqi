<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWAPNO Project</title>
    <link rel="icon" type="image/png" href="{{asset('assets/logo-gain-health.svg')}}">


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
            /*width: 80px;*/
            /*height: 80px;*/
            /*background: linear-gradient(135deg, #0891b2, #10b981);*/
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

            /*.logo {
                width: 60px;
                height: 60px;
            }*/

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
        .menu .nav-link {
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
            text-decoration: none;
        }

        .menu .nav-link:hover {
            color: #007bff;
        }

    </style>
    @stack('CustomStyle')

</head>
<body>
<!-- Header Section -->
<div class="header-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo Section -->
            <div class="col-md-4">
                <div class="logo-container">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img width="70%" src="{{ asset('assets/logo-gain-health.svg') }}" alt="Logo">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Menu Section -->
            <div class="col-md-5 text-center">
                <nav class="menu">
                    <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('swapno-dashboard') }}">Factories</a>
                        </li>

                            @php
                                $type = Request::segment(2);
                            @endphp

                            @if ($type === 'gallery')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('swapno-gallery', 'resource') }}">Resource</a>
                                </li>
                            @elseif ($type === 'resource')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('swapno-gallery', 'gallery') }}">Gallery</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('swapno-gallery', 'resource') }}">Resource</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('swapno-gallery', 'gallery') }}">Gallery</a>
                                </li>
                            @endif
                    </ul>
                </nav>
            </div>

            <!-- Funded By Section -->
            <div class="col-md-3 text-end">
                <div class="text-muted mb-2"></div>
                <a href="{{ route('home') }}">
                    <img width="80%" src="{{ asset('assets/logo-auchon.jpeg') }}" alt="Auchan Foundation Logo">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Project Title Section -->
<div class="container">
    @yield('content')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@stack('CustomJs')

</body>
</html>
