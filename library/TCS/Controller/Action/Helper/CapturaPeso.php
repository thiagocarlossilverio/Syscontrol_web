<?php

class Zend_Controller_Action_Helper_CapturaPeso extends Zend_Controller_Action_Helper_Abstract {

    public $view = '';

    public function __construct() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
    }

    public function Capturar($format = false) {

        /* Recebo as configuração de de ip e porta balanca.ini */
        $conf = $this->getConfig('producao');

        try {

            $fp = fsockopen($conf->IP, $conf->PORTA);

            if (!$fp) {
                return 'erro';
            } else {

                $data = fread($fp, 10);
                $result = trim(substr(trim($data), 4, 12));
                fclose($fp);

                if ($format) {
                    $peso = number_format($result, 2, ',', '.');
                } else {
                    $peso = number_format($result, 0, '', '.');
                }

                return $peso;
            }

        } catch (Exception $e) {
            return ($e->getMessage());
        }
    }

    public function getConfig($local = NULL) {
        return new Zend_Config_Ini(APPLICATION_PATH . '/configs/balanca.ini', $local);
    }

}
