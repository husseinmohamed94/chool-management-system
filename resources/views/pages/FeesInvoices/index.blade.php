@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.tuition_fees')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.tuition_fees')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('Fee.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('Fees_trans.Add_fee')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Fees_trans.title')}}</th>
                                            <th>{{trans('Fees_trans.amount')}}</th>
                                            <th>{{trans('Fees_trans.Grade')}}</th>
                                            <th>{{trans('Fees_trans.classrooms')}}</th>
                                            <th>{{trans('Fees_trans.description')}}</th>
                                            <th>{{trans('Fees_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fee_invoices as $fee_invoice)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$fee_invoice->students->name}}</td>
                                                <td>{{$fee_invoice->amount}}</td>
                                                <td>{{$fee_invoice->grade->Name}}</td>
                                                <td>{{$fee_invoice->classroom->Name_class}}</td>

                                                <td>{{$fee_invoice->description}}</td>
                                                <td>
                                                    <a href="{{route('FeeInvoices.edit',$fee_invoice->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_invoice{{ $fee_invoice->id }}" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>

                                                </td>
                                            </tr>
                                        @include('pages.FeesInvoices.Delete')
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
