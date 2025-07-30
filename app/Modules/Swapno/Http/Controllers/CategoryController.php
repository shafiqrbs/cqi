<?php

namespace App\Modules\Swapno\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Swapno\Models\Category;
use App\Modules\Swapno\Models\Sales;
use App\Modules\Swapno\Requests\CategoryRequest;
use App\Modules\Swapno\Requests\SalesRequest;
use Auth;
use DB;
use File;
use Illuminate\Support\Str;
use Session;
use Storage;

class CategoryController extends Controller
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
        $ModuleTitle = 'Manage Swapno Categories';
        $PageTitle = 'Swapno Categories List';
        $TableTitle = 'Swapno Categories List';;

        $categories = Category::orderby('id','desc')->paginate(10);

        return view("Swapno::category.index", compact('ModuleTitle','PageTitle','TableTitle','categories'));
    }

    public function create(){
        $ModuleTitle = 'Manage Swapno Category';
        $PageTitle = 'New Swapno Category';
        $TableTitle = __('Swapno::ControllerMsg.TableTitle');

        return view("Swapno::category.create", compact('ModuleTitle','PageTitle','TableTitle'));
    }

    /**
     * @throws \Throwable
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);

        $exists = Category::where('slug', $input['slug'])->exists();

        if ($exists) {
            Session::flash('validate', 'Category already exists.');
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
            Category::create($input);
            DB::commit();
            Session::flash('message','Category added Successfully!');
            return redirect()->route('admin.category.index');
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

        $data = Category::where('id',$id)->first();

        return view("Swapno::category.edit", compact('data','ModuleTitle','PageTitle'));
    }


    public function update(CategoryRequest $request,$id){
        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);
        $input['is_active'] = $input['is_active']==1 ? 1 : 0;

        $exists = Category::where('slug', $input['slug'])->first();

        if ($exists && $exists->id != $id) {
            Session::flash('validate', 'Category already exists.');
            return redirect()->back()->withInput();
        }

        $updateModel = Category::find($id);

        DB::beginTransaction();
        try {
            $updateModel->update($input);
            $updateModel->save();

            DB::commit();

            Session::flash('message', __('Survey::FormValidation.UpdateData'));
            return redirect()->route('admin.category.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function delete($id){
        $categoryExistsSales = Sales::where('category_id',$id)->exists();
        if($categoryExistsSales){
            Session::flash('validate', 'Category already exists in sales.');
            return redirect()->back();
        }
        Category::find($id)->delete();

        Session::flash('delete', __('Survey::FormValidation.DeleteMsg'));
        return redirect()->back();
    }
}
