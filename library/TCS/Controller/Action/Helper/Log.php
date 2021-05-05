<?php
class Zend_Controller_Action_Helper_Log extends Zend_Controller_Action_Helper_Abstract {
    public function Log($descricao = NULL) {
        $db = new LoginHistorico();
        $auth = Zend_Auth::getInstance();
        if (!$descricao)
            $descricao = 'Nenhuma Descrição adicionada';
        if ($auth->hasIdentity())
            $userId = $auth->getIdentity()->id;
        else
            $userId = 0;
        $hora = date('Y-m-d H:i:s');
        $uri = new Zend_Controller_Action_Helper_Url();
        $url = $uri->getRequest();
        $modulo = $url->getModuleName();
        $controle = $url->getControllerName();
        $action = $url->getActionName();
        $params = $url->getParams();
        $parametros = '';
        foreach ($params as $key => $val):
            if ($key != 'module' && $key != 'controller' && $key != 'action')
                $parametros .= $key . ' = ' . $val . " \n";
        endforeach;
        $data = array(
            'vinculo' => $userId,
            'descricao' => $descricao,
            'data' => $hora,
            'module' => $modulo,
            'controller' => $controle,
            'action' => $action,
            'parametros' => $parametros
        );
        $db->insert($data);
    }
    public function Grava($descricao = NULL) {
        $this->Log($descricao);
    }
}
