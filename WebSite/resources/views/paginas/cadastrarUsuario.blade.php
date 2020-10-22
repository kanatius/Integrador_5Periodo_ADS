<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <script src="https://kit.fontawesome.com/f8802530fc.js" crossorigin="anonymous"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="../css/cadastroU.css">
        <title>Cadastro</title>
    </head>

    <body>
        <!-- Navigation -->
        <header>
            <nav class="navbar navbar-expand-lg   navbar-dark" id="topo">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <img src="../img/logo2.png" width="80" height="60" class="d-inline-block align-top" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Page Content -->
        <section id="main">
            <div class="container pagina-login">
                <div class="row login ">

                    <div class="col-lg-12 text-center">
                        <span class="text-center">
                            <img src="../img/reception.png" width="80" height="80" class="d-inline-block align-top m-3" alt="">
                            <h3 class="text-secondary">Dados Pessoais</h3>
                        </span>

                        <div class="container">



                            <div class="row justify-content-center  ">
                                <!-- Grid column -->

                                <form action="/cadastrarUsuario" method="post">
                                    @csrf
                                    <div class="form-group"><label for="sign-up-first-name">Nome Completo</label>
                                        <div class="input-wrapper">
                                            <input name="nome" id="sign-up-first-name" class="form-control" type="text" required="" dir="auto" aria-required="true"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sign-up-email">Endereço de e-mail</label>
                                        <div class="input-wrapper">
                                            <input id="sign-up-email" class="form-control" name="email" type="email" aria-required="true" required="" dir="auto" autofocus=""></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sign-up-password">Senha</label>
                                        <div class="input-wrapper">
                                            <input name="senha" id="sign-up-password" class="form-control" type="password" autocomplete="off" required="" dir="auto" aria-required="true"></div><small class="help-message">De 6 a 20 caracteres com 1 número pelo menos.</small>
                                    </div>


                                    <!-- <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            Clique em mim
                                        </label>
                                    </div>
                                </div> -->
                                    <button type="submit" class="btn btn-dark " style="background-color: #ff5800;border: none;">Cadastrar</button>
                                    </br>
                                    </br>
                                    </form>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        @include('/componentes/footer')

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>

</html>