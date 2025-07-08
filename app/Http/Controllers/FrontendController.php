<?php

namespace App\Http\Controllers;

use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Swapno\Models\Sales;
use App\Modules\Swapno\Models\SwapnoNumber;
use App\Modules\Swapno\Models\TotalNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Session;
use DB;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function HomePage(){
        ConfigurationHelper::Language();
        $TabHeader = 'Home';
        $currentMonth = date('F');
        $currentYear = date('Y');
        $monthlySalesData = Sales::where('swapno_sales.month', $currentMonth)->where('swapno_sales.year', $currentYear)
            ->join('sur_organization','sur_organization.id','=','swapno_sales.organization_id')
            ->select('swapno_sales.*','sur_organization.name as org_name','sur_organization.short_name')
            ->get()->toArray();

        // for bar chat
        $labels = [date('F', strtotime('-1 month'))];
        $colors = ['#60a5fa', '#34d399', '#fbbf24', '#a78bfa', '#f87171']; // Add more if needed
        $datasets = [];

        $monthlyOverview = SwapnoNumber::join('sur_organization','sur_organization.id','=','swapno_total.organization_id')
            ->select('swapno_total.total_sales_in_bdt','sur_organization.name as org_name','sur_organization.short_name')
            ->get()->toArray();
//        dump($monthlyOverview);

        foreach ($monthlyOverview as $index => $item) {
            $datasets[] = [
                'label' => $item['short_name'] ?? $item['org_name'],
                'data' => [(float) $item['total_sales_in_bdt']],
                'backgroundColor' => $colors[$index % count($colors)],
                'borderRadius' => 4,
                'barThickness' => 30
            ];
        }

    /*    // for pie chart
        $pieLabels = ['Category 1', 'Category 2', 'Category 3', 'Category 4'];
        $pieData = [50, 25, 15, 10];
        $pieColors = ['#60a5fa', '#34d399', '#f472b6', '#fbbf24'];*/

        $colorPalette = ['#60a5fa', '#34d399', '#f472b6', '#fbbf24', '#a78bfa', '#f87171'];

        $pieLabels = [];
        $pieData = [];
        $pieColors = [];

        foreach ($monthlySalesData as $index => $item) {
            $pieLabels[] = $item['short_name'] ?? $item['org_name'];
            $pieData[] = (float) $item['total_sales_amount'];
            $pieColors[] = $colorPalette[$index % count($colorPalette)];
        }

        return view("frontend.layouts.welcome",compact('TabHeader','labels','datasets','pieLabels','pieData','pieColors'));
    }

    public function swapnoDashboard(){
        ConfigurationHelper::Language();
        $TabHeader = 'Swapno Dashboard';
        $totalNumbers = TotalNumber::first();
        $Organization = Organization::join('swapno_total','swapno_total.organization_id','=','sur_organization.id')->where('status','1')->select('sur_organization.*')->get();

        $swapnoNumbers = SwapnoNumber::get();
        return view("frontend.layouts.swapno-dashboard",compact('TabHeader','totalNumbers','swapnoNumbers','Organization'));
    }

    public function swapnoSummary(){
        ConfigurationHelper::Language();
        $TabHeader = 'Swapno Summary';
        return view("frontend.layouts.swapno-summary",compact('TabHeader'));
    }

    public function swapnoGallery(){
        ConfigurationHelper::Language();
        $TabHeader = 'Swapno Gallery';
        return view("frontend.layouts.swapno-gallery",compact('TabHeader'));
    }



}
