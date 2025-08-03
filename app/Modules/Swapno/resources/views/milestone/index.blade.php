@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">

                            <a href="{{route('admin.milestone.create')}}" title="{{__('Survey::message.CreateButton')}}" class="module_button_header">
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

                            @if(isset($milestones) && !empty($milestones))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered" id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($milestones as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$value->particular->name}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>{{$value->slug}}</td>
                                                <td>{{$value->is_active==1?'Active':'Inactive'}}</td>
                                                <td>

                                                        <span class="allbutton{{$value->id}}">
<a href="{{route('admin.milestone.edit',$value->id)}}" title="Edit" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
<a href="{{route('admin.milestone.delete',$value->id)}}" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                                        </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $milestones->links('backend.layouts.pagination') }}
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
    <script>
        $(document).on('click','#is_featured',function(e) {
            let entityId= $(this).attr('data-id');
            if(entityId==''){
                alert('This record are not available');
                return false;
            }

            jQuery.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/admin-particular-feature/' + entityId,
                data: {},
                success: function (data) {alert(data.message)}
            });
        });

    </script>
@endpush
