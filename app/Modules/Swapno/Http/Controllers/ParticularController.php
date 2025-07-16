<?php

namespace App\Modules\Swapno\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Swapno\Models\Category;
use App\Modules\Swapno\Models\Particulars;
use App\Modules\Swapno\Models\ParticularTypes;
use App\Modules\Swapno\Models\Sales;
use App\Modules\Swapno\Requests\ParticularRequest;
use App\Modules\Swapno\Requests\SalesRequest;
use Auth;
use DB;
use File;
use Illuminate\Support\Str;
use Session;
use Storage;

class ParticularController extends Controller
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
        $ModuleTitle = 'Manage Swapno Particulars';
        $PageTitle = 'Swapno Particulars List';
        $TableTitle = 'Swapno Particulars List';;

        $particulars = Particulars::orderby('id','desc')->where('is_active',1)->paginate(20);

        return view("Swapno::particular.index", compact('ModuleTitle','PageTitle','TableTitle','particulars'));
    }

    public function create(){
        $ModuleTitle = 'Manage Swapno Particulars';
        $PageTitle = 'New Swapno Particular';
        $TableTitle = __('Swapno::ControllerMsg.TableTitle');
        $particularTypes = ParticularTypes::where('is_active','1')->pluck('name','id')->all();
        $groups = [
            '0' => 'Choose Group',
            'capacity_building_training' => 'Capacity Building Training',
            'sbcc_approach' => 'SBCC Approach',
            'promotional_campaign' => 'Promotional Campaign',
            'fps_sales_performance' => 'FPS Sales Performance',
        ];

        return view("Swapno::particular.create", compact('ModuleTitle','PageTitle','TableTitle','particularTypes','groups'));
    }

    /**
     * @throws \Throwable
     */
    public function store(ParticularRequest $request)
    {
        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);

        $exists = Particulars::where('slug', $input['slug'])
            ->when(!empty($input['group']), function ($query) use ($input) {
                $query->where('group', $input['group']);
            })
            ->exists();

        if ($exists) {
            Session::flash('validate', 'Particulars already exists.');
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {

            Particulars::create($input);
            DB::commit();
            Session::flash('message','Particular added Successfully!');
            return redirect()->route('admin.particular.index');
//            return redirect()->back()->withInput();
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

        $data = Particulars::where('id',$id)->first();

        $particularTypes = ParticularTypes::where('is_active','1')->pluck('name','id')->all();
        $groups = [
            '0' => 'Choose Group',
            'capacity_building_training' => 'Capacity Building Training',
            'sbcc_approach' => 'SBCC Approach',
            'promotional_campaign' => 'Promotional Campaign',
            'fps_sales_performance' => 'FPS Sales Performance',
        ];

        return view("Swapno::particular.edit", compact('data','ModuleTitle','PageTitle','particularTypes','groups'));
    }


    public function update(ParticularRequest $request,$id){
        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);

        $exists = Particulars::where('slug', $input['slug'])
            ->when(!empty($input['group']), function ($query) use ($input) {
                $query->where('group', $input['group']);
            })
            ->first();

        if ($exists && $exists->id != $id) {
            Session::flash('validate', 'Particular already exists.');
            return redirect()->back()->withInput();
        }

        $updateModel = Particulars::where('id',$id)->first();

        DB::beginTransaction();
        try {

            $updateModel->update($input);
            $updateModel->save();

            DB::commit();

            Session::flash('message', __('Survey::FormValidation.UpdateData'));
            return redirect()->route('admin.particular.index');
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
