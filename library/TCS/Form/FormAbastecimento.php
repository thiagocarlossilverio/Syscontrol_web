<?php

class TCS_Form_FormAbastecimento extends Zend_Form {

    public $view = NULL;

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;

        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormAbastecimento', 'name' => 'FormAbastecimento'));
        $this->setAttrib('enctype', 'multipart/form-data');

        $elemento = $this->createElement('hidden', 'id', array('id' => 'id'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);

       // listo os veiculos ativos .......................................................................
        $ModelVeiculos = new Admin_Model_Caminhoes();
        $elemento = $this->createElement('select', 'veiculo', array('label' => 'Veículo (*)', 'id' => 'veiculo', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione o veículo'));
        foreach ($ModelVeiculos->ListarCaminhoes(false, TRUE) as $key => $row)
            if ($row['id'])
                $elemento->addMultioptions(array($row['id'] => $row['placa']));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        
        
        // listo os Motoristas ativos .......................................................................
        $Modelmotoristas = new Admin_Model_Motoristas();
        $elemento = $this->createElement('select', 'motorista', array('label' => 'Motorista (*)', 'id' => 'motorista', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione o motorista'));
        foreach ($Modelmotoristas->ListarMotoristas(true) as $key => $row)
            if ($row['id'])
                $elemento->addMultioptions(array($row['id'] => $row['nome']));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        
        // listo os fornecdores de combustivel .......................................................................
        $FornecedoresCombustivel = new Admin_Model_FornecedoresCombustivel();
        $elemento = $this->createElement('select', 'fornecedor', array('label' => 'Fornecedor (*)', 'id' => 'fornecedor', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione o fornecedor'));
        foreach ($FornecedoresCombustivel->ListarFornecedores() as $key => $row)
            if ($row['id'])
                $elemento->addMultioptions(array($row['id'] => $row['nome']));
        $elemento->setRequired(true);
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'litros', array('label' => 'Litros (*)', 'id' => 'litros', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'km', array('label' => 'KM (*)', 'id' => 'km', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'registro', array('id' => 'registro', 'Label' => 'Registro', 'class' => 'form-control'));
        $this->addElement($elemento);
        
               
        $elemento = $this->createElement('text', 'valor', array('id' => 'valor', 'Label' => 'Valor', 'class' => 'form-control'));
        $this->addElement($elemento);
        
        
        $elemento = $this->createElement('textarea', 'observacao', array('label' => 'Observação', 'rows' => '3', 'id' => 'observacao', 'class' => 'form-control'));
        $this->addElement($elemento);
        
       
        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('Label');
        $this->addElement($elemento);
        $this->addDisplayGroup(array('id', 'veiculo', 'motorista','fornecedor', 'litros', 'km', 'registro', 'valor', 'observacao', 'Salvar'), 'abastecimento', array('removeDecorator' => 'Label'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }

}
