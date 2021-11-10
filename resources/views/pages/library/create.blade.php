@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.library')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.library')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> </h4>
                <h3>{{trans('main_trans.Add_library')}}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">    {{trans('main_trans.library')}}</li>
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

                    <form method="post"  action="{{ route('library.store') }}" autocomplete="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('llibrary_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="title_ar"  class="form-control">
                                </div>
                                @error('name_ar')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('llibrary_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="title_en" type="text" >
                                </div>
                                @error('name_en')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>

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
                            <div class="col-md-12">
                                <label for="inputName" class="control-label">{{ trans('llibrary_trans.Attachments') }}</label>
                                <input  name="file_name" accept="application/pdf" class="form-control" type="file">
                                @error('filename')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('llibrary_trans.submit')}}</button>
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
