@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.garde')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.garde')}}</h4>
            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">{{trans('Grades_trans.add_grade')}}</a>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.garde')}}</li>
            </ol>
        </div>
    </div>
</div>
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
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                           style="text-align: center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('Grades_trans.Name')}}</th>
                            <th>{{trans('Grades_trans.Note')}}</th>
                            <th>{{trans('Grades_trans.Processes')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                         @php $i =0; @endphp
                         @foreach($grades as $grade)
                             @php $i++ @endphp
                     <tr>
                         <td>{{$i}}</td>
                        <td>{{$grade->Name}}</td>
                        <td>{{$grade->Notes}}</td>
                         <td>

                                 <button class="modal-effect btn btn btn-outline-success  btn-sm " data-effect="effect-scale"
                                        data-toggle="modal" href="#edit_grade"
                                         title="{{trans('Grades_trans.edit')}}">{{trans('Grades_trans.edit')}}<i class="las la-pen"></i></button>

                                 <button class="modal-effect btn btn-sm btn-outline-danger" data-effect="effect-scale"
                                         data-toggle="modal"
                                         href="#delete_grades" title="{{trans('Grades_trans.delete')}}">{{trans('Grades_trans.delete')}}<i class="las la-trash"></i></button>

                         </td>
                        </tr>
                         @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>


<!-- row closed -->
</div>
<!-- Basic modal -->
<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{trans('Grades_trans.add_grade')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('Grades.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class=col-6">
                            <label for="Name" class="mr-sm-2">{{trans('Grades_trans.add_grade_name_ar')}}</label>
                            <input type="text" class="form-control" id="Name" name="Name" required >
                        </div>
                        <div class=col-6">
                            <label for="Name_en" class="mr-sm-2">{{trans('Grades_trans.add_grade_name_en')}}</label>
                            <input type="text" class="form-control mr-sm-6" id="Name_en" name="Name_en"  required>
                        </div>
                    <div class="col-12">
                        <label for="exampleInput">{{trans('Grades_trans.Note')}} </label>
                        <input type="text" class="form-control mr-sm-6" id="Notes" name="Notes" >
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit"> {{trans('Grades_trans.save')}}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Grades_trans.close')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Basic modal -->


<!-- edit -->
<div class="modal fade" id="edit_grade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="post" autocomplete="off">
                    {{method_field('patch')}}
                    {{csrf_field()}}


                 <div class="row">
                    <div class=col">
                        <label for="Name">{{trans('Grades_trans.add_grade_name_ar')}}</label>
                        <input type="text" class="form-control" id="Name" name="Name" >
                    </div>
                     <div class=col">
                        <label for="Name_en">{{trans('Grades_trans.add_grade_name_en')}}</label>
                        <input type="text" class="form-control" id="Name_en" name="Name_en" >
                    </div>

                 </div>
                    <div class="form-group">
                        <label for="exampleInput">{{trans('Grades_trans.Note')}} </label>
                        <input type="text" class="form-control" id="Notes" name="Notes" >
                    </div>



            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit"> {{trans('Grades_trans.save')}}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Grades_trans.close')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- delete -->
<div class="modal" id="delete_grades">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                              type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
                <div class="modal-body">
                    <p>{{trans('Grades_trans.delete_grade')}}</p><br>
                    <input type="hidden" name="pro_id" id="pro_id" value="">
                    <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Grades_trans.close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('Grades_trans.save')}}</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

@endsection
@section('js')

        @toastr_js
        @toastr_render
@endsection
