<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

$Reset = __('Survey::message.Reset');
$Submit = __('Survey::message.Submit');
?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-sm-2">
                {!! Form::label('gallery_name', 'Gallery Name', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
            </div>
            <div class="col-sm-10">
                {!! Form::text('name', old('name'), ['id'=>'name','class'=>'form-control','placeholder'=>'Gallery Name']) !!}
                <span class="text-danger">{!! $errors->first('name') !!}</span>
            </div>
        </div>
    </div>
</div>


<div class="row mt-5">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
            {{--<tr>
                <td>Image</td>
                <td>Caption</td>
                <td>Action</td>
            </tr>--}}
            <tr>
                <td>
                    <input type="file" id="file" name="file[]" class="form-control" multiple />
{{--                    <span style="font-size: 10px;">( Greater than or equal to width 1280px & height 850px. )</span>--}}
                </td>
                <td>
                    {!! Form::text('caption', null, ['id'=>'caption','class'=>'form-control','placeholder'=>'Caption']) !!}

{{--                    {!! Form::text('caption', null, array('class'=>'form-control', 'id'=>'caption', 'placeholder'=>'Caption')) !!}--}}
                </td>
                <td>
{{--                    <button id="photo_gallery_image_add" type="button" data-action="" data-entity-id="{{$photoGallery->id}}" class="btn btn-primary btn-sm">Add</button>--}}
                    <button id="photo_gallery_image_add" type="button" data-action="" data-entity-id="{{$photoGallery->id}}" class="btn btn-primary btn-sm">Add</button>
                </td>
            </tr>
            </thead>
            <tbody class="photo_gallery_images">
            @include('Swapno::gallery/photo_gallery_images')
            </tbody>
        </table>
    </div>
</div>


<br>

<div class="row ">
    <div class="col-md-12 mb-4" style="text-align: right;">
        <div class="from-group">
            <div class="">
                <button type="reset" class="btn submit-button">{{$Reset}}</button>
                <button type="submit" class="btn btn-primary" id="OrganizationFormSubmit">{{$Submit}}</button>
            </div>
        </div>
    </div>

</div>


@push('PerPageCustomJs')


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#photo_gallery_image_add').on('click',function(e) {
        var fd = new FormData();
        var caption=$('#caption').val();
        var id=$(this).attr('data-entity-id');

        let TotalFiles = $('#file')[0].files.length; //Total files
        let files = $('#file')[0];
        for (let i = 0; i < TotalFiles; i++) {
            fd.append('files' + i, files.files[i]);
        }
        fd.append('TotalFiles', TotalFiles);

        if(TotalFiles > 0 ){
            fd.append('id',id);
            fd.append('caption',caption);
            fd.append("_token", '{{csrf_token()}}');
            $.ajax({
                url: '{!! route('store_photo_gallery_image') !!}',
                headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
                async:true,
                type:"post",
                contentType:false,
                data:fd,
                processData:false,
                success: function(response){
                    jQuery(".photo_gallery_images").html(response.html);
                },
            });
        }else{
            alert("Please select a file.");
        }
    });

    $(document).on('click','.record_delete',function(e) {
        var element= $(this);
        var entityId= $(this).attr('data-id');
        if(entityId==''){
            alert('This record are not available');
            return false;
        }
        if(confirm('Are you sure delete?')){
            jQuery.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/ajax/photo-gallery-image/delete/' + entityId,
                data: {},
                success: function (data) {

                    if (data.status == 200) {
                        jQuery('.alert').addClass('alert-success').show().html(data.message);
                    }
                    $(element).closest('tr').remove();
                }

            });
        }
    });
</script>
@endpush
