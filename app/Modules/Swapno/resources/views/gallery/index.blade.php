@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">

                            <a href="{{route('admin.gallery.create','gallery')}}" title="{{__('Survey::message.CreateButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus-circle"></i>  Create Gallery
                                </button>
                            </a>

                            <a href="{{route('admin.gallery.create','resource')}}" title="{{__('Survey::message.CreateButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus-circle"></i>  Create Resource
                                </button>
                            </a>

                            @if($type=='all' || $type=='gallery')
                            <a style="color: #000;" href="{{route('admin.gallery.index','resource')}}" title="{{__('Survey::message.ListButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-th-list"></i> Resource List
                                </button>
                            </a>
                            @endif

                            @if($type=='all' || $type=='resource')

                            <a style="color: #000;" href="{{route('admin.gallery.index','gallery')}}" title="{{__('Survey::message.ListButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-th-list"></i> Gallery List
                                </button>
                            </a>
                            @endif

                            <a style="color: #000;" href="{{route('admin.gallery.index','all')}}" title="{{__('Survey::message.ListButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-th-list"></i> List
                                </button>
                            </a>

                            {{--<?php
                            $TultipMessage = __('Survey::message.HintsMsg');
                            ?>

                            <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                               title="{{$TultipMessage}}">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-question-circle"></i> {{__('Survey::message.Hints')}}
                                </button>
                            </a>--}}
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

                            @if(isset($galleries) && !empty($galleries))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered" id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($galleries as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$value->file_type=='gallery'?'Gallery':'Resource'}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>

                                                        <span class="allbutton{{$value->id}}">
<a href="{{route('admin.gallery.edit',$value->id)}}" title="Edit" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
<a href="{{route('admin.gallery.delete',$value->id)}}" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                                        </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $galleries->links('backend.layouts.pagination') }}
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
