<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Pousadas</h2>
    @foreach($pousadas as $pousada)
        Nome: {{$pousada->getNome()}} <br>
        Tipo: {{$pousada->getTipoDeEstabelecimento()->getNome()}} <br>
        Cidade: {{$pousada->getEndereco()->getCidade()}} <br>
        <br>
    @endforeach
    <h2>Hoteis</h2>
    @foreach($hoteis as $hotel)
        Nome: {{$hotel->getNome()}} <br>
        Tipo: {{$hotel->getTipoDeEstabelecimento()->getNome()}} <br>
        Cidade: {{$hotel->getEndereco()->getCidade()}} <br>
        <br>
    @endforeach
</body>
</html>