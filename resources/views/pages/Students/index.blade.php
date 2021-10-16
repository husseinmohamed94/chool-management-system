@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.list_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.list_students')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> </h4>
                <h3>{{trans('main_trans.Add_students')}}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">    {{trans('main_trans.list_students')}}</li>
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
                                <a href="{{route('Students.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_trans.Add_students')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.name')}}</th>
                                            <th>{{trans('Students_trans.email')}}</th>
                                            <th>{{trans('Students_trans.gender')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->gender->Name}}</td>
                                                <td>{{$student->grade->Name}}</td>
                                                <td>{{$student->classroom->Name_class}}</td>
                                                <td>{{$student->section->Name_section}}</td>
                                                <td>

                                                    <!-- Example single danger button -->
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{trans('Students_trans.Processes')}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{route('Students.show',$student->id)}}" class="dropdown-item " role="button" aria-pressed="true"><i class="fa fa-eye bg-warning"></i>  {{ trans('Students_trans.show') }}</a>
                                                            <a href="{{route('Students.edit',$student->id)}}" class="dropdown-item" role="button" aria-pressed="true"><i class="fa fa-edit bg-success"></i>  {{ trans('Students_trans.edit') }}</a>
                                                            <a href="{{route('FeeInvoices.show',$student->id)}}" class="dropdown-item " role="button" aria-pressed="true"><i class="fa fa-eye bg-warning "></i>  {{ trans('Students_trans.show_invoices') }}</a>
                                                            <a href="{{route('ReceiptStudents.show',$student->id)}}" class="dropdown-item " role="button" aria-pressed="true"><i class="fa fa-eye bg-warning "></i>  {{ trans('Students_trans.Receipt_Students') }}</a>
                                                            <a href="{{route('ProcessingFee.show',$student->id)}}" class="dropdown-item " role="button" aria-pressed="true"><i class="fa fa-eye bg-dribbble"></i>  {{ trans('Students_trans.Processing_Students') }}</a>
                                                            <a href="{{route('PaymentSudents.show',$student->id)}}" class="dropdown-item " role="button" aria-pressed="true"><i class="fa fa-eye bg-dribbble"></i>  {{ trans('Students_trans.PaymentSudents') }}</a>
                                                            <a type="button" class="dropdown-item " data-toggle="modal" data-target="#Delete_Student{{ $student->id }}" title=""><i class="fa fa-trash bg-danger"></i>  {{ trans('Students_trans.delete') }}</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @include('pages.Students.graduate.Delete')
                                        @include('pages.Students.Delete')
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
