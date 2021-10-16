@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.Exams')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.Exams')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> </h4>
                <h3>{{trans('quizz_trans.Add_quizz')}}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">    {{trans('main_trans.Exams')}}</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post"  action="{{ route('Quizzs.store') }}" autocomplete="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('quizz_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('quizz_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" type="text" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="inputState">{{trans('quizz_trans.Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="Grade_id" required>
                                    <option selected disabled>{{trans('quizz_trans.Choose')}}...</option>
                                    @foreach($Grades as $Grade)
                                        <option value="{{$Grade->id}}">{{$Grade->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="Classroom_id">{{trans('quizz_trans.classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id" required>

                                </select>
                            </div>

                            <div class="col">
                                <label for="section_id">{{trans('quizz_trans.section')}} : </label>
                                <select class="custom-select mr-sm-2" name="section_id" required>

                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName"
                                       class="control-label">{{ trans('Section_trans.name_teacher') }}</label>
                                <select  name="subject_id" class="custom-select">
                                    <!--placeholder-->
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"> {{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName"
                                       class="control-label">{{ trans('Section_trans.name_teacher') }}</label>
                                <select  name="teacher_id" class="custom-select">
                                    <!--placeholder-->
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"> {{ $teacher->Name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('quizz_trans.submit')}}</button>
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



s
