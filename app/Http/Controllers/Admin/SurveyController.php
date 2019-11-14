<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\ReponsesQuestion;
use App\Survey;
use App\Question;
use App\Repondant;

use Mail;
use URL;

use Illuminate\Http\Request;


class SurveyController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $surveys = Survey::all();

        return view('surveys.index', compact('surveys'));
    }


    public function create() {
        return view('surveys.create');
    }

    public function edit($id) {
        $survey = Survey::all()->where('id', $id)->first();

        return view('surveys.edit', compact('survey'));
    }

    public function delete($id) {
        $survey = Survey::all()->where('id', $id)->first();
        $survey->delete();

        return redirect('admin/surveys');
    }

    public function addreponse($id) {
        return view('surveys.addreponse', compact('id'));
    }

    public function store(Request $request) {

        $survey = Survey::create(['label' => $request->input('label')]);

        $tab_questions = [];
        $tab_repondants = [];
        foreach($request->input() as $l => $req) {
            $tab_req = explode('_', $l);
            if ($tab_req[0] == 'labelq') {
                $tab_questions[$tab_req[1]]['label'] = $req;
            }
            elseif ($tab_req[0] == 'typeq') {
                $tab_questions[$tab_req[1]]['type'] = $req;
            }
            elseif ($tab_req[0] == 'labelrep') {
                $tab_repondants[$tab_req[1]]['mail'] = $req;
            }
        }

        foreach($tab_questions as $question){
            if(isset($question['label'])) {
                $question = Question::create(['label' => $question['label'], 'type' => $question['type'], 'survey_id' => $survey->getAttributes()['id']]);
            }
        }

        foreach($tab_repondants as $repondant){
            if(isset($repondant['mail'])) {
                $rep = Repondant::create(['mail' => $repondant['mail'], 'url' => '', 'survey_id' => $survey->getAttributes()['id']]);
                $rep->update(['url' => encrypt($rep->id)]);
            }
        }


        return redirect('admin/surveys');
    }

    public function storereponse($id, Request $request) {
        $tab_reponses = [];
        foreach($request->input() as $l => $req) {
            $tab_req = explode('_', $l);
            if ($tab_req[0] == 'labelr') {
                $tab_reponses[$tab_req[1]]['label'] = $req;
            }
        }

        foreach($tab_reponses as $reponse){
            $reponse = ReponsesQuestion::create(['label' => $reponse['label'], 'question_id' => $id]);
        }

        return redirect('admin/surveys');
    }

    public function update($id, Request $request) {
        $survey = Survey::all()->where('id', $id)->first();

        if($survey->label != $request->input('label')) {
            $survey->update(['label' => $request->input('label')]);
        }

        $questions = $survey->getQuestions();

        foreach($questions as $q) {
            if(!$request->input('labelqe_'.$q->id)) {
                $q->delete();
            }

            if($request->input('labelqe_'.$q->id) != $q->label) {
                $q->update(['label' => $request->input('labelqe_'.$q->id)]);
            }

            if($request->input('typeqe_'.$q->id) != $q->type) {
                $q->update(['type' => $request->input('typeqe_'.$q->id)]);
            }
        }

        $repondants = $survey->getRepondants();

        foreach($repondants as $r) {
            if(!$request->input('labelrepe_'.$r->id)) {
                $r->delete();
            }

            if($request->input('labelrepe_'.$q->id) != $r->mail) {
                $r->update(['mail' => $request->input('labelrepe_'.$r->id)]);
            }
        }

        $tab_questions = [];
        $tab_repondants = [];
        foreach($request->input() as $l => $req) {
            $tab_req = explode('_', $l);
            if ($tab_req[0] == 'labelq') {
                $tab_questions[$tab_req[1]]['label'] = $req;
            }
            elseif ($tab_req[0] == 'typeq') {
                $tab_questions[$tab_req[1]]['type'] = $req;
            }
            elseif ($tab_req[0] == 'labelrep') {
                $tab_repondants[$tab_req[1]]['mail'] = $req;
            }
        }

        foreach($tab_questions as $question){
            if(isset($question['label'])) {
                $question = Question::create(['label' => $question['label'], 'type' => $question['type'], 'survey_id' => $survey->getAttributes()['id']]);
            }
        }

        foreach($tab_repondants as $repondant){
            if(isset($repondant['mail'])) {
                $rep = Repondant::create(['mail' => $repondant['mail'], 'url' => '', 'survey_id' => $survey->getAttributes()['id']]);
                $rep->update(['url' => encrypt($rep->id)]);
            }
        }

        return redirect('admin/surveys');
    }

    public function contact($id) {
        $survey = Survey::all()->where('id', $id)->first();
        $repondants = $survey->getRepondants();

        foreach($repondants as $r) {
            Mail::send('emails.questionnaire', ['url' => $r->url], function($message) use ($r) {
                $message->to($r->mail)->subject('Questionnaire');
            });
        }

        return redirect('admin/surveys');
    }

    public function admin()
    {
        return redirect('admin/surveys');
    }
}
