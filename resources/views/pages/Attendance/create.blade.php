@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.Attendance')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.Attendance')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> </h4>
                <h3>{{trans('Attendanec_trans.Attendance')}}</h3>
                <h3>{{trans('Attendanec_trans.date')}} : {{date('Y-m-d')}}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">    {{trans('main_trans.Attendance')}}</li>
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

                                <div class="table-responsive">
                                    <form method="post" action="{{route('Attendance.store')}}" >
                                        @csrf
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
                                                    @if(isset($student->attendance()->where('attendence_date',date('Y-m-d'))->first()->student_id))
                                                    <label class="black tex-gray-500 font-somibold sm:pr-4">
                                                        <input name="attndances[{{$student->id}}]" disabled
                                                        {{$student->attendance()->first()->attencene_status == 1 ? 'checked' : ''}}
                                                        class="leading-tight" type="radio" value="presence">
                                                        <span class="text-success">{{trans('Attendanec_trans.presence')}}</span>
                                                    </label>
                                                        <label class="black tex-gray-500 font-somibold sm:pr-4">
                                                        <input name="attndances[{{$student->id}}]" disabled
                                                        {{$student->attendance()->first()->attencene_status == 0 ? 'checked' : ''}}
                                                        class="leading-tight" type="radio" value="absent">
                                                            <span class="text-danger">{{trans('Attendanec_trans.absent')}}</span>

                                                        </label>

                                                     @else
                                                        <label class="black tex-gray-500 font-somibold sm:pr-4">
                                                            <input name="attndances[{{$student->id}}]" class="leading-tight" type="radio" value="presence">
                                                            <span class="text-success">{{trans('Attendanec_trans.presence')}}</span>
                                                        </label>
                                                        <label class="black tex-gray-500 font-somibold sm:pr-4">
                                                            <input name="attndances[{{$student->id}}]" class="leading-tight" type="radio" value="absent">
                                                            <span class="text-danger">{{trans('Attendanec_trans.absent')}}</span>

                                                        </label>
                                                    @endif
                                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                                    <input type="hidden" name="grade_id" value="{{$student->Grade_id}}">
                                                    <input type="hidden" name="classroom_id" value="{{$student->Classroom_id}}">
                                                    <input type="hidden" name="section_id" value="{{$student->section_id}}">
                                                </td>
                                            </tr>
                                        {{-- @include('pages.Students.graduate.Delete')
                                        @include('pages.Students.Delete')--}}
                                        @endforeach
                                    </table>
                                        <p> <button class="btn btn-success" type="submit">{{trans('Attendanec_trans.submit')}}</button></p>
                                    </form>


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
