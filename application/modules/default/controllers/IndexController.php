<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        header("Access-Control-Allow-Origin: *");
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
    }

    public function indexAction() {
        $this->_forward('index', 'login', 'admin');
    }

    public function autenticarAction() {
        $this->_helper->layout->disableLayout();
        $cpf = $this->_request->getParam('cpf');
        $ModelMotoristas = new Admin_Model_Motoristas();

        $consulta = $ModelMotoristas->ConsultarCPF($cpf);

        if (is_numeric($consulta)) {
            $resposta = $consulta;
        } else {
            $resposta = 'erro';
        }
        die($resposta);
    }

    public function getQuilometragensJsonAction() {
        $this->_helper->layout->disableLayout();
        $motorista = $this->_request->getParam('motorista');
        $modelQuilometragem = new Admin_Model_Quilometragem();

        $consulta = $modelQuilometragem->GetQuilometroMotorista($motorista);

        if ($consulta) {
            $resposta = $consulta;
            $resposta['result'] = 'ok';
        } else {
            $resposta['result'] = 'failed';
        }
        $this->_helper->json($resposta);
    }

     public function getVeiculosJsonAction() {
        $this->_helper->layout->disableLayout();
        
        $ModelCaminhao = new Admin_Model_Caminhoes();
        $consulta = $ModelCaminhao->ListarCaminhoes(false, true);
        

        if ($consulta) {
            $resposta = $consulta;
            $resposta['result'] = 'ok';
        } else {
            $resposta['result'] = 'failed';
        }
        $this->_helper->json($resposta);
    }

    public function getCargaAction() {
        $this->_helper->layout->disableLayout();
        $carga = $this->_request->getParam('carga');
        $modelCargas = new Admin_Model_Cargas();

        $result = $modelCargas->GetDadosCarga($carga);
        $result['data_entrada'] = $this->view->ConvercaoDate('-', $result['data_entrada'], 10);
        $result['data_saida'] = $this->view->ConvercaoDate('-', $result['data_saida'], 10);
        $result['peso_tara'] = number_format($result['peso_tara'], 2, ".", ",");
        $result['peso_bruto'] = number_format($result['peso_bruto'], 2, ".", ",");
        $result['peso_liquido'] = number_format($result['peso_liquido'], 2, ".", ",");
        $result['peso_medio'] = number_format($result['peso_medio'], 2, ".", ",");
        echo Zend_Json::encode($result);
        exit();
    }

    public function listaPendentesAction() {
        $this->_helper->layout->disableLayout();
        $veiculo = $this->_request->getParam('veiculo');
        $modelCargas = new Admin_Model_Cargas();

        $result = $modelCargas->Getcargas($veiculo);

        foreach ($result as $key => $row) {
            $result[$key]['data_entrada'] = $this->view->ConvercaoDate('-', $row['data_entrada'], 10);
            $result[$key]['data_saida'] = $this->view->ConvercaoDate('-', $row['data_saida'], 10);
        }

        echo Zend_Json::encode($result);
        exit();
    }

    public function verificaCargaAction() {
        $this->_helper->layout->disableLayout();
        $veiculo = $this->_request->getParam('veiculo');
        $modelCargas = new Admin_Model_Cargas();

        $result = $modelCargas->VerificaCarga($veiculo);

        echo Zend_Json::encode($result);
        exit();
    }

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

    public function getVeiculosAction() {
        $this->_helper->layout->disableLayout();
        $ModelCaminhao = new Admin_Model_Caminhoes();
        $option = '<option value="">Selecione a Placa</option>';
        foreach ($ModelCaminhao->ListarCaminhoes(2, true) as $row) {

            $option .= '<option value="' . $row['id'] . '">' . $row['placa'] . '</option>';
        }

        die($option);
    }

    public function getSubcategoriasAction() {
        $this->_helper->layout->disableLayout();
        $ModelCategoria = new Admin_Model_Categorias();
        $option = '<option value="">Insira a Categoria</option>';
        foreach ($ModelCategoria->getSubs(1) as $row) {

            $option .= '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
        }

        die($option);
    }

    public function getMotoristasAction() {
        $this->_helper->layout->disableLayout();
        $ModelMotoristas = new Admin_Model_Motoristas();
        $option = '<option value="">Selecione o Motorista</option>';
        foreach ($ModelMotoristas->ListarMotoristas(true) as $row) {
            $option .= '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
        }

        die($option);
    }

    public function getFornecedoresAction() {
        $this->_helper->layout->disableLayout();
        $ModelFornecedores = new Admin_Model_Fornecedores();
        $option = '<option value="">Selecione o Fornecedor</option>';
        foreach ($ModelFornecedores->ListarFornecedores() as $row) {
            $option .= '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
        }
        die($option);
    }

    public function getClientesAction() {
        $this->_helper->layout->disableLayout();
        $ModelClientes = new Admin_Model_Clientes();
        $option = '<option value="">Selecione o Destino</option>';
        foreach ($ModelClientes->ListarClientes() as $row) {
            $option .= '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
        }

        die($option);
    }

    public function getUsuariosAction() {
        $this->_helper->layout->disableLayout();
        $ModelUsuarios = new Admin_Model_Usuarios();
        $option = '<option value="">Selecione o Destino</option>';
        foreach ($ModelUsuarios->GetUsuarios() as $row) {
            $option .= '<option value="' . $row['email'] . '">' . $row['nome'] . '</option>';
        }

        die($option);
    }

    public function cadastrarAction() {
        $ModelCargas = new Admin_Model_Cargas();

        $data = $this->_request->getPost();

        if (!empty($data['placa'])) {

            /* Verifico se tem carga em pendente */
            $pendente = $ModelCargas->GetPendente($data['placa']);
            //print_r($pendente);die;
            $data['caminhao'] = $data['placa'];
            $data['categoria'] = 1;
            $data['user'] = 0;

            if (empty($data['cabecas']) || $data['cabecas'] == 0) {
                unset($data['cabecas']);
            }

            if (empty($data['cliente']) || $data['cliente'] == 0) {
                unset($data['cliente']);
            }
            if (empty($data['fornecedor']) || $data['fornecedor'] == 0) {
                unset($data['fornecedor']);
            }

            if (empty($data['subcategoria']) || $data['subcategoria'] == 0) {
                unset($data['subcategoria']);
            }

            /* Se retornar é pq existe pemdencia */
            if ($pendente) {
                /* se retornar vazio é pq é carga tara */
                if (empty($pendente['peso_tara'])) {
                    $data['peso_tara'] = $this->view->LimpaNumero($data['peso']);
                    $data['peso_bruto'] = $this->view->LimpaNumero($pendente['peso_bruto']);
                    $data['cabecas'] = $pendente['cabecas'];
                } else {
                    $data['peso_bruto'] = $this->view->LimpaNumero($data['peso']);
                    $data['peso_tara'] = $this->view->LimpaNumero($pendente['peso_tara']);
                }

                $data['id'] = $pendente['id'];
                $data['data_saida'] = date('d/m/Y H:i:s');
            } else {
                if ($data['tipo'] == 'tara') {
                    $data['peso_tara'] = $this->view->LimpaNumero($data['peso']);
                } else {
                    $data['peso_bruto'] = $this->view->LimpaNumero($data['peso']);
                }

                $data['data_entrada'] = date('d/m/Y H:i:s');
            }

            /* insiro os registro no banco de dados */
            $ultima_carga = $ModelCargas->insert($data);
            //Zend_Debug::dump($ultima_carga);die;

            if (is_numeric($ultima_carga)) {
                die('enviado');
            } else {
                die('falha');
            }
        }
    }

    public function verificaKmAction() {
        $this->_helper->layout->disableLayout();
        $veiculo = $this->_request->getParam('veiculo');
        $modelKm = new Admin_Model_Quilometragem();

        $result = $modelKm->VerificaPendencia($veiculo);

        if (is_numeric($result)) {
            $resposta = $result;
        } else {
            $resposta = 'erro';
        }
        die($resposta);
    }

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

    public function cadastrarKmAction() {
        $this->_helper->layout->disableLayout();
        $ModelKm = new Admin_Model_Quilometragem();

        $data = $this->_request->getPost();

     	$dados['veiculo'] = $data['veiculo'];
        $dados['motorista'] = $data['motorista'];
        $dados['km_inicial'] = $this->view->LimpaNumero($data['km_inicial']);
        $dados['km_final'] = $this->view->LimpaNumero($data['km_final']);
        $dados['tipo_carga'] = $data['tipo_carga'];
        $dados['numero_nota'] = $data['numero_nota'];
        $dados['localidade'] = $data['localidade'];
        $dados['data_abertura'] = $data['data_abertura'];
        $dados['data_fechamento'] = $data['data_fechamento'];

        $retorno = $ModelKm->insert($dados);

         if ($retorno) {
            die('A quilometragem foi Registrada na base de dados do servidor!');
        } else {
            die('Falha ao registrar a quilometrage /n Contate o administrador do sistema!');
        }


          /*  if ($retorno) {
                die('A quilometragem foi aberta com sucesso!');
            } else {
                die('Falha ao abrir a quilometragem!');
            }*/

        /* Se ID for vazio insiro */
      //  if (!is_numeric($data['id'])) {
           


          //  unset($dados['id']);
          //  unset($dados['km_final']);

          //  $retorno = $ModelKm->insert($dados);

          /*  if ($retorno) {
                die('A quilometragem foi aberta com sucesso!');
            } else {
                die('Falha ao abrir a quilometragem!');
            }*/

            /* Senão faço update */
      //  } else {
          /*  unset($dados['veiculo']);
            unset($dados['km_inicial']);
            unset($dados['motorista']);
            unset($dados['tipo_carga']);
            unset($dados['numero_nota']);
            unset($dados['localidade']);*/
         /*   $id = $data['id'];

            $km_inicial = $ModelKm->GetKmInicial($id);


            if ($this->view->LimpaNumero($km_inicial) >= $this->view->LimpaNumero($data['km_final'])) {
                die('A quilometragem Final não pode ser menor que a inicial!');
            }

            $dados['km_final'] = $this->view->LimpaNumero($data['km_final']);
            $dados['data_fechamento'] = date('y-m-d H:i:s');
            $ModelKm->update($dados, "id = '" . $id . "' ");

            if (!empty($id)) {
                die('A quilometragem foi fechada com sucesso!');
            } else {
                die('Falha ao fechar a quilometragem!');
            }*/
       // }
    }

}
