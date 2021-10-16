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
                                <a href="{{route('Quizzs.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('quizz_trans.Add_subject')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('quizz_trans.name')}}</th>
                                            <th>{{trans('quizz_trans.teacher')}}</th>
                                            <th>{{trans('quizz_trans.Grade')}}</th>
                                            <th>{{trans('quizz_trans.classrooms')}}</th>
                                            <th>{{trans('quizz_trans.section')}}</th>
                                            <th>{{trans('quizz_trans.subject')}}</th>
                                            <th>{{trans('quizz_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzs as $quizz)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$quizz->name}}</td>
                                                <td>{{ $quizz->teacher->Name   }}</td>
                                                <td>{{$quizz->grade->Name}}</td>
                                                <td>{{$quizz->classroom->Name_class}}</td>
                                                <td>{{  $quizz->Section->Name_section }}</td>
                                                <td>{{ $quizz->subject->name   }}</td>

                                                <td>
                                                    <a href="{{route('Quizzs.edit',$quizz->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Student{{ $quizz->id }}" title="{{ trans('quizz_trans.Delete') }}"><i class="fa fa-trash"></i></button>

                                                </td>
                                            </tr>
                                        @include('pages.Quizzs.Delete')
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
