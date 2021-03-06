<!DOCTYPE html>
<html lang="pt">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://kit.fontawesome.com/f8802530fc.js" crossorigin="anonymous"></script>

    @include('/componentes/includeBootstrapAndJquery')

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />

    <link rel="stylesheet" href="../css/inicioCss.css">
    <title>Inicio</title>
</head>

<body>
    <!-- Navigation -->
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
    <!-- Page Content -->
    <section>
        <div class="container pagina-reserva">
            <div class="row">
                <div class="col-lg-12 text-center">

                    <div class="container">
                        <div class="row justify-content-center ">
                            <!-- Grid column -->
                            <div class="col-sm" id="cardPesquisa">

                                <div class="card">
                                    <div class="">
                                        <br>
                                        <h3 class="hero__title">Encontre um hotel ou pousada ideal para seus planos!</h3>
                                    </div>
                                    <div class="card-body">

                                        <form action="/buscarEstabelecimentos">

                                            <div class="row" style="text-align: left;">
                                                <div class="col-sm-12 col-md-4 inputWithIcon form-group">
                                                    <!-- <i class="fa fa-search" aria-hidden="true"></i> -->
                                                    <label class="labelDescricaoInput">Cidade</label>
                                                    <input name="cidade" type="text" class="form-control" placeholder="Insira o nome da cidade ">
                                                </div>
                                                <div class="col-sm-6 col-md-3 inputWithIcon form-group">
                                                    <!-- <span><i class="far fa-calendar-check"></i></span> -->
                                                    <label class="labelDescricaoInput">Check-in</label>
                                                    <input type="date" name="dataEntrada" id="datePicker1" class="datepicker form-control datas" placeholder="--/--/----">
                                                </div>
                                                <div class="col-sm-6 col-md-3 inputWithIcon form-group">
                                                    <label class="labelDescricaoInput">Check-out</label>
                                                    <input type="date" name="dataSaida" id="datePicker2" class="datepicker form-control datas" placeholder="--/--/----">
                                                </div>
                                                <div class="col-sm-6 col-md-2 form-group" id="btn-pesquisa">
                                                    <button class="btn btn-dark">Pesquisar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container pagina-cards">
            <div>
                <h3>Inspire-se e escolha o próximo destino das suas férias</h3>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="../img/bar.jpg" alt="Card image cap" style="height: 260.987px;">
                        <div class="card-body">
                            <h5 class="card-title">Bares mais famosos do Brasil.</h5>
                            <p class="card-text">"Podemos vislumbrar nas redes sociais ou mesmo no “boca a boca” que os bares são um dos locais de entretenimento e lazer mais populares do mundo e do Brasil.Os bares mais famosos do Brasil são a prova viva desse incontestável fato."</p>
                            <a href="https://freesider.com.br/viajar/descubra-os-7-bares-mais-famosos-do-brasil/" target="_blank">Conheças os melhores e mais famosos bares do Brasil</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="/img/sp.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Hotéis mais luxuosos de São Paulo.</h5>
                            <p class="card-text">"São Paulo é conhecida como uma cidade totalmente urbana com arquitetura contemporânea, seus hotéis mostram o quão glamouroso esse município pode ser."</p>
                            <a href="https://www.etiquetaunica.com.br/blog/os-top-hoteis-mais-luxuosos-de-sao-paulo/" target="_blank">Conheças os melhores e mais luxuosos hotéis de São Paulo</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="/img/porto-de-galinhas.jpg" alt="Card image cap" style="height: 260.987px;">
                        <div class="card-body">
                            <h5 class="card-title">Os 5 lugares mais românticos do Brasil</h5>
                            <p class="card-text">Viva momentos incrivéis e marcantes nos lugares mais românticos do Brasil, seja pela natureza ou pela arquitetura,e colecione lindas memórias com o seu amor!</p>
                            <a href="https://casalnomade.com/os-5-lugares-mais-romanticos-do-brasil-para-passar-o-mes-dos-namorados/" target="_blank">Os 5 lugares mais românticos do Brasil para passar o mês dos namorados!</a>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="/img/parque.jpg" alt="Card image cap" style="height: 358.663px;">
                        <div class="card-body">
                            <h5 class="card-title">Pontos turísticos imperdíveis no Rio de Janeiro</h5>
                            <p class="card-text">"Se tem uma cidade que fica difícil montar um roteiro de passeios, tamanha a variedade de locais incríveis, essa cidade é o Rio."</p>
                            <a href="https://www.momondo.com.br/discover/pontos-turisticos-rio-de-janeiro" target="_blank">Conheça 9 pontos turísticos imperdíveis no Rio de Janeiro</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="/img/Pipa.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"> Melhores Praias do Nordeste Brasileiro</h5>
                            <p class="card-text">"O Nordeste esbanja opções de praias para descansar, entrar em contato com a natureza e badalar na vida noturna."</p>
                            <a href="https://casalnomade.com/top-10-conheca-as-melhores-praias-do-nordeste-brasileiro/" target="_blank">Conheça o top 10 das melhores praias do Nordeste Brasileiro</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    @include('/componentes/footer')

    <script>
        $(function() {

            <?php 
                $dataAtual = new DateTime();
                $plusOneDay = new DateTime();
                
                //adiciona 1 dia
                $plusOneDay->add(new DateInterval("P1D"));
            ?>

            var dp1 = document.getElementById("datePicker1");
            var dp2 = document.getElementById("datePicker2");

            //desabilita dias antes do dia atual
            dp1.min = "<?php echo $dataAtual->format("yy-m-d");?>";

            //desabilita dias antes do dia atual + 1 dia
            dp2.min = "<?php echo $plusOneDay->format("yy-m-d");?>"; 

            //atualiza o segundo datepicker de acordo com o primero - minimo 1 dia depois
            dp1.onchange = function(){

                //pega as str do valor que consta no datepicker
                dtStr = dp1.value;

                //cria um obj date
                date = new Date(dtStr);

                //adiciona um dia
                date.setDate(date.getDate() + 1);

                //set segundo datepicker
                document.getElementById("datePicker2").min = date.toISOString().split("T")[0];  
            };

            //chama a função se já tiver algum valor preenchido pelos cookies
            if(dp1.value != "")
                dp1.onchange();

        });

    </script>

</body>

</html>