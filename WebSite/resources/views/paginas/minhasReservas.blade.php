<!DOCTYPE html>
<html lang="pt">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://kit.fontawesome.com/f8802530fc.js" crossorigin="anonymous"></script>

    @include('/componentes/includeBootstrapAndJquery')

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

    <section>

        <div class="container pagina-reservas">

            <div class="row">
                @if(isset($mensagem))
                @if(!is_null($mensagem))
                @include('/componentes/alertBox')
                @endif
                @endif
                <div class="col-lg-12 text-center info-geral-reservas">
                    <div class="container" style="margin-bottom: 20px">
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
                                    "Cancelado" => "badge-danger"
                                ];
                                ?>
                                <!-- SKELETO DA LINHA -->
                                <tr id="itemListTableSkeleton" hidden>
                                    <td class="dados" hidden>
                                        <input class="id-reserva">
                                        <input class="nome-estabelecimento">
                                        <input class="data-checkin">
                                        <input class="data-checkout">
                                        <input class="dias-estadia">
                                        <input class="valor-estadia">
                                        <input class="valor-total">
                                    </td>
                                    <td class="item tdIdReserva"></td>
                                    <td class="item tdNome"></td>
                                    <td class="item tdCheckIn"></td>
                                    <td class="item tdCheckOut"></td>
                                    <td class="item tdStatus"><span class="badge badge-primary"></span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-light btn-sm" type="button">
                                                <i class="fas fa-bars" aria-hidden="true"></i>
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
                                <!-- SKELETO DA LINHA -->
                            </tbody>
                        </table>


                        <!-- Visualizar mais reservas -->
                        <div id="carregar-mais-div">
                            <div class="col text-center">
                                <button type="button" id="carregar-mais-btn" class="btn btn-block btn-light rounded-0"><i class="fas fa-chevron-down"></i></button>
                            </div>
                        </div>
                    </div>

                    <script src="/js/btnCarregarMais.js"></script>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
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
                                                    <td></td>
                                                    <td id="id_"> </td>

                                                </tr>
                                                <tr>
                                                    <td><strong>Estabelecimento</strong></td>
                                                    <td></td>
                                                    <td id="nome_estabelecimento"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Diárias</strong></td>
                                                    <td></td>
                                                    <td id="dias_estadia"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Estadia</strong></td>
                                                    <td></td>
                                                    <td id="checkin"></td>
                                                    <td id="checkout"></td>
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
                                        <i class="fas fa-tags"></i>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="text-right m-3 float-right col-md-3">
                                        Estadia: <br />
                                        <span class="h3 text-muted" id="valor_estadia"></span>
                                    </div>

                                    <div class="text-right m-3 float-right col-md-3">
                                        Total: <br />
                                        <span class="h3 text-muted" id="valor_total"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ----------- -->
                </div>

            </div>
        </div>
    </section>
    @include('componentes/footer')

    <script>
        showModal = function() {
                var tdDados = $(this).find(".dados");

                var id = tdDados.find(".id-reserva").val();
                var nomeHotel = tdDados.find(".nome-estabelecimento").val();
                var dias = tdDados.find(".dias-estadia").val();
                var checkin = tdDados.find(".data-checkin").val();
                var checkout = tdDados.find(".data-checkout").val();
                var valorEstadia = tdDados.find(".valor-estadia").val();
                var valorTotal = tdDados.find(".valor-total").val();

                $("#id_").html(id);
                $("#nome_estabelecimento").html(nomeHotel);
                $("#dias_estadia").html(dias);
                $("#checkin").html(checkin + " ");
                $("#checkout").html(checkout);
                $("#valor_estadia").html(valorEstadia);
                $("#valor_total").html(valorTotal);

                $('#myModal').modal('show');
            };

        $(function() {
            $('.items').on("click", showModal);            

            //função para a pesquisa de reservas pelo nome do hotel
            $('#input-search').on('keyup', function() {
                var rex = new RegExp($(this).val(), 'i');
                $('.searchable-container .items').hide();
                $('.searchable-container .items').filter(function() {
                    return rex.test($(this).text());
                }).show();
            });
        });
    </script>
</body>

</html>