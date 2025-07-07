@if($photoGallery->photoGalleryImages)
    @foreach($photoGallery->photoGalleryImages as $image)
<tr>
    <td>
        @if($image->gallery_image)
{{--                {{ ImgUploader::print_image("photo_gallery/thumb/$image->gallery_image", 100, 50) }}--}}
{{--                {{ ImgUploader::print_image("photo_gallery/mid/$image->gallery_image", 100, 50) }}--}}
            <img src="{{asset("photo_gallery/$image->gallery_image")}}" alt="" width="50px" height="50px">
        @endif
    </td>
    <td>{{$image->caption}}</td>
    <td><button type="button" data-id="{{$image->id}}" class="btn btn-danger btn-sm record_delete">X</button></td>
</tr>
    @endforeach
@endif