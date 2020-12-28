<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Lista de Compras</title>

</head>
<body class="antialiased" style="margin: 15px; font-family: "Nunito", sans-serif'">



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="/">Listas</a>
                <a class="nav-link active" aria-current="page" href="/produtos">Produtos</a>
            </div>
        </div>
    </div>
</nav>


<div style="margin: 15px;">
    <form action="/produtos/periodo">
    <div class="row">
        <div class="col-2">
            <input class="form-control" type="date" name="period[0]" value="{{$startTimestamp}}">
        </div>
        <div class="col-2">
            <input class="form-control" type="date" name="period[1]" value="{{$endTimestamp}}">

        </div>
        <div class="col-3">
            <button type="submit" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
    </div>


    </form>
</div>




<div class="row row-cols-1 row-cols-md-4 g-4" style="margin: 15px 15px;">
    <ul class="list-group">
        @foreach($produtos as $produto)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{$produto->produto}}
                        <span class="badge bg-primary rounded-pill">{{$produto->produto_qtd}}</span>
            </li>
        @endforeach

    </ul>


</div>










<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
