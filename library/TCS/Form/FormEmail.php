<?php
class TCS_Form_FormEmail extends Zend_Form {
    public $view = NULL;
    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormEmail', 'name' => 'FormEmail'));
        $this->setAttrib('enctype', 'multipart/form-data');
        $elemento = $this->createElement('hidden', 'id', array('id' => 'id'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);
        $elemento = $this->createElement('text', 'smtp', array('id' => 'smtp', 'Label' => 'SMTP', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        $elemento = $this->createElement('text', 'conta', array('id' => 'conta', 'Label' => 'Conta', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        $elemento = $this->createElement('text', 'senha', array('id' => 'senha', 'Label' => 'Senha', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        $elemento = $this->createElement('text', 'remetente', array('id' => 'remetente', 'Label' => 'Remetente', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        $elemento = $this->createElement('text', 'conexao', array('id' => 'conexao', 'Label' => 'Conexão', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        $elemento = $this->createElement('text', 'porta', array('id' => 'porta', 'Label' => 'Porta', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('Label');
        $this->addElement($elemento);
        $this->addDisplayGroup(array('id', 'smtp', 'conta', 'senha', 'remetente', 'conexao', 'porta','Salvar'), 'configemail', array('removeDecorator' => 'Label'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }
}
