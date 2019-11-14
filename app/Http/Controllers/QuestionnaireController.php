<?php

namespace App\Http\Controllers;

use App\ReponsesQuestion;
use App\Survey;
use App\Question;
use App\Repondant;
use App\Reponsesrepondants;
use App\Surveysrepondant;

use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function index($id) {
        $id_q = decrypt($id);

        $repondant = Repondant::all()->where('id', $id_q)->first();

        $questionnaire = Survey::all()->where('id', $repondant->survey_id)->first();

        $survrep = Surveysrepondant::all()->where('survey_id', $questionnaire->id)->where('repondant_id', $id_q)->first();

        if(isset($survrep)) {
            return "Merci d'avoir répondu au questionnaire !";
        }

        $questions = Question::all()->where('survey_id', $repondant->survey_id);

        $tab_reponsesrep = [];
        foreach($questions as $quest) {
            $reponsesrep = Reponsesrepondants::all()->where('question_id', $quest->id)->where('repondant_id', $id_q)->first();
            if(isset($reponsesrep)) {
                $tab_reponsesrep[$quest->id] = $reponsesrep->reponse;
            }
        }

        return view('questionnaire.index', compact('questionnaire', 'id_q', 'tab_reponsesrep'));
    }

    public function valid(Request $request) {
        $survrep = Surveysrepondant::create(['survey_id' => $request->all()['survey'], 'repondant_id' => $request->all()['repondant']]);

        return redirect('questionnaire/'.encrypt($request->all()['repondant']));
    }

    public function save(Request $request) {
        foreach($request->all()['content'] as $id => $value) {
            if(isset($value)) {
                $reponsesrep = Reponsesrepondants::all()->where('question_id', $id)->where('repondant_id', $request->all()['id_repondant'])->first();
                var_dump($reponsesrep);
                if(!$reponsesrep) {
                    $rep = Reponsesrepondants::create(['reponse' => $value, 'question_id' => $id, 'repondant_id' => $request->all()['id_repondant']]);
                }
                else {
                    $rep = $reponsesrep->update(['reponse' => $value]);
                }
            }
        }
    }
}
