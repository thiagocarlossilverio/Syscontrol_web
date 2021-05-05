<?php

/**
 * Controlador de erros
 *
 * @name ErrorController
 */
class ErrorController extends Zend_Controller_Action {

    /**
     * AÃ§Ã£o do erro
     *
     * @name errorAction
     */
    public function errorAction() {
        // Desabilita o layout e busca o handler de erro
        $this->_helper->layout->disableLayout();
        $errors = $this->_getParam("error_handler");

        // Verifica se foi possivel bucar o erro
        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = "You have reached the error page";
            return;
        }

        // Busca as configurações
        //$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
        // $db = Zend_Config::factory($config->phpSettings);
        // Zend_Debug::dump($config->PhpSettings->display_startup_errors);die;
        // Verifica o tipo do erro
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                $this->view->message = "Page not found";
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $priority = Zend_Log::CRIT;
                $this->view->message = "Application error";
                break;
        }

        // Verifica se existe o erro
        if ($log = $this->getLog()) {
            $log->log($this->view->message, $priority, $errors->exception);
            $log->log('Request Parameters', $priority, $errors->request->getParams());
        }

        // Verifica se deve exibir o erro
        if ($this->getInvokeArg("displayExceptions") == TRUE) {
            $this->view->exception = $errors->exception;
        }
        $msg = $errors->exception->getMessage();
        if ($msg !== 'Invalid controller specified (commons)' && $msg !== 'Invalid controller specified (wp-content)' && $msg !== 'Invalid controller specified (images)') {
            // Salva no banco de dados
            try {

                $model = new Admin_Model_Erros();
                $hora_brasil = (date('H') - 3) . ":" . date('i') . ":" . date('s');
                if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                    $IP = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (isset($_SERVER['HTTP_FROM '])) {
                    $IP = $_SERVER['HTTP_FROM'];
                } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                    $IP = $_SERVER['REMOTE_ADDR'];
                }

                $array = explode(',', $IP);
                if ($array) {
                    $IP = $array[0];
                }

                $parametros = $errors->request->getParams();

                if ($parametros['controller'] != 'assets' && $parametros['controller'] != 'adm') {
                    $data = array();
                    $data['trace'] = $errors->exception->getTraceAsString();
                    $data['parametros'] = json_encode($parametros);
                    $data['mensagem'] = $errors->exception->getMessage();
                    $data['ip'] = $IP;
                    //$data['parametros_acesso'] = $model->Rastrear($IP);
                    $data['data_execucao'] = date("Y-m-d H:i:s");
                    $model->insert($data);
                }
            } catch (Exception $e) {
                $extras = $e->getMessage();
            }
        }

        // Assina as variaveis
        $this->view->request = $errors->request;
        $this->view->extras = $extras;
        $this->view->assign("has_exception", TRUE);
        $this->view->assign("exception_message", $errors->exception->getMessage());
        $this->view->assign("trace", $errors->exception->getTraceAsString());
        $this->view->assign("params", $this->view->escape(var_export($errors->request->getParams(), TRUE)));
    }

    /**
     * Busca o log
     *
     * @name getLog
     */
    public function getLog() {
        // Busca o bootstrap
        $bootstrap = $this->getInvokeArg("bootstrap");
        if (!$bootstrap->hasResource("Log")) {
            return false;
        }

        // Busca o log
        $log = $bootstrap->getResource("Log");

        // Retorna o log
        return $log;
    }

}
