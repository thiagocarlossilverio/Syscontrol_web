<?php

class Admin_CargasController extends Zend_Controller_Action {

    public function indexAction() {
        $auth = Zend_Auth::getInstance();
        $Model = new Admin_Model_Cargas();

        $mes = $this->_request->getParam('mes');

        if ($mes) {
            $post = date("Y-m", strtotime("$mes month"));
        } else {
            $post = date("Y-m");
        }

        $array = explode("-", $post);
        $data = array();
        $data['mes'] = $array[1];
        $data['ano'] = $array[0];

        $result = $Model->Lista(TRUE, $data);

        $this->view->mes = $mes;
        $this->view->data = $data;
        $this->view->dados = $result;
        $this->view->user = $auth->getIdentity();
    }

    public function exportarExcelAction() {

        $Model = new Admin_Model_Cargas();
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


        $cargas = $Model->FiltroCargas(FALSE, $data_inicio, $data_fim, $categoria);

        if (!$cargas) {
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não há cargas para a exportação!'));
            $this->redirect('admin/cargas/');
        }

        if ($data_inicio) {
            $dt_inicio = $this->view->ConvercaoDate('-', $data_inicio, 2);
        }

        if ($data_fim) {
            $dt_fim = $this->view->ConvercaoDate('-', $data_fim, 2);
        }

        //Zend_Debug::dump($cargas);die;
        $arquivo = 'cargas-' . date('d-m-Y H:i:s') . '.xls';
        $html = '';
        $html .= '<table border="1px">';
        $html .= '<tr>';
        $html .= '<td colspan="15" align="center" bgcolor="#1a629a"><b>Cargas do per&iacute;odo:' . $dt_inicio . ' a ' . $dt_fim . '.</b></tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>PLACA</b></td>';
        $html .= '<td><b>VEICULO</b></td>';
        $html .= '<td><b>MOTORISTA</b></td>';
        $html .= '<td><b>CPF MOT.</b></td>';
        $html .= '<td><b>CARGA</b></td>';
        $html .= '<td><b>DESTINO</b></td>';
        $html .= '<td><b>PESO BRUTO</b></td>';
        $html .= '<td><b>PESO TARA</b></td>';
        $html .= '<td><b>' . utf8_decode('PESO LIQUÍDO') . '</b></td>';
        $html .= '<td><b>PESO NOTA</b></td>';
        $html .= '<td><b>' . utf8_decode('CABEÇAS') . '</b></td>';
        $html .= '<td><b>' . utf8_decode('PESO MÉDIO') . '</b></td>';
        $html .= '<td><b>DATA ENTRADA</b></td>';
        $html .= '<td><b>DATA SAIDA</b></td>';
        $html .= '</tr>';

        foreach ($cargas as $carga) {
            $html .= '<tr>';
            $html .= '<td>' . $carga['placa'] . '</td>';
            $html .= '<td>' . utf8_decode($carga['modelo']) . '</td>';
            $html .= '<td>' . utf8_decode($carga['motorista']) . '</td>';
            $html .= '<td>' . $carga['cpf_motorista'] . '</td>';
            $html .= '<td>' . utf8_decode($carga['nome_categoria']) . '</td>';
            $html .= '<td>' . utf8_decode($carga['cliente']) . '</td>';
            $html .= '<td>' . number_format($carga['peso_bruto'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($carga['peso_tara'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($carga['peso_liquido'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($carga['peso_nota'], 2, ".", ",") . '</td>';
            $html .= '<td>' . $carga['cabecas'] . '</td>';
            $html .= '<td>' . number_format($carga['peso_medio'], 2, ".", ",") . '</td>';
            $html .= '<td>' . $this->view->ConvercaoDate('-', $carga['data_entrada'], 10) . '</td>';
            $html .= '<td>' . $this->view->ConvercaoDate('-', $carga['data_saida'], 10) . '</td>';
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

        $Model = new Admin_Model_Cargas();
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


        $cargas = $Model->FiltroCargas(FALSE, $data_inicio, $data_fim, $categoria);


        if (!$cargas) {
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não há cargas para a exportação!'));
            $this->redirect('admin/cargas/');
        }

        if ($data_inicio) {
            $dt_inicio = $this->view->ConvercaoDate('-', $data_inicio, 2);
        }

        if ($data_fim) {
            $dt_fim = $this->view->ConvercaoDate('-', $data_fim, 2);
        }

        $arquivo = 'cargas-' . date('d-m-Y H:i:s');
        $html = '<html><body>';
        $html .= '<table border="1px">';
        $html .= '<tr>';
        $html .= '<td colspan="15" align="center" bgcolor="#1a629a"><b>Cargas do per&iacute;odo:' . $dt_inicio . ' a ' . $dt_fim . '.</b></tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>PLACA</b></td>';
        $html .= '<td><b>VEICULO</b></td>';
        $html .= '<td><b>MOTORISTA</b></td>';
        $html .= '<td><b>CPF MOT.</b></td>';
        $html .= '<td><b>CARGA</b></td>';
        $html .= '<td><b>DESTINO</b></td>';
        $html .= '<td><b>PESO BRUTO</b></td>';
        $html .= '<td><b>PESO TARA</b></td>';
        $html .= '<td><b>PESO LIQUÍDO</b></td>';
        $html .= '<td><b>PESO NOTA</b></td>';
        $html .= '<td><b>CABEÇAS</b></td>';
        $html .= '<td><b>PESO MÉDIO</b></td>';
        $html .= '<td><b>DATA ENTRADA</b></td>';
        $html .= '<td><b>DATA SAIDA</b></td>';
        $html .= '</tr>';

        foreach ($cargas as $carga) {
            $html .= '<tr>';
            $html .= '<td>' . $carga['placa'] . '</td>';
            $html .= '<td>' . $carga['modelo'] . '</td>';
            $html .= '<td>' . $carga['motorista'] . '</td>';
            $html .= '<td>' . $carga['cpf_motorista'] . '</td>';
            $html .= '<td>' . $carga['nome_categoria'] . '</td>';
            $html .= '<td>' . $carga['cliente'] . '</td>';
            $html .= '<td>' . number_format($carga['peso_bruto'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($carga['peso_tara'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($carga['peso_liquido'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($carga['peso_nota'], 2, ".", ",") . '</td>';
            $html .= '<td>' . $carga['cabecas'] . '</td>';
            $html .= '<td>' . number_format($carga['peso_medio'], 2, ".", ",") . '</td>';
            $html .= '<td>' . $this->view->ConvercaoDate('-', $carga['data_entrada'], 10) . '</td>';
            $html .= '<td>' . $this->view->ConvercaoDate('-', $carga['data_saida'], 10) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table></body></html>';
        $data = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $this->view->GerarPdf($data, 'relatorios', $arquivo);
        exit();
        //$this->view->cargas = $cargas;
    }

    public function ajaxPesoAction() {
        $peso = Zend_Controller_Action_HelperBroker::getStaticHelper('CapturaPeso')->Capturar(false);
        print_r($peso);
        exit;
    }

    public function adicionarAction() {
        $form = new TCS_Form_FormCarga();
        $Model = new Admin_Model_Cargas();
        $data = $this->_request->getPost();

        if (!isset($data['peso_tara']) && empty($data['peso_tara'])) {
            if ($data['peso_bruto'] < $data['peso_tara']) {
                $this->_helper->FlashMessenger->addMessage(array('erro' => 'O peso bruto não pode ser menor que o peso tara!'));
                $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }


        if ($this->_request->isPost() && $form->isValid($data)) {
            if (!empty($data['caminhao']) && !empty($data['nota_fiscal'])) {
                $verifica = $Model->VerificaNota($data['caminhao'], $data['nota_fiscal']);

                if ($verifica) {
                    //Adiciona a mensagem de sucesso
                    $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não é possível inserir o mesmo Nº de nota fiscal para o mesmo veículo!'));
                    $this->redirect($_SERVER['HTTP_REFERER']);
                }
            }
            $Model->insert($data);

            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Adicionado com sucesso'));
            $this->redirect('admin/cargas/');
        }
        $this->view->form = $form;
        $this->view->controller = $this->_request->getControllerName();
    }

    public function editarAction() {
        $id = (int) $this->_request->getParam('id');
        $form = new TCS_Form_FormCarga();
        $Model = new Admin_Model_Cargas();

        if ($id) {
            $values = $Model->GetDados($id);

            if (!$values) {
                //Adiciona a mensagem de sucesso
                $this->_helper->FlashMessenger->addMessage(array('erro' => 'Ação não Permitida!'));
                $this->_helper->redirector('index');
            }
            if (empty($values['data_saida'])) {
                $values['data_saida'] = date('d/m/Y H:i:s');
            }
            //  Zend_Debug::dump($values);die;
            $form->populate($values);

            $data = $this->_request->getPost();
            //Zend_Debug::dump($data);die;
            if (!isset($data['peso_tara']) && empty($data['peso_tara'])) {
                if (isset($data['peso_bruto']) && $data['peso_bruto'] < $data['peso_tara']) {
                    $this->_helper->FlashMessenger->addMessage(array('erro' => 'O peso bruto não pode ser menor que o peso tara!'));
                    $this->redirect($_SERVER['HTTP_REFERER']);
                }
            }

            if (isset($data['peso_tara']) && $data['peso_tara'] == '0') {
                $this->_helper->FlashMessenger->addMessage(array('erro' => 'Preencha o peso tara!'));
                $this->redirect($_SERVER['HTTP_REFERER']);
            }


            if (isset($data['peso_tara']) && $data['peso_tara'] > $data['peso_bruto']) {
                $this->_helper->FlashMessenger->addMessage(array('erro' => 'O peso tara deve ser menor que o peso bruto!'));
                $this->redirect($_SERVER['HTTP_REFERER']);
            }


            if ($data['data_saida'] < $data['data_entrada']) {
                $this->_helper->FlashMessenger->addMessage(array('erro' => 'A data de saida deve ser maior que a data de entrada!'));
                $this->redirect($_SERVER['HTTP_REFERER']);
            }

            if ($this->_request->isPost() && $form->isValid($data)) {

                $data['peso_medio'] = NULL;
                if (!empty($data['peso_bruto']) && !empty($data['peso_tara']) && $data['peso_bruto'] > $data['peso_tara']) {
                    $peso_bruto = $this->view->LimpaNumero($data['peso_bruto']);
                    $peso_tara = $this->view->LimpaNumero($data['peso_tara']);
                    $peso_liquido = ($peso_bruto - $peso_tara);
                    $peso_nota = $this->view->LimpaNumero($data['peso_nota']);

                    if (!empty($peso_liquido) && !empty($peso_nota) && $peso_liquido > $peso_nota) {

                        //(2615 - 2400) / 2400 * 100 = 8.958%
                        $percentual = ((($peso_liquido - $peso_nota) / $peso_nota) * 100);
                        //die($var1);
                        //$indice = (0.2 / 100.0);
                        // die($indice);
                        if ($percentual > 0.2) {
                            $this->_helper->FlashMessenger->addMessage(array('erro' => 'A porcentagem de indice de quebra, está acima de 0.2%'));
                            $data['percentual_quebra'] = $percentual;
                        }
                    } else {
                        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'A carga  foi concluida com sucesso!'));
                    }
                    // O resultado será 13,39
                }
                $Model->insert($data);
                $this->redirect('admin/cargas/carga/id/' . $id);
            }
            $this->view->form = $form;
            $this->view->controller = $this->_request->getControllerName();
            $this->render('adicionar');
        } else {
            $this->_helper->redirector('index');
        }
    }

    public function excluirAction() {
        $id = (int) $this->_request->getParam('id');

        $Model = new Admin_Model_Cargas();
        //$Model->delete("id = " . $id);
        $Model->update(array('excluido' => '1'), "id = '" . $id . "' ");

        //Adiciona a mensagem de sucesso
        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Excluido com sucesso'));

        $this->_redirect('admin/cargas');
    }

    public function ticketAction() {
        $this->_helper->layout()->disableLayout();
        $id = (int) $this->_request->getParam('id');
        $Model = new Admin_Model_Cargas();
        $result = $Model->GetTicket($id);
        //Zend_Debug::dump($result);die;
        if (!$result) {
            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Ação não Permitida!'));
            $this->_helper->redirector('index');
        }

        //Zend_Debug::dump($result);die;
        $this->view->dados = $result;
    }

    public function cargaAction() {

        $id = (int) $this->_request->getParam('id');
        $Model = new Admin_Model_Cargas();
        $result = $Model->GetTicket($id);

        if (!$result) {
            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Ação não Permitida!'));
            $this->_helper->redirector('index');
        }

        //Zend_Debug::dump($result);die;
        $this->view->dados = $result;
    }

    public function ajaxVerificaAction() {
        $Model = new Admin_Model_Cargas();
        $result = $Model->VerificaCargas();
        die($result);
    }

    public function ajaxVerificaNotaAction() {
        $this->_helper->layout()->disableLayout();
        $Model = new Admin_Model_Cargas();
        $caminhao = $this->_request->getParam('caminhao');
        $nota = $this->_request->getParam('nota');
        $result = $Model->VerificaNota($caminhao, $nota);
        die($result);
    }

}
