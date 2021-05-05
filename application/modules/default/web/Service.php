<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acoes
 *
 * @author ThiagoCarlos
 */
class Web_Service {
    
    public function GetProduct() {
        $Model = new Admin_Model_Unidades();
        $result = array();
      	$result = $Model->GetDelivery();
        return  $result;
    }
    public function GetConf() {
        return Zend_Db_Table::getDefaultAdapter();
     }
    public function Login($email, $senha) {
        $Model = new Admin_Model_Clientes();

        $row = $Model->BuscarLogin($email);

        if (!$row) {
            // Verifica se a senha é valida
            if ($row['senha'] == sha1($senha)) {
                return TRUE;
            } else {
                throw new Exception('Senha Inválida', '0');
            }
        } else {
            throw new Exception('E-mail inexistente', '0');
        }
    }

    public function soma($a, $b) {
        return $a + $b;
    }
	
	public function multiplica($a, $b) {
        return ($a * $b);
    }
}