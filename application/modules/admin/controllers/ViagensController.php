<?php

class Admin_ViagensController extends Zend_Controller_Action {

    public function indexAction() {
        $auth = Zend_Auth::getInstance();
        $Model = new Admin_Model_Viagens();
        $categorias = new Admin_Model_Categorias();
        $veiculos = new Admin_Model_Caminhoes();
        $motoristas = new Admin_Model_Motoristas();

        $veiculo = $this->_request->getParam('veiculo');
        $motorista = $this->_request->getParam('motorista');

        $categoria = $this->_request->getParam('categoria');
        $subcategoria = $this->_request->getParam('subcategoria');


        if ($subcategoria == 'undefined') {
            $subcategoria = FALSE;
        }

        
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
        
        $lista_viagens = $Model->Lista($veiculo, $motorista, $categoria, $subcategoria, $data_inicio, $data_fim);

        $lista_categorias = $categorias->ListCategory();
        if ($categoria) {
            $lista_subcategoria = $categorias->getSubs($categoria);
        }
        $lista_veiculos = $veiculos->ListarCaminhoes();
        $lista_motoristas = $motoristas->ListarMotoristas();


        $this->view->dados = $lista_viagens;
        $this->view->categorias = $lista_categorias;
        $this->view->subcategorias = $lista_subcategoria;
        $this->view->veiculos = $lista_veiculos;
        $this->view->motoristas = $lista_motoristas;


        $this->view->user = $auth->getIdentity();
        $this->view->categoria = $categoria;
        $this->view->subcategoria = $subcategoria;
        $this->view->veiculo = $veiculo;
        $this->view->motorista = $motorista;
        $this->view->data_inicio = $data_inicio;
        $this->view->data_fim = $data_fim;
    }

    public function excluirAction() {
        $id = (int) $this->_request->getParam('id');

        $Model = new Admin_Model_Viagens();
        //$Model->delete("id = " . $id);
        $Model->update(array('excluido' => '1'), "id = '" . $id . "' ");

        //Adiciona a mensagem de sucesso
        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Excluido com sucesso'));

        $this->_redirect('admin/viagens');
    }
    
     public function ticketAction() {
        $this->_helper->layout()->disableLayout();
        $id = (int) $this->_request->getParam('id');
        $Model = new Admin_Model_Viagens();
        $auth = Zend_Auth::getInstance();
          
        $result = $Model->GetTicket($id);
        $result['dados_usuario'] = $auth->getIdentity();
      // Zend_Debug::dump($result);die;
        if (!$result) {
            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Ação não Permitida!'));
            $this->_helper->redirector('index');
        }

        //Zend_Debug::dump($result);die;
        $this->view->dados = $result;
    }

