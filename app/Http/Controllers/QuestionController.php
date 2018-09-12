<?php

namespace App\Http\Controllers;

use App\Question;
use App\Questionnaire;
use App\Repository\QuestionRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class QuestionController extends Controller
{
    protected $user;
    protected $user_id;

    public function __construct() {

        $this->middleware(function ($request, $next) {
            $this->user    = Auth::user();
            $this->user_id = $this->user->id;
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($questionnaire_id) {
        try {
            $data[ 'questionnaire' ] = Questionnaire::findOrFail($questionnaire_id);
        } catch (ModelNotFoundException $e) {
            return back()->with('danger', 'Questionnaire not found');
        }
        $data[ 'title' ] = 'Create Questions';
        return view('questions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {

        //Check if question is not added
        if(!$request->has('questions')) {
            return Response::json('Please add questions', 422);
        }

        try {
            //questionnaire found than ok
            $data[ 'questionnaire' ] = Questionnaire::findOrFail($request->get('questionnaire_id'));
        } catch (ModelNotFoundException $e) {
            //questionnaire not found.
            return Response::json('Questionnaire not found', 422);
        }
        $questionRepo = new QuestionRepository();

        $data = $questionRepo->store($request->all(), $this->user_id);
        if($data[ 'error' ] == 1) {
            return Response::json($data[ 'message' ], 422);
        }
        $response = [
          'message' => 'Question created successfully',
            'url' => url('questionnaire')
        ];
        return Response::json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question $question
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question $question
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Question $question
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question $question
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question) {
        //
    }
}
