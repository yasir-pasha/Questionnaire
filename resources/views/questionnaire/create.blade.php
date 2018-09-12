{{--

    * Created by   :  Muhammad Yasir
    * Project Name : questionnaire
    * Product Name : PhpStorm
    * Date         : 10-Sep-18 6:13 PM
    * File Name    : create.blade.php

--}}
@extends('layouts.app')
@section('content')
    @include('partials.errors')
    <form method="post" action="{{route('questionnaire.store')}}">
        @method('POST')
        @csrf
        <div class="form-group"> <!-- Full Name -->
            <label for="questionnaire_name" class="control-label">Questionnaire Name</label>
            <input type="text" class="form-control" id="questionnaire_name" name="questionnaire_name"
                   placeholder="Enter Questionnaire Name" value="{{ old('questionnaire_name') }}">
        </div>

        <div class="form-group"> <!-- Street 1 -->
            <label for="duration" class="control-label">Duration</label>
            <div class="row">
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="duration" name="duration"
                           placeholder="Enter Duration" value="{{ old('duration') }}">


                </div>
                <div class="col-sm-4">
                    <select name="duration_type" class="form-control float-right custom-select">
                        <option value="">Select</option>
                        <option value="hr" {{old('duration_type') == 'hr'?'selected':''}}>Hour</option>
                        <option value="min" {{old('duration_type') == 'min'?'selected':''}}>Minute</option>
                    </select>
                </div>
            </div>


        </div>

        <div class="form-group"> <!-- Street 2 -->
            <label for="can_resume" class="control-label">Can Resume?</label>
            <div class="col-sm-12 row">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="can_resume" id="can_resume_no"
                           value="1" {{old('can_resume') == '1'?'checked':''}}>
                    <label class="form-check-label" for="can_resume_no">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="can_resume" id="can_resume_yes"
                           value="0" {{old('can_resume') == '0'?'checked':''}}>
                    <label class="form-check-label" for="can_resume_yes">No</label>
                </div>
            </div>


        </div>
        <div class="form-group"> <!-- Street 1 -->
            <label for="duration" class="control-label">Published</label>
            <div class="row">
                <div class="col-sm-4">
                    <select name="is_published" class="form-control float-right custom-select">
                        <option value="">Select Status</option>
                        <option value="1" {{old('is_published') == '1'?'selected':''}}>Yes</option>
                        <option value="0" {{old('is_published') == '0'?'selected':''}}>No</option>
                    </select>
                </div>
            </div>


        </div>

        <div class="form-group float-right"> <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
@stop
