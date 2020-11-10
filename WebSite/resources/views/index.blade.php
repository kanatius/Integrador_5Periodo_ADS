<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://kit.fontawesome.com/f8802530fc.js" crossorigin="anonymous"></script>

    @include('/componentes/includeBootstrapAndJquery')

    <link rel="stylesheet" href="../css/loginStyle.css">
    <title>Login</title>
</head>
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
                        <li class="nav-item">
                            <a class="nav-link" href="/usuario/signUpPage">Cadastre-se</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Content -->
    @if(isset($mensagem)) 
    <div>{{$mensagem}}</div>
    @endif

    <section>
        <div class="container pagina-login">
            <div class="row">
                <div class="col-lg-12 text-center">

                    <div class="container">

                        <div class="row justify-content-center ">
                            <!-- Grid column -->

                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                      <i class="fa fa-user-circle-o fa-5x" aria-hidden="true" style="color: #ff5800d4;"></i>
                    </span>
                                        <h2 class="text-center default-text py-2 text-secondary"> Faça seu login</h2>
                                        <p class="text-secondary">Exclusivo para usúarios</p>
                                        <!--Body-->
                                        <form action="/logar" method="post">
                                        @csrf
                                            <div class="form-group row justify-content-center">
                                                <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label> -->

                                                <div class="col-md-10 ">
                                                    <input name="email" type="email" class="form-control m-3 text-center" id="inputEmail" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-center">
                                                <!-- <label for="inputPassword3" class="col-sm-2 col-form-label">Senha</label> -->
                                                <div class="col-md-10">

                                                    <input name="senha" type="password" class="form-control m-3 text-center inp" id="inputPassword" placeholder="Senha">
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-dark w-50" id="btn_ok" style="background-color: #ff5800;">OK</button>

                                            </div>
                                        </form>

                                        <div class=" text-center m-3">
                                            <a href="#" style="color: #ff5800;">ainda não é nosso parceiro? <i
                          class="far fa-arrow-alt-circle-right"></i> </a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--footer-->
    <!-- Site footer -->
    
    @include('/componentes/footer')

</body>
</html>