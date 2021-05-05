<?php

/**
 * Cria o plugin do metas
 *
 * @name TCS_Controller_Plugin_Metas
 */
class TCS_Controller_Plugin_Metas extends Zend_Controller_Plugin_Abstract {

    /**
     * Método da classe
     * 
     * @name includejs
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        // Busca o view renderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper("viewRenderer");
        $viewRenderer->initView();
        $view = $viewRenderer->view;

        $server = $request->getServer('HTTP_X_REQUESTED_WITH');


        /* Se não for uma requisição ajax */
        if (!isset($server) && strtolower($server) != "xmlhttprequest") {
            // Armazena o controller e o action
            $controller = (string) $request->getControllerName();
            $controller = str_ireplace('-', '', $controller);

            $action = (string) $request->getActionName();
            $action = str_ireplace('-', '', $action);

            $module = (string) $request->getModuleName();
            $param = (string) $request->getParam('param');
            $url_atual = 'http://' . $request->getServer('HTTP_HOST') . '/' . $controller . '/' . $action;

            if ($module != 'admin' && $action != 'busca') {
                // Busca as informações das metas
                try {
                    $metas = new Zend_Config_Ini(APPLICATION_PATH . "/configs/metas.ini", null, array('skipExtends' => true, 'allowModifications' => true));
                    $metas = $metas->toArray();
                } catch (Exception $e) {
                    return FALSE;
                }
                if (isset($metas[$controller][$action])) {
                    // Verifica se existe a sessão das metas
                    if ($metas[$controller][$action] !== NULL) {

                        if (!empty($param)) {

                            $param = str_ireplace('-', ' ', $param);
                            $param = ucwords($param);
                            $view->headTitle($metas[$controller][$action]['title'] . ' | ' . $param);
                        } else {
                            $view->headTitle($metas[$controller][$action]['title']);
                        }
                        $view->doctype(Zend_View_Helper_Doctype::XHTML1_RDFA);

                        /* METAS DO FACEBOOK */
                        $view->headMeta()->setProperty('og:title', $metas[$controller][$action]['title']);
                        $view->headMeta()->setProperty('og:site_name', $metas[$controller][$action]['keywords']);
                        $view->headMeta()->setProperty('og:description', $metas[$controller][$action]['description']);
                        $view->headMeta()->setProperty('og:url', $url_atual);

                        /* METAS DO TWITTER */
                        $view->headMeta()->setProperty('twitter:title', $metas[$controller][$action]['title']);
                        $view->headMeta()->setProperty('twitter:description', $metas[$controller][$action]['description']);
                        $view->headMeta()->setProperty('twitter:site', $url_atual);

                        /* METAS PARÃO */
                        $view->headMeta()->setName("description", $metas[$controller][$action]['description']);
                        $view->headMeta()->setName("keywords", $metas[$controller][$action]['keywords']);

                    }
                }
            }
        }
    }

}
