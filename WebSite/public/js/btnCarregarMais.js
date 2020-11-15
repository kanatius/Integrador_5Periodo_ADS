convertDateToStringBR = function (date){

    dateV = date.split("-");
    return dateV[2] + "/" + dateV[1] + "/" + dateV[0];
}

buscarReservas = function (offset, qtd) {
    $.get("http://localhost:8000/getReservas", {
        offset: offset, qtd: qtd
    }, function (msg) {
        var reservas = JSON.parse(msg);

        var res = [];

        console.log(reservas);

        reservas.forEach(reserva => {
            var clone = $("#itemListTableSkeleton").clone();

            var tr = clone[0];
            //remove id Skeleton
            tr.id = "";

            //td dos dados escondidos
            var tdDados = tr.children[0];

            //pegando cada input da td
            var inputIdReserva = tdDados.children[0];
            var inputNomeEstabelecimento = tdDados.children[1];
            var inputDataCheckIn = tdDados.children[2];
            var inputDataCheckOut = tdDados.children[3];
            var inputDiasEstadia = tdDados.children[4];
            var inputValorEstadia = tdDados.children[5];
            var inputValorTotal = tdDados.children[6];

            inputIdReserva.value = reserva.id;
            inputNomeEstabelecimento.value = reserva.quarto.estabelecimento.nome;

            inputDataCheckIn.value = convertDateToStringBR(reserva.data_entrada);
            inputDataCheckOut.value = convertDateToStringBR(reserva.data_saida);

            inputValorTotal.value = reserva.valor_a_pagar;

            // calcula os dias de estadia
            var dtEnt = new Date(reserva.data_entrada);
            var dtSai = new Date(reserva.data_saida);

            var diffMil = dtSai - dtEnt;
            var diffDays = diffMil / (1000 * 60 * 60 * 24);


            inputDiasEstadia.value = diffDays;
            inputValorEstadia.value = inputValorTotal.value / diffDays;

            // Fim dados hidden

            var tdIdReserva = tr.children[1];
            var tdNome = tr.children[2];
            var tdCheckIn = tr.children[3];
            var tdCheckOut = tr.children[4];

            tdIdReserva.innerHTML = inputIdReserva.value
            tdNome.innerHTML = inputNomeEstabelecimento.value
            tdCheckIn.innerHTML = inputDataCheckIn.value;
            tdCheckOut.innerHTML = inputDataCheckOut.value;

            tr.hidden = false;
            tr.class = "items";
            tr.classList.add(tr.class);
            tr.onclick = showModal;
            res.push(tr);
        });

        res.forEach(trReserva => {
            $("#tb-reservas").children("tbody").append(trReserva);
        });
    });
}

$("#carregar-mais-btn").on("click", function () {
    var trs = $("#tb-reservas").find("tbody").children("tr");

    var contReservas = 0;

    for (tr of trs) { //conta quantos items tem na lista
        if (tr.classList.contains("items")) {
            contReservas++;
        }
    }

    buscarReservas(contReservas, 3);
});

$(window).on("load", function(){
    buscarReservas(0, 3);
})