<?php
/**
 * GenerateRandom Action Helper
 *
 * @desc Cria uma string randômica
 * @uses Zend_Controller_Action_Helper
 */
class Zend_Controller_Action_Helper_GenerateRandom
    extends Zend_Controller_Action_Helper_Abstract {
    /**
    * @var Zend_Loader_PluginLoader
    */
    public $pluginLoader;
    /**
    * config
    */
    private $lower = 'abcdefghijklmnopqrstuvwxyz';
    private $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private $numbers = '1234567890';
    private $simbols = '!@#$%*-';
    /**
    * @var $characters
    */
    private $characters;
    /**
    * @var $resultado
    */
    private $resultado;
 
    /**
    * Constructor: initialize plugin loader
    *
    * @return void
    */
    public function __construct() {
        // TODO Auto-generated Constructor
        $this->pluginLoader = new Zend_Loader_PluginLoader ();
    }
 
    /**
    * generateRandom
    *
    * @desc Cria uma string randômica
    * @param int $length
    * @param boolean $uppercase
    * @param boolean $number
    * @param boolean $simbol
    * @return string $resultado
    */
    public function generateCustom( $length = 8, $uppercase = true, $number = true, $simbol = false )
    {
        $this->characters = $this->lower;
        if($uppercase)
            $this->characters .= $this->upper;
        if($number)
            $this->characters .= $this->numbers;
        if($simbol)
            $this->characters .= $this->simbols;
 
        $this->resultado = $this->generate($length);
 
        return $this->resultado;
    }
 
    /**
    * numeric
    *
    * @desc Cria uma string de números randômicos
    * @param int $length
    * @return $resultado
    */
    public function numeric( $length = 8 )
    {
        $this->characters = $this->numbers;
 
        $this->resultado = $this->generate($length);
 
        return $this->resultado;
    }
 
    /**
    * hardPassword
    *
    * @desc Cria uma senha forte
    * @param int $length
    * @return $resultado
    */
    public function hardPassword( $length = 8 )
    {
        $this->characters = $this->lower;
        $this->characters .= $this->simbols;
        $this->characters .= $this->upper;
        $this->characters .= $this->simbols;
        $this->characters .= $this->numbers;
        $this->characters .= $this->simbols;
 
        $this->resultado = $this->generate($length);
 
        return $this->resultado;
    }
 
    /**
    * generate
    *
    * @desc Gera a string baseado nos atributos da classe
    * @param int $length
    * @return $text
    */
    private function generate( $length = 8 )
    {
        $text = '';
        $max = strlen($this->characters) - 1;
        for ($i = 1; $i <= $length; $i++) {
            $rand = rand(0, $max);
            $text .= $this->characters[$rand];
        }
 
        return $text;
    }
 
    /**
    * Strategy pattern: call helper as broker method
    */
    public function direct( $length = 8, $uppercase = true, $number = true, $simbol = false )
    {
        return $this->generateCustom($length, $uppercase, $number, $simbol);
    }
}