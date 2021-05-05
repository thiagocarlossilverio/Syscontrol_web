<?php

class TCS_Form_FormCliente extends Zend_Form {

    public $view = NULL;

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;

        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormCliente', 'name' => 'FormCliente'));
        $this->setAttrib('enctype', 'multipart/form-data');

        $elemento = $this->createElement('hidden', 'id', array('id' => 'id'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'nome', array('id' => 'nome', 'Label' => 'Nome *', 'class' => 'form-control'));
        $elemento->setRequired(true)
                ->addValidator(new Zend_Validate_Alpha(true))
                ->addValidator(new Zend_Validate_StringLength(1, 100))
                ->addFilter(new Zend_Filter_StringToUpper());
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'endereco', array('label' => 'Endereço', 'id' => 'endereco', 'class' => 'form-control'));
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'cidade', array('label' => 'Cidade', 'id' => 'cidade', 'class' => 'form-control'));
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'telefone', array('id' => 'telefone', 'Label' => 'Telefone', 'class' => 'form-control'));
        $this->addElement($elemento);

        $elemento = $this->createElement('radio', 'ativo', array('MultiOptions' => array('1' => 'Ativo', '0' => 'Inativo'), 'Label' => 'Ativo', 'class' => 'label_radio'));
        $elemento->setSeparator('');
        $elemento->setValue('1');
        $this->addElement($elemento);

        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('Label');
        $this->addElement($elemento);
        $this->addDisplayGroup(array('id', 'nome', 'endereco', 'cidade', 'telefone', 'ativo', 'Salvar'), 'cliente', array('removeDecorator' => 'Label'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }

}
