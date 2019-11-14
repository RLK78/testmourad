
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Starter Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body style="padding-top: 50px;">

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>

<main role="main" class="container">

    <div class="starter-template" id="app" style="padding-top: 40px;">
        @yield('content')
    </div>

</main><!-- /.container -->

<script type="text/javascript">
    var app = new Vue({
        el: "#app",
        data: {
            rows: [],
            reponses: [],
            repondants: [],
            reponseForm: []
        },
        methods: {
            addQuestion: function() {
                var elem = document.createElement('tr');
                this.rows.push({
                    label: "",
                    type: 0
                });
            },
            removeQuestion: function(index) {
                this.rows.splice(index, 1);
            },
            removeQuestionUpd: function(id) {
                var element = document.getElementById('quest_' + id);
                element.parentNode.removeChild(element);
            },
            addReponse: function() {
                var elem = document.createElement('div');
                this.reponses.push({
                    label: ""
                });

            },
            removeReponse: function(index) {
                this.reponses.splice(index, 1);
            },
            addRepondant: function() {
                var elem = document.createElement('tr');
                this.repondants.push({
                    mail: ""
                });
            },
            removeRepondant: function(index) {
                this.repondants.splice(index, 1);
            },
            removeRepondantUpd: function(id) {
                var element = document.getElementById('repond_' + id);
                element.parentNode.removeChild(element);
            },
            saveForm: function() {
                axios.post('/questionnaire/save', {
                    content: this.reponseForm,
                    id_repondant: document.getElementById('repondant').value
                })
                .then(function (response) {
                    //console.log(reponse);
                })
            }
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script></body>
</html>
