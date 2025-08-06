<?php

namespace App\Modules\Swapno\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Swapno\Models\Category;
use App\Modules\Swapno\Models\Milestone;
use App\Modules\Swapno\Models\Particulars;
use App\Modules\Swapno\Models\ParticularTypes;
use App\Modules\Swapno\Models\Sales;
use App\Modules\Swapno\Requests\CategoryRequest;
use App\Modules\Swapno\Requests\MilestoneRequest;
use Auth;
use DB;
use File;
use Illuminate\Support\Str;
use Session;
use Storage;

class MilestoneController extends Controller
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
        $ModuleTitle = 'Manage Swapno Milestones';
        $PageTitle = 'Swapno Milestone List';
        $TableTitle = 'Swapno Milestone List';;

        $milestones = Milestone::orderby('id','desc')->paginate(10);

        return view("Swapno::milestone.index", compact('ModuleTitle','PageTitle','TableTitle','milestones'));
    }

    public function create(){
        $ModuleTitle = 'Manage Swapno Milestones';
        $PageTitle = 'New Swapno Milestone';
        $TableTitle = __('Swapno::ControllerMsg.TableTitle');
        $milestoneTypes = Particulars::join('swapno__particular_types','swapno__particular_types.id','=','swapno__particulars.particular_id')
                ->where('swapno__particular_types.slug','milestones')
                ->where('swapno__particular_types.is_active','1')
                ->where('swapno__particulars.is_active','1')
                ->pluck('swapno__particulars.name','swapno__particulars.id')
                ->all();
        $years = ['2025'=>'2025', '2026'=>'2026', '2027'=>'2027', '2028'=>'2028', '2029'=>'2029', '2030'=>'2030'];
        $currentYear  = date('Y');

        return view("Swapno::milestone.create", compact('ModuleTitle','PageTitle','TableTitle','milestoneTypes','years','currentYear'));
    }

    /**
     * @throws \Throwable
     */
    public function store(MilestoneRequest $request)
    {
        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);

        DB::beginTransaction();
        try {
            Milestone::create($input);
            DB::commit();
            Session::flash('message','Milestone added Successfully!');
            return redirect()->route('admin.milestone.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        $ModuleTitle = 'Manage Swapno Milestones';
        $PageTitle = 'Update Swapno Milestone';
        $TableTitle = 'Update Swapno Milestone';

        $milestoneTypes = Particulars::join('swapno__particular_types','swapno__particular_types.id','=','swapno__particulars.particular_id')
            ->where('swapno__particular_types.slug','milestones')
            ->where('swapno__particular_types.is_active','1')
            ->where('swapno__particulars.is_active','1')
            ->pluck('swapno__particulars.name','swapno__particulars.id')
            ->all();

        $data = Milestone::where('id',$id)->first();
        $years = ['2025'=>'2025', '2026'=>'2026', '2027'=>'2027', '2028'=>'2028', '2029'=>'2029', '2030'=>'2030'];
        return view("Swapno::milestone.edit", compact('data','ModuleTitle','PageTitle','milestoneTypes','years'));
    }


    public function update(MilestoneRequest $request,$id){
        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);
        $input['is_active'] = $input['is_active']==1 ? 1 : 0;

        $updateModel = Milestone::find($id);

        DB::beginTransaction();
        try {
            $updateModel->update($input);
            $updateModel->save();

            DB::commit();

            Session::flash('message', __('Survey::FormValidation.UpdateData'));
            return redirect()->route('admin.milestone.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function delete($id){
        Milestone::find($id)->delete();

        Session::flash('delete', __('Survey::FormValidation.DeleteMsg'));
        return redirect()->back();
    }
}
