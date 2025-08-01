@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            {{--<a href="{{route('admin.swapno.total.index')}}" title="Swapno Total" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-th-list"></i>  Swapno Total
                                </button>
                            </a>--}}
{{--                            @canany(['survey-list'])--}}
                        <a style="color: #000;" href="{{route('admin.particular.index')}}" title="{{__('Organization::message.ListButton')}}" class="module_button_header">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-th-list"></i> {{__('Survey::message.ListButton')}}
                            </button>
                        </a>
{{--                            @endcan--}}
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
                            {{$PageTitle}}
                        </div>
                        <div class="card-body">

                            @include('backend.layouts.message')

                            {!! Form::open(['route' => 'admin.particular.store','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true, 'id'=>'basic-form', 'class' => '']) !!}

                            @include('Swapno::particular._form')

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('PerPageCustomJs')
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

