<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

$Reset = __('Survey::message.Reset');
$Submit = __('Survey::message.Submit');
$ActiveStatus = __('Organization::message.Active');
$InctiveStatus = __('Organization::message.Inactive');
?>

<div class="row">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-12">

                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('particular_id', 'Particular Type', ['class' => 'col-form-label']) !!}
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-sm-9">
                        {!! Form::select('particular_id',$milestoneTypes,old('particular_id'),['id'=>'particular_id','class' => 'form-control form-select js-example-basic-single']) !!}
                        <span class="text-danger">{!! $errors->first('particular_id') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-3">
                        {!! Form::label('name', 'Name', ['class' => 'col-form-label']) !!}
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('name', old('name'), ['id'=>'name','class'=>'form-control','placeholder'=>'Name']) !!}
                        <span class="text-danger">{!! $errors->first('name') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-3">
                        {!! Form::label('year', 'Year', ['class' => 'col-form-label']) !!}
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-sm-9">
                        {!! Form::select('year',$years,$currentYear??old('year'),['id'=>'year','class' => 'form-control form-select js-example-basic-single']) !!}
                        <span class="text-danger">{!! $errors->first('year') !!}</span>
                    </div>
                </div>

                <div class="form-group row mg-top">
                    <div class="col-sm-3">
                        {!! Form::label('Status', 'Status', array('class' => 'form-label')) !!}
                        <span style="color: red">*</span>
                    </div>
                    <?php
                    $Active = '';
                    $Inactive = '';
                    if (isset($data->is_active)){
                        if ($data->is_active == 1){
                            $Active = 'checked="checked"';
                        }else{
                            $Inactive = 'checked="checked"';
                        }
                    }else{
                        $Active = 'checked="checked"';
                    }
                    ?>

                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="inlineRadioActive" value="1" {{$Active}}>
                            <label class="form-check-label" for="inlineRadioActive">{{$ActiveStatus}}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input  class="form-check-input" type="radio" name="is_active" id="inlineRadioInactive" value="0" {{$Inactive}}>
                            <label class="form-check-label" for="inlineRadioInactive">{{$InctiveStatus}}</label>
                        </div>
                        <br>
                        <span style="color: #ff0000">{!! $errors->first('is_active') !!}</span>
                    </div>
                </div>


            </div>

        </div>
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
