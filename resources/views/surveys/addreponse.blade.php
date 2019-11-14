@extends('default')

@section('content')

    <h1>Question {!! $id !!}</h1>
    <form action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div v-for="(reponse, indexr) in reponses">
            <div>
                <input type="text" :name="'labelr_' + indexr" v-model="reponse.label">
            </div>
            <div>
                <a v-on:click="removeReponse(index);" >Supprimer</a>
            </div>
        </div>
        <div>
            <span class="button btn-primary" @click="addReponse">Ajouter une réponse</span>
        </div>

        <div class=form-group">
            <button class="btn btn-primary">Valider</button>
        </div>
    </form>


@stop
