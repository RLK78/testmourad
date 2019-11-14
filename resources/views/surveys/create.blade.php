@extends('default')

@section('content')

    <h1>Créer un questionnaire</h1>
    <form action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class=form-group">
            <label for="label">Nom du questionnaire</label>
            <input type="text" name="label" id="label" class="form-control" />
        </div>

        <div>
            <span class="button btn-primary" @click="addQuestion">Ajouter une question</span>
        </div>
        <table class="table">
            <thead>
            <tr>
                <td><strong>Label</strong></td>
                <td><strong>Type</strong></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(row, index) in rows">

                <td><input type="text" :name="'labelq_' + index" v-model="row.label"></td>
                <td>
                    <input type="radio" :name="'typeq_' + index" value="0" v-model="row.type">Question ouverte<br/>
                    <input type="radio" :name="'typeq_' + index" value="1" v-model="row.type">Question bouton radio<br/>
                    <input type="radio" :name="'typeq_' + index" value="2" v-model="row.type">Question checkbox
                </td>
                <td>
                    <a v-on:click="removeQuestion(index);" >Supprimer</a>
                </td>

            </tr>

            </tbody>
        </table>

        <div>
            <span class="button btn-primary" @click="addRepondant">Ajouter un repondant</span>
        </div>

        <table class="table">
            <tr v-for="(repondant, indexrep) in repondants">

                <td><input type="text" :name="'labelrep_' + indexrep" v-model="repondant.mail" placeholder="mail@mail.com"></td>
                <td>
                    <a v-on:click="removeRepondant(indexrep);" >Supprimer</a>
                </td>

            </tr>
        </table>

        <div class=form-group">
            <button class="btn btn-primary">Valider</button>
        </div>
    </form>


@stop
