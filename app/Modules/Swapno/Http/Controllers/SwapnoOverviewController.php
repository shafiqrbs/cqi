<?php

namespace App\Modules\Swapno\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Swapno\Models\Kpi;
use App\Modules\Swapno\Models\KpiValue;
use App\Modules\Swapno\Models\Particulars;
use App\Modules\Swapno\Models\PhotoGalleryImage;
use App\Modules\Swapno\Models\SwapnoNumber;
use App\Modules\Swapno\Models\TotalNumber;
use Auth;
use DB;
use File;
use Illuminate\Http\Request;
use Image;
use Session;
use Storage;


class SwapnoOverviewController extends Controller
{
    public function __construct()
    {
        $Language = ConfigurationHelper::Language();
    }

    public function index()
    {
        ConfigurationHelper::Language();
        $ModuleTitle = "Manage Swapno KPI";
        $PageTitle = "KPI Information List";
        $TableTitle = "KPI Information List";

        Kpi::where('is_active',0)->delete();

        $kpis = Kpi::orderby('id','desc')
            ->where('is_active',1)
            ->join('sur_organization','sur_organization.id','=','swapno__kpi.organization_id')
            ->select('swapno__kpi.*','sur_organization.name as organization_name')
            ->paginate(10);

        return view("Swapno::overview.index", compact('ModuleTitle','PageTitle','TableTitle','kpis'));
    }

    public function create(){
        //for initial data insert
        $organizations = Organization::where('status', '1')
            ->pluck('name', 'id')
            ->sortKeys()
            ->all();

        $defaultOrgId = array_key_first($organizations);
        $currentYear = date('Y');
//        $defaultMonth = date('F', strtotime('-1 month'));
        $defaultMonth = date('F');
        $kpi = Kpi::create([
            'organization_id' => $defaultOrgId,
            'month' => $defaultMonth,
            'year' => $currentYear,
            'is_active' => false
        ]);
        return redirect()->route('admin.kpi.edit', $kpi->id);
    }

    /**
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $input = $request->only('id','kpi_value','particular_id');
        $kpi = Kpi::find($input['id']);
        if (!$kpi) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Sorry, KPI with id ' . $input['id'] . ' cannot be found'
            ]);
        }

        $kpiValueExists = KpiValue::where('kpi_id', $kpi->id)->where('particular_id', $input['particular_id'])->first();
        if ($kpiValueExists) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Already Exists'
            ]);
        }

        $kpiValue = new KpiValue();
        $kpiValue->kpi_id = $input['id'];
        $kpiValue->particular_id = $input['particular_id'];
        $kpiValue->kpi_value = $input['kpi_value'];
        $kpi->kpiValues()->save($kpiValue);

        // Return updated view HTML
        $returnHtml = view('Swapno::overview/kpi_values_table', [
            'kpi' => $kpi
        ])->render();

        return response()->json([
            'success' => true,
            'status' => 200,
            'html' => $returnHtml
        ]);
    }

    public function kpiValuesDelete($id)
    {
        $kpiValue = KpiValue::find($id);
        $kpiValue->delete();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message'=>'Record deleted successfully'
        ]);
    }


    public function edit($id){
        $ModuleTitle = 'Manage KPI';
        $PageTitle = 'Manage KPI information';

        $data = Kpi::where('id',$id)->first();

        $organization = Organization::where('status','1')->pluck('name','id')->all();

        $months = [
            'January'=>'January', 'February'=>'February', 'March'=>'March', 'April'=>'April', 'May'=>'May', 'June'=>'June',
            'July'=>'July', 'August'=>'August', 'September'=>'September', 'October'=>'October', 'November'=>'November', 'December'=>'December'
        ];

        $years = ['2025'=>'2025', '2026'=>'2026', '2027'=>'2027', '2028'=>'2028', '2029'=>'2029', '2030'=>'2030'];


        $parametters = Particulars::join('swapno__particular_types','swapno__particular_types.id','=','swapno__particulars.particular_id')
            ->where('swapno__particular_types.slug','kpi')
            ->where('swapno__particular_types.is_active','1')
            ->where('swapno__particulars.is_active','1')
            ->pluck('swapno__particulars.name','swapno__particulars.id')
            ->all();

        $kpi = Kpi::find($id);

        return view("Swapno::overview.edit", compact('data','ModuleTitle','PageTitle','organization','months','years','parametters','kpi'));
    }


    public function update(Request $request,$id){
        $input = $request->only(['organization_id','month','year']);

        $kpiExists = Kpi::where('id','<>', $id)->where('organization_id', $input['organization_id'])->where('month',$input['month'])->where('year',$input['year'])->first();

        if ($kpiExists) {
            Session::flash('validate', 'This organization & month, year already exists.');
            return redirect()->back()->withInput();
        }
        $input['is_active'] = true;
        $kpi = Kpi::find($id);
        $kpi->update($input);

        Session::flash('message', 'Successfully updated kpi information.');
        return redirect()->route('admin.kpi.index');
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            Kpi::find($id)->update(['is_active'=>0]);

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
