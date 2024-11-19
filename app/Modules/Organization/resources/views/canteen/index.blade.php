@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">Manage Canteen</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            @canany(['organization-create'])
                            <a href="{{route('admin.canteen.create')}}" title="{{__('Organization::message.CreateButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus-circle"></i>  {{__('Organization::message.CreateButton')}}
                                </button>
                            </a>
                            @endcan


                            <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                               title="">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-question-circle"></i> {{__('Organization::message.Hints')}}
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

                            @if(isset($canteens) && !empty($canteens))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered" id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        <th>Organization</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($canteens as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$value->organization->name}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>
                                                    <?php
                                                        if (isset($value) && ($value->status == 1)){
                                                            $checked = 'checked';
                                                            $CheckValue = 0;
                                                        }else{
                                                            $checked = '';
                                                            $CheckValue = 1;
                                                        }
                                                    ?>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input isChecked setvalue{{$value->id}}" type="checkbox" style="text-align: center" id="flexSwitchCheckChecked" {{$checked}} dbTable = 'sur_canteen' value="{{$CheckValue}}" data-id="{{$value->id}}" data-href="{{route('admin.status.change')}}" onchange="getCheckboxValue(this.value,this.data-id)">
                                                    </div>
                                                </td>
                                                <td>
                                                    @php
                                                        if ($value->status == 1){
                                                            $style = '';
                                                        }else{
                                                            $style = 'display:none';
                                                        }
                                                    @endphp
                                                    <span class="allbutton{{$value->id}}" style="{{$style}}">

{{--                                                    @if(isset($value) && ($value->status == 1))--}}
                                                        @canany(['organization-edit'])
                                                    <a href="{{route('admin.canteen.edit',$value->id)}}" title="Edit Brand" class="text-primary"><i class="fas fa-pencil-alt"></i></a>@endcan
{{--                                                    <a href="{{route('admin.canteen.inactive',$value->id)}}" title="Delete From List" onclick="return confirm('Are you sure to remove from this list?')" class="text-warning"><i class="fas fa-ban"></i></a>--}}
                                                        {{--@canany(['organization-delete'])
                                                    <a href="{{route('admin.canteen.delete',$value->id)}}" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>@endcan--}}
{{--                                                    @endif--}}
                                                                                                            </span>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $canteens->links('backend.layouts.pagination') }}
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
