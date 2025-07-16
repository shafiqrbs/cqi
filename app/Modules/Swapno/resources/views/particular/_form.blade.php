<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

$Reset = __('Survey::message.Reset');
$Submit = __('Survey::message.Submit');
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
                        {!! Form::select('particular_id',$particularTypes,old('particular_id'),['id'=>'particular_id','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                        <span class="text-danger">{!! $errors->first('particular_id') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('group', 'Group', ['class' => 'col-form-label']) !!}
{{--                        <span style="color: red">*</span>--}}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::select('group',$groups,old('group'),['id'=>'group','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
{{--                        <span class="text-danger">{!! $errors->first('group') !!}</span>--}}
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('name', 'Name', ['class' => 'col-form-label']) !!}
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('name', old('name'), ['id'=>'name','class'=>'form-control','data-checkify'=>'minlen=1','placeholder'=>'Name']) !!}
                        <span class="text-danger">{!! $errors->first('name') !!}</span>
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
