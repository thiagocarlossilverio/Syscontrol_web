<?php

class Zend_Controller_Action_Helper_Emails extends Zend_Controller_Action_Helper_Abstract {

    public $view = '';

    public function __construct() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
    }

    public function Emails($type = 'default', $para, $assunto, $dados, $copiaOculta = false, $pagina) {
        /* Assino para a view */
        $this->view->dados = $dados;

        /* Recebo as configuração de mail do arquivo mail.ini */
        $conf = $this->getConfig('producao');

        try {
            $config = array(
                'auth' => 'login',
                'username' => $conf->conta,
                'password' => $conf->senha,
                'ssl' => $conf->conexao,
                'port' => $conf->porta
            );

            $mailTransport = new Zend_Mail_Transport_Smtp($conf->smtp, $config);
            $mail = new Zend_Mail();
            $mail->setFrom($conf->remetente);
            $mail->addTo($para);
            $mail->setBodyHTML($this->view->render($pagina));
            $mail->setSubject(utf8_decode($assunto));
            
            if (isset($dados['anexo'])) {
             $mail->createAttachment(file_get_contents($dados['anexo']), $dados['type'], Zend_Mime::DISPOSITION_INLINE, Zend_Mime::ENCODING_BASE64, $dados['name']);
            }

          return $mail->send($mailTransport);
            
            //Zend_Debug::dump($teste);die;
        } catch (Exception $e) {
            echo ($e->getMessage()); die;
        }
    }

    public function getConfig($local = NULL) {
        return new Zend_Config_Ini(APPLICATION_PATH . '/configs/mail.ini', $local);
    }

}
