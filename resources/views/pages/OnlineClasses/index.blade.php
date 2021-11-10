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
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('online_Classes.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('onlineclasses_trans.Add_onlineclaass')}}</a>
                                <a href="{{route('indirect.create')}}" class="btn btn-warning btn-sm" role="button"
                                   aria-pressed="true">{{trans('onlineclasses_trans.Add_oflineclaass')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('onlineclasses_trans.Grade')}}</th>
                                            <th>{{trans('onlineclasses_trans.classrooms')}}</th>
                                            <th>{{trans('onlineclasses_trans.section')}}</th>
                                            <th>{{trans('onlineclasses_trans.teacher')}}</th>
                                            <th>{{trans('onlineclasses_trans.topic')}}</th>
                                            <th>{{trans('onlineclasses_trans.start_at')}}</th>
                                            <th>{{trans('onlineclasses_trans.duration')}}</th>
                                            <th>{{trans('onlineclasses_trans.join_url')}}</th>
                                            <th>{{trans('onlineclasses_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($OnlineClasses as $OnlineClass)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$OnlineClass->grade->Name}}</td>
                                                <td>{{$OnlineClass->classroom->Name_class}}</td>
                                                <td>{{$OnlineClass->section->Name_section}}</td>
                                                <td>{{$OnlineClass->users->name}}</td>
                                                <td>{{$OnlineClass->topic}}</td>
                                                <td>{{$OnlineClass->start_at}}</td>
                                                <td>{{$OnlineClass->duration}}</td>
                                                <td class="text-danger"><a href="{{$OnlineClass->join_url}}" target="_blank">انضم الان</a></a> </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Student{{ $OnlineClass->id }}" title="{{ trans('onlineclasses_trans.Delete') }}"><i class="fa fa-trash"></i></button>

                                                </td>
                                            </tr>
                                        @include('pages.OnlineClasses.Delete')
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
