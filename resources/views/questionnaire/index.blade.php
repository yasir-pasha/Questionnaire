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
        <h1 class="col-sm-6 row float-left"> Questionnaires
        </h1>
        <div class="float-right">
            <a href="{{route('questionnaire.create')}}" class="btn btn-primary">Create Questionnaire</a>
        </div>
    </div>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Number of Questions</th>
            <th scope="col">Duration</th>
            <th scope="col">Resumeable</th>
            <th scope="col">Published</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($questionnaires) > 0)
            @foreach($questionnaires as $questionnaire)
            <tr>
                <td scope="row">{{$questionnaire->id}}</td>
                <td scope="row">{{$questionnaire->questionnaire_name}}</td>
                <td scope="row">{{count($questionnaire->question)}}
                    <a href="{{route('questions.create',[$questionnaire->id])}}">Add</a>
                </td>
                <td scope="row">{{$questionnaire->duration.$questionnaire->duration_type}}</td>
                <td scope="row">{{$questionnaire->can_resume?'Yes':'No'}}</td>
                <td scope="row">{{$questionnaire->is_published?'Yes':'No'}}</td>
                <td>
                    <a href="{{route('questionnaire.edit',[$questionnaire->id])}}" class="btn btn-outline-primary float-left">Edit</a>
                    <form class="float-left" action="{{route('questionnaire.destroy',[$questionnaire->id])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button  class="btn btn-outline-danger">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7" class="text-center">No record Found</td>
            </tr>
        @endif

        </tbody>

    </table>
    <div class="float-right">
        {!! $questionnaires->render() !!}
    </div>

@stop
