<?php

namespace App\Modules\Swapno\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Swapno\Models\Event;
use App\Modules\Swapno\Models\Milestone;
use App\Modules\Swapno\Models\Particulars;
use App\Modules\Swapno\Requests\EventRequest;
use App\Modules\Swapno\Requests\MilestoneRequest;
use Auth;
use DB;
use File;
use Illuminate\Support\Str;
use Session;
use Storage;

class EventController extends Controller
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
        $ModuleTitle = 'Manage Swapno Events';
        $PageTitle = 'Swapno Event List';
        $TableTitle = 'Swapno Event List';

        $events = Event::orderby('id','desc')->paginate(10);

        return view("Swapno::event.index", compact('ModuleTitle','PageTitle','TableTitle','events'));
    }

    public function create(){
        $ModuleTitle = 'Manage Swapno Events';
        $PageTitle = 'New Swapno Event';
        $TableTitle = __('Swapno::ControllerMsg.TableTitle');


        return view("Swapno::event.create", compact('ModuleTitle','PageTitle','TableTitle'));
    }

    /**
     * @throws \Throwable
     */
    public function store(EventRequest $request)
    {
        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);

        DB::beginTransaction();
        try {
            Event::create($input);
            DB::commit();
            Session::flash('message','Events added Successfully!');
            return redirect()->route('admin.event.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        $ModuleTitle = 'Manage Swapno Events';
        $PageTitle = 'Update Swapno Event';
        $TableTitle = 'Update Swapno Event';

        $data = Event::where('id',$id)->first();

        return view("Swapno::event.edit", compact('data','ModuleTitle','PageTitle'));
    }


    public function update(EventRequest $request,$id){
        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);
        $input['is_active'] = $input['is_active']==1 ? 1 : 0;

        $updateModel = Event::find($id);

        DB::beginTransaction();
        try {
            $updateModel->update($input);
            $updateModel->save();

            DB::commit();

            Session::flash('message', __('Survey::FormValidation.UpdateData'));
            return redirect()->route('admin.event.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function delete($id){
        Event::find($id)->delete();

        Session::flash('delete', __('Survey::FormValidation.DeleteMsg'));
        return redirect()->back();
    }
}
