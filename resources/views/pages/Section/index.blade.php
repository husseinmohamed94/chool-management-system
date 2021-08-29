@extends('layouts.master')
@section('css')

@section('title')
    {{trans('main_trans.sections')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('main_trans.sections')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">    {{trans('main_trans.sections')}}</li>
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

                    <button type="button" class="button x-small" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">
                        {{trans('Section_trans.add_section')}}
                    </button>
                </div>


                    <div class="card card-statistics h-100">
                        <div class="card-body">

                            <div class="accordion gray plus-icon round">
                                @foreach($grades as $grade)
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
                                                                    <th>{{ trans('Section_trans.Name_section') }}
                                                                    </th>
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

                                                                                <a href="#"
                                                                                   class="btn btn-outline-info btn-sm"
                                                                                   data-toggle="modal"
                                                                                   data-target="#edit{{ $Listsection->id }}">{{ trans('Section_trans.Edit') }}</a>
                                                                                <a href="#"
                                                                                   class="btn btn-outline-danger btn-sm"
                                                                                   data-toggle="modal"
                                                                                   data-target="#delete{{ $Listsection->id }}">{{ trans('Section_trans.Delete') }}</a>
                                                                            </td>
                                                                    </tr>

                                                                    <!--تعديل قسم جديد -->
                                                                    <div class="modal fade"
                                                                         id="edit{{ $Listsection->id }}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLabel"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        style="font-family: 'Cairo', sans-serif;"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('Section_trans.edit_Section') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <form action="{{ route('Section.update', 'test') }}"
                                                                                        method="POST">
                                                                                        {{ method_field('patch') }}
                                                                                        {{ csrf_field() }}
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                       name="Name_section_ar"
                                                                                                       class="form-control"
                                                                                                       value="{{ $Listsection->getTranslation('Name_section', 'ar') }}">
                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                       name="Name_section_en"
                                                                                                       class="form-control"
                                                                                                       value="{{ $Listsection->getTranslation('Name_section', 'en') }}">
                                                                                                <input id="id"
                                                                                                       type="hidden"
                                                                                                       name="id"
                                                                                                       class="form-control"
                                                                                                       value="{{ $Listsection->id }}">
                                                                                            </div>

                                                                                        </div>
                                                                                        <br>


                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                   class="control-label">{{ trans('Section_trans.seion_grade') }}</label>
                                                                                            <select name="Grade_id"
                                                                                                    class="custom-select"
                                                                                                    onclick="console.log($(this).val())">
                                                                                                <!--placeholder-->
                                                                                                <option
                                                                                                    value="{{ $grade->id }}">
                                                                                                    {{ $grade->Name }}
                                                                                                </option>
                                                                                                @foreach ($List_grades as $list_Grade)
                                                                                                    <option
                                                                                                        value="{{ $list_Grade->id }}">
                                                                                                        {{ $list_Grade->Name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                   class="control-label">{{ trans('Section_trans.name_class') }}</label>
                                                                                            <select name="Class_id"
                                                                                                    class="custom-select">
                                                                                                <option
                                                                                                    value="{{ $Listsection->Myclasses->id }}">
                                                                                                    {{ $Listsection->Myclasses->Name_Class }}
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <div class="form-check">

                                                                                                @if ($Listsection->Status === 1)
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        checked
                                                                                                        class="form-check-input"
                                                                                                        name="Status"
                                                                                                        id="exampleCheck1">
                                                                                                @else
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="form-check-input"
                                                                                                        name="Status"
                                                                                                        id="exampleCheck1">
                                                                                                @endif
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="exampleCheck1">{{ trans('Section_trans.Status') }}</label><br>
                                                                                            </div>
                                                                                        </div>
                                                                                            <div class="col">
                                                                                                    <label for="inputName" class="control-label">{{ trans('Section_trans.name_teacher') }}</label>
                                                                                                    <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                                                                                        @foreach($Listsection->teachers as $teacher)
                                                                                                            <option selected value="{{$teacher['id']}}">{{$teacher['Name']}}</option>
                                                                                                        @endforeach

                                                                                                        @foreach($teachers as $teacher)
                                                                                                            <option value="{{$teacher->id}}">{{$teacher->Name}}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">{{ trans('Section_trans.close') }}</button>
                                                                                            <button type="submit"
                                                                                                    class="btn btn-danger">{{ trans('Section_trans.submit') }}</button>
                                                                                        </div>
                                                                                    </div>
                                                                            </div>


                                                                                    </form>
                                                                                </div>
                                                                            </div>


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

        <!-- Add Section -->
        <div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                        <form action="{{route('Section.store','test')}}" method="post" autocomplete="off">
                            {{csrf_field()}}


                            <div class="row">
                                <div class=col">
                                    <label for="Name">{{trans('Section_trans.add_setion_name_ar')}}</label>
                                    <input type="text" class="form-control" id="Name_section_ar" name="Name_section_ar" value="" >
                                </div>
                                <div class=col">
                                    <label for="Name_en">{{trans('Section_trans.add_setion_name_en')}}</label>
                                    <input type="text" class="form-control" id="Name_section_en" name="Name_section_en"  value="" >
                                </div>

                            </div>
                            <div class="col">
                                <label for="inputName"
                                       class="control-label">{{ trans('Section_trans.seion_grade') }}</label>
                                <select name="Grade_id" class="custom-select"
                                        onchange="console.log($(this).val())">
                                    <!--placeholder-->
                                    <option value="" selected
                                            disabled>{{ trans('Section_trans.seion_grade') }}
                                    </option>
                                    @foreach ($List_grades as $list_Grade)
                                        <option value="{{ $list_Grade->id }}"> {{ $list_Grade->Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>




                            <div class="col">
                                <label for="inputName"
                                       class="control-label">{{ trans('Section_trans.name_class') }}</label>
                                <select name="Class_id" class="custom-select">

                                </select>
                            </div><br>


                            <div class="col">
                                <label for="inputName"
                                       class="control-label">{{ trans('Section_trans.name_teacher') }}</label>
                                <select multiple name="teacher_id[]" class="custom-select">
                                    <!--placeholder-->
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"> {{ $teacher->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit"> {{trans('Section_trans.Save')}}</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Section_trans.close')}}</button>
                    </div>
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




    <script>
        $(document).ready(function () {
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classes') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Class_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>




@endsection
