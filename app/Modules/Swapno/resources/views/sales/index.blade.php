@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">

                            <a href="{{route('admin.sales.create')}}" title="{{__('Survey::message.CreateButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus-circle"></i>  {{__('Survey::message.CreateButton')}}
                                </button>
                            </a>

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
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link {{$activeTab==='all'?'active':''}}" href="{{route('admin.sales.index','all')}}">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{$activeTab==='organization'?'active':''}}" href="{{route('admin.sales.index','organization')}}">Organization Wise</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{$activeTab==='category'?'active':''}}" href="{{route('admin.sales.index','category')}}">Category Wise</a>
                                </li>
                            </ul>
                            <br>
                            @if(isset($sales) && !empty($sales))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered" id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        <th>Organization</th>
                                        @if($activeTab!='organization')
                                            <th>Category</th>
                                        @endif
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($sales as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$value->organization_name}}</td>
                                                @if($activeTab!='organization')
                                                    <td>{{$value->category_name}}</td>
                                                @endif
                                                <td>{{$value->month}}</td>
                                                <td>{{$value->year}}</td>
                                                <td>{{$value->total_sales_quantity}}</td>
                                                <td>{{$value->total_sales_amount}}</td>
                                                <td style="color: {{$value->is_active==1?'':'red'}}">{{$value->is_active==1?'Acyive':'Inactive'}}</td>
                                                <td>

                                                        <span class="allbutton{{$value->id}}">
{{--@canany(['survey-edit'])--}}
<a href="{{route('admin.sales.edit',$value->id)}}" title="Edit" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
{{--@endcan--}}

                                                            @if($value->is_active)
<a href="{{route('admin.sales.delete',$value->id)}}" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                                            @else
                                                                <a href="{{route('admin.sales.delete',$value->id)}}" title="Restore Delete" onclick="return confirm('Are you sure to restore Delete?')" class="text-danger"><i class="fas fa-window-restore"></i></a>

                                                            @endif

                                                        </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $sales->links('backend.layouts.pagination') }}
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
