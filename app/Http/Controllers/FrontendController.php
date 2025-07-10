<?php

namespace App\Http\Controllers;

use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Swapno\Models\PhotoGallery;
use App\Modules\Swapno\Models\Sales;
use App\Modules\Swapno\Models\SwapnoNumber;
use App\Modules\Swapno\Models\TotalNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Session;
use DB;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    public function HomePage(Request $request){
        ConfigurationHelper::Language();
        $TabHeader = 'Home';
        $currentMonth = date('F');
        $currentYear = date('Y');

        // for bar chat
        $labels = [date('F', strtotime('-1 month'))];
        $colors = ['#60a5fa', '#34d399', '#fbbf24', '#a78bfa', '#f87171']; // Add more if needed
        $datasets = [];

        $monthlyOverview = SwapnoNumber::join('sur_organization','sur_organization.id','=','swapno_total.organization_id')
            ->select('swapno_total.total_sales_in_bdt','sur_organization.name as org_name','sur_organization.short_name')
            ->get()->toArray();

        foreach ($monthlyOverview as $index => $item) {
            $datasets[] = [
                'label' => $item['short_name'] ?? $item['org_name'],
                'data' => [(float) $item['total_sales_in_bdt']],
                'backgroundColor' => $colors[$index % count($colors)],
                'borderRadius' => 4,
                'barThickness' => 30
            ];
        }


        /*$organizations = Organization::where('status','1')->pluck('name','id')->all();
        ksort($organizations);
        $months = [
            '' => 'Choose Month',
            'January'=>'January', 'February'=>'February', 'March'=>'March', 'April'=>'April', 'May'=>'May', 'June'=>'June',
            'July'=>'July', 'August'=>'August', 'September'=>'September', 'October'=>'October', 'November'=>'November', 'December'=>'December'
        ];

        // Pick first organization and latest month
        $defaultOrgId = $organizations->keys()->first();
        $defaultMonth = $months->keys()->first();
        dump($defaultMonth,$defaultOrgId);*/

        $organizations = Organization::where('status', '1')
            ->pluck('name', 'id')
            ->sortKeys() // this replaces ksort
            ->all();     // this turns it into an array

        $defaultOrgId = array_key_first($organizations);   // ✅ Safe to use on array

        $months = [
            '' => 'Choose Month',
            'January' => 'January',
            'February' => 'February',
            'March' => 'March',
            'April' => 'April',
            'May' => 'May',
            'June' => 'June',
            'July' => 'July',
            'August' => 'August',
            'September' => 'September',
            'October' => 'October',
            'November' => 'November',
            'December' => 'December',
        ];

        $monthKeys = array_keys($months);
        $defaultMonth = $monthKeys[1]; // ❗ Skips '' => 'Choose Month' entry

//        dump($defaultMonth, $defaultOrgId);

        return view("frontend.layouts.welcome",compact('TabHeader','labels','datasets','organizations','months','defaultMonth','defaultOrgId'));
    }

    public function productWiseSales(Request $request)
    {
        $request->validate([
            'organization_id' => ['required'],
            'month' => ['required'],
        ]);
        $month = $request->month;
        $organization_id = $request->organization_id;

        $monthlySalesData = Sales::where('swapno_sales.month', $month)
            ->where('swapno_sales.year', date('Y'))
            ->where('swapno_sales.organization_id', $organization_id)
            ->leftJoin('swapno_category', 'swapno_category.id', '=', 'swapno_sales.category_id')
            ->join('sur_organization', 'sur_organization.id', '=', 'swapno_sales.organization_id')
            ->select([
                DB::raw("CONCAT(swapno_category.name, ': ', swapno_sales.total_sales_amount, ' Tk') as label"),
                'swapno_sales.total_sales_amount as value',
            ])
            ->get()
            ->toArray();

        return response()->json($monthlySalesData);
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
        $galleries = PhotoGallery::orderby('id','desc')->where('is_active',1)->get();
        return view("frontend.layouts.swapno-gallery",compact('TabHeader','galleries'));
    }

    public function swapnoGalleryDetails($id){
        ConfigurationHelper::Language();
        $TabHeader = 'Swapno Gallery Details';
        $galleries = PhotoGallery::find($id);
        return view("frontend.layouts.swapno-gallery-details",compact('TabHeader','galleries'));
    }



}
