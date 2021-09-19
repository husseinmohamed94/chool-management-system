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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post"  action="{{ route('Fee.store') }}" autocomplete="" >
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('Fees_trans.title_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="title_ar"  class="form-control">
                                </div>_
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('Fees_trans.title_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="title_en" type="text" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('Fees_trans.amount')}} : </label>
                                    <input type="number" value=""  name="amount" class="form-control" >
                                </div>

                        </div>

                        </div>
                          <div class="row">
                                 <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputState">{{trans('Fees_trans.Grade')}}</label>
                                    <select class="custom-select mr-sm-2" name="Grade_id" required>
                                        <option selected disabled>{{trans('Fees_trans.Choose')}}...</option>
                                        @foreach($Grades as $Grade)
                                            <option value="{{$Grade->id}}">{{$Grade->Name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                 <div class="col-md-3">
                                     <div class="form-group ">
                                         <label for="Classroom_id">{{trans('Fees_trans.classrooms')}} : <span
                                            class="text-danger">*</span></label>
                                         <select class="custom-select mr-sm-2" name="Classroom_id" required>

                                         </select>
                                     </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="academic_year">{{trans('Fees_trans.academic_year')}} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="academic_year">
                                            <option selected disabled>{{trans('Fees_trans.Choose')}}...</option>
                                            @php
                                                $current_year = date("Y");
                                            @endphp
                                            @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                                <option value="{{ $year}}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                              <div class="col-md-3">
                                  <div class="form-group ">
                                      <label for="fee_type">{{trans('Fees_trans.fee_type')}} : <span
                                              class="text-danger">*</span></label>
                                      <select class="custom-select mr-sm-2" name="feetype" required>
                                        <option value="1">{{trans('Fees_trans.fee_type_ture')}}</option>
                                        <option value="2">{{trans('Fees_trans.fee_type_bus')}}</option>
                                      </select>
                                  </div>
                              </div>

                            </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputState">{{trans('Fees_trans.Grade')}}</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Fees_trans.submit')}}</button>
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
