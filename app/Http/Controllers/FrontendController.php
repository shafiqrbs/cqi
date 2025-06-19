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
        return view("frontend.layouts.welcome",compact('TabHeader'));
    }

    public function swapnoDashboard(){
        ConfigurationHelper::Language();
        $TabHeader = 'Swapno Dashboard';
        $totalNumbers = TotalNumber::first();
        $Organization = Organization::where('status','1')->get();

        $swapnoNumbers = SwapnoNumber::get();
        return view("frontend.layouts.swapno-dashboard",compact('TabHeader','totalNumbers','swapnoNumbers','Organization'));
    }



}
