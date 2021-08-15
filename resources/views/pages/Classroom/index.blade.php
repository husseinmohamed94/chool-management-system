@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Class_trans.class')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('Class_trans.class')}}</h4>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Class_trans.class')}}</li>
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
                        <button type="button" class="button x-small" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">{{trans('Class_trans.add_class')}}</button>

                        <button type="button" class="button x-small" id="btn_delete_all" data-effect="effect-scale" data-toggle="modal" href="#btn_delete_all">{{trans('Class_trans.delete_checbox')}}</button>

                        <br><br>
                        <form action="{{ route('Filter_Classes') }}" method="POST">
                            {{ csrf_field() }}
                            <select class="selectpicker" data-style="btn-info" name="Grade_id" required
                                    onchange="this.form.submit()">
                                <option value="" selected disabled>{{ trans('Class_trans.Search_By_Grade') }}</option>
                                @foreach ($grades as $Grade)
                                    <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                @endforeach
                            </select>
                        </form>

                        <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th><input name="select_all" id="exanple-select-all" type="checkbox"
                                           onclick="checkAll('box1',this)"/></th>
                                <th>#</th>
                                <th>{{trans('Class_trans.Name')}}</th>
                                <th>{{trans('Class_trans.Note')}}</th>
                                <th>{{trans('Class_trans.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($details))

                               @php $List_Classes = $details; @endphp
                            @else

                                @php $List_Classes = $classrooms; @endphp
                            @endif

                                @php $i =0; @endphp
                             @foreach($classrooms as $classroom)
                                 @php $i++ @endphp
                         <tr>
                             <td><input value="{{$classroom->id}}" class="box1" type="checkbox"/></td>
                             <td>{{$i}}</td>
                            <td>{{$classroom->Name_class}}</td>
                            <td>{{$classroom->Grades->Name}}</td>
                             <td>

                                     <button class="modal-effect btn btn btn-outline-success  btn-sm " data-effect="effect-scale"
                                            data-toggle="modal" href=""
                                             data-target="#edit_grade{{$classroom->id}}"
                                             title="{{trans('Class_trans.edit')}}">{{trans('Class_trans.edit')}}<i class="fa fa-edit"></i></button>

                                     <button class="modal-effect btn btn-sm btn-outline-danger" data-effect="effect-scale"
                                             data-toggle="modal"
                                             data-target ="#delete_grades{{$classroom->id}}"
                                             href="#delete_grades" title="{{trans('Class_trans.delete')}}">{{trans('Class_trans.delete')}}<i class="fa fa-trash"></i></button>

                             </td>
                            </tr>



                                 <!-- edit -->
                                 <div class="modal fade" id="edit_grade{{$classroom->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                                                 <form action="{{route('classroom.update','test')}}" method="post" autocomplete="off">
                                                     {{method_field('patch')}}
                                                     {{csrf_field()}}


                                                     <div class="row">
                                                         <div class=col">
                                                             <label for="Name">{{trans('Class_trans.add_class_name_ar')}}</label>
                                                             <input type="text" class="form-control" id="Name" name="Name" value="{{ $classroom->getTranslation('Name_class','ar') }}" >
                                                             <input id="id" type="hidden" name="id" class="form-control" value="{{$classroom->id}}" >
                                                         </div>
                                                         <div class=col">
                                                             <label for="Name_en">{{trans('Class_trans.add_class_name_en')}}</label>
                                                             <input type="text" class="form-control" id="Name_en" name="Name_en"  value="{{  $classroom->getTranslation('Name_class','en') }}" >
                                                         </div>

                                                     </div>
                                                     <div class="form-group">
                                                         <label for="exampleInput">{{trans('Class_trans.Note')}} </label>
                                                         <select class="form-control form-control-lg" name="Grade_id">
                                                             <option value="{{$classroom->Grades->id}}">{{$classroom->Grades->Name}}</option>
                                                              @foreach($grades as $Grade)
                                                                <option value="{{$Grade->id}}">{{$Grade->Name}}</option>
                                                                @endforeach
                                                         </select>
                                                     </div><br><br>



                                             </div>
                                             <div class="modal-footer">
                                                 <button class="btn btn-success" type="submit"> {{trans('Class_trans.update')}}</button>
                                                 <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Class_trans.close')}}</button>
                                             </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>


                                 <!-- delete -->
                                 <div class="modal" id="delete_grades{{$classroom->id}}">
                                     <div class="modal-dialog modal-dialog-centered" role="document">
                                         <div class="modal-content modal-content-demo">
                                             <div class="modal-header">
                                                 <h6 class="modal-title">{{trans('Class_trans.delete')}}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                               type="button"><span aria-hidden="true">&times;</span></button>
                                             </div>
                                             <form action="{{route('classroom.destroy','test')}}" method="post">
                                                 {{method_field('delete')}}
                                                 {{csrf_field()}}
                                                 <div class="modal-body">
                                                     <p>{{trans('Class_trans.delete_grade')}}</p><br>
                                                     <input id="id" type="hidden" name="id" class="form-control" value="{{$classroom->id}}" >
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Class_trans.close')}}</button>
                                                     <button type="submit" class="btn btn-danger">{{trans('Class_trans.delete')}}</button>
                                                 </div>

                                             </form>
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




<!-- add_modal_class -->
<div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('Class_trans.add_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('classroom.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name"
                                                   class="mr-sm-2">{{ trans('Class_trans.add_class_name_ar') }}
                                                :</label>
                                            <input class="form-control" type="text" name="Name" />
                                        </div>


                                        <div class="col">
                                            <label for="Name"
                                                   class="mr-sm-2">{{ trans('Class_trans.add_class_name_en') }}
                                                :</label>
                                            <input class="form-control" type="text" name="Name_class_en" />
                                        </div>


                                        <div class="col">
                                            <label for="Name_en"
                                                   class="mr-sm-2">{{ trans('Class_trans.name_grade') }}
                                                :</label>

                                            <div class="box">
                                                <select class="fancyselect" name="Grade_id">
                                                    @foreach ($grades as $Grade)
                                                        <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="Name_en"
                                                   class="mr-sm-2">{{ trans('Class_trans.class_Processes') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                   type="button" value="{{ trans('Class_trans.delete_row') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('Class_trans.add_row') }}"/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('Class_trans.close') }}</button>
                                <button type="submit"
                                        class="btn btn-success">{{ trans('Class_trans.save') }}</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>
</div>


<!-- btn_delete_all -->
<div class="modal" id="delete_all">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{trans('Class_trans.delete')}}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('dletet_all','test')}}" method="post">

                {{csrf_field()}}
                <div class="modal-body">
                    <p>{{trans('Class_trans.delete_grade')}}</p><br>
                    <input id="delete_all_id" type="hidden" name="delete_all_id" class="form-control"  >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Class_trans.close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('Class_trans.delete')}}</button>
                </div>

            </form>
        </div>
    </div>
</div>







</div>

<!-- row closed -->
</div>


@endsection
@section('js')

        @toastr_js
        @toastr_render
<script type="text/javascript">
    $(function (){
       $('#btn_delete_all').click(function (){
           var selected = new Array();
           $("#datatable input[type = checkbox]:checked").each(function (){
              selected.push(this.value);
           });
            if (selected.length > 0 ){
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
       });
    });
</script>
@endsection
