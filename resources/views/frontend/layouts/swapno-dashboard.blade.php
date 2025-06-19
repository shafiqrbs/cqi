{{--
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Swapno Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <meta name="theme-color" content="#7952b3">
    <style>
        /* Body and General Styles */
        body {
            background-color: #f8f9fa;
        }

        /* Navbar Styles */
        .navbar-custom {
            background-color: #495057;
        }

        .dropdown-toggle::after {
            margin-left: 0.5em;
        }

        /* KPI Card Styles */
        .kpi-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
            transition: transform 0.2s ease;
            /* Fixed height for equal card heights */
            height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .kpi-title {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 10px;
            font-weight: 500;
            /* Limit title to 2 lines */
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 32px; /* 2 lines * line-height */
        }

        .kpi-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #28a745;
        }

        .arrow-icon {
            color: #6c757d;
            font-size: 1.2rem;
        }

        /* Alternative KPI Card Layouts */
        .equal-height-row {
            display: flex;
            flex-wrap: wrap;
        }

        .equal-height-col {
            display: flex;
        }

        .kpi-card-flexible {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
            transition: transform 0.2s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
        }

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
        }

        .table-header-green {
            background-color: #28a745;
            color: white;
        }

        .table-header-lime {
            background-color: #8bc34a;
            color: white;
        }

        .table-header-purple {
            background-color: #6f42c1;
            color: white;
        }

        /* Budget Section Styles */
        .budget-section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 30px;
        }

        /* Company Tabs Styles */
        .company-tabs {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
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
        }

        .company-tab:hover {
            background: #e9ecef;
        }

        .company-tab.active {
            background: #28a745;
            color: white;
        }

        .company-content {
            display: none;
        }

        .company-content.active {
            display: block;
        }

        /* Title Styles */
        .overview-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }

        .section-title {
            margin: 40px 0 20px 0;
            color: #2c3e50;
            font-weight: 600;
        }
    </style>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
</head>
<body class="app">

