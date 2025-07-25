@if($photoGallery->photoGalleryImages)
    @foreach($photoGallery->photoGalleryImages as $image)
<tr>
    <td>
        @if($image->gallery_image && $photoGallery->file_type=='gallery')
            <img src="{{asset("photo_gallery/$image->gallery_image")}}" alt="" width="50px" height="50px">
        @else
            {{$image->gallery_image}}
        @endif
    </td>
    <td>{{$image->caption}}</td>
    <td><button type="button" data-id="{{$image->id}}" class="btn btn-danger btn-sm record_delete">X</button></td>
</tr>
    @endforeach
@endif