<?php

class Zend_Controller_Action_Helper_WhattsApp extends Zend_Controller_Action_Helper_Abstract {

    public function direct($requisicao, $params, $send = NULL) {
        return $this->requisicao($requisicao, $params, $send);
    }

    public function requisicao($requisicao, $params, $send = NULL) {
        require_once('library/TCS/Controller/Action/Helper/whatts/src/whatsprot.class.php');
        require_once('library/TCS/Controller/Action/Helper/whatts/src/Registration.php');

        $whatts = new WhatsProt($params['username'], $params['nike'], $params['debug']);
        $register = new Registration($params['username'], $params['debug']);
        if ($requisicao == 'solicita') {
            return $register->codeRequest('sms');
        } elseif ($requisicao == 'register') {
            return $register->codeRegister($params['code']);
        } elseif ($requisicao == 'envia') {
            try {
                $whatts->connect();
                $whatts->loginWithPassword($params['senha']);
                $whatts->SendPresenceSubscription($send['number']);
               $res = $whatts->sendMessage($send['number'], $send['message']);
               return $res;
            } catch (Exception $ex) {
                return 'erro';
            }
        } elseif ($requisicao == 'recebe') {
            $whatts->connect();
            $whatts->loginWithPassword($params['senha']);

            while (true) {
                $whatts->pollMessage();
                $msgs = $whatts->GetMessages();
            }
            die(print_r($msgs));
        }
    }

}
