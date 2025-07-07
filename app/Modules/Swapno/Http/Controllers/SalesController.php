<?php

namespace App\Modules\Swapno\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Swapno\Models\Category;
use App\Modules\Swapno\Models\Sales;
use App\Modules\Swapno\Models\SwapnoNumber;
use App\Modules\Swapno\Requests\SalesRequest;
use Auth;
use DB;
use File;
use Illuminate\Http\Request;
use Session;
use Storage;

class SalesController extends Controller
{
    public function __construct()
    {
        $Language = ConfigurationHelper::Language();
    }

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index($activeTab)
    {
        ConfigurationHelper::Language();
        $ModuleTitle = 'Manage Swapno Sales';
        $PageTitle = 'Swapno Sales List';
        $TableTitle = 'Swapno Sales List';;

        $sales = Sales::orderby('id','desc');
        if ($activeTab==='all') {
            $sales = $sales->join('sur_organization', 'sur_organization.id', '=', 'swapno_sales.organization_id')
                ->leftjoin('swapno_category', 'swapno_category.id', '=', 'swapno_sales.category_id')
                ->select('swapno_sales.*', 'sur_organization.name as organization_name', 'swapno_category.name as category_name');
        }
        if ($activeTab==='category') {
            $sales = $sales->join('sur_organization', 'sur_organization.id', '=', 'swapno_sales.organization_id')
                ->join('swapno_category', 'swapno_category.id', '=', 'swapno_sales.category_id')
                ->select('swapno_sales.*', 'sur_organization.name as organization_name', 'swapno_category.name as category_name');
        }
        if ($activeTab==='organization'){
            $sales = $sales->join('sur_organization', 'sur_organization.id', '=', 'swapno_sales.organization_id')
                ->select('swapno_sales.*', 'sur_organization.name as organization_name')
                ->whereNull('swapno_sales.category_id') ;
        }
        $sales=$sales->paginate(10);

        return view("Swapno::sales.index", compact('ModuleTitle','PageTitle','TableTitle','sales','activeTab'));
    }

    public function create(){
        $ModuleTitle = 'Manage Swapno Sales';
        $PageTitle = 'New Swapno Sales';
        $TableTitle = __('Swapno::ControllerMsg.TableTitle');
        $organization = Organization::where('status','1')->pluck('name','id')->all();
        $months = [
            'January'=>'January', 'February'=>'February', 'March'=>'March', 'April'=>'April', 'May'=>'May', 'June'=>'June',
            'July'=>'July', 'August'=>'August', 'September'=>'September', 'October'=>'October', 'November'=>'November', 'December'=>'December'
        ];

        $years = ['2025'=>'2025', '2026'=>'2026', '2027'=>'2027', '2028'=>'2028', '2029'=>'2029', '2030'=>'2030'];

        $currentMonth = date('F');
        $currentYear  = date('Y');
        $category = Category::categoryDropdown();

        return view("Swapno::sales.create", compact('ModuleTitle','PageTitle','TableTitle','organization','category','months','years','currentMonth','currentYear'));
    }

    /**
     * @throws \Throwable
     */
    public function store(SalesRequest $request)
    {
        $input = $request->validated();

        $exists = Sales::where('organization_id', $input['organization_id'])
            ->when(!empty($input['category_id']), function ($query) use ($input) {
                $query->where('category_id', $input['category_id']);
            })
            ->where('month', $input['month'])
            ->where('year', $input['year'])
            ->exists();

        if ($exists) {
            Session::flash('validate', 'Sales already exists.');
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
            if (empty($input['total_sales_quantity'])){
                $input['total_sales_quantity'] = 0;
            }
            $input['category_id'] = !empty($input['category_id']) ? $input['category_id'] : null;
            $input['report_date'] = now();
            Sales::create($input);
            DB::commit();
            Session::flash('message','Sales added Successfully!');
            return redirect()->route('admin.sales.index','all');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        $ModuleTitle = __('Survey::ControllerMsg.ModuleTitle');
        $PageTitle = __('Survey::ControllerMsg.PageTitleUpdate');

        $data = Sales::where('id',$id)->first();

        $organization = Organization::where('status','1')->pluck('name','id')->all();

        $months = [
            'January'=>'January', 'February'=>'February', 'March'=>'March', 'April'=>'April', 'May'=>'May', 'June'=>'June',
            'July'=>'July', 'August'=>'August', 'September'=>'September', 'October'=>'October', 'November'=>'November', 'December'=>'December'
        ];

        $years = ['2025'=>'2025', '2026'=>'2026', '2027'=>'2027', '2028'=>'2028', '2029'=>'2029', '2030'=>'2030'];
        $category = Category::categoryDropdown();

        return view("Swapno::sales.edit", compact('data','ModuleTitle','PageTitle','organization','category','months','years'));
    }


    public function update(SalesRequest $request,$id){
        $input = $request->validated();

        $exists = Sales::where('organization_id', $input['organization_id'])
            ->when(!empty($input['category_id']), function ($query) use ($input) {
                $query->where('category_id', $input['category_id']);
            })
            ->where('month', $input['month'])
            ->where('year', $input['year'])
            ->first();

        if ($exists && $exists->id != $id) {
            Session::flash('validate', 'Sales already exists.');
            return redirect()->back()->withInput();
        }

        $updateModel = Sales::where('id',$id)->first();

        DB::beginTransaction();
        try {
            if (empty($input['total_sales_quantity'])){
                $input['total_sales_quantity'] = 0;
            }
            $input['category_id'] = !empty($input['category_id']) ? $input['category_id'] : null;

            $updateModel->update($input);
            $updateModel->save();

            DB::commit();

            Session::flash('message', __('Survey::FormValidation.UpdateData'));
            return redirect()->route('admin.sales.index','all');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            Sales::where('id', $id)->delete();

            Session::flash('delete', __('Survey::FormValidation.DeleteMsg'));
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }
}
