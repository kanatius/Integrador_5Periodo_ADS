<!DOCTYPE html>
<html lang="pt">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://kit.fontawesome.com/f8802530fc.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/reservas.css">
    <title>Reservas</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg  navbar-dark" id="topo">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="../img/logo2.png" width="80" height="60" class="d-inline-block align-top" alt="">

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <span>Seja Bem-Vindo, {{$usuario->getNome()}}!</span>
                    <ul class="navbar-nav ml-auto">
                        @include('/componentes/navbar/inicio')
                        @include('/componentes/navbar/minhasReservas')
                        @include('/componentes/navbar/sair')
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <h3>{{$mensagem ?? ""}}</h3>


    <section>
        <div class="container pagina-reservas">
            <div class="row">
                <div class="col-lg-12 text-center info-geral-reservas">

                    <div class="container ">
                        <div class="row">
                            <h4 style="color: #ff5800; " class="float-left m-3"> <i class="fas fa-briefcase"></i> Reservas <small class="font-weight-light" style="color: rgb(245 141
                                    78);"> - click na reserva para mais detalhes</small>
                            </h4>
                        </div>
                        <hr>

                        <div class="container pesquisa">
                            <div class="col-lg-12">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    </div>
                                    <input type="search" class="form-control " id="input-search" placeholder="Pesquise a reserva...">
                                </div>
                            </div>
                        </div>

                        <!-- <div class="alert alert-info">
                                <a id="fullscreen" href="#fullscreen" class="alert-link"><strong>Click here</strong></a> to view this snippet in an iframe.
                                <i class="fa fa-info-circle fa-2x pull-right"></i>
                            </div> -->



                        <table class="table table-hover table-striped searchable-container" id="tb-reservas">
                            <thead>
                                <tr class="Titileitems">
                                    <th>Reserva</th>
                                    <th>Nome do hotel</th>
                                    <th>check-in</th>
                                    <th>check-out</th>
                                    <th>Status do Pagamento</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                //Classes dos botões
                                $classeStatusPagamento = [
                                    "Aguardando" => "badge-primary",
                                    "Pago" => "badge-success",
                                    "Cancelado" => "badge-danger"];
                                ?>
                                @foreach($reservas as $reserva)
                                <?php 
                                $statusPag = $reserva["situacao_de_pagamento"]["nome"];
                                $dataEntrada = new DateTime($reserva["data_entrada"]);
                                $dataSaida = new DateTime($reserva["data_saida"]);
                                ?>
                                <tr class="items">
                                    <td class="item">{{$reserva["id"]}}</td>
                                    <td class="item">{{$reserva["quarto"]["estabelecimento"]["nome"]}}</td>
                                    <td class="item">{{$dataEntrada->format("d/m/Y")}}</td>
                                    <td class="item">{{$dataSaida->format("d/m/Y")}}</td>
                                    <td><span class="badge <?php echo $classeStatusPagamento[$statusPag]?>">{{$statusPag}}</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-light btn-sm" type="button">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item" type="button">Pagar</button>
                                                <button class="dropdown-item" type="button">Cancelar</button>
                                                <button class="dropdown-item" type="button">Something else here</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Ainda não esta implementado essa páginação -->
                        <div class="col-sm-12 ">
                            <div class="container">
                                <div class="paginacao float-left"><strong>Mostrando 1 até 6 </strong></div>
                                <div class="float-right paginacao">
                                    <nav aria-label="Page navigation example ">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>

                        </div>



                    </div>

                    <!-- Modal -->

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-8 float-left">

                                        <table class="float-left">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Código</strong></td>
                                                    <td> </td>
                                                    <td>02051</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Estabelecimento</strong></td>
                                                    <td> </td>
                                                    <td>descrição do hotel/pousada</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Diárias</strong></td>
                                                    <td> </td>
                                                    <td>Qtd. dias de hospedagem</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Estadia</strong></td>
                                                    <td> </td>
                                                    <td>Data de entrada data de saida</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Quantidade de pessoas</strong></td>
                                                    <td></td>
                                                    <td>2</td>
                                                </tr>

                                            </tbody>
                                        </table>


                                    </div>
                                    <div class="col-md-4 float-right">
                                        <img src="../img/hotel1.jpg" alt="teste" class="img-thumbnail">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="text-right m-3 float-right col-md-3">
                                        Estadia: <br />
                                        <span class="h3 text-muted"><strong> R$50,00 </strong></span></span>
                                    </div>

                                    <div class="text-right m-3 float-right col-md-3">
                                        Total: <br />
                                        <span class="h3 text-muted"><strong>R$100,00</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- ----------- -->

                </div>

            </div>
        </div>
            <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $(function () {
            
            $('.item').on('click', function(event) {
                event.preventDefault();
                $('#myModal').modal('show');
            })
            
            $('#input-search').on('keyup', function() { //Função que abre modal com informações da linha
                var rex = new RegExp($(this).val(), 'i');
                $('.searchable-container .items').hide();
                $('.searchable-container .items').filter(function() {
                    return rex.test($(this).text());
            }).show();
        });
    
     
        });
    </script>
    </section>
    @include('componentes/footer')
</body>

</html>