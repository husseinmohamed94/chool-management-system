@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.add_question')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.add_question')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> </h4>
                <h3>{{trans('main_trans.add_question')}}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_trans.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">    {{trans('main_trans.add_question')}}</li>
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

                    <form method="post"  action="{{ route('questions.update',$question->id) }}" autocomplete="" enctype="multipart/form-data">
                        @csrf
                        @method('PUt')
                        <div class="row">
                            <input name="id" type="hidden" value="{{$question->id}}">
                            <div class="col">
                                <div class="form-group">
                                    <label>{{trans('question_trans.titel')}} : <span class="text-danger">*</span></label>
                                    <input value="{{$question->title}}"  type="text" name="title"  class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>{{trans('question_trans.answers')}} : <span class="text-danger">*</span></label>
                                    <textarea   class="form-control" name="answers">  {{$question->answers}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>{{trans('question_trans.right_answer')}} : <span class="text-danger">*</span></label>
                                    <input value="{{$question->right_answer}}"  type="text" name="right_answer"  class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="inputName"
                                       class="control-label">{{ trans('question_trans.subject') }}</label>
                                <select  name="quizze_id" class="custom-select">
                                    <!--placeholder-->
                                    <option value="{{ $question->quizze->id }}"> {{ $question->quizze->name }}</option>

                                @foreach ($quizzes as $quizze)
                                        <option value="{{ $quizze->id }}"> {{ $quizze->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">{{ trans('question_trans.score') }}</label>
                                <select  name="score"   class="custom-select">
                                    <!--placeholder-->
                                    <option value="{{$question->score}}">{{$question->score}}</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>

                                </select>
                            </div>

                        </div><br/>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('question_trans.submit')}}</button>


                    </form>
                </div>
            </div>
        </div>
        <!-- row closed -->
        @endsection

        @section('js')
            @toastr_js
            @toastr_render


@endsection

