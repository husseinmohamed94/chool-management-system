@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.subject')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.subject')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> </h4>
                <h3>{{trans('main_trans.Add_subject')}}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">    {{trans('main_trans.subject')}}</li>
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

                    <form method="post"  action="{{ route('Subject.store') }}" autocomplete="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Subject_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar"  class="form-control">
                                </div>
                                @error('name_ar')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Subject_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" type="text" >
                                </div>
                                @error('name_en')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <label for="inputName"
                                       class="control-label">{{ trans('Section_trans.seion_grade') }}</label>
                                <select name="Grade_id" class="custom-select"
                                        onchange="console.log($(this).val())">
                                    <!--placeholder-->
                                    <option value="" selected
                                            disabled>{{ trans('Section_trans.seion_grade') }}
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
                                       class="control-label">{{ trans('Section_trans.name_class') }}</label>
                                <select name="Class_id" class="custom-select">

                                </select>
                                @error('Class_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div><br>


                            <div class="col-md-4">
                                <label for="inputName"
                                       class="control-label">{{ trans('Section_trans.name_teacher') }}</label>
                                <select  name="teacher_id" class="custom-select">
                                    <option value="">حدد من القائمة</option>

                                    <!--placeholder-->
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"> {{ $teacher->Name }}</option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div><br>


                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Subject_trans.submit')}}</button>
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
