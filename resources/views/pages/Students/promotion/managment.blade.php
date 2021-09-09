@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.Department_promotion_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.Department_promotion_students')}}
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
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all_promation">
                                   ترجع الكل
                                </button>

                                <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{trans('promotions_trans.name')}}</th>
                                            <th class="alert-danger">{{trans('promotions_trans.Grade')}}</th>
                                            <th class="alert-danger">{{trans('promotions_trans.classrooms')}}</th>
                                            <th class="alert-danger">{{trans('promotions_trans.section')}}</th>
                                            <th class="alert-danger">{{trans('promotions_trans.academic_year')}}</th>
                                            <th class="alert-success">{{trans('promotions_trans.Grade_new')}}</th>
                                            <th class="alert-success">{{trans('promotions_trans.classrooms_new')}}</th>
                                            <th class="alert-success">{{trans('promotions_trans.section_new')}}</th>
                                            <th class="alert-success">{{trans('promotions_trans.academic_year_new')}}</th>
                                            <th>{{trans('promotions_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td class="alert-info">{{ $loop->index+1 }}</td>
                                                <td class="alert-info">{{$promotion->students->name}}</td>
                                                <td class="alert-danger">{{$promotion->f_grade->Name}}</td>
                                                <td class="alert-danger">{{$promotion->f_classroom->Name_class}}</td>
                                                <td class="alert-danger">{{$promotion->f_section->Name_section}}</td>
                                                <td class="alert-danger">{{$promotion->academic_year}}</td>
                                                <td class="alert-success">{{$promotion->t_grade->Name}}</td>
                                                <td class="alert-success">{{$promotion->t_classroom->Name_class}}</td>
                                                <td class="alert-success">{{$promotion->t_section->Name_section}}</td>
                                                <td class="alert-success">{{$promotion->academic_year_new}}</td>

                                                <td>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_one{{ $promotion->id }}">{{ trans('promotions_trans.Delete_one') }}</button>
                                                    <button type="button" class="btn btn-success  btn-sm" data-toggle="modal" data-target="#">{{ trans('promotions_trans.outpromotion') }}</button>

                                                </td>
                                            </tr>
                                        @include('pages.Students.promotion.Delete_all')
                                        @include('pages.Students.promotion.Delete_one')
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
