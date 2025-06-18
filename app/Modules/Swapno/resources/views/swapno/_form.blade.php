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
                <i class="bi bi-graph-up-arrow me-2"></i> Capacity Building Training
            </h5>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('organization_id', 'Organization', ['class' => 'col-form-label']) !!}
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-sm-9">
                        {!! Form::select('organization_id',$Organization,old('organization_id'),['id'=>'organization_id','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                        <span class="text-danger">{!! $errors->first('organization_id') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('nic_training_completed', 'Number of NIC training completed', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('nic_training_completed', old('nic_training_completed'), ['id'=>'nic_training_completed','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of NIC training completed']) !!}
                        <span class="text-danger">{!! $errors->first('nic_training_completed') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('nic_member_received_training', 'Number of  NIC member received training', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('nic_member_received_training', old('nic_member_received_training'), ['id'=>'nic_member_received_training','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of  NIC member received training']) !!}
                        <span class="text-danger">{!! $errors->first('nic_member_received_training') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('peer_educator_selected', 'Number of Peer educator selected', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('peer_educator_selected', old('peer_educator_selected'), ['id'=>'peer_educator_selected','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of Peer educator selected']) !!}
                        <span class="text-danger">{!! $errors->first('peer_educator_selected') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('female_peer_educator', 'Female Peer educator', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('female_peer_educator', old('female_peer_educator'), ['id'=>'female_peer_educator','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Female Peer educator']) !!}
                        <span class="text-danger">{!! $errors->first('female_peer_educator') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('male_peer_educator', 'Male Peer educator', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('male_peer_educator', old('male_peer_educator'), ['id'=>'male_peer_educator','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Male Peer educator']) !!}
                        <span class="text-danger">{!! $errors->first('male_peer_educator') !!}</span>
                    </div>
                </div>
                
                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('peer_educator_received_training', 'Number of Peer educator received training', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('peer_educator_received_training', old('peer_educator_received_training'), ['id'=>'peer_educator_received_training','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of Peer educator received training']) !!}
                        <span class="text-danger">{!! $errors->first('peer_educator_received_training') !!}</span>
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('female_participant', 'Female participant', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('female_participant', old('female_participant'), ['id'=>'female_participant','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Female participant']) !!}
                        <span class="text-danger">{!! $errors->first('female_participant') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('male_participant', 'Male participant', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('male_participant', old('male_participant'), ['id'=>'male_participant','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Female participant']) !!}
                        <span class="text-danger">{!! $errors->first('male_participant') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('peer_educator_tot_completed', 'Number of Peer Educator ToT completed', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('peer_educator_tot_completed', old('peer_educator_tot_completed'), ['id'=>'peer_educator_tot_completed','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of Peer Educator ToT completed']) !!}
                        <span class="text-danger">{!! $errors->first('peer_educator_tot_completed') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('training_conducted_for_fps_staff', 'Number of training conducted for FPS staff', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('training_conducted_for_fps_staff', old('training_conducted_for_fps_staff'), ['id'=>'training_conducted_for_fps_staff','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of training conducted for FPS staff']) !!}
                        <span class="text-danger">{!! $errors->first('training_conducted_for_fps_staff') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('fps_staff_received_training', 'Number of FPS staff received training', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('fps_staff_received_training', old('fps_staff_received_training'), ['id'=>'fps_staff_received_training','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of FPS staff received training']) !!}
                        <span class="text-danger">{!! $errors->first('fps_staff_received_training') !!}</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="mb-4 pb-2 border-bottom mt-5">
            <h5 class="fw-bold text-primary">
                <i class="bi bi-graph-up-arrow me-2"></i> SBCC Approach
            </h5>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('sbcc_materials_developed', 'Types of SBCC materials developed', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('sbcc_materials_developed', old('sbcc_materials_developed'), ['id'=>'sbcc_materials_developed','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Types of SBCC materials developed']) !!}
                        <span class="text-danger">{!! $errors->first('sbcc_materials_developed') !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('sbcc_items_distributed', 'Number of SBCC items distributed', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('sbcc_items_distributed', old('sbcc_items_distributed'), ['id'=>'sbcc_items_distributed','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of SBCC items distributed']) !!}
                        <span class="text-danger">{!! $errors->first('sbcc_items_distributed') !!}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 pb-2 border-bottom mt-5">
            <h5 class="fw-bold text-primary">
                <i class="bi bi-graph-up-arrow me-2"></i> Promotional Campaign
            </h5>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('campaign_organized', 'Number of campaign organized', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('campaign_organized', old('campaign_organized'), ['id'=>'campaign_organized','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of campaign organized']) !!}
                        <span class="text-danger">{!! $errors->first('campaign_organized') !!}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('workers_purchased_during_campaign', 'Number of workers purchased during campaign', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('workers_purchased_during_campaign', old('workers_purchased_during_campaign'), ['id'=>'workers_purchased_during_campaign','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of workers purchased during campaign']) !!}
                        <span class="text-danger">{!! $errors->first('workers_purchased_during_campaign') !!}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('bdt_during_campaign', 'Total sales in BDT during campaign', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('bdt_during_campaign', old('bdt_during_campaign'), ['id'=>'bdt_during_campaign','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Total sales in BDT during campaign']) !!}
                        <span class="text-danger">{!! $errors->first('bdt_during_campaign') !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('female_worker', 'Female worker', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('female_worker', old('female_worker'), ['id'=>'female_worker','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Female worker']) !!}
                        <span class="text-danger">{!! $errors->first('female_worker') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('male_worker', 'Male worker', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('male_worker', old('male_worker'), ['id'=>'male_worker','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Male worker']) !!}
                        <span class="text-danger">{!! $errors->first('male_worker') !!}</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="mb-4 pb-2 border-bottom mt-5">
            <h5 class="fw-bold text-primary">
                <i class="bi bi-graph-up-arrow me-2"></i> FPS Sales Performance
            </h5>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('workers_purchased_from_fps', 'Number of workers purchased from FPS', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('workers_purchased_from_fps', old('workers_purchased_from_fps'), ['id'=>'workers_purchased_from_fps','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of workers purchased from FPS']) !!}
                        <span class="text-danger">{!! $errors->first('workers_purchased_from_fps') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('amount_sales_through_credit', 'Amount sales through Credit', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('amount_sales_through_credit', old('amount_sales_through_credit'), ['id'=>'amount_sales_through_credit','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Amount sales through Credit']) !!}
                        <span class="text-danger">{!! $errors->first('amount_sales_through_credit') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('workers_purchased_through_credit', 'Number of workers purchased through credit', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('workers_purchased_through_credit', old('workers_purchased_through_credit'), ['id'=>'workers_purchased_through_credit','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of workers purchased through credit']) !!}
                        <span class="text-danger">{!! $errors->first('workers_purchased_through_credit') !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-3">
                        {!! Form::label('amount_sales_through_cash', 'Amount sales through Cash', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('amount_sales_through_cash', old('amount_sales_through_cash'), ['id'=>'amount_sales_through_cash','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Amount sales through Cash']) !!}
                        <span class="text-danger">{!! $errors->first('amount_sales_through_cash') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('total_sales_in_bdt', 'Total sales in BDT', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('total_sales_in_bdt', old('total_sales_in_bdt'), ['id'=>'total_sales_in_bdt','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Total sales in BDT']) !!}
                        <span class="text-danger">{!! $errors->first('total_sales_in_bdt') !!}</span>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-3">
                        {!! Form::label('products_available_in_fps', 'Number of products available in FPS', ['class' => 'col-form-label']) !!}
                    </div>
                    <div class="col-sm-9">
                        {!! Form::text('products_available_in_fps', old('products_available_in_fps'), ['id'=>'products_available_in_fps','class'=>'form-control','data-checkify'=>'minlen=1,required','placeholder'=>'Number of products available in FPS']) !!}
                        <span class="text-danger">{!! $errors->first('products_available_in_fps') !!}</span>
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
