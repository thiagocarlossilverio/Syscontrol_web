<?php

class Admin_RelatoriosController extends Zend_Controller_Action {

    public function init() {
        $arr_meses = array(
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        );
        $this->view->meses = $arr_meses;

        $arr_categorias = array(
            '1' => 'Porcadeiro',
            '2' => 'Silo',
            '3' => 'Granel'
        );
        $this->view->tipos = $arr_categorias;

        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
    }

    public function cargasAction() {
        $Model = new Admin_Model_Cargas();
        $categorias = new Admin_Model_Categorias();

        $categoria = $this->_request->getParam('categoria');

        if ($this->_request->getParam('inicio')) {
            $data_inicio = $this->_request->getParam('inicio');
        } else {
            $inicio_mes = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $data_inicio = date('Y-m-d', $inicio_mes);
        }

        if ($this->_request->getParam('fim')) {
            $data_fim = $this->_request->getParam('fim');
        } else {
            $data_fim = date('Y-m-d');
        }

        $result = $Model->FiltroCargas(FALSE, $data_inicio, $data_fim, $categoria);
        $lista_categorias = $categorias->ListCategory();

        $this->view->dados = $result;
        $this->view->categorias = $lista_categorias;
        $this->view->categoria = $categoria;
        $this->view->data_inicio = $data_inicio;
        $this->view->data_fim = $data_fim;
    }

    public function viagensAction() {
        $this->_forward('index', 'viagens', 'admin');
    }

    public function abastecimentosAction() {
        $Model = new Admin_Model_Abastecimentos();
        $ModelVeiculos = new Admin_Model_Caminhoes;
        $ModelMotorista = new Admin_Model_Motoristas();

        $veiculo = $this->_request->getParam('veiculo');
        $motorista = $this->_request->getParam('motorista');
        $mes = $this->_request->getParam('mes');

        if ($motorista == 0) {
            $motorista = false;
        }

        if ($veiculo == 0) {
            $veiculo = false;
        }

        $veiculos = $ModelVeiculos->ListarCaminhoes(FALSE, TRUE);
        $motoristas = $ModelMotorista->ListarMotoristas(TRUE);
        $abastecimentos = $Model->ListaAbastecimentos(false, $veiculo, $motorista, $mes);

        $this->view->dados = $abastecimentos;
        $this->view->motoristas = $motoristas;
        $this->view->veiculos = $veiculos;

        $this->view->motorista = $motorista;
        $this->view->mes = $mes;
        $this->view->veiculo = $veiculo;
    }

    public function mediaConsumoAction() {
        $Model = new Admin_Model_Abastecimentos();

        if ($this->_request->getParam('inicio')) {
            $data_inicio = $this->_request->getParam('inicio');
        } else {
            $inicio_mes = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $data_inicio = date('Y-m-d', $inicio_mes);
        }

        if ($this->_request->getParam('fim')) {
            $data_fim = $this->_request->getParam('fim');
        } else {
            $data_fim = date('Y-m-d');
        }


        /* $teste = $this->view->CalcularMedia('249');
          Zend_Debug::Dump($teste);
          die; */

        $abastecimentos = $Model->ListarVeiculos();
        $this->view->dados = $abastecimentos;
        $this->view->data_inicio = $data_inicio;
        $this->view->data_fim = $data_fim;
    }

    public function mediaConsumoExcelAction() {
        $Model = new Admin_Model_Abastecimentos();

        $abastecimentos = $Model->ListarVeiculos();

        if (!$abastecimentos) {
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não há abastecimento para a exportação!'));
            $this->redirect('admin/relatorios/media-consumo');
        }

        $arquivo = 'media_consumo_' . date('d-m-Y H:i:s') . '.xls';
        $html = '';
        $html .= '<table border="1px">';
        $html .= '<tr>';
        $html .= '<td colspan="7" align="center" bgcolor="#1a629a"><b>M&Eacute;DIAS DO DIA ' . $this->view->ConvercaoDate('-', $this->_request->getParam('inicio'), 2) . ' &Aacute; ' . $this->view->ConvercaoDate('-', $this->_request->getParam('fim'), 2) . '</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><b>PLACA</b></td>';
        $html .= '<td><b>VEICULO</b></td>';
        $html .= '<td><b>KM INICIAL</b></td>';
        $html .= '<td><b>KM FINAL</b></td>';
        $html .= '<td><b>KM RODADOS</b></td>';
        $html .= '<td><b>CONSUMO TOTAL</b></td>';
        $html .= '<td><b>M&Eacute;DIA</b></td>';
        $html .= '</tr>';

        foreach ($abastecimentos as $abastecimento) {
            $dados_abastecimento = $this->view->CalcularMedia($abastecimento['id_veiculo'], $this->_request->getParam('inicio'), $this->_request->getParam('fim'));
            if ($dados_abastecimento['media_consumo']) {
                $html .= '<tr>';
                $html .= '<td>' . $abastecimento['placa'] . '</td>';
                $html .= '<td>' . utf8_decode($abastecimento['modelo_veiculo']) . '</td>';
                $html .= '<td>' . $this->view->FormatNumber($dados_abastecimento['km_inicial']) . '</td>';
                $html .= '<td>' . $this->view->FormatNumber($dados_abastecimento['km_final']) . '</td>';
                $html .= '<td>' . $this->view->FormatNumber($dados_abastecimento['km_rodados']) . '</td>';
                $html .= '<td>' . $this->view->FormatNumber($dados_abastecimento['total_litros']) . '</td>';
                $html .= '<td>' . $this->view->FormatNumber($dados_abastecimento['media_consumo']) . '</td>';
                $html .= '</tr>';
            }
        }

        $html .= '</table>';
        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel; charset=utf-8");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        exit;
    }

