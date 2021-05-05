<?php
/**
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class TCS_validator_Pesos extends Zend_Validate_Abstract
{
    /**
     * Error codes
     * @const string
     */
    const MAIOR      	= 'maior';
    const MISSING_TOKEN = 'missingToken';
    /**
     * Error messages
     * @var array
     */
    protected $_messageTemplates = array(
        self::MAIOR      	 => "O peso inicial tem que ser maior que o peso final.",
        self::MISSING_TOKEN  => "Peso inválido",
    );
    /**
     * @var array
     */
    protected $_messageVariables = array(
        'token' => '_tokenString'
    );
    /**
     * Original token against which to validate
     * @var string
     */
    protected $_tokenString;
    protected $_token;
    protected $_compare;
    /**
     * Sets validator options
     *
     * @param  mixed $token
     * @param  mixed $compare
     * @return void
     */
    public function __construct($token = null, $compare = null)
    {
        if (null !== $token) {
            $this->setToken($token);
            $this->setCompare($compare);
        }
    }
    /**
     * Set token against which to compare
     *
     * @param  mixed $token
     * @return Zend_Validate_Identical
     */
    public function setToken($token)
    {
        $this->_tokenString = (string) $token;
        $this->_token       = $token;
        return $this;
    }
    /**
     * Retrieve token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->_token;
    }
    /**
     * Set compare against which to compare
     *
     * @param  mixed $compare
     * @return Zend_Validate_Identical
     */
    public function setCompare($compare)
    {
        $this->_compareString = (string) $compare;
        $this->_compare       = $compare;
        return $this;
    }
    /**
     * Retrieve compare
     *
     * @return string
     */
    public function getCompare()
    {
        return $this->_compare;
    }
    /**
     * Defined by Zend_Validate_Interface
     *
     * Returns true if and only if a token has been set and the provided value
     * matches that token.
     *
     * @param  mixed $value
     * @return boolean
     */
    public function isValid($value)
    {
        $this->_setValue((string) $value);
        $token = $this->getToken();
        if ($token === null) {
            $this->_error(self::MISSING_TOKEN);
            return false;
        }
        // Not Later
        if ($this->getCompare() == 'maior'){
            if ($value < $token[0]) {
                $this->_error(self::MAIOR);
                return false;
            }
        }
        // Date is valid
        return true;
    }
}