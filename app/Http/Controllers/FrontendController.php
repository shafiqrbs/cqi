<?php

namespace App\Http\Controllers;

use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
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

        // for bar chat
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $datasets = [
            [
                'label' => 'Category 1',
                'data' => [65, 75, 70, 68, 72, 70],
                'backgroundColor' => '#60a5fa',
                'borderRadius' => 4,
                'barThickness' => 30
            ],
            [
                'label' => 'Category 2',
                'data' => [45, 55, 60, 58, 62, 65],
                'backgroundColor' => '#34d399',
                'borderRadius' => 4,
                'barThickness' => 30
            ]
        ];

        // for pie chart
        $pieLabels = ['Category 1', 'Category 2', 'Category 3', 'Category 4'];
        $pieData = [50, 25, 15, 10];
        $pieColors = ['#60a5fa', '#34d399', '#f472b6', '#fbbf24'];

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



}
