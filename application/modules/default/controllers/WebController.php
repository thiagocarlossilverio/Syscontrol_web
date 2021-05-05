<?php

/* Carregando a classe que nosso server vai consumir */
require_once APPLICATION_PATH . '/modules/default/web/Service.php';

class WebController extends Zend_Controller_Action {

    public function init() {
        ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
    }

    public function serviceAction() {
        define("ACCESSKEY", (sha1("Minha" . date('d/m/Y') . "Classe")));
        if (isset($_GET['key']) && $_GET['key'] === ACCESSKEY) {
            /**
             * Verifica se o parâmetro wsdl está na url para montar o WSDL
             */
            if (isset($_GET['wsdl'])) {
                /**
                 * Faz a instância da classe Zend_Soap_AutoDiscover
                 */
                $wsdl = new Zend_Soap_AutoDiscover();
                /**
                 * Chama a classe para Zend_Soap_AutoDiscover criar o WSDL
                 */
                $wsdl->setClass('Web_Service');
                $wsdl->handle();
            } else {
                /**
                 * Opções básicas de criação do Zend_Soap_Server
                 */
                $options = array(
                    'soap_version' => SOAP_1_2,
                    'encoding' => 'UTF-8',
                    'uri' => 'http://' . $_SERVER['SERVER_NAME'] . '/web/service/'
                );
                /**
                 * Faz a instância do Zend_Soap_Server
                 */
                $server = new Zend_Soap_Server(null, $options);
                /**
                 * Desabilita o cache wsdl do SOAP
                 */
                $server->setWsdlCache(0);
                /**
                 * Seta a classe a ser consumida com o Zend_Soap_Server
                 */
                $server->setClass('Web_Service');
                $server->handle();
                $server->getReturnResponse();
            }
        } else {
            header("Location: http://www.thiagocarlos.com.br");
        }
        exit;
    }

}
