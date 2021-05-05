<?php

class TCS_Form_FormCaminhao extends Zend_Form {

    public $view = NULL;

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormCaminhao', 'name' => 'FormCaminhao', 'enctype' => 'multipart/form-data'));
        $id = $this->createElement('hidden', 'id', array('id' => 'id'));
        $id->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($id);


        $elemento = $this->createElement('select', 'tipo', array('id' => 'tipo', 'Label' => 'Tipo *', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione o tipo'));
        $elemento->addMultioptions(array('1' => 'Granel'));
        $elemento->addMultioptions(array('2' => 'Porcadeiro'));
        $elemento->addMultioptions(array('3' => 'Silo'));
        $elemento->setRequired(TRUE);
        $this->addElement($elemento);


        // marca ......................................................................................
        $ModelMarcas = new Admin_Model_Marcas();
        $ListaMarcas = $ModelMarcas->ListarMarcas();
        $elemento = $this->createElement('select', 'marca', array('id' => 'marca', 'Label' => 'Marca *', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione a marca'));
        if ($ListaMarcas) {
            foreach ($ListaMarcas as $key => $marca) {
                if ($marca['id']) {
                    $elemento->addMultioptions(array($marca['id'] => $marca['nome']));
                }
            }
        }
        $elemento->setRequired(true);
        $elemento->setAttrib('required', 'required');
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'modelo', array('id' => 'modelo', 'Label' => 'Modelo', 'class' => 'form-control'));
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'placa', array('id' => 'placa', 'Label' => 'Placa *', 'maxlength'=>'7','class' => 'form-control'));
        $where = array('table' => 'caminhoes',
            'field' => 'placa',
            'messages' => "A Placa '%value%' já existe na base de dados."
        );

        // CONDIÃ‡ÃƒO USADA AO EDITAR O REGISTRO
        if (isset($_POST['id']) and $_POST['id'] != '') {
            $where[] = 'id != ' . $_POST['id'];
        }
        $elemento->addValidator('Db_NoRecordExists', true, $where)
                ->setAttrib('required', 'required')
                ->setRequired(true)
                ->addDecorator('Description', array('tag' => 'span', 'class' => 'btn', 'id' => 'botGerarCod', 'escape' => false));
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'proprietario', array('id' => 'proprietario', 'Label' => 'Proprietário', 'class' => 'form-control'));
        $this->addElement($elemento);

        $elemento = $this->createElement('radio', 'proprio', array('MultiOptions' => array('1' => 'Sim', '0' => 'Não'), 'Label' => 'Veiculo Próprio? *', 'class' => 'label_radio'));
        $elemento->setSeparator('');
        $elemento->setRequired(true);
        $this->addElement($elemento);

        $elemento = $this->createElement('radio', 'ativo', array('MultiOptions' => array('1' => 'Sim', '0' => 'Não'), 'Label' => 'Ativo *', 'class' => 'label_radio'));
        $elemento->setSeparator('');
        $elemento->setRequired(true);
        $elemento->setAttrib('required', 'required');
        $this->addElement($elemento);



        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);

        $this->addDisplayGroup(array('id', 'tipo', 'marca', 'modelo', 'placa', 'proprietario', 'proprio', 'ativo', 'Salvar'), 'caminhao', array('removeDecorator' => 'Label', 'class' => 'form-group'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }

}
