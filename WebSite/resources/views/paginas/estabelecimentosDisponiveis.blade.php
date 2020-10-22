<!DOCTYPE html>
<html lang="pt">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">

    <script src="https://kit.fontawesome.com/f8802530fc.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/hotelcss.css">
    <title>Estabelecimentos Disponíveis</title>
</head>
<?php
$cidade = ucwords(strtolower($cidade));
?>

<body>
    <!-- Navigation -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" id="topo">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="../img/logo2.png" width="80" height="60" class="d-inline-block align-top" alt="">

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        @include('/componentes/navbar/inicio')
                        @include('/componentes/navbar/minhasReservas')
                        @include('/componentes/navbar/hoteisEPousadasCadastrados')
                        @include('/componentes/navbar/sair')
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Page Content -->
    <section>
        <div class="container pagina-hoteis">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- Grid column -->
                            <div class="col-md-12">
                                <div class="sr_header">
                                    <h1>Estabelecimentos disponíveis em {{$cidade}} com:</br>
                                        Entrada em {{date("d/m/Y", strtotime($dataEntrada))}}</br>
                                        Saída em {{date("d/m/Y", strtotime($dataSaida))}}</h1>
                                </div>
                                <hr />
                                </br>
                                <!--Body-->
                                <div class="container">
                                    <!-- linha 1 -->
                                    @foreach($estabelecimentos as $estabelecimento)
                                    <div class="row equipo-item">
                                        <div class="col-md-3
                                                separador-vertical"><img src="/..." class="img-responsive
                                                    center-block">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row sr_header">
                                                <div class="col-md-9">
                                                    <h1 class="titulo-equipo">{{$estabelecimento->getNome()}} </h1>
                                                </div>

                                            </div>

                                            <hr />
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <p class="texto-equipo">{{$estabelecimento->getEndereco()->toString()}}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="price  col-md-12">
                                                            <!-- <a href="#" class="price-link" target="_blank"><ins><strong>$ 61</strong></ins></a> -->
                                                        </div>
                                                        <div class="price-breakdown col-md-12"><strong class="price-instalments">Em até 12x sem juros</strong></div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="price  col-md-12">
                                                            <a class="btn btn-info" href="/visualizarQuartos?idEstabelecimento=<?php echo $estabelecimento->getId() ?>&dataEntrada=<?php echo $dataEntrada ?>&dataSaida=<?php echo $dataSaida ?>">Visualizar Quartos</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>



    </section>
    <!-- volta ao topo -->
    <div class="container">
        <!-- <a href="#" id="subir">Topo</a> -->
        <a class="button" onclick="topFunction()" id="myBtn" title="Ir ao topo"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
    </div>
    @include('/componentes/footer')

</html>