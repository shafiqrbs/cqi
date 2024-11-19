<?php

namespace App\Modules\Organization\Http\Controllers;
use App\Modules\Configuration\ConfigurationHelper;
use App\Http\Controllers\Controller;
use App\Modules\Organization\Models\Canteen;
use App\Modules\Organization\Models\Device;
use Illuminate\Http\Request;

use App\Modules\Organization\Models\Organization;
use App\Modules\Organization\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Session;


use Image;
use File;
use Storage;
use App;
Use Auth;

class DeviceController extends Controller
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
        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleAddDevice');
        $TableTitle = __('Organization::ControllerMsg.TableTitleDevice');

        $devices = Device::orderby('id','desc')->paginate(10);

        return view("Organization::device.index", compact('ModuleTitle','PageTitle','TableTitle','devices'));
    }

    public function create(){

        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Organization::ControllerMsg.TableTitle');
        $canteens = Canteen::where('status','1')->pluck('name','id')->all();
        return view("Organization::device.create", compact('ModuleTitle','PageTitle','TableTitle','canteens'));
    }

    public function store(Requests\Device $request)
    {
        $input = $request->validated();
        DB::beginTransaction();
        try {
            if ($deviceData = Device::create($input)) {
                $deviceData->save();
            }

            DB::commit();
            Session::flash('message',__('Organization::FormValidation.DataAdd'));
            return redirect()->route('admin.device.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleUpdate');

        $data = Device::where('status','1')->where('id',$id)->first();
        $canteens = Canteen::where('status','1')->pluck('name','id')->all();

        return view("Organization::device.edit", compact('data','ModuleTitle','PageTitle','canteens'));
    }


    public function update(Requests\Device $request,$id){
        $input = $request->validated();

        $UpdateModel = Device::where('id',$id)->first();

        DB::beginTransaction();
        try {
            $UpdateModel->update($input);
            $UpdateModel->save();

            DB::commit();

            Session::flash('message', __('Organization::FormValidation.UpdateData'));
            return redirect()->route('admin.device.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function inactive($id){
        DB::beginTransaction();
        try {
            $data = Organization::where('id',$id);
            $data->update([
                'status' => 0,
                'updated_by' => Auth::user()->id,
            ]);
            DB::commit();
            Session::flash('message', __('Organization::FormValidation.RemoveList'));
            return redirect()->back();
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $organizationExists = DB::table('sur_survey_organization')->where('organization_id',$id)->count();
//            dd($organizationExists);
            if ($organizationExists == 0){
                $DeleteModel = Organization::where('id', $id)
                    ->select('*')
                    ->first();

                $DeleteModel->delete();
                Session::flash('delete', __('Organization::FormValidation.DeleteMsg'));
                DB::commit();
                return redirect()->back();
            }else{
//                Session::flash('delete', __('Organization::FormValidation.DeleteMsg'));
                Session::flash('delete', 'Already use this organization');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public  function getorganizationdata(){
        $appUrl=env('APP_URL');
        $response = Http::withHeaders([
            'x-api-key' => 'survey',
            'x-api-value' => 'survey@123',
            'x-api-secret' => 'survey'
        ])->get($appUrl.'api/organization/getorganizationdata');
        $body = $response->getBody()->getContents();
        $allOrganization = json_decode($body);
        return $allOrganization;
    }
}
