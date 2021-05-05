<?php

/**
 * Cria o plugin da verificação do usuario
 *
 * @name Avadora_Controller_Plugin_Userverify
 */
class TCS_Controller_Plugin_Userverify extends Zend_Controller_Plugin_Abstract {

    /**
     * Método da classe
     * 
     * @name includejs
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        // Busca o view
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper("viewRenderer");
        $viewRenderer->initView();
        $view = $viewRenderer->view;

        $module = $request->getModuleName();
       
        // Verifica se é o admin
        if ($module == "admin") { 
            // Busca a sessão
            $session = new Zend_Session_Namespace("login");

            $auth = Zend_Auth::getInstance();

            if ($auth->hasIdentity()) {
                // Assina as variaveis
                $view->logged = TRUE;
                $view->logged_usuario = $session->logged_usuario;
            } else {
                // Verifica se o modulo acessado é o de login
                if (($this->_request->getControllerName() != "login")) {
                    $this->getResponse()->setRedirect("/admin/login")->sendResponse();
                }
            }
        }
    }
}