<?php

class Admin_AbastecimentosController extends Zend_Controller_Action {

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


        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
    }

    public function adicionarAction() {
        $form = new TCS_Form_FormAbastecimento();
        $ModelAbastecimento = new Admin_Model_Abastecimentos();
        $ModelEstoque = new Admin_Model_EstoqueCombustivel();
        $id = 1;
        /* Busco o estoque atual */
        $estoque = $ModelEstoque->GetDados($id);
        $total_estoque = $this->view->LimpaNumero($estoque['litros']);

        /* Recupero os valores do POST */
        $data = $this->_request->getPost();

        if ($this->_request->isPost() && $form->isValid($data)) {

            $data['data_envio'] = date("Y-m-d H:i:s");

            if ($data['fornecedor'] == 1) {

                unset($data['valor']);
                /* Limpo os valores */
                $litros_abastecido = $data['litros'];

                if ($litros_abastecido <= $total_estoque) {
                    //$valor_litro = $this->view->LimpaNumero($estoque['valor_litro']);

                    $data['valor'] = ($litros_abastecido * $estoque['valor_litro']);
                    $data['valor_litro'] = $estoque['valor_litro'];
                    // Zend_Debug::dump($data);die;
                    $form->registro->setRequired(true);
                    $form->valor->setRequired(FALSE);
                    $ModelAbastecimento->insert($data);

                    /* Dou baixa no estoque */
                    $estoque = ($total_estoque - $litros_abastecido);
                    $ModelEstoque->update(array('litros' => $estoque), "id = '" . $id . "' ");

                    //Adiciona a mensagem de sucesso
                    $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Adicionado com sucesso'));
                } else {
                    //Adiciona a mensagem de erro
                    $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não é possível inserir a quantidade de litros maior que o estoque!'));
                }
            } else {
                unset($data['registro']);

                $form->valor->setRequired(TRUE);
                $form->registro->setRequired(FALSE);
                $ModelAbastecimento->insert($data);

                //Adiciona a mensagem de sucesso
                $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Adicionado com sucesso'));
            }

            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        $this->view->form = $form;
        $this->view->controller = $this->_request->getControllerName();
    }

    public function indexAction() {
        $Model = new Admin_Model_Abastecimentos();
        $abastecimentos = $Model->ListaAbastecimentos();
        $this->view->dados = $abastecimentos;
    }

    public function visualizarAction() {
        $param = (int) $this->_request->getParam('id');
        $ModelAbastecimentos = new Admin_Model_Abastecimentos();
        $consulta = $ModelAbastecimentos->VisualizaAbastecida($param);


        if ($consulta) {

            $resposta = $consulta;
            $resposta['result'] = 'ok';
            $resposta['data_envio'] = $this->view->ConvercaoDate('-', $consulta['data_envio'], '10');
            $resposta['km'] = number_format($consulta['km'], 2, ",", ".");
            $resposta['litros'] = number_format($consulta['litros'], 2, ",", ".");
            $resposta['valor'] = number_format($consulta['valor'], 2, ",", ".");
            $quilometragem = $this->view->LimpaNumero($consulta['km']);

            $result_km = $ModelAbastecimentos->GetPneultimaAbastecida($quilometragem, $consulta['veiculo']);

            if ($result_km) {

                $pneultimo_km = $this->view->LimpaNumero($result_km['km']);
                $ultimo_km = $this->view->LimpaNumero($consulta['km']);
                $litros = $this->view->LimpaNumero($consulta['litros']);
                $km_rodados = ($ultimo_km - $pneultimo_km);
                $resposta['km_anterior'] = number_format($pneultimo_km, 2, ",", ".");
                $resposta['km_rodados'] = number_format($km_rodados, 2, ",", ".");
                $resposta['media_km'] = number_format(($km_rodados / $litros), 2, ",", ".");
            } else {
                $resposta['km_anterior'] = '0.00';
                $resposta['media_km'] = '0.00';
                $resposta['km_rodados'] = '0.00';
            }
        } else {
            $resposta['result'] = 'failed';
        }

        $this->_helper->json($resposta);
    }

    public function estoqueAction() {
        $ModelEstoque = new Admin_Model_EstoqueCombustivel();
        $form = new TCS_Form_FormCombustivel();
        $values = $ModelEstoque->GetDados(1);

        $litros_estoque = $values['litros'];

        /* Retiro do array */
        unset($values['litros']);


        $form->populate($values);
        $data = $this->_request->getPost();

        if ($this->_request->isPost() && $form->isValid($data)) {

            /* Pedo os dados do usuario logado no sistema */
            $auth = Zend_Auth::getInstance();
            $user = $auth->getIdentity();

            /* Limpo o valor total estoque */
            $total = number_format($data['litros'], 2, ",", ".");

            $litros_adicionado = $this->view->LimpaNumero($data['litros']);
            $litros_estoque = $this->view->LimpaNumero($litros_estoque);

            /* Subtraio estoque atual pela quantidade abastecida */
            $total_litros = ($litros_estoque + $litros_adicionado);

            if ($total_litros <= $values['capacidade_tanque']) {

                $data['litros'] = $total_litros;
                $data['valor_litro'] = $this->view->LimpaNumero($data['valor_litro']);
                $data['usuario'] = $user->id;
                $data['data_atualizacao'] = date("Y-m-d H:i:s");

                $ModelEstoque->update($data, "id = '" . $data['id'] . "' ");
                $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Atenção foi adicionado ' . $total . ' litros ao estoque!'));
            } else {
                $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não é possível adicionar combustivel acima da capacidade do tanque!'));
            }
            $this->redirect($_SERVER['HTTP_REFERER']);
        }

        $this->view->form = $form;
        $this->view->estoque = $litros_estoque;
        $this->view->capacidade = $values['capacidade_tanque'];
    }

    public function excluirAction() {
        $id = (int) $this->_request->getParam('id');

        $modelAbastecimento = new Admin_Model_Abastecimentos();


        $modelAbastecimento->delete("id = " . $id);

        //Adiciona a mensagem de sucesso
        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Excluido com sucesso'));

        $this->_redirect('admin/abastecimentos');
    }

    public function exportarExcelAction() {

        $Model = new Admin_Model_Abastecimentos();

        $veiculo = $this->_request->getParam('veiculo');
        $motorista = $this->_request->getParam('motorista');
        $mes = $this->_request->getParam('mes');


        if ($mes) {
            $data = array();
            $data['mes'] = $mes;
            $data['ano'] = date("Y");
        }

        if ($motorista == 0) {
            $motorista = false;
        }

        if ($veiculo == 0) {
            $veiculo = false;
        }

        if ($mes == 0) {
            $mes = false;
        }


        $abastecimentos = $Model->ListaAbastecimentos(false, $veiculo, $motorista, $mes);

        if (!$abastecimentos) {
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não há registro de abastecimentos para a exportação!'));
            $this->redirect('admin/abastecimentos/');
        }

        if (!empty($data['mes'])) {
            $mes = $data['mes'];
        } else {
            $mes = date('m');
        }

        //Zend_Debug::dump($cargas);die;
        $arquivo = 'abastecimentos_' . date('d-m-Y H:i:s') . '.xls';
        $html = '';
        $html .= '<table border="1px">';
        $html .= '<tr>';
        $html .= '<td colspan="14" align="center" bgcolor="#1a629a"><b>ABASTECIMENTOS  DO MÊS DE ' . strtoupper($this->view->MesExtenso($mes)) . '</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><b>PLACA</b></td>';
        $html .= '<td><b>MOTORISTA</b></td>';
        $html .= '<td><b>FORNECEDOR</b></td>';
        $html .= '<td><b>KM</b></td>';
        $html .= '<td><b>LITROS</b></td>';
        $html .= '<td><b>REGISTRO</b></td>';
        $html .= '<td><b>VALOR</b></td>';
        $html .= '<td><b>DATA ENVIO</b></td>';
        $html .= '</tr>';


        foreach ($abastecimentos as $abastecimento) {
            $html .= '<tr>';
            $html .= '<td>' . $abastecimento['placa'] . '</td>';
            $html .= '<td>' . utf8_decode($abastecimento['nome_motorista']) . '</td>';
            $html .= '<td>' . utf8_decode($abastecimento['nome_fornecedor']) . '</td>';
            $html .= '<td>' . number_format($abastecimento['km'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($abastecimento['litros'], 2, ".", ",") . '</td>';
            $html .= '<td>' . $abastecimento['registro'] . '</td>';
            $html .= '<td>' . number_format($abastecimento['valor'], 2, ".", ",") . '</td>';
            $html .= '<td>' . $this->view->ConvercaoDate('-', $abastecimento['data_envio'], 10) . '</td>';
            $html .= '</tr>';
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

    public function exportarPdfAction() {

        $Model = new Admin_Model_Abastecimentos();

        $veiculo = $this->_request->getParam('veiculo');
        $motorista = $this->_request->getParam('motorista');
        $mes = $this->_request->getParam('mes');


        if ($mes) {
            $data = array();
            $data['mes'] = $mes;
            $data['ano'] = date("Y");
        }

        if ($motorista == 0) {
            $motorista = false;
        }

        if ($veiculo == 0) {
            $veiculo = false;
        }

        if ($mes == 0) {
            $mes = false;
        }

        $abastecimentos = $Model->ListaAbastecimentos(false, $veiculo, $motorista, $mes);

        if (!$abastecimentos) {
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não há registro de abastecimentos para a exportação!'));
            $this->redirect('admin/abastecimentos/');
        }

        if (!empty($data['mes'])) {
            $mes = $data['mes'];
        } else {
            $mes = date('m');
        }

        $arquivo = 'abastecimentos_' . date('d-m-Y H:i:s');
        $html = '';
        $html .= '<table border="1px">';
        $html .= '<tr>';
        $html .= '<td colspan="14" align="center" bgcolor="#1a629a"><b>ABASTECIMENTOS  DO MÊS DE ' . strtoupper($this->view->MesExtenso($mes)) . '</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><b>PLACA</b></td>';
        $html .= '<td><b>MOTORISTA</b></td>';
        $html .= '<td><b>FORNECEDOR</b></td>';
        $html .= '<td><b>KM</b></td>';
        $html .= '<td><b>LITROS</b></td>';
        $html .= '<td><b>REGISTRO</b></td>';
        $html .= '<td><b>VALOR</b></td>';
        $html .= '<td><b>DATA ENVIO</b></td>';
        $html .= '</tr>';


        foreach ($abastecimentos as $abastecimento) {
            $html .= '<tr>';
            $html .= '<td>' . $abastecimento['placa'] . '</td>';
            $html .= '<td>' . utf8_decode($abastecimento['nome_motorista']) . '</td>';
            $html .= '<td>' . utf8_decode($abastecimento['nome_fornecedor']) . '</td>';
            $html .= '<td>' . number_format($abastecimento['km'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($abastecimento['litros'], 2, ".", ",") . '</td>';
            $html .= '<td>' . $abastecimento['registro'] . '</td>';
            $html .= '<td>' . number_format($abastecimento['valor'], 2, ".", ",") . '</td>';
            $html .= '<td>' . $this->view->ConvercaoDate('-', $abastecimento['data_envio'], 10) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table></body></html>';
        $data = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $this->view->GerarPdf($data, 'relatorios', $arquivo);
        exit();
    }

    public function detalhesMediaAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        $veiculo = $this->_request->getParam('veiculo');
        $data_inicio = $this->_request->getParam('inicio');
        $data_fim = $this->_request->getParam('fim');

        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        $ModelSistema = new Admin_Model_ConfSistema();
        $ModelAbastecimento = new Admin_Model_Abastecimentos();
        $abastecimentos = $ModelAbastecimento->GetViagensMedia($veiculo, $data_inicio, $data_fim);


        $this->view->conf = $ModelSistema->GetDados($user->id);
        $this->view->dados = $abastecimentos;
    }

}
