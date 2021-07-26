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
        $auth = Zend_Auth::getInstance();
        $ModelViagens = new Admin_Model_Viagens();

        $this->view->dados = $auth->getIdentity();
        $this->view->acesso = $logado->sessao;
        $this->view->dia = $ModelViagens->geraGraficoDia();
        $this->view->mes = $ModelViagens->geraGraficoMes();
        $this->view->hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));
     
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
        
         $peso =Zend_Controller_Action_HelperBroker::getStaticHelper('CapturaPeso')->Capturar(true);
         print_r($peso);exit;
     
    }

}
