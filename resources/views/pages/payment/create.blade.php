@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.PaymentSudents')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.PaymentSudents')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> </h4>
                <h3>{{trans('Students_trans.PaymentSudents')}}{{$student->name}}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">    {{trans('main_trans.PaymentSudents')}}</li>
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

                    <form method="post"  action="{{ route('PaymentSudents.store') }}" autocomplete="" enctype="multipart/form-data">
                        @csrf


                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.debit')}} : <span class="text-danger">*</span></label>
                                    <input  type="number" name="Debit"  class="form-control">
                                    <input  type="hidden" name="student_id"  value="{{$student->id}}" class="form-control">
                                </div>
                            </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.final_balance')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="final_balance"   value="{{number_format($student->studentaccount->sum('Debit')  - $student->studentaccount->sum('credit'),2) }}"  readonly  class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">

                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.description')}} : <span class="text-danger">*</span></label>
                                    <textarea  class="form-control" name="description"  ></textarea>
                                </div>
                            </div>
                        </div>







                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
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


@endsection
