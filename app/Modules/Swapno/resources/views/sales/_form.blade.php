<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

$Reset = __('Survey::message.Reset');
$Submit = __('Survey::message.Submit');
?>

<div class="row">
    <div class="col-md-12">
        {{--<div class="mb-4 pb-2 border-bottom">
            <h5 class="fw-bold text-primary">
                <i class="bi bi-graph-up-arrow me-2"></i> Capacity Building Training
            </h5>
        </div>--}}

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

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('category_id', 'Category', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::select('category_id',$category,old('category_id'),['id'=>'category_id','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                        <span class="text-danger">{!! $errors->first('category_id') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
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
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('year', 'Year', ['class' => 'col-form-label']) !!}
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-sm-9">
                        {!! Form::select('year',$years,$currentYear??old('year'),['id'=>'year','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'year','aria-describedby'=>'basic-addon2']) !!}
                        <span class="text-danger">{!! $errors->first('year') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('total_sales_quantity', 'Total sales quantity', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('total_sales_quantity', old('total_sales_quantity'), ['id'=>'total_sales_quantity','class'=>'form-control','data-checkify'=>'minlen=1','placeholder'=>'Total sales quantity']) !!}
                        <span class="text-danger">{!! $errors->first('total_sales_quantity') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('total_sales_amount', 'Total sales amount', ['class' => 'col-form-label']) !!}
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('total_sales_amount', old('total_sales_amount'), ['id'=>'total_sales_amount','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Total sales amount']) !!}
                        <span class="text-danger">{!! $errors->first('total_sales_amount') !!}</span>
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
