<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionnaire extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'questionnaire_name'=>'required|max:255',
            'duration'=>'required|integer',
            'duration_type'=>['required',function($attribute, $value, $fail) {
                if ($value != 'hr' && $value != 'min') {
                    $fail($attribute.' is invalid.');
                }
            },],
            'can_resume'=>'required|boolean'
        ];
    }
}
