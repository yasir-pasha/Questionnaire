{{--

    * Created by   :  Muhammad Yasir
    * Project Name : questionnaire
    * Product Name : PhpStorm
    * Date         : 10-Sep-18 6:13 PM
    * File Name    : create.blade.php

--}}
@extends('layouts.app')
@section('content')
    <div class="page-header">
        <h1> Add Questions
        </h1>
    </div>
    <form method="post" action="{{route('questions.store')}}" id="question-form">
        @method('POST')
        @csrf
        <input name="questionnaire_id" type="hidden" value="{{$questionnaire->id}}">



        <div id="questions">

        </div>

        <div class="form-group float-left"> <!-- Submit Button -->
            <button type="button" class="btn btn-primary" id="add-question">Add Question</button>
        </div>
        <div class="form-group float-right"> <!-- Submit Button -->
            <button type="button" class="btn btn-primary" id="save-questions">Save</button>
        </div>

    </form>
    <div id="question-type-field" class="d-none" style="position: absolute; text-outline: -100px;">
        <div class="form-group"> <!-- Street 1 -->
            <label for="duration" class="control-label">Question Type</label>
            <div class="row">
                <div class="col-sm-4">
                    <select name="question[0]question_type" class="form-control float-right custom-select question-type">
                        <option value="">Select</option>
                        @foreach(config('question.QUESTION_TYPES') as $index =>$question)
                            <option
                                value="{{$index}}" {{old('duration_type') == 'hr'?'selected':''}}>{{$question}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-sm-2" style="">
                    <button type="button" class="btn btn-danger delete-question">Delete Question</button>
                </div>
            </div>


        </div>
    </div>
@stop
@section('scripts')
    <script src="{{ asset('js/question.min.js') }}" defer></script>
    <style>
        .question-box{
            border-bottom: 1px solid rgba(0,0,0,.1);
            margin-bottom: 8px;
        }
    </style>
@stop
