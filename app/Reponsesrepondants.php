<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponsesrepondants extends Model
{
    protected $fillable = ['reponse','question_id','repondant_id'];
}
