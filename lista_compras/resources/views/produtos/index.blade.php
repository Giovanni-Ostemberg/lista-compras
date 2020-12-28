<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" src="<?php echo asset('css/app.css')?>">
    <title>Lista de Compras</title>

</head>
<body style="margin: 15px; font-family: "Nunito", sans-serif'">



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovaLista">
            Novo produto
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="/">Listas</a>
                <a class="nav-link active" aria-current="page" href="/produtos/periodo">Produtos por Periodo</a>
            </div>
        </div>
    </div>
</nav>


<div class="text-center" style="margin:15px;">
    <h3 style="color:slategray; text-shadow: 1px 1px 1px darkslategray">Todos os produtos</h3>
</div>




<div class="row row-cols-1" style="margin:auto; width: 60%;">
    <ul class="list-group">
        @foreach($produtos as $produto)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-10"><p class="text-center position-relative top-50 start-50 translate-middle" style="font-size: 1.25em">{{$produto->nome}}</p></div>
                    <div class="col-2">
                        <button onclick="window.location.href='/produtos/delete/{{$produto->id}}'" class="btn btn-danger" style="border-radius: 50%; box-shadow: 2px 2px 2px darkslateblue; margin-right: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg></button>
                        <button data-bs-toggle="modal" data-bs-target="#editarProduto{{$produto->id}}" class="btn btn-info" style="border-radius: 50%; box-shadow: 2px 2px 2px darkslateblue;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </li>

            <div class="modal fade" id="editarProduto{{$produto->id}}" tabindex="-1" aria-labelledby="editarProduto{{$produto->id}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Criar nova lista</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/produtos/update/{{$produto->id}}">
                                <input class="form-control" type="text" placeholder="Nome" name="nome" value="{{$produto->nome}}"/>
                                <button type="submit" class="btn btn-primary" style="border-radius: 50%; box-shadow: 2px 2px 2px darkslateblue; margin-top: 10px; float: right;">+</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </ul>


</div>








<!-- Modal -->
<div class="modal fade" id="modalNovaLista" tabindex="-1" aria-labelledby="modalNovaListaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar nova lista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/produtos/create">
                    <input class="form-control" type="text" placeholder="Nome" name="nome"/>
                    <button type="submit" class="btn btn-primary" style="border-radius: 50%; box-shadow: 2px 2px 2px darkslateblue; margin-top: 10px; float: right;">+</button>
                </form>
            </div>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
