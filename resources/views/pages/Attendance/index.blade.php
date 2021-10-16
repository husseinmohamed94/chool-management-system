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

                                <div class="accordion gray plus-icon round">
                                    @foreach($Grades as $grade)
                                        <div class="acd-group">
                                            <a href="#" class="acd-heading">{{$grade->Name}}</a>
                                            <div class="acd-des">

                                                <div class="row">
                                                    <div class="col-xl-12 mb-30">
                                                        <div class="card card-statistics h-100">
                                                            <div class="card-body">
                                                                <div class="d-block d-md-flex justify-content-between">
                                                                    <div class="d-block">
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive mt-15">
                                                                    <table class="table center-aligned-table mb-0">
                                                                        <thead>
                                                                        <tr class="text-dark">
                                                                            <th>#</th>
                                                                            <th>{{ trans('Section_trans.Name_section') }}</th>
                                                                            <th>{{ trans('Section_trans.name_class') }}</th>
                                                                            <th>{{ trans('Section_trans.Status') }}</th>
                                                                            <th>{{ trans('Section_trans.Processes') }}</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php $i= 0; ?>
                                                                        @foreach($grade->Section as $Listsection)
                                                                            <tr>
                                                                                <?php $i++; ?>
                                                                                <td>{{$i}}</td>
                                                                                <td>{{$Listsection->Name_section}}</td>
                                                                                <td>{{$Listsection->Myclasses->Name_class}}</td>
                                                                                <td>
                                                                                    @if ($Listsection->Status === 1)
                                                                                        <label
                                                                                            class="badge badge-success">{{ trans('Section_trans.Status_Section_AC') }}</label>
                                                                                    @else
                                                                                        <label
                                                                                            class="badge badge-danger">{{ trans('Section_trans.Status_Section_No') }}</label>
                                                                                    @endif

                                                                                </td>
                                                                                <td>

                                                                                    <a href="{{route('Attendance.show',$Listsection->id)}}" class="btn btn-outline-info btn-sm">{{ trans('Attendanec_trans.mune_studentd') }}</a>

                                                                                </td>
                                                                            </tr>




                                                                </div>


                                                                <!-- delete_modal_Grade -->
                                                                <div class="modal fade"
                                                                     id="delete{{ $Listsection->id }}"
                                                                     tabindex="-1" role="dialog"
                                                                     aria-labelledby="exampleModalLabel"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                    class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    {{ trans('Section_trans.Delete') }}
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="{{ route('Section.destroy', 'test') }}"
                                                                                    method="post">
                                                                                    {{ method_field('Delete') }}
                                                                                    @csrf
                                                                                    {{ trans('Section_trans.Warning_Section') }}
                                                                                    <input id="id" type="hidden"
                                                                                           name="id"
                                                                                           class="form-control"
                                                                                           value="{{ $Listsection->id }}">
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">{{ trans('Section_trans.close') }}</button>
                                                                                        <button type="submit"
                                                                                                class="btn btn-danger">{{ trans('Section_trans.Delete') }}</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @endforeach
                                                                </tbody>

                                                                </table>
                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                </div>

                                @endforeach
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