<!-- Main Content -->
<div class="container-fluid p-4">
    <h1 class="overview-title">Overview</h1>

    <div class="grid-container mb-4">
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of factory Onboarded</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->factory_onboarded ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of FPS inaugurated</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->fps_inaugurated ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of NIC formed</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->nic_formed ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of NIC meeting conducted</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->nic_meeting_conducted ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of workshop, meeting with different stakeholder conducted</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->stakeholder_conducted ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of participants attend the workshop, meeting</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->participants_attend ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
    </div>

    <!-- Budget Follow Up Section -->
    <div class="budget-section">
        <h3 class="mb-4">Follow up</h3>

        <div class="company-tabs">
            @if($Organization)
                @foreach($Organization as $index => $org)
                    <button class="company-tab {{ $index == 0 ? 'active' : '' }}" data-company="{{$org->id}}">{{$org->name}}</button>
                @endforeach
            @endif
        </div>

        <!-- Company Content Sections -->
        @if($swapnoNumbers)
            @foreach($swapnoNumbers as $index => $swp)
                <div class="company-content {{ $index == 0 ? 'active' : '' }}" id="company-{{$swp->organization_id}}">
                    <div class="row g-4">
                        <!-- Capacity Building Training Table -->
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-header-blue">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Capacity Building Training</th>
                                        <th>Numbers</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-striped">
                                    <tr>
                                        <td>1.</td>
                                        <td>Number of NIC training completed</td>
                                        <td class="text-center">{{$swp->nic_training_completed ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Number of  NIC member received training</td>
                                        <td class="text-center">{{$swp->nic_member_received_training ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Number of Peer educator selected</td>
                                        <td class="text-center">{{$swp->peer_educator_selected ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Female Peer educator</td>
                                        <td class="text-center">{{$swp->female_peer_educator ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Male Peer educator</td>
                                        <td class="text-center">{{$swp->male_peer_educator ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>Number of Peer educator received training</td>
                                        <td class="text-center">{{$swp->peer_educator_received_training ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>7.</td>
                                        <td>Female participant</td>
                                        <td class="text-center">{{$swp->female_participant ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>8.</td>
                                        <td>Male participant</td>
                                        <td class="text-center">{{$swp->male_participant ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>9.</td>
                                        <td>Number of Peer Educator ToT completed</td>
                                        <td class="text-center">{{$swp->peer_educator_tot_completed ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>10.</td>
                                        <td>Number of training conducted for FPS staff</td>
                                        <td class="text-center">{{$swp->training_conducted_for_fps_staff ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>11.</td>
                                        <td>Number of FPS staff received training</td>
                                        <td class="text-center">{{$swp->fps_staff_received_training ?? 0}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Promotional Campaign Table -->
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-header-green">
                                    <tr>
                                        <th>S/N</th>
                                        <th>SBCC Approach</th>
                                        <th>Numbers</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-striped">
                                    <tr>
                                        <td>1.</td>
                                        <td>Types of SBCC materials developed</td>
                                        <td class="text-center">{{$swp->sbcc_materials_developed ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Number of SBCC items distributed</td>
                                        <td class="text-center">{{$swp->sbcc_items_distributed ?? 0}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- SBCC Approach Table -->
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-header-lime">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Promotional Campaign</th>
                                        <th>Numbers</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-striped">
                                    <tr>
                                        <td>1.</td>
                                        <td>Number of campaign organized</td>
                                        <td class="text-center">{{$swp->campaign_organized ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Number of workers purchased during campaign</td>
                                        <td class="text-center">{{$swp->workers_purchased_during_campaign ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Female worker</td>
                                        <td class="text-center">{{$swp->female_worker ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Male worker</td>
                                        <td class="text-center">{{$swp->male_worker ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Total sales in BDT during campaign</td>
                                        <td class="text-center">{{$swp->bdt_during_campaign ?? 0.00}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- FPS Sales Performance Table -->
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-header-purple">
                                    <tr>
                                        <th>S/N</th>
                                        <th>FPS Sales Performance</th>
                                        <th>Numbers</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-striped">
                                    <tr>
                                        <td>1.</td>
                                        <td>Number of workers purchased from FPS</td>
                                        <td class="text-center">{{$swp->workers_purchased_from_fps ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Amount sales through Credit</td>
                                        <td class="text-center">{{$swp->amount_sales_through_credit ?? 0.00}}</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Number of workers purchased through credit</td>
                                        <td class="text-center">{{$swp->workers_purchased_through_credit ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Amount sales through Cash</td>
                                        <td class="text-center">{{$swp->amount_sales_through_cash ?? 0.00}}</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Total sales in BDT</td>
                                        <td class="text-center">{{$swp->total_sales_in_bdt ?? 0.00}}</td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>Number of products available in FPS</td>
                                        <td class="text-center">{{$swp->products_available_in_fps ?? 0}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
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
    });
</script>

</body>
</html>--}}

        <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Swapno Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <meta name="theme-color" content="#7952b3">
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

        /* Navbar Styles */
        .navbar-custom {
            background-color: #495057;
        }

        .dropdown-toggle::after {
            margin-left: 0.5em;
        }

        /* KPI Card Styles */
        .kpi-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            /* Fixed height for equal card heights */
            height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            animation: fadeIn 0.5s ease-out forwards;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .kpi-title {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 10px;
            font-weight: 500;
            /* Limit title to 2 lines */
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 32px; /* 2 lines * line-height */
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

        .arrow-icon {
            color: #6c757d;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .kpi-card:hover .arrow-icon {
            transform: translateX(5px);
            color: #28a745;
        }

        /* Alternative KPI Card Layouts */
        .equal-height-row {
            display: flex;
            flex-wrap: wrap;
        }

        .equal-height-col {
            display: flex;
        }

        .kpi-card-flexible {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
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

        .section-title {
            margin: 40px 0 20px 0;
            color: #2c3e50;
            font-weight: 600;
            animation: fadeIn 0.5s ease-out;
        }

        /* Loading animation for initial load */
        @keyframes loadingPulse {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        .loading-placeholder {
            animation: loadingPulse 1.5s ease-in-out infinite;
            background-color: #e9ecef;
            border-radius: 4px;
        }
    </style>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
</head>
<body class="app">

<!-- Main Content -->
<div class="container-fluid p-4">
    <h1 class="overview-title">Overview</h1>

    <div class="grid-container mb-4">
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of factory Onboarded</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->factory_onboarded ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of FPS inaugurated</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->fps_inaugurated ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of NIC formed</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->nic_formed ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of NIC meeting conducted</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->nic_meeting_conducted ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of workshop, meeting with different stakeholder conducted</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->stakeholder_conducted ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
        <div class="kpi-card-flexible">
            <div class="kpi-title">Number of participants attend the workshop, meeting</div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="kpi-number">{{$totalNumbers->participants_attend ?? 0}}</div>
                <i class="fas fa-arrow-right arrow-icon"></i>
            </div>
        </div>
    </div>

    <!-- Budget Follow Up Section -->
    <div class="budget-section">
        <h3 class="mb-4">Follow up</h3>

        <div class="company-tabs">
            @if($Organization)
                @foreach($Organization as $index => $org)
                    <button class="company-tab {{ $index == 0 ? 'active' : '' }}" data-company="{{$org->id}}">{{$org->name}}</button>
                @endforeach
            @endif
        </div>

        <!-- Company Content Sections -->
        @if($swapnoNumbers)
            @foreach($swapnoNumbers as $index => $swp)
                <div class="company-content {{ $index == 0 ? 'active' : '' }}" id="company-{{$swp->organization_id}}">
                    <div class="row g-4">
                        <!-- Capacity Building Training Table -->
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-header-blue">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Capacity Building Training</th>
                                        <th>Numbers</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-striped">
                                    <tr>
                                        <td>1.</td>
                                        <td>Number of NIC training completed</td>
                                        <td class="text-center">{{$swp->nic_training_completed ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Number of  NIC member received training</td>
                                        <td class="text-center">{{$swp->nic_member_received_training ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Number of Peer educator selected</td>
                                        <td class="text-center">{{$swp->peer_educator_selected ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Female Peer educator</td>
                                        <td class="text-center">{{$swp->female_peer_educator ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Male Peer educator</td>
                                        <td class="text-center">{{$swp->male_peer_educator ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>Number of Peer educator received training</td>
                                        <td class="text-center">{{$swp->peer_educator_received_training ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>7.</td>
                                        <td>Female participant</td>
                                        <td class="text-center">{{$swp->female_participant ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>8.</td>
                                        <td>Male participant</td>
                                        <td class="text-center">{{$swp->male_participant ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>9.</td>
                                        <td>Number of Peer Educator ToT completed</td>
                                        <td class="text-center">{{$swp->peer_educator_tot_completed ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>10.</td>
                                        <td>Number of training conducted for FPS staff</td>
                                        <td class="text-center">{{$swp->training_conducted_for_fps_staff ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>11.</td>
                                        <td>Number of FPS staff received training</td>
                                        <td class="text-center">{{$swp->fps_staff_received_training ?? 0}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Promotional Campaign Table -->
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-header-green">
                                    <tr>
                                        <th>S/N</th>
                                        <th>SBCC Approach</th>
                                        <th>Numbers</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-striped">
                                    <tr>
                                        <td>1.</td>
                                        <td>Types of SBCC materials developed</td>
                                        <td class="text-center">{{$swp->sbcc_materials_developed ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Number of SBCC items distributed</td>
                                        <td class="text-center">{{$swp->sbcc_items_distributed ?? 0}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- SBCC Approach Table -->
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-header-lime">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Promotional Campaign</th>
                                        <th>Numbers</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-striped">
                                    <tr>
                                        <td>1.</td>
                                        <td>Number of campaign organized</td>
                                        <td class="text-center">{{$swp->campaign_organized ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Number of workers purchased during campaign</td>
                                        <td class="text-center">{{$swp->workers_purchased_during_campaign ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Female worker</td>
                                        <td class="text-center">{{$swp->female_worker ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Male worker</td>
                                        <td class="text-center">{{$swp->male_worker ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Total sales in BDT during campaign</td>
                                        <td class="text-center">{{$swp->bdt_during_campaign ?? 0.00}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- FPS Sales Performance Table -->
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-header-purple">
                                    <tr>
                                        <th>S/N</th>
                                        <th>FPS Sales Performance</th>
                                        <th>Numbers</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-striped">
                                    <tr>
                                        <td>1.</td>
                                        <td>Number of workers purchased from FPS</td>
                                        <td class="text-center">{{$swp->workers_purchased_from_fps ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Amount sales through Credit</td>
                                        <td class="text-center">{{$swp->amount_sales_through_credit ?? 0.00}}</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Number of workers purchased through credit</td>
                                        <td class="text-center">{{$swp->workers_purchased_through_credit ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Amount sales through Cash</td>
                                        <td class="text-center">{{$swp->amount_sales_through_cash ?? 0.00}}</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Total sales in BDT</td>
                                        <td class="text-center">{{$swp->total_sales_in_bdt ?? 0.00}}</td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>Number of products available in FPS</td>
                                        <td class="text-center">{{$swp->products_available_in_fps ?? 0}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
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

</body>
</html>