@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">

                            <a href="{{route('admin.swapno.total.index')}}" title="Swapno Total" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-th-list"></i>  Swapno Total
                                </button>
                            </a>

                            @canany(['survey-create'])
                                <a href="{{route('admin.kpi.create')}}" title="{{__('Survey::message.CreateButton')}}" class="module_button_header">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-plus-circle"></i>  {{__('Survey::message.CreateButton')}}
                                    </button>
                                </a>
                            @endcan


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

                            @if(isset($kpis) && !empty($kpis))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered" id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        <th>Organization</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                            <?php $i=1; ?>
                                        @foreach($kpis as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$value->organization_name}}</td>
                                                <td>{{$value->month}}</td>
                                                <td>{{$value->year}}</td>
                                                <td>

                                                        <span class="allbutton{{$value->id}}">
{{--@canany(['survey-edit'])--}}
<a href="{{route('admin.kpi.edit',$value->id)}}" title="Edit" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
{{--@endcan--}}
                                                            {{--                                                            @canany(['survey-delete'])--}}
<a href="{{route('admin.kpi.delete',$value->id)}}" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
{{--                                                            @endcan--}}
                                                            {{--@endif--}}
                                                        </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $kpis->links('backend.layouts.pagination') }}
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
