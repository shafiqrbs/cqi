<?php

namespace App\Modules\Organization\Http\Controllers;
use App\Modules\Configuration\ConfigurationHelper;
use App\Http\Controllers\Controller;
use App\Modules\Organization\Requests\Canteen;
use Illuminate\Http\Request;

use App\Modules\Organization\Models\Organization;
use App\Modules\Organization\Models\Canteen as OrganizationCanteen;
use App\Modules\Organization\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Session;

use App;

class CanteenController extends Controller
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
        $PageTitle = __('Organization::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Organization::ControllerMsg.TableTitle');

        $canteens = OrganizationCanteen::orderby('id','desc')->paginate(10);

        return view("Organization::canteen.index", compact('ModuleTitle','PageTitle','TableTitle','canteens'));
    }

    public function create(){
        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Organization::ControllerMsg.TableTitle');
        $Organization = Organization::where('status','1')->pluck('name','id')->all();
        return view("Organization::canteen.create", compact('ModuleTitle','PageTitle','TableTitle','Organization'));
    }

    public function store(Canteen $request)
    {
        $input = $request->validated();

        DB::beginTransaction();
        try {
            if ($canteenData = OrganizationCanteen::create($input)) {
                $canteenData->save();
            }

            DB::commit();
            Session::flash('message',__('Organization::FormValidation.DataAdd'));
            return redirect()->route('admin.canteen.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleUpdateCanteen');
        $Organization = Organization::where('status','1')->pluck('name','id')->all();

        $data = OrganizationCanteen::where('status','1')->where('id',$id)->first();

        return view("Organization::canteen.edit", compact('data','ModuleTitle','PageTitle','Organization'));
    }


    public function update(Canteen $request,$id){
        $input = $request->validated();

        $UpdateModel = OrganizationCanteen::where('id',$id)->first();

        DB::beginTransaction();
        try {
            $UpdateModel->update($input);
            $UpdateModel->save();

            DB::commit();

            Session::flash('message', __('Organization::FormValidation.UpdateData'));
            return redirect()->route('admin.canteen.index');
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
            $data = OrganizationCanteen::where('id',$id);
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
            $canteenExists = DB::table('sur_device')->where('canteen_id',$id)->count();
//            dd($organizationExists);
            if ($canteenExists == 0){
                $DeleteModel = App\Modules\Organization\Models\Canteen::where('id', $id)
                    ->select('*')
                    ->first();

                $DeleteModel->delete();
                Session::flash('delete', __('Organization::FormValidation.DeleteMsg'));
                DB::commit();
                return redirect()->back();
            }else{
//                Session::flash('delete', __('Organization::FormValidation.DeleteMsg'));
                Session::flash('delete', 'Already use this canteen');
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
