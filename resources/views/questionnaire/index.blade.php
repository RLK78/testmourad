@extends('default')

@section('content')
    <h1>Questionnaire : {{ $questionnaire->label }}</h1>
    <form method="POST" action="/questionnaire/valid">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="repondant" id="repondant" value="{{ $id_q }}">
    <input type="hidden" name="survey" id="survey" value="{{ $questionnaire->id }}">
    <table>
        @foreach($questionnaire->getQuestions() as $question)
        <tr>
            <td style="border: 1px solid black;padding: 10px; text-align:center;">{{ $question->label }}</td>
            @if($question->type == '0')
                <td style="border: 1px solid black;padding: 10px; text-align:center;"><input type="text" v-on:change="saveForm" v-model="reponseForm[{{ $question->id }}]" name="reponse_{{ $question->id }}" ></td>
            @elseif($question->type == '1')
                <td style="border: 1px solid black;padding: 10px; text-align:center;">
                    @foreach($question->getReponses() as $reponse)
                        <input type="radio" value="{{ $reponse->label }}" v-on:change="saveForm" v-model="reponseForm[{{ $question->id }}]" name="reponse_{{ $question->id }}"> {{ $reponse->label }}
                    @endforeach
                </td>
            @elseif($question->type == '2')
                <td style="border: 1px solid black;padding: 10px; text-align:center;">
                    @foreach($question->getReponses() as $reponse)
                        <input type="checkbox" value="{{ $reponse->label }}" v-on:change="saveForm" v-model="reponseForm[{{ $question->id }}]" name="reponse_{{ $question->id }}_{{ $reponse->id }}"> {{ $reponse->label }}
                    @endforeach
                </td>
            @endif
        </tr>
        @endforeach
    </table>

    <br/>
    <br/>
    <input type="submit" value="Valider le questionnaire">
    </form>
@stop
