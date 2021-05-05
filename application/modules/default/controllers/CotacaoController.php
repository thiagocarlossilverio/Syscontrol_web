<?php

class CotacaoController extends Zend_Controller_Action {

    public function init() {

        //  header("Access-Control-Allow-Origin: *");
//        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
//        $viewRenderer->init();
//        $this->view = $viewRenderer->view;
    }

    public function indexAction() {
        $this->_helper->layout->disableLayout();

//        $url = 'https://www.e-adm.com/pda/futures.aspx';
//
//// PEGANDO TODO CONTEUDO
//        $dadosSite = file_get_contents($url);
//        
//        $var1 = explode('<p>', $dadosSite);
//        
//     //  $var2 = explode("<t "", $var1[1]);
//       print_r(strip_tags($var1));die;

    }

}
