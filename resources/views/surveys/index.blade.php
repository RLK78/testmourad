@extends('default')

@section('content')
    <h3><a href="surveys/create">Ajouter un questionnaire</a></h3>
    @foreach($surveys as $survey)
      <table>
          <tr>
              <td style="padding:20px;text-align:center;"><h2>{!! $survey->label !!}</h2></td>
              <td style="padding:20px;text-align:center;"><a href="surveys/edit/{!! $survey->id !!}">Modifier</a></td>
              <td style="padding:20px;text-align:center;"><a href="surveys/delete/{!! $survey->id !!}">Supprimer</a></td>
              @if($survey->getRepondants()->first() !== null)
                <td style="padding:20px;text-align:center;"><a href="surveys/contact/{!! $survey->id !!}">Envoyer le mail aux répondants</a></td>
              @endif
          </tr>
      </table>
        <table>
            <tr>
                @foreach($survey->getQuestions() as $question)
                    <td style="border: 1px solid black;text-align: center;">
                        <div>{!! $question->label !!}</div>
                        @if($question->type == '0')
                            <div>Question ouverte</div>
                        @elseif($question->type == '1')
                            <div>Question bouton radio</div>
                        @elseif($question->type == '2')
                            <div>Question checkbox</div>
                        @endif
                        @if($question->type != '0')
                            <div><a href="surveys/addreponse/{!! $question->id !!}">Ajouter des réponses</a></div>
                        @else
                            <div>Champ libre</div>
                        @endif
                    </td>
                @endforeach
            </tr>
        </table>
    @endforeach
  </ul>
@stop
