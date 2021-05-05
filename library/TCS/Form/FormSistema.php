<?php

class TCS_Form_FormSistema extends Zend_Form {

    public $imagem = array('y' => '9999', 'x' => '9999', 'dir' => 'imagens/logos/');
    public $view = NULL;

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormSistema', 'name' => 'FormSistema'));
        $this->setAttrib('enctype', 'multipart/form-data');
        $elemento = $this->createElement('hidden', 'id', array('id' => 'id'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);
        /*
          $elemento = $this->createElement('text', 'titulo', array('id' => 'titulo', 'Label' => 'Titulo', 'class' => 'form-control'));
          $elemento->setRequired(true);
          $this->addElement($elemento); */

        // logo ....................................................................................
        /* $elemento = $this->createElement('file', 'logo', array('label' => 'Logo', 'id' => 'logo', 'class' => 'Upload'));
          try {
          $elemento->setDestination($this->imagem['dir']);
          } catch (Exception $e) {
          mkdir($this->imagem['dir']);
          $elemento->setDestination($this->imagem['dir']);
          }
          if ($_POST) {
          $this->Upload($elemento);
          }
          $this->addElement($elemento); */

        $elemento = $this->createElement('text', 'cor_layout', array('id' => 'picker1', 'Label' => 'Cor do Layout *', 'class' => 'form-control'));
        $elemento->setAttrib('required', 'required');
        $elemento->setRequired(true);
        $this->addElement($elemento);


        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('Label');
        $this->addElement($elemento);
        $this->addDisplayGroup(array('id', 'cor_layout', 'Salvar'), 'confsistema', array('removeDecorator' => 'Label'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }

    public function Upload($campo = NULL) {
        $config = array('nomeAleatorio' => true);
        $arquivo = Zend_Controller_Action_HelperBroker::getStaticHelper('Upload')->Upload($campo, $config);
        $_POST['logo'] = $arquivo['novoNome'];
    }

}
