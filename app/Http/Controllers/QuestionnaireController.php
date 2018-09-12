<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionnaire;
use App\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
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
        $data[ 'title' ]          = 'All Questionnaires';
        $data[ 'questionnaires' ] = Questionnaire::orderBy('is_published', 'DESC')->with('question')->paginate(25);
        return view('questionnaire.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('questionnaire.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionnaire $request) {
        try {
            $questionnaire                     = new Questionnaire;
            $questionnaire->questionnaire_name = $request->get('questionnaire_name');
            $questionnaire->duration           = $request->get('duration');
            $questionnaire->duration_type      = $request->get('duration_type');
            $questionnaire->can_resume         = $request->get('can_resume');
            $questionnaire->user_id            = $this->user_id;
            $questionnaire->is_published       = $request->get('is_published');;
            $questionnaire->save();
            return redirect()->route('questionnaire.index')->with('success', 'Questionnaire saved successfully');
        } catch (\Exception $e) {
            return redirect()->route('questionnaire.index')->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try {
            $data[ 'questionnaire' ] = Questionnaire::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('questionnaire.index')->with('danger', $e->getMessage());
        }

        $data[ 'title' ] = 'Edit Questionnaire';
        return view('questionnaire.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire) {
        try {
            $questionnaire->questionnaire_name = $request->get('questionnaire_name');
            $questionnaire->duration           = $request->get('duration');
            $questionnaire->duration_type      = $request->get('duration_type');
            $questionnaire->can_resume         = $request->get('can_resume');
            $questionnaire->user_id            = $this->user_id;
            $questionnaire->is_published       = $request->get('is_published');;
            $questionnaire->save();
            return redirect()->route('questionnaire.index')->with('success', 'Questionnaire update successfully');
        } catch (\Exception $e) {
            return redirect()->route('questionnaire.index')->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            Questionnaire::find($id)->delete();
            return redirect()->route('questionnaire.index')->with('success', 'Questionnaire deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('questionnaire.index')->with('danger', $e->getMessage());
        }
    }
}
