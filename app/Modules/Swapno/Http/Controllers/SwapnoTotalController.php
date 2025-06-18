<?php

namespace App\Modules\Swapno\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Swapno\Models\TotalNumber;
use Auth;
use DB;
use File;
use Illuminate\Http\Request;
use Image;
use Session;
use Storage;


class SwapnoTotalController extends Controller
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
    public function index()
    {
        ConfigurationHelper::Language();
        $ModuleTitle = 'Swapno Total Numbers';
        $PageTitle = __('Swapno::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Swapno::ControllerMsg.TableTitle');

        $totalNumbers = TotalNumber::orderby('id','desc')->paginate(10);
        if (count($totalNumbers)==0){
            TotalNumber::create([
                'factory_onboarded' => 0,
                'fps_inaugurated' => 0,
                'nic_formed' => 0,
                'nic_meeting_conducted' => 0,
                'stakeholder_conducted' => 0,
                'participants_attend' => 0
            ]);
        }

        return view("Swapno::swapno-total.index", compact('ModuleTitle','PageTitle','TableTitle','totalNumbers'));
    }

    public function create(){
        $ModuleTitle = 'Swapno Total Numbers';
        $PageTitle = __('Swapno::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Swapno::ControllerMsg.TableTitle');
        $Organization = Organization::where('status','1')->pluck('name','id')->all();

        return view("Swapno::swapno-total.create", compact('ModuleTitle','PageTitle','TableTitle','Organization'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            TotalNumber::create($input);
            DB::commit();
            Session::flash('message',__('Organization::FormValidation.DataAdd'));
            return redirect()->route('admin.swapno.total.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        $ModuleTitle = 'Swapno Total Numbers';
        $PageTitle = 'Total numbers update';

        $data = TotalNumber::where('id',$id)->first();

        return view("Swapno::swapno-total.edit", compact('data','ModuleTitle','PageTitle'));
    }


    public function update(Request $request,$id){
        $input = $request->all();
        $UpdateModel = TotalNumber::where('id',$id)->first();

        DB::beginTransaction();
        try {
            $UpdateModel->update($input);
            $UpdateModel->save();

            DB::commit();

            Session::flash('message', __('Survey::FormValidation.UpdateData'));
            return redirect()->route('admin.swapno.total.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }
}
