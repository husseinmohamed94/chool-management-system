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
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('library.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('llibrary_trans.Add_library')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('llibrary_trans.name')}}</th>
                                            <th>{{trans('llibrary_trans.Grade')}}</th>
                                            <th>{{trans('llibrary_trans.classrooms')}}</th>
                                            <th>{{trans('llibrary_trans.section')}}</th>
                                            <th>{{trans('llibrary_trans.teacher')}}</th>
                                            <th>{{trans('llibrary_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($librarys as $library)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$library->title}}</td>
                                                <td>{{$library->grade->Name}}</td>
                                                <td>{{$library->classroom->Name_class}}</td>
                                                <td>{{$library->section->Name_section}}</td>
                                                <td>{{$library->teacher->Name}}</td>
                                                <td>
                                                    <a href="{{route('library.download',$library->file_name)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-download"></i></a>
                                                    <a href="{{route('library.edit',$library->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Student{{ $library->id }}" title="{{ trans('llibrary_trans.Delete') }}"><i class="fa fa-trash"></i></button>

                                                </td>
                                            </tr>
                                        @include('pages.library.Delete')
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
