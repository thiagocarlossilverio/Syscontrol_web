<?php

class TCS_Form_FormApp extends Zend_Form {

    public $view = NULL;

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormApp', 'name' => 'FormApp'));
        $this->setAttrib('enctype', 'multipart/form-data');
        $elemento = $this->createElement('hidden', 'id', array('id' => 'id'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'version_atual_app', array('id' => 'version_atual_app', 'Label' => 'Versão do Aplicativo', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);

        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('Label');
        $this->addElement($elemento);

        $this->addDisplayGroup(array('id', 'version_atual_app', 'Salvar'), 'configemail', array('removeDecorator' => 'Label'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }

}
