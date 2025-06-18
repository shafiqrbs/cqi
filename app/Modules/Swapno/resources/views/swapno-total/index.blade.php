@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            {{--@canany(['survey-create'])
                            <a href="{{route('admin.swapno.total.create')}}" title="{{__('Survey::message.CreateButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus-circle"></i>  {{__('Survey::message.CreateButton')}}
                                </button>
                            </a>
                            @endcan--}}


                            <?php
                            $TultipMessage = __('Survey::message.HintsMsg');
                            ?>

                            <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                               title="{{$TultipMessage}}">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-question-circle"></i> {{__('Survey::message.Hints')}}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </main>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            {{$TableTitle}}
                        </div>
                        <div class="card-body">
                            @include('backend.layouts.message')

                            @if(isset($totalNumbers) && !empty($totalNumbers))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered" id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        <th>Number of factory Onboarded</th>
                                        <th>Number of FPS inaugurated</th>
                                        <th>Number of NIC formed</th>
                                        <th>Number of NIC meeting conducted</th>
                                        <th>Number of workshop, meeting with different stakeholder conducted</th>
                                        <th>Number of participants attend the workshop, meeting</th>
                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($totalNumbers as $value)
                                            <tr>
                                                <td>{{$i++}}</td>

                                                <td>{{$value->factory_onboarded}}</td>
                                                <td>{{$value->fps_inaugurated}}</td>
                                                <td>{{$value->nic_formed}}</td>
                                                <td>{{$value->nic_meeting_conducted}}</td>
                                                <td>{{$value->stakeholder_conducted}}</td>
                                                <td>{{$value->participants_attend}}</td>
                                                <td>
                                                        <span class="allbutton{{$value->id}}">
                                                            <a href="{{route('admin.swapno.total.edit',$value->id)}}" title="Edit" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $totalNumbers->links('backend.layouts.pagination') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('PerPageCustomJs')

@endpush
