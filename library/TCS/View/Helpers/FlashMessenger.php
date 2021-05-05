<?php
class TCS_View_Helpers_FlashMessenger extends Zend_Controller_Action_Helper_Abstract {
    public function FlashMessenger() {
        $flashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
        $module = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
        $mensagem = '';
        if ($flashMessenger->hasMessages()) {
            if ($module == 'admin') {
                foreach ($flashMessenger->getMessages() as $msg):
                    if (isset($msg['erro']) != '') {
                        $mensagem .= '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Erro:</span>';
                        $mensagem .= $msg['erro'];
                    }
                    if (isset($msg['sucesso']) != '') {
                        $mensagem .= '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>';
                        $mensagem .= $msg['sucesso'];
                    }
                    $mensagem .= '</div>';
                endforeach;
            } else {
                foreach ($flashMessenger->getMessages() as $msg):
                    if (isset($msg['erro']) != '') {
                        $mensagem .= '<div class="alert alert-danger" role="alert"><span class="glyphicon" aria-hidden="true"></span><span class="sr-only">Erro:</span>';
                        $mensagem .= $msg['erro'];
                    }
                    if (isset($msg['sucesso']) != '') {
                        $mensagem .= '<div class="alert alert-success" role="alert"><span class="glyphicon" aria-hidden="true"></span><span class="sr-only">Error:</span>';
                        $mensagem .= $msg['sucesso'];
                    }
                    $mensagem .= '</div>';
                endforeach;
            }
        }
        return $mensagem;
    }
}
