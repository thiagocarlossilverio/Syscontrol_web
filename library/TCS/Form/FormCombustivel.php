<?php
class TCS_Form_FormCombustivel extends Zend_Form {
    public $view = NULL;
    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormEmail', 'name' => 'FormCombustivel'));
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $elemento = $this->createElement('hidden', 'id', array('id' => 'id'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);
        
        $elemento = $this->createElement('text', 'litros', array('id' => 'litros', 'Label' => 'Litros', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        
        $elemento = $this->createElement('text', 'valor_litro', array('id' => 'valor_litro', 'Label' => 'Valor', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        
        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('Label');
        $this->addElement($elemento);
        
        $this->addDisplayGroup(array('id', 'litros', 'valor_litro','Salvar'), 'combustivel', array('removeDecorator' => 'Label'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }
}