    public function mediaConsumoPdfAction() {

        $Model = new Admin_Model_Abastecimentos();

        $abastecimentos = $Model->ListarVeiculos();

        if (!$abastecimentos) {
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não há abastecimento para a exportação!'));
            $this->redirect('admin/relatorios/media-consumo');
        }

        $arquivo = 'media_consumo_' . date('d-m-Y H:i:s');
        $html = '';
        $html .= '<table border="1px">';
        $html .= '<tr>';
        $html .= '<td colspan="7" align="center" bgcolor="#1a629a"><b>M&Eacute;DIAS DO DIA ' . $this->view->ConvercaoDate('-', $this->_request->getParam('inicio'), 2) . ' &Aacute; ' . $this->view->ConvercaoDate('-', $this->_request->getParam('fim'), 2) . '</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><b>PLACA</b></td>';
        $html .= '<td><b>VEICULO</b></td>';
        $html .= '<td><b>KM INICIAL</b></td>';
        $html .= '<td><b>KM FINAL</b></td>';
        $html .= '<td><b>KM RODADOS</b></td>';
        $html .= '<td><b>CONSUMO TOTAL</b></td>';
        $html .= '<td><b>M&Eacute;DIA</b></td>';
        $html .= '</tr>';

        foreach ($abastecimentos as $abastecimento) {
            $dados_abastecimento = $this->view->CalcularMedia($abastecimento['id_veiculo'], $this->_request->getParam('inicio'), $this->_request->getParam('fim'));
            if ($dados_abastecimento['media_consumo']) {
                $html .= '<tr>';
                $html .= '<td>' . $abastecimento['placa'] . '</td>';
                $html .= '<td>' . utf8_decode($abastecimento['modelo_veiculo']) . '</td>';
                $html .= '<td>' . $this->view->FormatNumber($dados_abastecimento['km_inicial']) . '</td>';
                $html .= '<td>' . $this->view->FormatNumber($dados_abastecimento['km_final']) . '</td>';
                $html .= '<td>' . $this->view->FormatNumber($dados_abastecimento['km_rodados']) . '</td>';
                $html .= '<td>' . $this->view->FormatNumber($dados_abastecimento['total_litros']) . '</td>';
                $html .= '<td>' . $this->view->FormatNumber($dados_abastecimento['media_consumo']) . '</td>';
                $html .= '</tr>';
            }
        }

        $html .= '</table>';
        $data = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $this->view->GerarPdf($data, 'relatorios', $arquivo);
        exit();
        //$this->view->cargas = $cargas;
    }

    public function mediaConsumoGraficoAction() {

        $Model = new Admin_Model_Abastecimentos();

        $grafico = $this->_request->getParam('param');

        if ($this->_request->getParam('inicio')) {
            $inicio = $this->_request->getParam('inicio');
        } else {
            $inicio_mes = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $inicio = date('Y-m-d', $inicio_mes);
        }

        if ($this->_request->getParam('fim')) {
            $fim = $this->_request->getParam('fim');
        } else {
            $fim = date('Y-m-d');
        }


        $dados = $Model->GraficoMediaVeiculos($inicio, $fim);

        $titulo = utf8_decode('Grafico de média de consumo entre veículos');
        $tipo_grafico = 'stackedbars';
        $tituloY = utf8_decode('Médias de Consumo L/KM');
        $tituloX = 'Veiculos';

        if ($grafico) {
            $this->view->GerarGrafico($titulo, $tipo_grafico, $tituloY, $tituloX, $dados);
            exit();
        }

        $this->view->dt_inicio = $this->view->ConvercaoDate('-', $inicio, 2);
        $this->view->dt_fim = $this->view->ConvercaoDate('-', $fim, 2);
        $this->view->grafico = $_SERVER['REQUEST_URI'] . '/param/1';
    }

}
