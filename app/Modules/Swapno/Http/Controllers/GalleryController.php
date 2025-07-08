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

        $galleries = PhotoGallery::orderby('id','desc')->where('is_active',1)->paginate(10);

        return view("Swapno::gallery.index", compact('ModuleTitle','PageTitle','TableTitle','galleries'));
    }

    public function create(){
        PhotoGallery::where('is_active',0)->delete();
        $photoGallery = PhotoGallery::create([
            'is_active' => 0
        ]);
        return redirect()->route('admin.gallery.edit',['id' => $photoGallery->id]);
    }


    public function edit($id){
        $ModuleTitle = 'Manage Swapno Gallery';
        $PageTitle = 'Swapno Gallery Create';
        $TableTitle = 'Swapno Gallery Create';

        $data = PhotoGallery::where('id',$id)->first();
        $photoGallery = PhotoGallery::findOrFail($id);


        return view("Swapno::gallery.edit", compact('data','ModuleTitle','PageTitle','photoGallery'));
    }


    public function update(Request $request,$id){
        $input = $request->all(['name']);
        $input['is_active'] = 1;

        DB::beginTransaction();
        try {
            $updateModel = PhotoGallery::find($id);
            $updateModel->update($input);
            $updateModel->save();

            DB::commit();

            Session::flash('message', __('Survey::FormValidation.UpdateData'));
            return redirect()->route('admin.gallery.index');
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
            $update = PhotoGallery::find($id);
            $update->is_active = 0;
            $update->save();
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
