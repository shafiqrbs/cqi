<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

$Reset = __('Survey::message.Reset');
$Submit = __('Survey::message.Submit');
?>

<div class="row">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('organization_id', 'Organization', ['class' => 'col-form-label']) !!}
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-sm-9">
                        {!! Form::select('organization_id',$organization,old('organization_id'),['id'=>'organization_id','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                        <span class="text-danger">{!! $errors->first('organization_id') !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('month', 'Month', ['class' => 'col-form-label']) !!}
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-sm-9">
                        {!! Form::select('month',$months,$currentMonth??old('month'),['id'=>'month','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                        <span class="text-danger">{!! $errors->first('month') !!}</span>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('year', 'Year', ['class' => 'col-form-label']) !!}
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-sm-9">
                        {!! Form::select('year',$years,$currentYear??old('year'),['id'=>'year','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'year','aria-describedby'=>'basic-addon2']) !!}
                        <span class="text-danger">{!! $errors->first('year') !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td width="50%">
                    {!! Form::select('particular_id',$parametters,old('particular_id'),['id'=>'particular_id','class' => 'form-control form-select js-example-basic-single']) !!}
                </td>
                <td width="40%">
                    {!! Form::text('kpi_value', null, ['id'=>'kpi_value','class'=>'form-control','placeholder'=>'Value']) !!}

                </td>
                <td>
                    <button id="added_kpi_parametters" type="button" data-action="" data-entity-id="{{$data->id}}" class="btn btn-primary btn-sm">Add</button>
                </td>
            </tr>
            </thead>
            <tbody class="kpi_value_table">
            @include('Swapno::overview/kpi_values_table')
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
        $('#added_kpi_parametters').on('click',function(e) {
            let fd = new FormData();
            let particular_id=$('#particular_id').val();
            let kpi_value=$('#kpi_value').val();
            let id=$(this).attr('data-entity-id');

            if(id && particular_id && kpi_value){
                fd.append('id',id);
                fd.append('kpi_value',kpi_value);
                fd.append('particular_id',particular_id);
                fd.append("_token", '{{csrf_token()}}');
                $.ajax({
                    url: '{!! route('admin.kpi.parameter.store') !!}',
                    headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
                    async:true,
                    type:"post",
                    contentType:false,
                    data:fd,
                    processData:false,
                    success: function(response){
                        if (response.status===500){
                            alert(response.message)
                        }else if (response.status===200) {
                            jQuery(".kpi_value_table").html(response.html);
                        }
                    },
                });
            }else{
                if(!particular_id){
                    alert('Choose KPI parameter.')
                }else if (!kpi_value){
                    alert('Enter parameter value.')
                }else {
                    alert('KPI id missing')
                }
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
                    url: '/admin-kpi-parameter-delete/' + entityId,
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