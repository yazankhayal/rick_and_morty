<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Rick & Morty</title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Rick & Morty</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://rickandmortyapi.com/documentation">DOC</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br>

<div class="container">
    <div class="row" id="result"></div>
    <div class="row ">
        <div class="col-12 d-flex justify-content-center">
            <button type="button" class="btn btn-primary btn_load">Load More..</button>
        </div>
    </div>
</div>

<br>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

<script>
    var global_page = "https://rickandmortyapi.com/api/character";
    var restult_episode = "";

    function getData(global_page) {
        $("#result").html('');
        fetch(global_page)
            .then(response => response.json())
            .then(data => {
                if (data['results'].length != 0) {
                    for (var i = 0; i < data['results'].length; i++) {
                        var images = data['results'][i].image;
                        var name = data['results'][i].name;
                        var species = data['results'][i].species;
                        var origin = data['results'][i].origin.name;

                        var array_episode = data['results'][i].episode;
                        if (array_episode.length != 0) {
                            for (var j = 0; j < array_episode.length; j++) {
                                restult_episode += '<li class="list-group-item"><a href="'+array_episode[j]+'">'+ array_episode[j] +'</a></li>';
                            }
                        }

                        var res = '<div class="col-3">\n' +
                            '            <div class="card">\n' +
                            '                <img src="' + images + '" class="card-img-top" alt="' + name + '">\n' +
                            '                <div class="card-body">\n' +
                            '                    <h5 class="card-title">' + name + '</h5>\n' +
                            '<p class="card-text">Species  ' + species + ' </p>' +
                            '<p class="card-text">Origin  ' + origin + '</p>' +
                            '                </div>\n' +
                            '                <ul class="list-group list-group-flush">'+restult_episode+'</ul>\n' +
                            '            </div>\n' +
                            '        </div>';
                        $("#result").append(res);
                    }
                }
                var next = data['info']['next'];
                var prev = data['info']['prev'];
                set_variable(next);
            });
    }

    $(document).ready(function () {

        getData(global_page);

        $(".btn_load").click(function () {
            getData(global_page);
        });

    });
    var set_variable = function (string) {
      return global_page = string;
    };
</script>

</body>
</html>
