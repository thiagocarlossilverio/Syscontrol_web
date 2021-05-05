<?php

class Admin_LogsController extends Zend_Controller_Action {
   
    public function indexAction() {
        $ModelRegistros = new Admin_Model_Logs();
        $ModelErros = new Admin_Model_Erros();
        $registros =$ModelRegistros->Lista();
        $erros = $ModelErros->GetAll();
        $this->view->dados_registro =$registros;
        $this->view->dados_erros =$erros;
    }

   

}
