<!DOCTYPE html>
<html lang="pt">

<head>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">

        <script src="https://kit.fontawesome.com/f8802530fc.js" crossorigin="anonymous"></script>

        @include('/componentes/includeBootstrapAndJquery')

        <link rel="stylesheet" href="/css/quartocss.css">
        <title>Quartos</title>
    </head>
</head>


<body>
    <!-- Navigation -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" id="topo">
            <div class="container">
                @include('/componentes/navbar/iconeInicio')
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
        <div class="container pagina-quartos">
            <div class="row">
                <div class="col-lg-12 text-center">

                    <div class="container text-left propiedade-hotel">
                        <div class="propriedade-descricao-head">
                            <div class="hotel-title sistema-fonte">
                                <h4 class="hotel-name" id="hotel_name">
                                    <span class="badge badge-secondary
                                            hotel-type-badge">{{$estabelecimento->getTipoDeEstabelecimento()->getNome()}}</span>
                                    {{$estabelecimento->getNome()}}
                                </h4>
                            </div>
                            <div class="propriedade-endereco sistema-fonte">
                                <p>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{$estabelecimento->getEndereco()->toString()}}</span>
                                </p>

                            </div>
                        </div>
                        <hr/>
                        <div class="container propiedade-hotel-img">
                            <div class="row">
                                <div class="col-sm-8" style="padding-left: 0px;">
                                    <img src="/img/sp.jpg" class="img-fluid" alt="Responsive
                                            image">
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <a href="#info-quartos" role="button" class="scroll btn btn-primary btn-lg btn-block">Selecione o quarto</a>

                                    </div><br />
                                    <div class="row">
                                        <div class="container-fluid">

                                            <div class="map-responsive map" id="map">
                                                <iframe class="embed-responsive-item" src="https://embed.waze.com/iframe?zoom=14&lat=-23.55052&lon=-46.63331&pin=1&desc=1" width="100%" height="520"></iframe>
                                            </div>
                                        </div>
                                    </div><br />
                                    <div>
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: medium;font-weight: bold;">SEM TAXAS ESCONDIDAS <i class="fas fa-ban"></i></h5>

                                                <p class="card-text">"Nossas políticas de reserva são transparentes. Você sabe exatamente o que vai pagar, desde o começo."</p>

                                                <a href="#" class="card-link">Políticas de pagamento</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="container info-quartos " id="info-quartos">
                    <div class="container">
                        <div class="row ">
                            <div>
                                <p class="h5">Selecione o quarto</p>

                            </div>
                            <div class="col-md-12 date-of-stay">
                                <strong class="header-estadia">Datas da estadia</strong>
                                <p class="info">
                                    {{date("d/m/Y", strtotime($dataEntrada))}} – {{date("d/m/Y", strtotime($dataSaida))}}<span class="duration"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover
                            table-responsive" style="background-color: #f5f4f0;">
                        <thead>
                            <tr style="background-color: rgb(245 141
                                    78);">
                                <th scope="col">Categoria de quarto</th>
                                <th scope="col">Acomoda:</th>
                                <th scope="col">Preço da diária</th>
                                <th scope="col">Condições</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- -->
                            @foreach($estabelecimento->getQuartos()["normais"] as $quarto)
                                @include('/componentes/linhaTableQuartosDiponiveis')
                            @endforeach
                            @foreach($estabelecimento->getQuartos()["VIPs"] as $quarto)
                                @include('/componentes/linhaTableQuartosDiponiveis')
                            @endforeach
                            <!-- -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </section>



    @include('/componentes/footer')

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOFpfn-lN-97JhYhmtd9VWGMajDr-6byk&callback=initMap" type="text/javascript"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $('.scroll').on('click', function() {

                var target_offset = $("#info-quarto").offset();
                var target_top = target_offset.top;
                $('html, body').animate({
                    scrollTop: target_top
                }, 0);
            })
        });
    </script>
</body>

</html>