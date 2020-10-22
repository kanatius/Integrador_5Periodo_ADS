<?php

namespace App\Providers;

use App\Models\Reserva;
use App\Models\ReservaDAO;
use App\Models\Usuario;
use App\Models\Quarto;

use DateTime;


use Illuminate\Support\ServiceProvider;

class ReservaService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function getDataReserva(Reserva $reserva)
    {

        $situacaoDePagamento = SituacaoDePagamentoService::getSituacaoByReserva($reserva);
        $quarto = QuartoService::getQuartoByReserva($reserva);
        $tipoDeQuarto = TipoDeQuartoService::getTipoDeQuartoByQuarto($quarto);
        $estabelecimento = EstabelecimentoService::getEstabelecimentoByQuarto($quarto);
        $endereco = EnderecoService::getEnderecoByEstabelecimento($estabelecimento);
        $usuario = UsuarioService::getUsuarioByReserva($reserva);

        $estabelecimento->setEndereco($endereco);
        $quarto->setEstabelecimento($estabelecimento);
        $quarto->setTipoDeQuarto($tipoDeQuarto);
        $reserva->setQuarto($quarto);
        $reserva->setSituacaoDoPagamento($situacaoDePagamento);
        $reserva->setUsuario($usuario);
        return $reserva;
    }

    public static function getReservasByUsuario(Usuario $usuario)
    {
        $reservas = ReservaDAO::getReservasByIdUsuario($usuario->getId());
        foreach ($reservas as $reserva) {
            ReservaService::getDataReserva($reserva);
        }
        return $reservas;
    }
    public static function getReservasById($id)
    {
        return ReservaDAO::findById($id);
    }
    public static function pagarReserva(Usuario $usuario, Reserva $reserva)
    {

        if (SituacaoDePagamentoService::getSituacaoByReserva($reserva)->getId() == SituacaoDePagamentoService::getSituacaoPagamentoPago()->getId()) {
            return false;
        }

        //se o usuario não for dono da reserva
        if ($usuario->getId() != ReservaDAO::getIdUsuario($reserva)) {
            return false;
        }

        //$pagamento = PagamentoService pagar();
        $pagamento = true;

        if ($pagamento) {
            ReservaService::getDataReserva($reserva);
            $reserva->setSituacaoDoPagamento(SituacaoDePagamentoService::getSituacaoPagamentoPago());
            return ReservaDAO::update_($reserva);
        }
        return false;
    }

    public static function cancelarReserva(Usuario $usuario, Reserva $reserva)
    {

        if (SituacaoDePagamentoService::getSituacaoByReserva($reserva)->getId() == SituacaoDePagamentoService::getSituacaoPagamentoCancelado()->getId()) {
            return false;
        }

        //se o usuario não for dono da reserva
        if ($usuario->getId() != ReservaDAO::getIdUsuario($reserva)) {
            return false;
        }

        //$pagamento = PagamentoService extorno();
        $extorno = true;

        if ($extorno) {
            ReservaService::getDataReserva($reserva);
            $reserva->setSituacaoDoPagamento(SituacaoDePagamentoService::getSituacaoPagamentoCancelado());
            return ReservaDAO::update_($reserva);
        }
        return false;
    }


    public static function getIdQuarto(Reserva $reserva)
    {
        return ReservaDAO::getIdQuarto($reserva);
    }
    public static function getIdUsuario(Reserva $reserva)
    {
        return ReservaDAO::getIdUsuario($reserva);
    }
    public static function reservarQuarto($idQuarto, $dataEntrada, $dataSaida, $idUsuario)
    {
        $reserva = new Reserva(0, $dataEntrada, $dataSaida);
        $reserva->setSituacaoDoPagamento(SituacaoDePagamentoService::getSituacaoPagamentoAguardando());
        $reserva->setUsuario(UsuarioService::getUsuarioById($idUsuario));
        $reserva->setQuarto(QuartoService::getQuatoById($idQuarto));
        if (ReservaService::registerReserva($reserva)) {
            return "Quarto reservado com sucesso!";
        };
        return "Erro ao reservar o quarto!";
    }

    public static function calculateValorApagar(Reserva $reserva){
        $de = new DateTime($reserva->getDataEntrada());
        $ds = new DateTime($reserva->getDataSaida());
        $intervalo = date_diff($ds, $de);
        $qtdDias = $intervalo->d + 1;
        $valorDoQuarto = $reserva->getQuarto()->getValor();
        $reserva->setValorAPagar($qtdDias * $valorDoQuarto);
    }

    public static function registerReserva(Reserva $reserva)
    {
        //REGRA DE NEGOCIO
        if (ReservaService::verifyDisponibilidade($reserva->getQuarto(), $reserva->getDataEntrada(), $reserva->getDataSaida())) {
            ReservaService::calculateValorApagar($reserva);
            $reserva->setSituacaoDoPagamento(SituacaoDePagamentoService::getSituacaoPagamentoAguardando());
            return ReservaDAO::insert($reserva);
        }
        //PRECISA VERIFICAR SE JA HÁ ALGUMA RESERVA PRA AQUELE QUARTO, NAQUELAS DATA 
        return false;
    }
    public static function verifyDisponibilidade(Quarto $quarto, $dataEntrada, $dataSaida)
    {
        $reserva = ReservaDAO::getReservaByDates($quarto->getId(), $dataEntrada, $dataSaida);
        //se não tiver reserva, retorna true
        if (is_null($reserva)) {
            return true;
        }
        return false;
    }
}
