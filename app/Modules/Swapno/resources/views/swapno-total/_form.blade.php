<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

$Reset = __('Survey::message.Reset');
$Submit = __('Survey::message.Submit');
?>

<div class="row">
    <div class="col-md-12">
        <div class="mb-4 pb-2 border-bottom">
            <h5 class="fw-bold text-primary">
                <i class="bi bi-graph-up-arrow me-2"></i> Total Numbers
            </h5>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('factory_onboarded', 'Number of factory Onboarded', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('factory_onboarded', old('factory_onboarded'), ['id'=>'factory_onboarded','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of factory Onboarded']) !!}
                        <span class="text-danger">{!! $errors->first('factory_onboarded') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('fps_inaugurated', 'Number of FPS inaugurated', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('fps_inaugurated', old('fps_inaugurated'), ['id'=>'fps_inaugurated','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of FPS inaugurated']) !!}
                        <span class="text-danger">{!! $errors->first('fps_inaugurated') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('nic_formed', 'Number of NIC formed', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('nic_formed', old('nic_formed'), ['id'=>'nic_formed','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of NIC formed']) !!}
                        <span class="text-danger">{!! $errors->first('nic_formed') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('nic_meeting_conducted', 'Number of NIC meeting conducted', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('nic_meeting_conducted', old('nic_meeting_conducted'), ['id'=>'nic_meeting_conducted','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of NIC meeting conducted']) !!}
                        <span class="text-danger">{!! $errors->first('nic_meeting_conducted') !!}</span>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('stakeholder_conducted', 'Number of workshop, meeting with different stakeholder conducted', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('stakeholder_conducted', old('stakeholder_conducted'), ['id'=>'stakeholder_conducted','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of workshop, meeting with different stakeholder conducted']) !!}
                        <span class="text-danger">{!! $errors->first('stakeholder_conducted') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('participants_attend', 'Number of participants attend the workshop, meeting', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('participants_attend', old('participants_attend'), ['id'=>'participants_attend','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of participants attend the workshop, meeting']) !!}
                        <span class="text-danger">{!! $errors->first('participants_attend') !!}</span>
                    </div>
                </div>
            </div>
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
