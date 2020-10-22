<tr>
    <td>
        <a href="#">
            <span class="titulo-quarto">
                Quarto {{$quarto->getTipoDeQuarto()->getNome()}}
            </span>
        </a>
        <hr>
        <ul>
            <li>
                <div>
                    <i class="fas fa-bed"></i>
                    Uma cama queen size
                    Casal
                </div>
            </li>
            <li>
                <div>
                    <i class="fas fa-bath"></i>
                    Banheiro suite
                </div>
            </li>
        </ul>
    </td>
    <td>
        <div>
            <span>
                <i class="fas fa-user"></i>
                <i class="far fa-user"></i>
            </span>
        </div>
    </td>
    <td>
        <div class="container text-right">
            <div class="preco">R$ {{$quarto->getValor()}}</div>
            <div class="informação-pagamento">em
                até 12x sem juros</div><br />
            <div class="cancelamento-gratis">
                <strong id="main-content" data-toggle="tooltip" data-placement="top" title="Você pode
                                                        cancelar esta
                                                        reserva grátis até a
                                                        data do Check-in. Se
                                                        cancelar ou alterar
                                                        a reserva após esse
                                                        período, poderá
                                                        receber uma
                                                        cobrança. Não
                                                        podemos emitir
                                                        reembolso em caso de
                                                        check-out antecipado
                                                        ou se não aparecer
                                                        na acomodação.">
                    Cancelamento grátis
                </strong>
                <span class="data-cancelamento">
                    Até o data de
                    Check-in</span>
            </div>
        </div>
    </td>
    <td>
        <ul>
            <li>
                <div>
                    <span class="estilo-titulo" data-toggle="tooltip" data-placement="top" title="Há acesso
                                                            a Wi-Fi neste
                                                            quarto">
                        <i class="fas
                                                                fa-wifi"></i>
                        Wi-Fi grátis
                    </span>
                </div>
            </li>
            <li>
                <div>
                    <span class="feature-title"><i class="fas
                                                                fa-mug-hot"></i>
                        Café da manhã
                        disponível, a
                        pagar na
                        acomodação</span>
                </div>
            </li>
        </ul>

    </td>
    <td>
        <form id="btn-reserva">
            <div class="container text-center">
                <a href="reservarQuarto/?idQuarto=<?php echo $quarto->getId() ?>&dataEntrada=<?php echo $dataEntrada ?>&dataSaida=<?php echo $dataSaida ?>" type="submit" class="btn btn-outline-primary">Reservar</a>
                <div class="info-reserva">
                    <ul>
                        <li class="hprt-booking-cta-ticker__list-item">
                            Leva apenas 2
                            minutos
                        </li>
                        <li class="hprt-booking-cta-ticker__list-item cta-list-item--immediate-conf">
                            Confirmação
                            imediata
                        </li>
                        <li class="hprt-booking-cta-ticker__list-item">
                            Sem taxas de
                            reserva ou de
                            cartão de
                            crédito!
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </td>
</tr>