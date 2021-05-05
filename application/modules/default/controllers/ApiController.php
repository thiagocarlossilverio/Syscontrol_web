<?php

class ApiController extends Zend_Controller_Action {

    public function init() {
        header("Access-Control-Allow-Origin: *");
        $mobile = FALSE;
        $user_agents = array("iPhone", "iPad", "Android", "webOS", "BlackBerry", "iPod", "Symbian", "IsGeneric");

        foreach ($user_agents as $user_agent) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
                $mobile = TRUE;
                $modelo = $user_agent;
                break;
            }
        }

        if (!$mobile) {
            $chat_id = "1004472088";
            $token = "863430097:AAFKu0FRfZoBjIfAYX36wPKIR4OJO2Y1ups";
            $mensagem = "Alguém de IP: " . $_SERVER["REMOTE_ADDR"] . ", tentou acessar o sistema!";
            $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&text=" . $mensagem . "";
            file_get_contents($url);
            exit;
        }

        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
    }

    public function verificaServidorAction() {
        $this->_helper->layout->disableLayout();

        // Path ao arquivo de configuração
        $filename = APPLICATION_PATH . '/configs/version_app.ini';

        // Carrega o arquivo de configuração
        $conf_versao_app = new Zend_Config_Ini($filename, "producao", TRUE);

        $configuracao = $conf_versao_app->toArray();

        $versao = $configuracao['version_atual_app'];

        $this->_helper->json($versao);
    }

    public function indexAction() {
        $this->_helper->layout->disableLayout();
        $cpf = $this->_request->getParam('cpf');
        $ModelMotoristas = new Admin_Model_Motoristas();
        $session = new Zend_Session_Namespace("loginApp");

        $consulta = '';
        if (!empty($cpf)) {
            $consulta = $ModelMotoristas->ConsultarCPF($cpf);
        }


        if (is_numeric($consulta)) {
            $resposta = $consulta;
            $session->logged_usuario = $consulta;
        } else {
            $resposta = 'erro';
        }

        die($resposta);
    }

    /* Action para login do usuario no aplicativo */

    public function autenticarAction() {
        $this->_helper->layout->disableLayout();
        $cpf = $this->_request->getParam('cpf');
        $ModelMotoristas = new Admin_Model_Motoristas();
        $session = new Zend_Session_Namespace("loginApp");
        $ip = $_SERVER['REMOTE_ADDR'];
        $consulta = $ModelMotoristas->ConsultarCPF($cpf);

        if (is_numeric($consulta)) {
            $resposta = $consulta;
            $session->logged_usuario = $consulta;

            $ModelMotoristas->update(array('ultimo_acesso' => date("Y-m-d H:i:s"), 'ip' => $ip), "id = " . $consulta);
        } else {
            $resposta = 'erro';
        }
        die($resposta);
    }

    /* Busco todos os fornecedores */

    public function getFornecedoresCombustivelAction() {
        $this->_helper->layout->disableLayout();
        $ModelFornecedores = new Admin_Model_FornecedoresCombustivel();

        $consulta = $ModelFornecedores->ListarFornecedores();

        if ($consulta) {
            $resposta = $consulta;
            $resposta['total'] = count($consulta);
            $resposta['result'] = 'ok';
        } else {
            $resposta['result'] = 'failed';
        }
        $this->_helper->json($resposta);
    }

    /* Busco todos os fornecedores */

    public function getFornecedoresAction() {
        $this->_helper->layout->disableLayout();
        $ModelFornecedores = new Admin_Model_Fornecedores();

        $consulta = $ModelFornecedores->ListarFornecedores();

        if ($consulta) {
            $resposta = $consulta;
            $resposta['total'] = count($consulta);
            $resposta['result'] = 'ok';
        } else {
            $resposta['result'] = 'failed';
        }
        $this->_helper->json($resposta);
    }

    /* Busco todos os Clientes */

    public function getClientesAction() {
        $this->_helper->layout->disableLayout();
        $ModelClientes = new Admin_Model_Clientes();

        $consulta = $ModelClientes->ListarClientes();

        if ($consulta) {
            $resposta = $consulta;
            $resposta['total'] = count($consulta);
            $resposta['result'] = 'ok';
        } else {
            $resposta['result'] = 'failed';
        }
        $this->_helper->json($resposta);
    }

    /* Busco todas as categorias e subcategorias */

    public function getCategoriasAction() {
        $this->_helper->layout->disableLayout();
        $ModelCategorias = new Admin_Model_Categorias();

        $consulta = $ModelCategorias->GetAll();

        if ($consulta) {
            $resposta = $consulta;
            $resposta['total'] = count($consulta);
            //$resposta['result'] = 'ok';
        } else {
            $resposta['result'] = 'failed';
        }

        $this->_helper->json($resposta);
    }

    /* Capturo a peso da balança rodoviaria */

    public function capturarAction() {
        $this->_helper->layout->disableLayout();
        ini_set('display_errors', 0);
        $fp = fsockopen("10.1.1.2", 23);
        if (!$fp) {
            print('erro');
        } else {
            $data = fread($fp, 10);
            $result = substr(trim($data), 4, 12);
            fclose($fp);
            $result = number_format(trim($result), 0, '', '.');
            print_r($result);
        }
        die;
    }

    /* Insiro na Base dados mysql */

    public function cadastrarAbastecimentoAction() {
        $this->_helper->layout->disableLayout();
        $ModelAbastecimento = new Admin_Model_Abastecimentos();
        $ModelEstoque = new Admin_Model_EstoqueCombustivel();

        $data = $this->_request->getPost();
        $id = 1;
        $dados['veiculo'] = $data['veiculo'];

        if (!is_numeric($data['motorista'])) {
            $dados['motorista'] = preg_replace("/[^0-9]/", "", $data['motorista']);
        } else {
            $dados['motorista'] = $data['motorista'];
        }

        $dados['fornecedor'] = $data['fornecedor'];
        $dados['litros'] = $this->view->LimpaNumero($data['litros']);
        $dados['km'] = $this->view->LimpaNumero($data['km']);

        if (!empty($data['valor'])) {
            $dados['valor'] = $data['valor'];
        }

        if ($data['fornecedor'] == 1) {

            /* Busco o estoque atual */
            $estoque = $ModelEstoque->GetDados($id);

            $total_estoque = $this->view->LimpaNumero($estoque['litros']);

            $litros_abastecido = $dados['litros'];
            $dados['valor'] = ($litros_abastecido * $estoque['valor_litro']);

            if ($total_estoque <= 0) {
                $estoque_atual = 0;
            } else {
                /* Dou baixa no estoque */
                $estoque_atual = ($total_estoque - $litros_abastecido);
            }
        } else {
            $dados['valor'] = $this->view->LimpaNumero($dados['valor']);
        }

        if (!empty($data['registro'])) {
            $dados['registro'] = $data['registro'];
        }

        $dados['observacao'] = $data['observacao'];
        $dados['data_envio'] = $data['data_envio'];


        /* insiro os registro no banco de dados */
        $ultimo_id = $ModelAbastecimento->insert($dados);


        if (is_numeric($ultimo_id)) {

            if (isset($estoque_atual)) {
                $ModelEstoque->update(array('litros' => $estoque_atual), "id = '" . $id . "' ");
            }

            $resposta['id'] = $ultimo_id;
            $resposta['msg'] = 'Abastecimento Inserido na base de dados do servidor!';
        } else {
            $resposta['msg'] = 'Falha ao inserir o abastecimento, contate o administrador do sistema!';
        }


        $this->_helper->json($resposta);
    }

    /* Busco todos os Veículos tivo do sistema para o aplicativo */

    public function getVeiculosJsonAction() {
        $this->_helper->layout->disableLayout();

        $ModelCaminhao = new Admin_Model_Caminhoes();
        $consulta = $ModelCaminhao->ListarCaminhoes(false, true);


        if ($consulta) {
            $resposta = $consulta;
            $resposta['total'] = count($consulta);
            $resposta['result'] = 'ok';
        } else {
            $resposta['result'] = 'failed';
        }
        $this->_helper->json($resposta);
    }

    /* Listo todos os usarios do sistema para o envio de email via aplicativo */

    public function getUsuariosAction() {
        $this->_helper->layout->disableLayout();
        $ModelUsuarios = new Admin_Model_Usuarios();
        $option = '<option value="">Selecione o Destino</option>';
        foreach ($ModelUsuarios->GetUsuarios() as $row) {
            $option .= '<option value="' . $row['email'] . '">' . $row['nome'] . '</option>';
        }

        die($option);
    }

    /* Envia Email via aplicativo */

    public function contatoAction() {
        $this->_helper->layout->disableLayout();
        $data = $this->_request->getPost();

        if (!empty($data['email'])) {
            $ModelMotorista = new Admin_Model_Motoristas();
            $motorista = $ModelMotorista->GetDados($data['motorista']);

            $data['motorista'] = $motorista['nome'];

            Zend_Controller_Action_HelperBroker::getStaticHelper('Emails')->Emails('', trim($data['email']), $data['assunto'], $data, false, 'emails/contato.phtml');
            die('Seu recado foi enviado com suceso!');
        } else {
            die('Falha ao enviar seu recado!');
        }
    }

    /* ----Insiro os dados da viagem------------------------------------------------------------- */

    public function insertViagemAction() {

        $ModelViagens = new Admin_Model_Viagens();
        $data = $this->_request->getPost();

        if ($this->_request->isPost()) {
            if (!empty($data['peso_tara'])) {
                $data['peso_tara'] = $this->view->LimpaNumero($data['peso_tara']);
            } else {
                unset($data['peso_tara']);
            }

            if (!empty($data['peso_nota'])) {
                $data['peso_nota'] = $this->view->LimpaNumero($data['peso_nota']);
            } else {
                unset($data['peso_nota']);
            }

            if (!empty($data['peso_bruto'])) {
                $data['peso_bruto'] = $this->view->LimpaNumero($data['peso_bruto']);
            } else {
                unset($data['peso_bruto']);
            }

            if (!empty($data['km_inicial'])) {
                $data['km_inicial'] = $this->view->LimpaNumero($data['km_inicial']);
            } else {
                unset($data['km_inicial']);
            }

            if (!empty($data['km_carga'])) {
                $data['km_carga'] = $this->view->LimpaNumero($data['km_carga']);
            } else {
                unset($data['km_carga']);
            }

            if (!empty($data['km_descarga'])) {
                $data['km_descarga'] = $this->view->LimpaNumero($data['km_descarga']);
            } else {
                unset($data['km_descarga']);
            }


            if (!empty($data['km_final'])) {
                $data['km_final'] = $this->view->LimpaNumero($data['km_final']);
            } else {
                unset($data['km_final']);
            }


            if (empty($data['local_abertura'])) {
                unset($data['local_abertura']);
            }

            if (empty($data['local_fechamento'])) {
                unset($data['local_fechamento']);
            }

            if (empty($data['tipo_pesagem_fechamento'])) {
                unset($data['tipo_pesagem_fechamento']);
            }

            if (empty($data['pesagem_manual_fim'])) {
                unset($data['pesagem_manual_fim']);
            }

            if (empty($data['status'])) {
                unset($data['status']);
            }



            if (empty($data['quantidade'])) {
                unset($data['quantidade']);
            }

            if (empty($data['data_fechamento'])) {
                unset($data['data_fechamento']);
            }


            $data['data_inserido_servidor'] = date('Y-m-d H:i:s');


            /* insiro os registro no banco de dados */
            $ultima_viagem = $ModelViagens->insert($data);


            if (is_numeric($ultima_viagem)) {
                $resposta['id'] = $ultima_viagem;
                $resposta['msg'] = 'A viagem foi enviada para a base de dados do servidor!';
            } else {
                $resposta['msg'] = 'Falha ao inserir a viagem, contate o administrador do sistema!';
            }
        } else {
            $resposta['msg'] = 'Ação não permitida!';
        }

        $this->_helper->json($resposta);
    }

    /* ----Atualizo os dados da viagem------------------------------------------------------------- */

    public function updateViagemAction() {

        $ModelViagens = new Admin_Model_Viagens();
        $data = $this->_request->getPost();

        if ($this->_request->isPost()) {
            /* Se existir é pq é atualização de registro se não é inserção */
            if (!empty($data['status']) && $data['status'] == '1' || !empty($data['status']) && $data['status'] == '2') {
                $data['id'] = $data['id_viagem'];
            } else {
                unset($data['data_fechamento']);
            }

            unset($data['version_app']);

            if (!empty($data['peso_tara'])) {
                $data['peso_tara'] = $this->view->LimpaNumero($data['peso_tara']);
            } else {
                unset($data['peso_tara']);
            }

            if (!empty($data['peso_nota'])) {
                $data['peso_nota'] = $this->view->LimpaNumero($data['peso_nota']);
            } else {
                unset($data['peso_nota']);
            }

            if (!empty($data['peso_bruto'])) {
                $data['peso_bruto'] = $this->view->LimpaNumero($data['peso_bruto']);
            } else {
                unset($data['peso_bruto']);
            }

            if (!empty($data['km_inicial'])) {
                $data['km_inicial'] = $this->view->LimpaNumero($data['km_inicial']);
            } else {
                unset($data['km_inicial']);
            }

            if (!empty($data['km_carga'])) {
                $data['km_carga'] = $this->view->LimpaNumero($data['km_carga']);
            } else {
                unset($data['km_carga']);
            }

            if (!empty($data['km_descarga'])) {
                $data['km_descarga'] = $this->view->LimpaNumero($data['km_descarga']);
            } else {
                unset($data['km_descarga']);
            }

            if (!empty($data['km_final'])) {
                $data['km_final'] = $this->view->LimpaNumero($data['km_final']);
            } else {
                unset($data['km_final']);
            }


            if (empty($data['local_abertura'])) {
                unset($data['local_abertura']);
            }

            if (empty($data['local_fechamento'])) {
                unset($data['local_fechamento']);
            }

            if (empty($data['tipo_pesagem_fechamento'])) {
                unset($data['tipo_pesagem_fechamento']);
            }

            if (empty($data['pesagem_manual_fim'])) {
                unset($data['pesagem_manual_fim']);
            }

            if (empty($data['status'])) {
                unset($data['status']);
            }



            if (empty($data['quantidade'])) {
                unset($data['quantidade']);
            }


            $data['data_atualizacao_servidor'] = date('Y-m-d H:i:s');

            /* Atualizo os registros os registro no banco de dados */
            $ultima_viagem = $ModelViagens->insert($data);

            if ($ultima_viagem) {
                $resposta['id'] = $ultima_viagem;
                $resposta['msg'] = 'A viagem foi atualizada na base de dados do servidor!';
            } else {
                $resposta['id'] = '';
                $resposta['msg'] = 'Falha ao atualizar a viagem, contate o administrador do sistema!';
            }
        } else {
            $resposta['msg'] = 'Ação não permitida!';
        }

        $this->_helper->json($resposta);
    }

    /* Excluo a viagem do servidor via app */

    public function deleteViagemAction() {
        $this->_helper->layout->disableLayout();
        $id_viagem = $this->_request->getParam('param');
        $ModelViagens = new Admin_Model_Viagens();


        if (is_numeric($id_viagem)) {
            $ModelViagens->update(array('excluido' => '1'), "id = '" . $id_viagem . "' ");
            $resposta = 'sucesso';
        } else {
            $resposta = 'erro';
        }

        $this->_helper->json($resposta);
    }

    /* Listo todas as viagens do motorista para a inserção no WebSQL do app */

    public function getViagensJsonAction() {
        $this->_helper->layout->disableLayout();

        if (!is_numeric($this->_request->getParam('motorista'))) {
            $motorista = preg_replace("/[^0-9]/", "", $this->_request->getParam('motorista'));
        } else {
            $motorista = $this->_request->getParam('motorista');
        }

        $ModelViagens = new Admin_Model_Viagens();

        $consulta = $ModelViagens->GetViagensMotorista($motorista, 30);

        if ($consulta) {
            $resposta = $consulta;
            $resposta['total'] = count($consulta);
            //$resposta['result'] = 'ok';
        } else {
            $resposta['result'] = 'failed';
        }

        $this->_helper->json($resposta);
    }

    /* Listo todas as abastecidas do motorista e veiculo para a inserção no WebSQL do app */

    public function getAbastecidasJsonAction() {
        $this->_helper->layout->disableLayout();

        $motorista = $this->_request->getParam('motorista');

        $ModelAbastecimentos = new Admin_Model_Abastecimentos();

        $consulta = $ModelAbastecimentos->GetAbastecidaMotorista($motorista, 30);

        if ($consulta) {
            $resposta = $consulta;
            $resposta['total'] = count($consulta);
            //$resposta['result'] = 'ok';
        } else {
            $resposta['result'] = 'failed';
        }

        $this->_helper->json($resposta);
    }

}
