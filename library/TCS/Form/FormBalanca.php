<?php
class TCS_Form_FormBalanca extends Zend_Form {
    public $view = NULL;
    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormBalanca', 'name' => 'FormBalanca'));
        $this->setAttrib('enctype', 'multipart/form-data');
        $elemento = $this->createElement('hidden', 'id', array('id' => 'id'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);
        $elemento = $this->createElement('text', 'IP', array('id' => 'ip', 'Label' => 'IP', 'class' => 'form-control'));
        $elemento->setRequired(true);
        
        $this->addElement($elemento);
        $elemento = $this->createElement('text', 'PORTA', array('id' => 'porta', 'Label' => 'PORTA', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        
        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('Label');
        $this->addElement($elemento);
        $this->addDisplayGroup(array('id', 'IP', 'PORTA','Salvar'), 'config_IP', array('removeDecorator' => 'Label'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }
}
