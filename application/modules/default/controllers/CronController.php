<?php

class CronController extends Zend_Controller_Action {

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
    }

    public function indexAction() {
        $this->_helper->layout->disableLayout();
        $ModelCargas = new Admin_Model_Cargas();

        /* Listo os registros dos ultimo 7 dias */
        $cargas = $ModelCargas->GetRelatorioSemanal(1);

        if ($cargas) {
            $ModelUsuarios = new Admin_Model_Usuarios();
            $grafico_peso_liquido = $ModelCargas->geraGraficoPesoLiquido(800, 350);
            $grafico_peso_medio = $ModelCargas->geraGraficoPesoMedio(800, 350);
            $grafico_total = $ModelCargas->geraGraficoTotal(800, 350);


            $relatorio = array();
            $relatorio['registros'] = $cargas;
            $relatorio['grafico_peso_liquido'] = $grafico_peso_liquido;
            $relatorio['grafico_peso_medio'] = $grafico_peso_medio;
            $relatorio['grafico_total'] = $grafico_total;

            /* Listo todos os usuarios ativos */
            $listaUsuarios = $ModelUsuarios->GetUsuarios();

            $assunto = "SysControl | Relatório Semanal";
            foreach ($listaUsuarios as $user) {
                if (!empty($user['email'])) {
                    $relatorio['usuario'] = $user['nome'];
                    $enviar = Zend_Controller_Action_HelperBroker::getStaticHelper('Emails')->Emails('', trim($user['email']), $assunto, $relatorio, false, 'emails/relatorio.phtml');
                }
            }

            die('1');
        }
    }

    public function notificaAction() {
        $this->_helper->layout->disableLayout();
        $ModelCargas = new Admin_Model_Cargas();
        $ModelUsuarios = new Admin_Model_Usuarios();

        $DadosCarga = $ModelCargas->GetNotifica();

        /* Listo todos os usuarios ativos */
        $listaUsuarios = $ModelUsuarios->UsrNotificar();

        if ($DadosCarga) {
            $id_carga = $DadosCarga['id'];
            foreach ($listaUsuarios as $user) {

                if (!empty($user['email'])) {
                    $conteudo = array('nome' => $user['nome'],
                        'placa' => $DadosCarga['placa'],
                        'modelo_veiculo' => $DadosCarga['modelo'],
                        'motorista' => $DadosCarga['motorista'],
                        'fornecedor' => $DadosCarga['fornecedor'],
                        'destino' => $DadosCarga['cliente'],
                        'carga' => $DadosCarga['id'],
                        'cabecas' => $DadosCarga['cabecas'],
                        'peso_tara' => $DadosCarga['peso_tara'],
                        'peso_bruto' => $DadosCarga['peso_bruto'],
                        'peso_liquido' => $DadosCarga['peso_liquido'],
                        'peso_medio' => $DadosCarga['peso_medio'],
                        'data_entrada' => $DadosCarga['data_entrada'],
                        'data_saida' => $DadosCarga['data_saida'],
                        'categoria' => 'Carga Viva',
                        'local_pesagem' => $DadosCarga['local_pesagem'],
                        'subcategoria' => $DadosCarga['nome_subcategoria']
                    );

//                    if ($user['perfil'] == 3) {
//                        $assunto = "SysControl | Nova Carga do Caminhão: " . $DadosCarga['placa'];
//                        Zend_Controller_Action_HelperBroker::getStaticHelper('Emails')->Emails('', trim($user['email']), $assunto, $conteudo, false, 'emails/carga.phtml');
//                    } else {
                    if ($DadosCarga['peso_liquido']) {
                        $assunto = "SysControl | Nova Carga do Caminhão: " . $DadosCarga['placa'];
                        $HTML = Zend_Controller_Action_HelperBroker::getStaticHelper('Emails')->Emails('', trim($user['email']), $assunto, $conteudo, false, 'emails/carga.phtml');
                        //Zend_Debug::dump($HTML);die;

                        if ($HTML) {
                            $ModelCargas->update(array('envia_email' => '1'), "id = '" . $id_carga . "' ");
                        }
                    }
//                    }
                }
            }


            die('1');
        }

        die('0');
    }

    public function notificaViagensAction() {
        $this->_helper->layout->disableLayout();
        $ModelViagens = new Admin_Model_Viagens();
        $ModelUsuarios = new Admin_Model_Usuarios();

        $ListaViagens = $ModelViagens->GetNotifica();
        $listaUsuarios = $ModelUsuarios->UsrNotificar();

        /* Zend_Debug::Dump($ListaViagens);
          die; */

        foreach ($ListaViagens as $row) {
            if ($row['categoria'] == 1) {
                $peso_bruto = $this->view->LimpaNumero($row['peso_bruto']);
                $peso_tara = $this->view->LimpaNumero($row['peso_tara']);

                $peso_liquido = ($peso_bruto - $peso_tara);
                $peso_medio = ($peso_liquido / $row['quantidade']);
                $data_fechamento = $this->view->ConvercaoDate('-', $row['data_fechamento'], 10);
                $id_viagem = $row['id'];

                foreach ($listaUsuarios as $key => $user) {

                    if ($row['pesagem_manual_inicio'] == '1') {
                        $pesagem_manual_inicio = 'Manual';
                    } else {
                        $pesagem_manual_inicio = 'Automático';
                    }

                    if ($row['pesagem_manual_fim'] == '1') {
                        $pesagem_manual_fim = 'Manual';
                    } else {
                        $pesagem_manual_fim = 'Automático';
                    }

                    $conteudo = array(
                        'nome_usuario' => $user['nome'],
                        'veiculo' => $row['placa'],
                        'motorista' => $row['motorista'],
                        'categoria' => $row['nome_categoria'],
                        'subcategoria' => $row['nome_subcategoria'],
                        'origem' => $row['origem'],
                        'destino_carregamento' => $row['nome_destino_carregamento'],
                        'origem_carregamento' => $row['nome_origem_carregamento'],
                        'destino_final' => $row['destino_final'],
                        'pesagem_manual_inicio' => $pesagem_manual_inicio,
                        'pesagem_manual_fim' => $pesagem_manual_fim,
                        'peso_tara' => number_format($row['peso_tara'], 2, ",", "."),
                        'peso_bruto' => number_format($row['peso_bruto'], 2, ",", "."),
                        'peso_liquido' => number_format($peso_liquido, 2, ",", "."),
                        'peso_medio' => number_format($peso_medio, 2, ",", "."),
                        'data_abertura' => $this->view->ConvercaoDate('-', $row['data_abertura'], 10),
                        'data_fechamento' => $data_fechamento,
                        'local_abertura' => $row['local_abertura'],
                        'local_fechamento' => $row['local_fechamento'],
                        'quantidade' => $row['quantidade'],
                        'observacao' => $row['observacao']
                    );


                    if (!empty($user['email'])) {
                        $assunto = "SysControl | Pesagem de: " . $row['nome_subcategoria'] . ' - Veículo: ' . $row['placa'];
                        $HTML = Zend_Controller_Action_HelperBroker::getStaticHelper('Emails')->Emails('', trim($user['email']), $assunto, $conteudo, false, 'emails/email-viagens.phtml');
                    }

                    if ($HTML && $key == 0) {
                        $ModelViagens->update(array('notificado' => '1'), "id = '" . $id_viagem . "' ");
                    }
                }
            }
        }


        die('0');
    }

    public function notificaViagensSemanalAction() {
        $this->_helper->layout->disableLayout();
        $ModelViagens = new Admin_Model_Viagens();
        $ModelUsuarios = new Admin_Model_Usuarios();

        $semana_categoria = $ModelViagens->GetSubCategoriaSemana();

        if ($semana_categoria) {

            // $grafico_peso_liquido = $ModelCargas->geraGraficoPesoLiquido(800, 350);
            //$grafico_peso_medio = $ModelCargas->geraGraficoPesoMedio(800, 350);
            // $grafico_total = $ModelCargas->geraGraficoTotal(800, 350);


            $relatorio = array();
            $relatorio['categorias'] = $semana_categoria;
            //$relatorio['grafico_peso_liquido'] = $grafico_peso_liquido;
            //$relatorio['grafico_peso_medio'] = $grafico_peso_medio;
            //$relatorio['grafico_total'] = $grafico_total;

            /* Listo todos os usuarios ativos que recebe notificação */
            $listaUsuarios = $ModelUsuarios->UsrNotificar();


            $assunto = "SysControl | Relatório Semanal";
            foreach ($listaUsuarios as $user) {
                if (!empty($user['email'])) {
                    $relatorio['usuario'] = $user['nome'];
                    $enviar = Zend_Controller_Action_HelperBroker::getStaticHelper('Emails')->Emails('', trim($user['email']), $assunto, $relatorio, false, 'emails/relatorio.phtml');
                }
            }

            die('Executado');
        }
    }

    public function testeAction() {
        $this->_helper->layout->disableLayout();
        $ModelCargas = new Admin_Model_Cargas();
        $this->view->grafico = $ModelCargas->geraGraficoPesoMedio(800, 350);
    }

}
