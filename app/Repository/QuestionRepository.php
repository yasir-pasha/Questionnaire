<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : questionnaire
 * Product Name : PhpStorm
 * Date         : 11-Sep-18 11:41 PM
 * File Name    : QuestionRepository.php
 */

namespace App\Repository;

use App\Question;
use App\QuestionChoice;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class QuestionRepository
{

    public function store(array $request, $user_id) {
        DB::beginTransaction();
        foreach ($request[ 'questions' ] as $question) {
            $question_m                   = new Question;
            $question_m->questionnaire_id = $request[ 'questionnaire_id' ];
            $question_m->question_type    = $question[ 'question_type' ];
            $question_m->question         = $question[ 'question' ];
            if($question[ 'question_type' ] === 'TEXT') {
                $question_m->answer = $question[ 'answer' ];
            }

            try {
                $question_m->save();
                if($question[ 'question_type' ] != 'TEXT') {
                    $result = $this->storeChoices($question_m->id, $question);
                    if($result[ 'error' ] == 1) {
                        return $result;
                    }
                }
            } catch (QueryException $e) {
                DB::rollBack();
                return [
                  'error' =>1,
                    'message' => $e->getMessage()
                ];

            }

        }
        DB::commit();
    }

    private function storeChoices($question_id, $question) {
        if(!isset($question[ 'choices' ])) {
            return [
              'error'   => 1,
              'message' => 'Some question has no choice. Please create choice first'
            ];
        }
        foreach ($question[ 'choices' ] as $index => $choice) {
            $choice_m = new QuestionChoice;

            $choice_m->question_id = $question_id;
            $choice_m->choice      = $choice;
            if(isset($question[ 'correct' ][ $index ])) {
                $choice_m->is_correct = 1;
            }
            try {
                $choice_m->save();
            } catch (QueryException $e) {
                DB::rollBack();
                return [
                  'error' =>1,
                  'message' => $e->getMessage()
                ];

            }
        }
    }
}
