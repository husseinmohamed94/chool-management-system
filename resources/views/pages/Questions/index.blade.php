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
                <h3>{{trans('main_trans.Add_subject')}}</h3>
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
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('questions.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('question_trans.Add_question')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('question_trans.titel')}}</th>
                                            <th>{{trans('question_trans.answers')}}</th>
                                            <th>{{trans('question_trans.right_answer')}}</th>
                                            <th>{{trans('question_trans.subject')}}</th>
                                            <th>{{trans('question_trans.score')}}</th>
                                            <th>{{trans('question_trans.Processes')}}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($questions as $question)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$question->title}}</td>
                                                <td>{{ $question->answers   }}</td>
                                                <td>{{$question->right_answer}}</td>
                                                <td>{{$question->quizze->name}}</td>
                                                <td>{{$question->score}}</td>


                                                <td>
                                                    <a href="{{route('questions.edit',$question->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Student{{ $question->id }}" title="{{ trans('quizz_trans.Delete') }}"><i class="fa fa-trash"></i></button>

                                                </td>
                                            </tr>
                                        @include('pages.Questions.Delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
