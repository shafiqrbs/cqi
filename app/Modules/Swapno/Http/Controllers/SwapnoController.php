<?php

namespace App\Modules\Swapno\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;

use App\Modules\Swapno\Models\SwapnoNumber;
use DB;
use Illuminate\Http\Request;
use Session;
use File;
use Storage;
use App;
Use Auth;

class SwapnoController extends Controller
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
        $ModuleTitle = __('Swapno::ControllerMsg.ModuleTitle');
        $PageTitle = __('Swapno::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Swapno::ControllerMsg.TableTitle');

        $swapnoNumbers = SwapnoNumber::orderby('id','desc')
            ->join('sur_organization','sur_organization.id','=','swapno_total.organization_id')
            ->select('swapno_total.*','sur_organization.name as organization_name')
            ->paginate(10);
        return view("Swapno::swapno.index", compact('ModuleTitle','PageTitle','TableTitle','swapnoNumbers'));
    }

    public function create(){
        $ModuleTitle = __('Swapno::ControllerMsg.ModuleTitle');
        $PageTitle = __('Swapno::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Swapno::ControllerMsg.TableTitle');
        $Organization = Organization::where('status','1')->pluck('name','id')->all();

        return view("Swapno::swapno.create", compact('ModuleTitle','PageTitle','TableTitle','Organization'));
    }

    /**
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $exists = SwapnoNumber::where('organization_id',$input['organization_id'])->exists();
        if ($exists) {
            Session::flash('validate', 'This organization already exists.');
            return redirect()->back()->withInput();
        }

        $fieldsToDefault = [
            'nic_training_completed',
            'nic_member_received_training',
            'peer_educator_selected',
            'female_peer_educator',
            'male_peer_educator',
            'peer_educator_received_training',
            'female_participant',
            'male_participant',
            'peer_educator_tot_completed',
            'training_conducted_for_fps_staff',
            'fps_staff_received_training',
            'sbcc_materials_developed',
            'sbcc_items_distributed',
            'campaign_organized',
            'workers_purchased_during_campaign',
            'female_worker',
            'male_worker',
            'workers_purchased_from_fps',
            'products_available_in_fps',
        ];

        foreach ($fieldsToDefault as $field) {
            $data[$field] = $request->input($field, 0) ?? 0;
        }

        // Handle decimal values safely too
        $data['bdt_during_campaign'] = $request->input('bdt_during_campaign', 0.00) ?? 0.00;
        $data['amount_sales_through_credit'] = $request->input('amount_sales_through_credit', 0.00) ?? 0.00;
        $data['workers_purchased_through_credit'] = $request->input('workers_purchased_through_credit', 0.00) ?? 0.00;
        $data['amount_sales_through_cash'] = $request->input('amount_sales_through_cash', 0.00) ?? 0.00;
        $data['total_sales_in_bdt'] = $request->input('total_sales_in_bdt', 0.00) ?? 0.00;
        $data['organization_id'] = $request->input('organization_id');


        DB::beginTransaction();
        try {
            SwapnoNumber::create($data);
            DB::commit();
            Session::flash('message',__('Organization::FormValidation.DataAdd'));
            return redirect()->route('admin.swapno.index');
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

        $data = SwapnoNumber::where('id',$id)->first();
        $Organization = Organization::where('status','1')->pluck('name','id')->all();

        return view("Swapno::swapno.edit", compact('data','ModuleTitle','PageTitle','Organization'));
    }


    public function update(Request $request,$id){
        $input = $request->all();
        $UpdateModel = SwapnoNumber::where('id',$id)->first();

        $exists = SwapnoNumber::where('organization_id',$input['organization_id'])->first();
        if ($exists && $exists->id != $id) {
            Session::flash('validate', 'This organization already exists.');
            return redirect()->back()->withInput();
        }

        $fieldsToDefault = [
            'nic_training_completed',
            'nic_member_received_training',
            'peer_educator_selected',
            'female_peer_educator',
            'male_peer_educator',
            'peer_educator_received_training',
            'female_participant',
            'male_participant',
            'peer_educator_tot_completed',
            'training_conducted_for_fps_staff',
            'fps_staff_received_training',
            'sbcc_materials_developed',
            'sbcc_items_distributed',
            'campaign_organized',
            'workers_purchased_during_campaign',
            'female_worker',
            'male_worker',
            'workers_purchased_from_fps',
            'products_available_in_fps',
        ];

        foreach ($fieldsToDefault as $field) {
            $data[$field] = $request->input($field, 0) ?? 0;
        }

        // Handle decimal values safely too
        $data['bdt_during_campaign'] = $request->input('bdt_during_campaign', 0.00) ?? 0.00;
        $data['amount_sales_through_credit'] = $request->input('amount_sales_through_credit', 0.00) ?? 0.00;
        $data['workers_purchased_through_credit'] = $request->input('workers_purchased_through_credit', 0.00) ?? 0.00;
        $data['amount_sales_through_cash'] = $request->input('amount_sales_through_cash', 0.00) ?? 0.00;
        $data['total_sales_in_bdt'] = $request->input('total_sales_in_bdt', 0.00) ?? 0.00;
        $data['organization_id'] = $request->input('organization_id');

        DB::beginTransaction();
        try {
            $UpdateModel->update($data);
            $UpdateModel->save();

            DB::commit();

            Session::flash('message', __('Survey::FormValidation.UpdateData'));
            return redirect()->route('admin.swapno.index');
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
            $DeleteModel = SwapnoNumber::where('id', $id)->delete();

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
