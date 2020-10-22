<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h3>{{$mensagem}}</h3>

    @foreach($reservas as $reserva)

    {{$reserva->getQuarto()->getEstabelecimento()->getNome()}} <br>
    Data de Entrada: {{$reserva->getDataEntradaPadraoBR()}} <br>
    Data de Saida: {{$reserva->getDataSaidaPadraoBR()}} <br>
    Quarto {{$reserva->getQuarto()->getTipoDeQuarto()->getNome()}}<br>
    Quantidade de dias: {{date_diff(new DateTime($reserva->getDataSaida()), new DateTime($reserva->getDataEntrada()))->d+1}}
    <br>
    Valor total: {{$reserva->getValorAPagar()}} <br>
    Pagamento: {{$reserva->getSituacaoDoPagamento()->getNome()}}<br>
    <a href="/pagarReserva?id=<?php echo $reserva->getId()?>" >Pagar</a>
    <a href="/cancelarReserva?id=<?php echo $reserva->getId()?>" >Cancelar</a>
    <br>
    <br>
    @endforeach
</body>
</html>