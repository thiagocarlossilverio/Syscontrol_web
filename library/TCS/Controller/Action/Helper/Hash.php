<?php
/**
 * Cria hash strings
 * 
 * @name TCS_Hash
 */

class Zend_Controller_Action_Helper_Hash extends Zend_Controller_Action_Helper_Abstract {
	/**
	 * Cria o hash para senhas
	 * 
	 * @name hashPassword
	 * @param string $password String contendo a senha
	 * @return string
	 */
	static public function hashPassword($password) {
		// Quantidade do salt
		$salt = 2;
		
		// Monta os caracteres permitidos
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		
		// Cria a semente random
		mt_srand(10000000 * (double)microtime());
		
		// Cria o hash unico
		for($i=0, $str="", $lc=strlen($chars)-1; $i<$salt; $i++) {
			$str .= $chars[mt_rand(0, $lc)];
		}
		
		// Cria o hash da senha com BOOM
		$password_hash = md5($str . $password) . ":" . $str;
		
		// Retorna o hash
		return $password_hash;
	}
	
	/**
	 * Cria strings aleatórias
	 *
	 * @name randomString
	 * @param int $size Tamanho da string à ser gerada
	 * @param boolean $hasNumber Flag se existe numero na string
	 * @return string
	 */
	 /*Método que gera a nova senha*/
	static public function randomString($size, $hasNumber=TRUE) {
		// Monta os caracteres permitidos
		$letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$numbers = "0123456789";
		
		// Verifica se possui numeros
		if($hasNumber) {
			$chars = $letters . $numbers;
		}
		
		// Cria a semente random
		mt_srand(10000000 * (double)microtime());
	
		// Cria a string aleatoria
		$str = "";
		for($i=0, $lc=strlen($chars)-1; $i < $size; $i++) {
			$str .= $chars[mt_rand(0, $lc)];
		}
			
		// Retorna a string
		return $str;
	}
}