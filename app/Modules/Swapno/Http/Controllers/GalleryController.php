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
use Illuminate\Support\Str;
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
    public function index( $type = 'all' )
    {
        ConfigurationHelper::Language();
        $ModuleTitle = 'Manage Swapno Gallery & Resources';
        $PageTitle = 'Swapno Gallery & Resources List';
        $TableTitle = 'Swapno Gallery & Resources List';

        $galleries = PhotoGallery::orderby('id','desc')->where('is_active',1);
            if($type=='gallery'){
                $ModuleTitle = 'Manage Swapno Gallery';
                $PageTitle = 'Swapno Gallery List';
                $TableTitle = 'Swapno Gallery List';
                $galleries = $galleries->where('file_type','gallery');
            }elseif ($type=='resource') {
                $ModuleTitle = 'Manage Swapno Resources';
                $PageTitle = 'Swapno Resources List';
                $TableTitle = 'Swapno Resources List';
                $galleries = $galleries->where('file_type','resource');
            }
        $galleries=$galleries->paginate(10);

        return view("Swapno::gallery.index", compact('ModuleTitle','PageTitle','TableTitle','galleries','type'));
    }

    public function create($type){
        PhotoGallery::where('is_active',0)->delete();
        $photoGallery = PhotoGallery::create([
            'is_active' => 0,
            'file_type' => $type
        ]);
        return redirect()->route('admin.gallery.edit',['id' => $photoGallery->id]);
    }


    public function edit($id){
//        $ModuleTitle = 'Manage Swapno Gallery';
//        $PageTitle = 'Swapno Gallery Create';
        $TableTitle = 'Swapno Gallery Create';

        $data = PhotoGallery::where('id',$id)->first();
        if ($data->file_type == 'resource') {
            $ModuleTitle = 'Manage Swapno Resource';
            $PageTitle = 'New Resource';
        }else{
            $ModuleTitle = 'Manage Swapno Gallery';
            $PageTitle = 'New Gallery';
        }
        $photoGallery = PhotoGallery::findOrFail($id);
        return view("Swapno::gallery.edit", compact('data','ModuleTitle','PageTitle','photoGallery'));
    }


    public function update(Request $request,$id){
        $input = $request->only('name','file_type');
        $input['is_active'] = 1;

        DB::beginTransaction();
        try {
            $updateModel = PhotoGallery::find($id);
            $updateModel->update($input);
            $updateModel->save();

            DB::commit();

            Session::flash('message', __('Survey::FormValidation.UpdateData'));
            return redirect()->route('admin.gallery.index',$updateModel->file_type);
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

    public function storePhotoGalleryImage(Request $request)
    {
        $id = $request->input('id');
        $photoGallery = PhotoGallery::findOrFail($id);
        $fileType = $photoGallery->file_type;

        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {
                if ($request->hasFile('files' . $x)) {
                    $file = $request->file('files' . $x);
                    $caption = $request->input('caption') ?? 'file';

                    $photoGalleryImage = new PhotoGalleryImage();
                    $photoGalleryImage->caption = $caption;

                    if ($fileType == 'gallery') {
                        // Use image processing helper
                        $fileName = ImageUploadingHelper::UploadImage(
                            'photo_gallery',
                            $file,
                            $caption . $x,
                            1280,
                            850,
                            true
                        );
                    } else {
                        $extension = $file->getClientOriginalExtension();
                        $safeName = Str::slug('f'.rand(5,1234567890) . '-' . time() . '-' . $x) . '.' . $extension;
                        $destinationPath = public_path('/photo_gallery'); // Make sure this path exists
                        $file->move($destinationPath, $safeName);
                        $fileName =  $safeName;
                    }

                    // Save filename to DB
                    $photoGalleryImage->gallery_image = $fileName;

                    // Save and update sort order
                    $photoGalleryImageSaved = $photoGallery->photoGalleryImages()->save($photoGalleryImage);
                    $photoGalleryImageSaved->sort_order = $photoGalleryImageSaved->id;
                    $photoGalleryImageSaved->update();
                }
            }
        }

        // Return updated view HTML
        $returnHtml = view('Swapno::gallery.photo_gallery_images', [
            'photoGallery' => $photoGallery
        ])->render();

        return response()->json(['html' => $returnHtml]);
    }

    public function deletePhotoGalleryImage($id){
        $photoGalleryImage = PhotoGalleryImage::find($id);
        File::delete(public_path().'/photo_gallery/'.$photoGalleryImage->gallery_image);
        $photoGalleryImage->delete();
        return new JsonResponse(array('status'=>'200','message'=>'Record deleted successfully'));
    }
}
