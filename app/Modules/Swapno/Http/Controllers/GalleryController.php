<?php

namespace App\Modules\Swapno\Http\Controllers;

use App;
use App\Helpers\ImageUploadingHelper;
use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Swapno\Models\Category;
use App\Modules\Swapno\Models\PhotoGallery;
use App\Modules\Swapno\Models\PhotoGalleryImage;
use App\Modules\Swapno\Models\Sales;
use App\Modules\Swapno\Requests\SalesRequest;
use Auth;
use DB;
use File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Session;
use Storage;

class GalleryController extends Controller
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
        $ModuleTitle = 'Manage Swapno Gallery';
        $PageTitle = 'Swapno Gallery List';
        $TableTitle = 'Swapno Gallery List';

        $sales = Sales::orderby('id','desc');
        $sales = $sales->join('sur_organization', 'sur_organization.id', '=', 'swapno_sales.organization_id')
            ->join('swapno_category', 'swapno_category.id', '=', 'swapno_sales.category_id')
            ->select('swapno_sales.*', 'sur_organization.name as organization_name', 'swapno_category.name as category_name');
        $sales=$sales->paginate(10);

        return view("Swapno::gallery.index", compact('ModuleTitle','PageTitle','TableTitle','sales'));
    }

    public function create(){
        PhotoGallery::where('is_active',0)->delete();
        $photoGallery = PhotoGallery::create([
            'is_active' => 0
        ]);
        return redirect()->route('admin.gallery.edit',['id' => $photoGallery->id]);
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
        $ModuleTitle = 'Manage Swapno Gallery';
        $PageTitle = 'Swapno Gallery Create';
        $TableTitle = 'Swapno Gallery Create';

        $data = PhotoGallery::where('id',$id)->first();
        $photoGallery = PhotoGallery::findOrFail($id);


        return view("Swapno::gallery.edit", compact('data','ModuleTitle','PageTitle','photoGallery'));
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


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storePhotoGalleryImage(Request $request){
        $id=$request->input('id');
        $photoGallery = PhotoGallery::findOrFail($id);

        if($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {
                if ($request->hasFile('files'.$x)) {
                    $file      = $request->file('files'.$x);
                    $photoGalleryImage= new PhotoGalleryImage();
                    $photoGalleryImage->caption=$request->input('caption');

                    if ($file) {
                        $fileName = ImageUploadingHelper::UploadImage('photo_gallery', $file, $request->input('caption').$x, 1280, 850,true);
                        $photoGalleryImage->gallery_image = $fileName;
                    }

                    $photoGalleryImageUpdate = $photoGallery->photoGalleryImages()->save($photoGalleryImage);
                    $photoGalleryImageUpdate->sort_order = $photoGalleryImageUpdate->id;
                    $photoGalleryImageUpdate->update();
                }
            }
        }

        $returnHTML = view('Swapno::gallery/photo_gallery_images',['photoGallery'=>$photoGallery])->render();
        return response()->json( ['html'=>$returnHTML]);
    }

    public function deletePhotoGalleryImage($id){
        $photoGalleryImage = PhotoGalleryImage::find($id);
        File::delete(public_path().'/photo_gallery/'.$photoGalleryImage->gallery_image);
        File::delete(public_path().'/photo_gallery/mid/'.$photoGalleryImage->gallery_image);
        File::delete(public_path().'/photo_gallery/thumb/'.$photoGalleryImage->gallery_image);
        $photoGalleryImage->delete();
        return new JsonResponse(array('status'=>'200','message'=>'Record deleted successfully'));
    }
}
