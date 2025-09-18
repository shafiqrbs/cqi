@extends(/** @lang text */'backend.layouts.master')

@section('body')
    @push('CustomStyle')
        <style>
            .chartdiv {
                width: 100%;
                height: 300px;
            }
             .table thead th {
                 text-align: left;  /* Align header text */
                 font-size: 14px;  /* Font size matching the chart labels */
             }

            .table tbody tr:hover {
                background-color: #f0f4f8;  /* Hover effect for tables to give user feedback */
            }

            .table tbody td {
                font-size: 14px;  /* Font size adjusted to be consistent with the chart */
                vertical-align: middle;  /* Vertically center the table content */
            }

            /* Ensure rows are spaced similarly to the chart markers */
            .table-bordered th, .table-bordered td {
                border: 1px solid #ebebeb !important;  /* Consistent light border color */
            }

            .table-responsive {
                max-height: 370px;  /* Same height as the chart container */
                overflow-y: auto;  /* Add vertical scrolling if content exceeds the set height */
                -ms-overflow-style: none;  /* For Internet Explorer/Edge */
                scrollbar-width: none;  /* For Firefox */
            }

            .table-responsive::-webkit-scrollbar {
                display: none;  /* Hide scrollbar */
            }
        </style>
    @endpush

    @push('PerPageCustomJs')
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

        <script>
            // for select2
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });

            // for select2 multiple
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });

        </script>
    @endpush

    <?php
    use App\Modules\SurveyResult\Models\SurveyResult;
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
    <div class="dashboard-area" {{session()->get('locale')}}>

        <div id="carbon-block">

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h4">Canteen wise report with chart</h2>

                    <div class="btn-toolbar mb-2 mb-md-0">


                    </div>
                </div>
            </main>

            <?php
                if (isset($input)){
                    $searchDate = $input['date'];
                    $searchDate = date("d-m-Y", strtotime($searchDate));
                }else{
                    $searchDate = date('d-m-Y');
                }
            ?>


            {!! Form::open(['route' => 'admin.canteen.report.value','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true]) !!}
            <div class="card" style="margin-bottom: 20px !important;">
                <div class="card-header" style="font-size: 16px;font-weight: bold;">
                    Filter
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            @if(isset($searchDate))
                                {{ Form::date('date',date('Y-m-d', strtotime($searchDate)),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px']) }}
                            @else
                                {{ Form::date('date',old(date('Y-m-d')),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px','required'=>true]) }}
                            @endif
                        </div>

                        <div class="col-md-2">
                            @if(isset($input))
                            {!! Form::select('canteen_name',$selectCanteen,$input['canteen_name'],['id'=>'canteen_name','class' => 'form-control form-select js-example-basic-single','required'=>true]) !!}
                            @else
                                {!! Form::select('canteen_name',$selectCanteen,old('canteen_name'),['id'=>'canteen_name','class' => 'form-control form-select js-example-basic-single','required'=>true]) !!}
                            @endif
                        </div>

                        <div class="col-md-3">
                            <a data-href="{{route('admin.surveywise.item')}}" class="itemRoute"></a>
                            @if(isset($input))
                            {!! Form::select('survey_id',$surveySelect,$input['survey_id'],['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single','required'=>true]) !!}
                            @else
                                {!! Form::select('survey_id',$surveySelect,old('survey_id'),['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single','required'=>true]) !!}
                            @endif
                        </div>

                        <div class="col-md-2">
                            @if(isset($input))
                            {!! Form::select('item_id',$surveyItem,$input['item_id'],['id'=>'item_id','class' => 'form-control form-select js-example-basic-single','required'=>true]) !!}
                            @else
                                @php
                                    $item[''] = 'Choose Item ';
                                @endphp
                                {!! Form::select('item_id',$item,old('item_id'),['id'=>'item_id','class' => 'form-control form-select js-example-basic-single','required'=>true,'disabled'=>true]) !!}
                            @endif
                        </div>

                        <div class="col-md-3" style="display: inherit;">
                            <button type="submit" class="btn btn-primary" id="Filter" style="height: 28px;width: 20%">
                                <span style="display: block;margin-top: -4px;"><i class="fas fa-search"></i></span>
                            </button>

                            <a href="{{route('admin.canteen.report')}}" title="Reset" class="btn btn-danger" style="height: 28px;width: 20%;margin-left: 2px;"><span  style="display: block;margin-top: -4px;"><i class="fas fa-redo-alt"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            @if(isset($survey))

                <div class="card" style="margin-bottom: 20px !important;">

                    <div class="card-header" style="font-size: 16px;font-weight: bold;">
                        {{$input['canteen_name']}}
                    </div>


                    <div class="card-body">
                        <div class="row" id="printThis">

                            <?php
                                if (isset($input) && $input['item_id'] == 'all'){
                                    $grid = 5;
                                }else{
                                    $grid = 12;
                                }
                            ?>

                            <h5>
                                @if(session()->get('locale') == 'en')
                                    {{$survey->nameen}}
                                @else
                                    {{$survey->namebn}}
                                @endif
                            </h5>

                                <div class="col-md-{{$grid}}">

                                    <div class="table-responsive" style="height: 370px; width: 100%; background-color: #f4f6f8; box-shadow: 0 3px 6px rgba(0,0,0,0.1); border-radius: 8px; padding: 15px; overflow-y: auto;">
                                        <table class="table table-striped table-bordered" id="table_id" style="background-color: white; border-collapse: separate; border-spacing: 0 8px;">
                                            <thead>
                                            <tr style="background-color: #567cad; color: white; font-weight: bold;">
                                                <th style="padding: 10px;">Name En</th>
                                                <th style="padding: 10px;">Name Bn</th>
                                                <th style="padding: 10px;">Total</th>
                                                <th style="padding: 10px;">Percent</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @if(count($cantteenWiseData)>0)
                                                    <?php $totalResponse = 0;?>
                                                @foreach($cantteenWiseData as $value)
                                                        <?php $totalResponse += $value['value']; ?>
                                                @endforeach
                                                @foreach($cantteenWiseData as $value)
                                                    <tr style="background-color: #fff; border: 1px solid #ebebeb;">
                                                        <td style="padding: 10px;">{{$value['item_en']}}</td>
                                                        <td style="padding: 10px;">{{$value['item_bn']}}</td>
                                                        <td style="padding: 10px;">{{$value['value']}}</td>
                                                        <td style="padding: 10px;">{{number_format(($value['value']*100)/$totalResponse,2)}}%</td>
                                                    </tr>
                                                @endforeach
                                                <tr style="background-color: #567cad; color: white; font-weight: bold;">
                                                    <th colspan="2" style="padding: 10px; text-align: left;">Total</th>
                                                    <th style="padding: 10px;">{{$totalResponse}}</th>
                                                    <th></th>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>



                                </div>

                                @if(isset($input) && $input['item_id'] == 'all')
                                    <div class="col-md-7">
                                        <div id="chartContainer" style="height: 370px; width: 100%; background-color: #f4f6f8; box-shadow: 0 3px 6px rgba(0,0,0,0.1); border-radius: 8px; padding: 15px;"></div>

                                        {{--                                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>--}}
                                    </div>
                                @endif
                        </div>

                    </div>

                </div>


                @push('PerPageCustomJs')

                    <script>
                        window.onload = function () {
                            var chart = new CanvasJS.Chart("chartContainer", {
                                theme: "light2",  // Lightweight theme
                                backgroundColor: "transparent",
                                animationEnabled: true,
                                exportEnabled: true,
                                toolTip: {
                                    shared: true,
                                    borderColor: "#567cad",
                                    backgroundColor: "#fff",
                                    fontColor: "#4f4f4f",
                                    fontSize: 14
                                },
                                title: {
                                    text: "Performance Overview",
                                    fontFamily: "Helvetica",
                                    fontSize: 20,
                                    fontColor: "#323232",
                                    padding: 5
                                },
                                axisY: {
                                    title: "Numbers",
                                    titleFontFamily: "Helvetica",
                                    titleFontSize: 14,
                                    titleFontColor: "#606060",
                                    gridColor: "#ebebeb",
                                    lineColor: "#bfbfbf",
                                    tickThickness: 1,
                                    labelFontFamily: "Arial",
                                    labelFontSize: 12,
                                    labelFontColor: "#888888"
                                },
                                axisX: {
                                    labelFontFamily: "Arial",
                                    labelFontSize: 12,
                                    labelFontColor: "#888888",
                                    interval: 1,
                                    tickThickness: 1
                                },
                                legend: {
                                    fontFamily: "Arial",
                                    fontSize: 14,
                                    fontColor: "#333",
                                    horizontalAlign: "center",
                                    verticalAlign: "bottom",
                                    cursor: "pointer"
                                },
                                data: [{
                                    type: "line",
                                    toolTipContent: "{label}: {y}",
                                    showInLegend: true,
                                    legendText: "Performance",
                                    markerSize: 6,
                                    markerType: "circle",
                                    markerBorderColor: "#567cad",
                                    markerBorderThickness: 2,
                                    markerColor: "#fff",
                                    lineColor: "#567cad",
                                    lineThickness: 3,
                                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>,

                                    // Always show the values next to the markers
                                    indexLabel: "{y}",  // Set indexLabel to display the value
                                    indexLabelFontFamily: "Arial",
                                    indexLabelFontSize: 12,
                                    indexLabelFontColor: "#333",  // Makes sure the label is readable
                                    indexLabelPlacement: "outside"  // Place the value label outside the marker
                                }]
                            });

                            chart.render();
                        }
                    </script>

                @endpush

            @endif


            <div style="height: 50px"></div>
        </div>
    </div>
@endsection

@push('PerPageCustomJs')
    {{--   script for bar graph start  --}}
    <script>
        $(document).delegate('#survey_id','change',function () {
            var surveyId = $(this).val();
            var url = $('.itemRoute').attr('data-href');

            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                data: {surveyId: surveyId},
                beforeSend: function( xhr ) {

                }
            }).done(function( response ) {
                var allItems = response.items;
                // var userDataOption = '';
                var userDataOption='<option value="all">All</option>';
                jQuery.each(allItems, function(i, item) {
                    userDataOption += '<option value="'+i+'">'+item+'</option>';
                });
                jQuery('#item_id').html(userDataOption);
                jQuery('#item_id').prop('disabled', false);
            }).fail(function( jqXHR, textStatus ) {

            });
            return false;
        });
    </script>
    {{--    pie chart end     --}}
@endpush


