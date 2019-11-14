<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['label','type','survey_id'];

    public function survey() {
        return $this->belongsTo('App\Survey');
    }

    public function getReponses() {
        $reponses = ReponsesQuestion::all()->where('question_id', $this->id);
        return $reponses;
    }

}
