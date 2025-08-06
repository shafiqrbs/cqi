<?php

namespace App\Http\Controllers;

use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Swapno\Models\Event;
use App\Modules\Swapno\Models\Kpi;
use App\Modules\Swapno\Models\KpiValue;
use App\Modules\Swapno\Models\Milestone;
use App\Modules\Swapno\Models\Particulars;
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

        $defaultMonth = date('F', strtotime('first day of last month'));
        $defaultYear = date('Y');

        // for bar chat
        $labels = [$defaultMonth];
        $colors = ['#60a5fa', '#34d399', '#fbbf24', '#a78bfa', '#f87171']; // Add more if needed
        $datasets = [];

        $kpiValues = KpiValue::where('swapno__kpi.is_active',1)
            ->where('swapno__kpi.month',$defaultMonth)
            ->where('swapno__kpi.year',$defaultYear)
            ->where('swapno__particulars.slug','total-sales-in-bdt')
            ->join('swapno__kpi','swapno__kpi.id','=','swapno__kpi_value.kpi_id')
            ->join('swapno__particulars','swapno__particulars.id','=','swapno__kpi_value.particular_id')
            ->join('sur_organization','sur_organization.id','=','swapno__kpi.organization_id')
            ->select([
                'swapno__kpi_value.kpi_value',
                'sur_organization.name as org_name',
                'sur_organization.short_name',
            ])
            ->get()->toArray();

        foreach ($kpiValues as $index => $item) {
            $datasets[] = [
                'label' => $item['short_name'] ?? $item['org_name'],
                'data' => [(float) $item['kpi_value']],
                'backgroundColor' => $colors[$index % count($colors)],
                'borderRadius' => 4,
                'barThickness' => 30
            ];
        }

        $organizations = Organization::where('status', '1')
            ->pluck('name', 'id')
            ->sortKeys()
            ->all();

        $defaultOrgId = array_key_first($organizations);

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
        $years = [
            '2025' => '2025',
            '2026' => '2026',
            '2027' => '2027',
            '2028' => '2028',
            '2029' => '2029',
            '2030' => '2030',
        ];

        $defaultMilestone = Particulars::join('swapno__particular_types','swapno__particular_types.id','=','swapno__particulars.particular_id')
                                ->where('swapno__particulars.is_featured', 1)
                                ->where('swapno__particulars.is_active', 1)
                                ->where('swapno__particular_types.slug','milestones')
                                ->value('swapno__particulars.id');

        $milestones = Milestone::where('is_active', 1)
            ->where('particular_id', $defaultMilestone)
            ->where('year', $defaultYear)
            ->orderBy('id', 'DESC')
            ->select(['name'])
            ->limit(4)
            ->get();

        $milestoneTypes = Particulars::join('swapno__particular_types','swapno__particular_types.id','=','swapno__particulars.particular_id')
            ->where('swapno__particular_types.slug','milestones')
            ->where('swapno__particular_types.is_active','1')
            ->where('swapno__particulars.is_active','1')
            ->pluck('swapno__particulars.name','swapno__particulars.id')
            ->all();

        $events = Event::where('is_active', 1)->orderBy('id', 'DESC')->limit(6)->get();


        return view("frontend.layouts.welcome",compact('TabHeader','labels','datasets','organizations','months','defaultMonth','defaultOrgId','years','defaultYear','milestones','milestoneTypes','defaultMilestone','events'));
    }

    public function getMilestones(Request $request)
    {
        $milestoneTypeId = $request->input('milestone_type_id');

        $milestones = Milestone::where('is_active', 1)
            ->where('year', $request->input('year'))
            ->when($milestoneTypeId, function ($query, $milestoneTypeId) {
                return $query->where('particular_id', $milestoneTypeId);
            })
            ->orderBy('id', 'DESC')
            ->select(['name'])
            ->limit(4)
            ->get();

        $colorClasses = ['primary', 'success', 'warning', 'danger', 'info']; // Example colors

        return view('frontend.layouts.milestones-list', compact('milestones', 'colorClasses'))->render();
    }

    public function organizationWiseFps(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $labels = [$month];
        $colors = ['#60a5fa', '#34d399', '#fbbf24', '#a78bfa', '#f87171'];
        $datasets = [];

        $kpiValues = KpiValue::where('swapno__kpi.is_active', 1)
            ->where('swapno__kpi.month', $month)
            ->where('swapno__kpi.year', $year)
            ->where('swapno__particulars.slug', 'total-sales-in-bdt')
            ->join('swapno__kpi', 'swapno__kpi.id', '=', 'swapno__kpi_value.kpi_id')
            ->join('swapno__particulars', 'swapno__particulars.id', '=', 'swapno__kpi_value.particular_id')
            ->join('sur_organization', 'sur_organization.id', '=', 'swapno__kpi.organization_id')
            ->select([
                'swapno__kpi_value.kpi_value',
                'sur_organization.name as org_name',
                'sur_organization.short_name',
            ])
            ->get()
            ->toArray();

        foreach ($kpiValues as $index => $item) {
            $datasets[] = [
                'label' => $item['short_name'] ?? $item['org_name'],
                'data' => [(float) $item['kpi_value']],
                'backgroundColor' => $colors[$index % count($colors)],
                'borderRadius' => 4,
                'barThickness' => 30
            ];
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets
        ]);
    }

    public function productWiseSales(Request $request)
    {
        $request->validate([
            'organization_id' => ['required'],
            'month' => ['required'],
            'year' => ['required'],
        ]);
        $month = $request->month;
        $organization_id = $request->organization_id;
        $year = $request->year;

        $monthlySalesData = Sales::where('swapno_sales.month', $month)
            ->where('swapno_sales.year', $year)
            ->where('swapno_sales.organization_id', $organization_id)
            ->where('swapno_sales.is_active', 1)
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

    public function swapnoDashboard(Request $request){
        $input = $request->only('month','year');

        ConfigurationHelper::Language();
        $TabHeader = 'Swapno Dashboard';
        $totalNumbers = TotalNumber::first();
        $Organization = Organization::join('swapno_total','swapno_total.organization_id','=','sur_organization.id')->where('status','1')->select('sur_organization.*')->get();

        $defaultMonth = $input['month'] ?? date('F', strtotime('first day of last month'));
        $defaultYear = $input['year'] ?? date('Y');

        $kpiValues = KpiValue::where('swapno__kpi.is_active',1)
            ->where('swapno__kpi.month',$defaultMonth)
            ->where('swapno__kpi.year',$defaultYear)
            ->where('swapno__particulars.group','!=','0')
            ->join('swapno__kpi','swapno__kpi.id','=','swapno__kpi_value.kpi_id')
            ->join('swapno__particulars','swapno__particulars.id','=','swapno__kpi_value.particular_id')
            ->join('sur_organization','sur_organization.id','=','swapno__kpi.organization_id')
            ->select([
                'swapno__kpi.id as kpi_id',
                'swapno__kpi.month',
                'swapno__kpi.year',
                'swapno__kpi_value.id',
                'swapno__kpi_value.kpi_value',
                'sur_organization.name as organization_name',
                'swapno__particulars.name as kpi_name',
                'swapno__particulars.slug as kpi_slug',
                'swapno__particulars.group as kpi_group',
            ])
            ->get()->toArray();

        $groupedKpis = collect($kpiValues)->groupBy([
            'organization_name',
            function ($item) {
                return $item['kpi_group'];
            },
        ]);

        $organizations = Organization::where('status', '1')
            ->pluck('name', 'id')
            ->sortKeys()
            ->all();
        $defaultOrgId = array_key_first($organizations);

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

        $years = [
            '2025' => '2025',
            '2026' => '2026',
            '2027' => '2027',
            '2028' => '2028',
            '2029' => '2029',
            '2030' => '2030',
        ];

        $particulars = Particulars::query()
                        ->where('swapno__particulars.is_featured', 1)
                        ->where('swapno__particulars.is_active', 1)
                        ->where('swapno__kpi.is_active', 1)
//                        ->where('swapno__kpi.month', $defaultMonth)
//                        ->where('swapno__kpi.year', $defaultYear)
                        ->leftJoin('swapno__kpi_value', 'swapno__kpi_value.particular_id', '=', 'swapno__particulars.id')
                        ->leftJoin('swapno__kpi','swapno__kpi.id','=','swapno__kpi_value.kpi_id')
                        ->select([
                            DB::raw('SUM(swapno__kpi_value.kpi_value) as total'),
                            'swapno__particulars.name',
                            'swapno__particulars.group',
                        ])
                        ->groupBy('swapno__particulars.id', 'swapno__particulars.name')
                        ->get()
                        ->toArray();

        return view("frontend.layouts.swapno-dashboard",compact('TabHeader','totalNumbers','groupedKpis','Organization','organizations','defaultOrgId','months','defaultMonth','particulars','defaultYear','years'));
    }

    public function swapnoSummary(){
        ConfigurationHelper::Language();
        $TabHeader = 'Swapno Summary';
        return view("frontend.layouts.swapno-summary",compact('TabHeader'));
    }

    public function swapnoGallery($type){
        ConfigurationHelper::Language();
        $TabHeader = 'Swapno Gallery';
        $galleries = PhotoGallery::orderby('id','desc')->where('is_active',1)->where('file_type',$type)->get();
        return view("frontend.layouts.swapno-gallery",compact('TabHeader','galleries','type'));
    }

    public function swapnoGalleryDetails($id){
        ConfigurationHelper::Language();
        $TabHeader = 'Swapno Gallery Details';
        $galleries = PhotoGallery::find($id);
        $type = $galleries->file_type;
        return view("frontend.layouts.swapno-gallery-details",compact('TabHeader','galleries','type'));
    }



}