    public function visualizarAction() {
        $param = (int) $this->_request->getParam('param');
        $ModelViagens = new Admin_Model_Viagens();
        $consulta = $ModelViagens->ViewViagem($param);


        if ($consulta) {

            $resposta = $consulta;
            $resposta['result'] = 'ok';
            $resposta['data_abertura'] = $this->view->ConvercaoDate('-', $consulta['data_abertura'], '10');
            $resposta['data_fechamento'] = $this->view->ConvercaoDate('-', $consulta['data_fechamento'], '10');
            $resposta['data_fechamento_final'] = $this->view->ConvercaoDate('-', $consulta['data_fechamento_final'], '10');
            $resposta['data_inserido_servidor'] = $this->view->ConvercaoDate('-', $consulta['data_inserido_servidor'], '10');
            $resposta['data_atualizacao_servidor'] = $this->view->ConvercaoDate('-', $consulta['data_atualizacao_servidor'], '10');
            $resposta['peso_bruto'] = number_format($consulta['peso_bruto'], 2, ",", ".");
            $resposta['peso_nota'] = number_format($consulta['peso_nota'], 2, ",", ".");
            $resposta['peso_tara'] = number_format($consulta['peso_tara'], 2, ",", ".");
            $resposta['km_inicial'] = number_format($consulta['km_inicial'], 2, ",", ".");
            $resposta['km_carga'] = number_format($consulta['km_carga'], 2, ",", ".");
            $resposta['km_descarga'] = number_format($consulta['km_descarga'], 2, ",", ".");
            $resposta['km_final'] = number_format($consulta['km_final'], 2, ",", ".");

            $peso_bruto = $this->view->LimpaNumero($consulta['peso_bruto']);
            $peso_tara = $this->view->LimpaNumero($consulta['peso_tara']);

            $km_inicial = $this->view->LimpaNumero($consulta['km_inicial']);
            $km_carga = $this->view->LimpaNumero($consulta['km_carga']);
            $km_descarga = $this->view->LimpaNumero($consulta['km_descarga']);
            $km_final = $this->view->LimpaNumero($consulta['km_final']);


            /* Se abriu a pesagem com Tara */
            if ($consulta['tipo_pesagem_abertura'] == '1' || $consulta['tipo_pesagem_abertura'] == '3') {

                if (!empty($km_carga)) {
                    $inicio_carga = ($km_carga - $km_inicial);
                } else {
                    $inicio_carga = '';
                }

                if (!empty($km_final) && !empty($km_descarga)) {
                    $fim_descarga = ($km_final - $km_descarga);
                } else {
                    $fim_descarga = '';
                }

                $km_rodados_vazio = ($inicio_carga + $fim_descarga);
            } else {
                if (!empty($km_final) && !empty($km_descarga)) {
                    $km_rodados_vazio = ($km_final - $km_descarga);
                } else {
                    $km_rodados_vazio = '';
                }
            }

            if (!empty($km_rodados_vazio)) {
                $resposta['km_rodados_vazio'] = number_format($km_rodados_vazio, 2, ",", ".");
            } else {
                $resposta['km_rodados_vazio'] = '0.00';
            }

            if (!empty($consulta['peso_tara']) && !empty($consulta['peso_bruto'])) {
                $peso_liquido = ($peso_bruto - $peso_tara);
                $resposta['peso_liquido'] = number_format($peso_liquido, 2, ",", ".");
            } else {
                $resposta['peso_liquido'] = '';
            }

            if (!empty($resposta['peso_liquido']) && !empty($consulta['quantidade'])) {
                $peso_medio = ($peso_liquido / $consulta['quantidade']);
                $resposta['peso_medio'] = number_format($peso_medio, 2, ",", ".");
            } else {
                $resposta['peso_medio'] = '';
            }


            if (!empty($consulta['km_inicial']) && !empty($consulta['km_final'])) {
                $km_rodados = ($km_final - $km_inicial);
                $resposta['km_rodados'] = number_format($km_rodados, 2, ",", ".");
            }

            if (!empty($km_rodados) && !empty($km_rodados_vazio)) {
                $resposta['km_rodados_carregado'] = number_format(($km_rodados - $km_rodados_vazio), 2, ",", ".");
            }
        } else {
            $resposta['result'] = 'failed';
        }

        $this->_helper->json($resposta);
    }

    public function rotaAction() {

    }

    public function jsonRotasAction() {
        $id = (int) $this->_request->getParam('id');
        $Model = new Admin_Model_Viagens();
        $dados = $Model->GetCoordenadas($id);

        $coordenadas_abertura = explode(',', $dados['coordenadas_abertura']);
        $coordenadas_fechamento = explode(',', $dados['coordenadas_fechamento']);
        $dados['latitude_abertura'] = $coordenadas_abertura[0];
        $dados['longitude_abertura'] = $coordenadas_abertura[1];
        $dados['latitude_fechamento'] = $coordenadas_fechamento[0];
        $dados['longitude_fechamento'] = $coordenadas_fechamento[1];




        $this->_helper->json($dados);
    }

