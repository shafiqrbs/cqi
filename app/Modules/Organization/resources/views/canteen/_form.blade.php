<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

$OrganizationFieldName =  __('Organization::message.OrganizationFieldName');
$CanteenPlaceholder = __('Organization::message.CanteenPlaceholder');
$Status = __('Organization::message.Status');
$ActiveStatus = __('Organization::message.Active');
$InctiveStatus = __('Organization::message.Inactive');
$Reset = __('Organization::message.Reset');
$Submit = __('Organization::message.Submit');
$organizationName = __('Survey::message.organizationName');
?>


<div class="row">

    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($organizationName,$organizationName, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">

            @if(isset($data))
                @php $orgArray = array(); @endphp
                @foreach($data->SurveyOrganization($data->id) as $orgData)
                    <?php
                    array_push($orgArray,$orgData->id);
                    ?>
                @endforeach

                {!! Form::select('organization_id',$Organization,$orgArray,['id'=>'organization_id','class' => 'form-select js-example-basic-multiple form-control','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                <span style="color: #ff0000">{!! $errors->first('organization_id') !!}</span>
            @else
                {!! Form::select('organization_id',$Organization,old('organization_id'),['id'=>'organization_id','class' => 'form-select js-example-basic-multiple form-control','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                <span style="color: #ff0000">{!! $errors->first('organization_id') !!}</span>
            @endif
        </div>
    </div>

    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($OrganizationFieldName, $OrganizationFieldName, array('class' => 'col-form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::text('name',old('name'),['id'=>'name','class' => 'form-control','data-checkify'=>'minlen=3,required','Placeholder' => $CanteenPlaceholder,'aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('name') !!}</span>
        </div>
    </div>
    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($Status, $Status, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>
        <?php
        $Active = '';
        $Inactive = '';
        if (isset($data->status)){
            if ($data->status == 1){
                $Active = 'checked="checked"';
            }else{
                $Inactive = 'checked="checked"';
            }
        }else{
            $Active = 'checked="checked"';
        }
        ?>

        <div class="col-sm-10">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inlineRadioActive" value="1" {{$Active}}>
                <label class="form-check-label" for="inlineRadioActive">{{$ActiveStatus}}</label>
            </div>
            <div class="form-check form-check-inline">
                <input  class="form-check-input" type="radio" name="status" id="inlineRadioInactive" value="0" {{$Inactive}}>
                <label class="form-check-label" for="inlineRadioInactive">{{$InctiveStatus}}</label>
            </div>
            <br>
            <span style="color: #ff0000">{!! $errors->first('status') !!}</span>
        </div>
    </div>

</div>




<div class="row">

    <div class="col-md-12" style="text-align: right;">
        <div class="from-group">
            <div class="">
                <button type="reset" class="btn submit-button">{{$Reset}}</button>
                <button type="submit" class="btn submit-button" id="OrganizationFormSubmit">{{$Submit}}</button>
            </div>
        </div>
    </div>

</div>
