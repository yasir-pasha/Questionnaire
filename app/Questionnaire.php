<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = ['questionnaire_name','user_id','duration','duration_type','can_resume'];

    public function question() {
        return $this->hasMany(Question::class);
    }
}
