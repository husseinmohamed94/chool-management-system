@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.zoomintrgation')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.zoomintrgation')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> </h4>
                <h3>{{trans('main_trans.add_zoomintrgation')}}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">    {{trans('main_trans.zoomintrgation')}}</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                  @endforeach
                          </ul>
                </div>
              @endif --}}

                    <form method="post"  action="{{ route('indirect.store') }}" autocomplete="" enctype="multipart/form-data">
                        @csrf


                        <div class="row">

                            <div class="col-md-4">
                                <label for="inputName"
                                       class="control-label">{{ trans('onlineclasses_trans.Grade') }}</label>
                                <select name="Grade_id" class="custom-select"
                                        onchange="console.log($(this).val())">
                                    <!--placeholder-->
                                    <option value="" selected
                                            disabled>{{ trans('onlineclasses_trans.Grade') }}
                                    </option>
                                    @foreach ($Grades as $Grade)
                                        <option value="{{ $Grade->id }}"> {{ $Grade->Name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('Grade_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>


                            <div class="col-md-4">
                                <label for="inputName"
                                       class="control-label">{{ trans('onlineclasses_trans.classrooms') }}</label>
                                <select name="Classroom_id" class="custom-select">

                                </select>
                                @error('Classroom_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div><br>

                            <div class="col-md-4">
                                <label for="section_id">{{trans('onlineclasses_trans.section')}} : </label>
                                <select class="custom-select mr-sm-2" name="section_id" required>
                                </select>
                                @error('section_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                        </div><br>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{trans('onlineclasses_trans.meeting_id')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="meeting_id"  class="form-control">
                                </div>
                                @error('topic')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{trans('onlineclasses_trans.topic')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="topic"  class="form-control">
                                </div>
                                @error('topic')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{trans('onlineclasses_trans.start_at')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="start_time" type="date" >
                                </div>
                                @error('start_at')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{trans('onlineclasses_trans.duration')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="duration" type="text" >
                                </div>
                                @error('duration')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{trans('onlineclasses_trans.password')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="password" type="password" >
                                </div>
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('onlineclasses_trans.start_url')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="start_url"  class="form-control">
                                </div>
                                @error('start_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('onlineclasses_trans.join_url')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="join_url"  class="form-control">
                                </div>
                                @error('join_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('onlineclasses_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render




    <script>
        $(document).ready(function () {
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classes') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Class_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>




@endsection
