<?php
class Zend_Controller_Action_Helper_Redireciona extends Zend_Controller_Action_Helper_Abstract {
    public function Redireciona($endereco) {
		$redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
		 if(is_array($endereco)){
			$redirector	->gotoSimpleAndExit($this->montaArrays($endereco));
		 } else if(is_string($endereco)){
			$redirector	->gotoUrl($endereco);
			} else {
					$url		= Zend_Controller_Action_Helper_Abstract::getRequest();
					$modulo     = $url->getModuleName();
					$controle	= $url->getControllerName();
					$action		= $url->getActionName();
					$redirector	->gotoSimpleAndExit($action, $controle, $modulo);
				}
	}
	public function montaArrays($parametros)
	{
		$url		= Zend_Controller_Action_Helper_Abstract::getRequest();
		$module     = $url->getModuleName();
		$controller	= $url->getControllerName();
		$action		= $url->getActionName();
		if(!isset($parametros['action']))
			$action		= $url->getActionName();
		else { $action = $parametros['action']; }
		if(!isset($parametros['controller']))
			$controller = $url->getControllerName();
		else { $controller = $parametros['controller']; }
		if(!isset($parametros['module']))
			$module		= $url->getModuleName();
		else { $module = $parametros['module']; }
		if(!isset($parametros['params']))
			$params		= array();
		else { $params	= $parametros['params']; }
		return array($action, $controller, $module, $params	);
	}
	public function direct($endereco){
        return $this->Redireciona($endereco);
    }
}