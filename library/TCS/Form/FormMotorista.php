<?php

class TCS_Form_FormMotorista extends Zend_Form {

    public $view = NULL;

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;

        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormMotorista', 'name' => 'FormMotorista'));
        $this->setAttrib('enctype', 'multipart/form-data');
        $elemento = $this->createElement('hidden', 'id', array('id' => 'id'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'nome', array('id' => 'nome', 'Label' => 'Nome Completo *', 'class' => 'form-control'));
        $elemento->setRequired(true)
                ->addValidator(new Zend_Validate_Alpha(true))
                ->addValidator(new Zend_Validate_StringLength(10, 100))
                ->addFilter(new Zend_Filter_StringToUpper());
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'data_nascimento', array('value' => '0000-00-00', 'label' => 'Data Nascimento', 'id' => 'data_nascimento', 'class' => 'form-control'));
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'cpf', array('label' => 'CPF', 'id' => 'cpf', 'class' => 'form-control'));
        $where = array('table' => 'motoristas',
            'field' => 'cpf',
            'messages' => "O CPF '%value%' já existe na base de dados."
        );
        // CONDIÃ‡ÃƒO USADA AO EDITAR O REGISTRO
        if (isset($_POST['id']) and $_POST['id'] != '')
            $where[] = 'id != ' . $_POST['id'];

        if (isset($_POST['cpf']) and $_POST['cpf'] != '') {
            $elemento->addValidator(new TCS_validator_Cpf());
            $elemento->addValidator('Db_NoRecordExists', true, $where)
                    ->addDecorator('Description', array('tag' => 'span', 'class' => 'btn', 'id' => 'botGerarCod', 'escape' => false));
        }
        $elemento->setRequired(true);
        $this->addElement($elemento);

        // email .........................................................................
        $elemento = $this->createElement('text', 'email', array('label' => 'Email', 'id' => 'email', 'class' => 'form-control'));
        $where = array('table' => 'motoristas',
            'field' => 'email',
            'messages' => "O E-mail '%value%' já existe na base de dados."
        );
        // CONDIÃ‡ÃƒO USADA AO EDITAR O REGISTRO
        if (isset($_POST['id']) and $_POST['id'] != '')
            $where[] = 'id != ' . $_POST['id'];
        $elemento->addValidator('Db_NoRecordExists', true, $where)
                //->setAttrib('required', 'required')
                //->setRequired(true)
                ->addValidator('emailAddress')
                ->addFilter('StripTags')
                ->addValidator('stringLength')
                ->addDecorator('Description', array('tag' => 'span', 'class' => 'btn', 'id' => 'botGerarCod', 'escape' => false));
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'telefone', array('id' => 'telefone', 'Label' => 'Telefone', 'class' => 'form-control'));
        $this->addElement($elemento);

        $elemento = $this->createElement('select', 'atua_empresa', array('id' => 'atua_empresa', 'Label' => 'Motorista da Empresa *', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione uma Opção'));
        $elemento->addMultioptions(array('1' => 'Sim'));
        $elemento->addMultioptions(array('0' => 'Não'));
        $elemento->setRequired(true);
        $this->addElement($elemento);


        $elemento = $this->createElement('radio', 'ativo', array('MultiOptions' => array('1' => 'Ativo', '0' => 'Inativo'), 'Label' => 'Ativo', 'class' => 'label_radio'));
        $elemento->setSeparator('');
        $elemento->setValue('1');
        $this->addElement($elemento);

        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('Label');
        $this->addElement($elemento);
        $this->addDisplayGroup(array('id', 'nome', 'data_nascimento', 'cpf', 'telefone', 'email', 'atua_empresa', 'ativo', 'Salvar'), 'motorista', array('removeDecorator' => 'Label'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }

}
