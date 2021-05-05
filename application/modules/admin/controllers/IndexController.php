<?php

class Admin_IndexController extends Zend_Controller_Action {

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
    }

    public function indexAction() {
        $logado = new Zend_Session_Namespace("logado");
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');


        $fp = fsockopen("10.1.1.2", 23);
        if (!$fp) {
            $result = 'erro';
        } else {

            //$data = fread($fp, 9);
            // $result = substr($data, 2, 7);
            $data = fread($fp, 10);
            $result = substr(trim($data), 4, 12);

            fclose($fp);
        }

        $auth = Zend_Auth::getInstance();
        $ModelViagens = new Admin_Model_Viagens();

        $this->view->dados = $auth->getIdentity();
        $this->view->acesso = $logado->sessao;
        $this->view->dia = $ModelViagens->geraGraficoDia();
        $this->view->mes = $ModelViagens->geraGraficoMes();
        $this->view->hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));
        $this->view->peso = $result;



        //$peso = $this->view->LerPeso();
    }

    public function ajaxOrdemAction() {
        $model = new Admin_Model_Menus();

        $ordem = $_POST['ordem'];
        for ($i = 0; $i < count($ordem); $i++)
            if (is_numeric($ordem[$i]))
                $model->update(array("ordem" => $i), "id =" . $ordem[$i]);
        die;
    }

    public function ajaxSesaoAction() {
        /* Crio a sessÃµes */
        $logado = new Zend_Session_Namespace("logado");
        if ($logado->sessao == '') {
            $logado->sessao = 1;
        }

        die();
    }

    public function ajaxPesoAction() {
        ini_set('display_errors', 0);
        $fp = fsockopen("10.1.1.2", 23);
        if (!$fp) {
            print('erro');
        } else {
            //$data = str_ireplace('i0 ', '', fread($fp, 9));
            //$result = str_ireplace('i8 ', '', $data);
            $data = fread($fp, 10);
            $result = substr(trim($data), 4, 12);

            fclose($fp);
            //die($result);
            $peso = number_format($result, 2, ',', '.');

            print_r($peso);
        }

        die;
    }

}