    public function exportarExcelAction() {

        $Model = new Admin_Model_Viagens();

        $categoria = $this->_request->getParam('categoria');
        $subcategoria = $this->_request->getParam('subcategoria');
        $veiculo = $this->_request->getParam('veiculo');
        $motorista = $this->_request->getParam('motorista');
        
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


        $lista_viagens = $Model->Lista($veiculo, $motorista, $categoria, $subcategoria, $data_inicio, $data_fim);

        if (!$lista_viagens) {
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não há viagens para a exportação!'));
            $this->redirect('admin/viagens/');
        }
        
         if ($data_inicio) {
            $dt_inicio = $this->view->ConvercaoDate('-', $data_inicio, 2);
        }

        if ($data_fim) {
            $dt_fim = $this->view->ConvercaoDate('-', $data_fim, 2);
        }

        //Zend_Debug::dump($cargas);die;
        $arquivo = 'viagens-' . date('d-m-Y H:i:s') . '.xls';
        $html = '';
        $html .= '<table border="1px">';
        $html .= '<tr>';
        $html .= '<td colspan="28" align="center" bgcolor="#1a629a"><b>Viagens do per&iacute;odo:' . $dt_inicio . ' a ' . $dt_fim . '.</b></tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>VEICULO</b></td>';
        $html .= '<td><b>MOTORISTA</b></td>';
        $html .= '<td><b>CATEGORIA</b></td>';
        $html .= '<td><b>SUBCATEGORIA</b></td>';
        $html .= '<td><b>ORIGEM VIAGEM</b></td>';
        $html .= '<td><b>ORIGEM CARREGAMENTO</b></td>';
        $html .= '<td><b>DESTINO DESCARREGAMENTO</b></td>';
        $html .= '<td><b>DESTINO FINAL</b></td>';
        $html .= '<td><b>KM INICIAL</b></td>';
        $html .= '<td><b>KM FINAL</b></td>';
        $html .= '<td><b>KM RODADOS</b></td>';
        $html .= '<td><b>LOCAL PESAGEM ABERTURA</b></td>';
        $html .= '<td><b>LOCAL PESAGEM FECHAMENTO</b></td>';
        $html .= '<td><b>ABRIU COM</b></td>';
        $html .= '<td><b>FECHOU COM</b></td>';
        $html .= '<td><b>TIPO PESAGEM ABERTURA</b></td>';
        $html .= '<td><b>TIPO PESAGEM FECHAMENTO</b></td>';
        $html .= '<td><b>PESO TARA</b></td>';
        $html .= '<td><b>PESO BRUTO</b></td>';
        $html .= '<td><b>PESO LIQU&Iacute;DO</b></td>';
        $html .= '<td><b>PESO NOTA</b></td>';
        $html .= '<td><b>PESO M&Eacute;DIO</b></td>';
        $html .= '<td><b>QUANTIDADE</b></td>';
        $html .= '<td><b>N&#186; NOTA</b></td>';
        $html .= '<td><b>DATA ABERTURA</b></td>';
        $html .= '<td><b>DATA FECHAMENTO</b></td>';
        $html .= '<td><b>OBSERVA&Ccedil;&Atilde;O</b></td>';

        $html .= '</tr>';

        foreach ($lista_viagens as $viagens) {

            if ($viagens['tipo_pesagem_abertura'] == '1') {
                $tipo_pesagem_abertura = 'Tara';
            } elseif ($viagens['tipo_pesagem_abertura'] == '2') {
                $tipo_pesagem_abertura = 'Bruto';
            } else {
                $tipo_pesagem_abertura = '';
            }

            if ($viagens['tipo_pesagem_fechamento'] == '1') {
                $tipo_pesagem_fechamento = 'Tara';
            } elseif ($viagens['tipo_pesagem_fechamento'] == '2') {
                $tipo_pesagem_fechamento = 'Bruto';
            } else {
                $tipo_pesagem_fechamento = '';
            }

            if ($viagens['pesagem_manual_inicio'] == '1') {
                $manual_abertura = 'Manual';
            } elseif ($viagens['pesagem_manual_inicio'] == '2') {
                $manual_abertura = 'automático';
            } else {
                $manual_abertura = '';
            }

            if ($viagens['pesagem_manual_fim'] == '1') {
                $manual_fechamento = 'Manual';
            } elseif ($viagens['pesagem_manual_fim'] == '2') {
                $manual_fechamento = 'automático';
            } else {
                $manual_fechamento = '';
            }

            if (!empty($viagens['km_inicial']) && !empty($viagens['km_final'])) {
                $km_rodados = ($viagens['km_final'] - $viagens['km_inicial']);
            } else {
                $km_rodados = '';
            }

            if (!empty($viagens['peso_bruto']) && !empty($viagens['peso_tara'])) {
                $peso_liquido = ($viagens['peso_bruto'] - $viagens['peso_tara']);
            } else {
                $peso_liquido = '0.00';
            }

            if (!empty($peso_liquido) && !empty($viagens['quantidade'])) {
                $peso_medio = ($peso_liquido / $viagens['quantidade']);
            } else {
                $peso_medio = '0.00';
            }

            $html .= '<tr>';
            $html .= '<td>' . $viagens['placa'] . '</td>';
            $html .= '<td>' . utf8_decode($viagens['motorista']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['nome_categoria']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['nome_subcategoria']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['origem']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['nome_origem']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['nome_cliente']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['destino_final']) . '</td>';
            $html .= '<td>' . number_format($viagens['km_inicial'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($viagens['km_final'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($km_rodados, 2, ".", ",") . '</td>';

            $html .= '<td>' . utf8_decode($viagens['local_abertura']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['local_fechamento']) . '</td>';
            $html .= '<td>' . $tipo_pesagem_abertura . '</td>';
            $html .= '<td>' . $tipo_pesagem_fechamento . '</td>';
            $html .= '<td>' . utf8_decode($manual_abertura) . '</td>';
            $html .= '<td>' . utf8_decode($manual_fechamento) . '</td>';


            $html .= '<td>' . number_format($viagens['peso_tara'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($viagens['peso_bruto'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($peso_liquido, 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($viagens['peso_nota'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($peso_medio, 2, ".", ",") . '</td>';
            $html .= '<td>' . $viagens['quantidade'] . '</td>';
            $html .= '<td>' . $viagens['numero_nota'] . '</td>';
            $html .= '<td>' . $this->view->ConvercaoDate('-', $viagens['data_abertura'], 10) . '</td>';
            $html .= '<td>' . $this->view->ConvercaoDate('-', $viagens['data_fechamento'], 10) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['observacao']) . '</td>';
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

        $Model = new Admin_Model_Viagens();

        $categoria = $this->_request->getParam('categoria');
        $subcategoria = $this->_request->getParam('subcategoria');
        $veiculo = $this->_request->getParam('veiculo');
        $motorista = $this->_request->getParam('motorista');
        
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

        $lista_viagens = $Model->Lista($veiculo, $motorista, $categoria, $subcategoria, $data_inicio, $data_fim);

        if (!$lista_viagens) {
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não há viagens para a exportação!'));
            $this->redirect('admin/viagens/');
        }
        
        
        if ($data_inicio) {
            $dt_inicio = $this->view->ConvercaoDate('-', $data_inicio, 2);
        }

        if ($data_fim) {
            $dt_fim = $this->view->ConvercaoDate('-', $data_fim, 2);
        }

        //Zend_Debug::dump($cargas);die;
        $arquivo = 'viagens-' . date('d-m-Y H:i:s') . '.xls';
        $html = '';
        $html .= '<table border="1px">';
        $html .= '<tr>';
        $html .= '<td colspan="28" align="center" bgcolor="#1a629a"><b>Viagens do per&iacute;odo:' . $dt_inicio . ' a ' . $dt_fim . '.</b></tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>VEICULO</b></td>';
        $html .= '<td><b>MOTORISTA</b></td>';
        $html .= '<td><b>CATEGORIA</b></td>';
        $html .= '<td><b>SUBCATEGORIA</b></td>';
        $html .= '<td><b>ORIGEM VIAGEM</b></td>';
        $html .= '<td><b>ORIGEM CARREGAMENTO</b></td>';
        $html .= '<td><b>DESTINO DESCARREGAMENTO</b></td>';
        $html .= '<td><b>DESTINO FINAL</b></td>';
        $html .= '<td><b>KM INICIAL</b></td>';
        $html .= '<td><b>KM FINAL</b></td>';
        $html .= '<td><b>KM RODADOS</b></td>';
        $html .= '<td><b>LOCAL PESAGEM ABERTURA</b></td>';
        $html .= '<td><b>LOCAL PESAGEM FECHAMENTO</b></td>';
        $html .= '<td><b>ABRIU COM</b></td>';
        $html .= '<td><b>FECHOU COM</b></td>';
        $html .= '<td><b>TIPO PESAGEM ABERTURA</b></td>';
        $html .= '<td><b>TIPO PESAGEM FECHAMENTO</b></td>';
        $html .= '<td><b>PESO TARA</b></td>';
        $html .= '<td><b>PESO BRUTO</b></td>';
        $html .= '<td><b>PESO LIQU&Iacute;DO</b></td>';
        $html .= '<td><b>PESO NOTA</b></td>';
        $html .= '<td><b>PESO M&Eacute;DIO</b></td>';
        $html .= '<td><b>QUANTIDADE</b></td>';
        $html .= '<td><b>N&#186; NOTA</b></td>';
        $html .= '<td><b>DATA ABERTURA</b></td>';
        $html .= '<td><b>DATA FECHAMENTO</b></td>';
        $html .= '<td><b>OBSERVA&Ccedil;&Atilde;O</b></td>';

        $html .= '</tr>';

        foreach ($lista_viagens as $viagens) {

            if ($viagens['tipo_pesagem_abertura'] == '1') {
                $tipo_pesagem_abertura = 'Tara';
            } elseif ($viagens['tipo_pesagem_abertura'] == '2') {
                $tipo_pesagem_abertura = 'Bruto';
            } else {
                $tipo_pesagem_abertura = '';
            }

            if ($viagens['tipo_pesagem_fechamento'] == '1') {
                $tipo_pesagem_fechamento = 'Tara';
            } elseif ($viagens['tipo_pesagem_fechamento'] == '2') {
                $tipo_pesagem_fechamento = 'Bruto';
            } else {
                $tipo_pesagem_fechamento = '';
            }

            if ($viagens['pesagem_manual_inicio'] == '1') {
                $manual_abertura = 'Manual';
            } elseif ($viagens['pesagem_manual_inicio'] == '2') {
                $manual_abertura = 'automático';
            } else {
                $manual_abertura = '';
            }

            if ($viagens['pesagem_manual_fim'] == '1') {
                $manual_fechamento = 'Manual';
            } elseif ($viagens['pesagem_manual_fim'] == '2') {
                $manual_fechamento = 'automático';
            } else {
                $manual_fechamento = '';
            }

            if (!empty($viagens['km_inicial']) && !empty($viagens['km_final'])) {
                $km_rodados = ($viagens['km_final'] - $viagens['km_inicial']);
            } else {
                $km_rodados = '';
            }

            if (!empty($viagens['peso_bruto']) && !empty($viagens['peso_tara'])) {
                $peso_liquido = ($viagens['peso_bruto'] - $viagens['peso_tara']);
            } else {
                $peso_liquido = '0.00';
            }

            if (!empty($peso_liquido) && !empty($viagens['quantidade'])) {
                $peso_medio = ($peso_liquido / $viagens['quantidade']);
            } else {
                $peso_medio = '0.00';
            }

            $html .= '<tr>';
            $html .= '<td>' . $viagens['placa'] . '</td>';
            $html .= '<td>' . utf8_decode($viagens['motorista']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['nome_categoria']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['nome_subcategoria']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['origem']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['nome_origem']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['nome_cliente']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['destino_final']) . '</td>';
            $html .= '<td>' . number_format($viagens['km_inicial'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($viagens['km_final'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($km_rodados, 2, ".", ",") . '</td>';

            $html .= '<td>' . utf8_decode($viagens['local_abertura']) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['local_fechamento']) . '</td>';
            $html .= '<td>' . $tipo_pesagem_abertura . '</td>';
            $html .= '<td>' . $tipo_pesagem_fechamento . '</td>';
            $html .= '<td>' . utf8_decode($manual_abertura) . '</td>';
            $html .= '<td>' . utf8_decode($manual_fechamento) . '</td>';


            $html .= '<td>' . number_format($viagens['peso_tara'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($viagens['peso_bruto'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($peso_liquido, 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($viagens['peso_nota'], 2, ".", ",") . '</td>';
            $html .= '<td>' . number_format($peso_medio, 2, ".", ",") . '</td>';
            $html .= '<td>' . $viagens['quantidade'] . '</td>';
            $html .= '<td>' . $viagens['numero_nota'] . '</td>';
            $html .= '<td>' . $this->view->ConvercaoDate('-', $viagens['data_abertura'], 10) . '</td>';
            $html .= '<td>' . $this->view->ConvercaoDate('-', $viagens['data_fechamento'], 10) . '</td>';
            $html .= '<td>' . utf8_decode($viagens['observacao']) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
        $data = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $this->view->GerarPdf($data, 'relatorios', $arquivo);
        exit();
        //$this->view->cargas = $cargas;
    }

    public function usuariosAjaxAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        $param = $this->_request->getParam('q');

        $ModelUsuarios = new Admin_Model_Usuarios();

        $resposta = $ModelUsuarios->BuscarUsuarios($param);

        $this->_helper->json($resposta);
    }

    public function enviaEmailAjaxAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        $id_viagem = $this->_request->getParam('id_viagem');
        $destino = $this->_request->getParam('destinos');

        if (!empty($id_viagem) && is_numeric($id_viagem)) {

            $ModelViagens = new Admin_Model_Viagens();
            $resultViagens = $ModelViagens->GetViagem($id_viagem);

            if ($resultViagens['categoria'] == 1) {
                $peso_bruto = $this->view->LimpaNumero($resultViagens['peso_bruto']);
                $peso_tara = $this->view->LimpaNumero($resultViagens['peso_tara']);

                $peso_liquido = ($peso_bruto - $peso_tara);
                $peso_medio = ($peso_liquido / $resultViagens['quantidade']);
                $data_fechamento = $this->view->ConvercaoDate('-', $resultViagens['data_fechamento'], 10);
                $id_viagem = $resultViagens['id'];


                if ($resultViagens['pesagem_manual_inicio'] == '1') {
                    $pesagem_manual_inicio = 'Manual';
                } else {
                    $pesagem_manual_inicio = 'Automático';
                }

                if ($resultViagens['pesagem_manual_fim'] == '1') {
                    $pesagem_manual_fim = 'Manual';
                } else {
                    $pesagem_manual_fim = 'Automático';
                }

                if (!empty($destino)) {
                    $destinos = explode(',', $destino);
                    $ModelUsuarios = new Admin_Model_Usuarios();

                    foreach ($destinos as $id_destino) {
                        $dados_usuario = $ModelUsuarios->GetDados($id_destino);

                        if (!empty($dados_usuario['email'])) {
                            $conteudo = array(
                                'nome_usuario' => $dados_usuario['nome'],
                                'veiculo' => $resultViagens['placa'],
                                'motorista' => $resultViagens['motorista'],
                                'categoria' => $resultViagens['nome_categoria'],
                                'subcategoria' => $resultViagens['nome_subcategoria'],
                                'origem' => $resultViagens['origem'],
                                'destino_carregamento' => $resultViagens['nome_destino_carregamento'],
                                'origem_carregamento' => $resultViagens['nome_origem_carregamento'],
                                'destino_final' => $resultViagens['destino_final'],
                                'pesagem_manual_inicio' => $pesagem_manual_inicio,
                                'pesagem_manual_fim' => $pesagem_manual_fim,
                                'peso_tara' => number_format($resultViagens['peso_tara'], 2, ",", "."),
                                'peso_bruto' => number_format($resultViagens['peso_bruto'], 2, ",", "."),
                                'peso_liquido' => number_format($peso_liquido, 2, ",", "."),
                                'peso_medio' => number_format($peso_medio, 2, ",", "."),
                                'data_abertura' => $this->view->ConvercaoDate('-', $resultViagens['data_abertura'], 10),
                                'data_fechamento' => $data_fechamento,
                                'local_abertura' => $resultViagens['local_abertura'],
                                'local_fechamento' => $resultViagens['local_fechamento'],
                                'quantidade' => $resultViagens['quantidade'],
                                'observacao' => $resultViagens['observacao']
                            );

                            $assunto = "SysControl | Pesagem de: " . $resultViagens['nome_subcategoria'] . ' - Veículo: ' . $resultViagens['placa'];
                            $HTML = Zend_Controller_Action_HelperBroker::getStaticHelper('Emails')->Emails('', trim($dados_usuario['email']), $assunto, $conteudo, false, 'emails/email-viagens.phtml');
                        }
                    }
                    $resposta['status'] = 'ok';
                } else {
                    $resposta['status'] = 'falha';
                }
            }

            $this->_helper->json($resposta);
        }
    }

}
