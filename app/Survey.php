<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

    protected $fillable = ['label'];

    public function question() {
        return $this->hasMany('App\Question');
    }

    public function getQuestions() {
        $questions = Question::all()->where('survey_id', $this->id);
        return $questions;
    }

    public function getRepondants() {
        $repondants = Repondant::all()->where('survey_id', $this->id);
        return $repondants;
    }
}
