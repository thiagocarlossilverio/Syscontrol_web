<?php

class TCS_Form_FormCarga extends Zend_Form {

    public $view = NULL;

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;

//
        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormCarga', 'name' => 'FormCarga', 'enctype' => 'multipart/form-data'));
        $id = $this->createElement('hidden', 'id', array('id' => 'id'));
        $id->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($id);

        $action = Zend_Controller_Front::getInstance()->getRequest()->getActionName();

        $elemento = $this->createElement('radio', 'carregado', array('MultiOptions' => array('1' => 'Sim', '0' => 'Não'), 'Label' => 'O Caminhão está carregado?', 'class' => 'label_radio'));
        $elemento->setSeparator('');
        $elemento->setRequired(true);
        $this->addElement($elemento);

        // caminhoes ......................................................................................
        $ModelCaminhoes = new Admin_Model_Caminhoes();
        $ListCaminhoes = $ModelCaminhoes->ListarCaminhoes();
        $elemento = $this->createElement('select', 'caminhao', array('id' => 'caminhao', 'Label' => 'Caminhão *', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione o Caminhão'));
        if ($ListCaminhoes) {
            foreach ($ListCaminhoes as $key => $caminhao) {
                if ($caminhao['id']) {
                    $elemento->addMultioptions(array($caminhao['id'] => $caminhao['placa']));
                }
            }
        }
        $elemento->setRequired(true);
        $this->addElement($elemento);

        // motorista ......................................................................................
        $Motoristas = new Admin_Model_Motoristas();
        $lista = $Motoristas->ListarMotoristas();

        $elemento = $this->createElement('select', 'motorista', array('id' => 'motorista', 'Label' => 'Motorista *', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione o motorista'));
        if ($lista) {
            foreach ($lista as $key => $cliente) {
                if ($cliente['id']) {
                    $elemento->addMultioptions(array($cliente['id'] => $cliente['nome']));
                }
            }
        }
        $elemento->setRequired(TRUE);
        $this->addElement($elemento);

        // Categoria .......................................................................
        $Categorias = new Admin_Model_Categorias();
        $lista = $Categorias->ListarCategorias();
        $elemento = $this->createElement('select', 'categoria', array('label' => 'Categoria *', 'id' => 'categoria', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione uma Categoria'));
        foreach ($lista as $key => $local)
            if ($local['id'])
                $elemento->addMultioptions(array($local['id'] => $local['nome']));
        $elemento->setRequired(true);
        $this->addElement($elemento);

        // subCategoria .......................................................................
        $Categorias = new Admin_Model_Categorias();
        $lista = $Categorias->getSub();
        $elemento = $this->createElement('select', 'subcategoria', array('label' => 'Subcategoria *', 'id' => 'subcategoria', 'class' => 'form-control'));
        $elemento->setRegisterInArrayValidator(false);
        $elemento->setAttrib('readonly', 'readonly');
        $elemento->addMultioptions(array('' => 'Selecione uma Subcategoria'));
        foreach ($lista as $key => $local)
            if ($local['id'])
                $elemento->addMultioptions(array($local['id'] => $local['nome']));
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'cabecas', array('id' => 'cabecas', 'Label' => 'Cabeças', 'class' => 'form-control'));
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'peso_bruto', array('id' => 'peso_bruto', 'Label' => 'Peso Bruto', 'class' => 'form-control'));
        // $elemento->setAttrib('readonly', 'readonly');
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'peso_tara', array('id' => 'peso_tara', 'Label' => 'Peso Tara', 'class' => 'form-control'));
        // $elemento->setAttrib('readonly', 'readonly');
        $this->addElement($elemento);

        $elemento = $this->createElement('textarea', 'descricao', array('label' => 'Descrição', 'rows' => '3', 'id' => 'descricao', 'class' => 'form-control'));
        $this->addElement($elemento);


        $elemento = $this->createElement('text', 'data_entrada', array('id' => 'data_entrada', 'Label' => 'Data Entrada', 'value' => date('d/m/Y H:i:s'), 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'data_saida', array('id' => 'data_saida', 'Label' => 'Data Saída', 'class' => 'form-control'));
        if (isset($action) && $action == 'editar') {
            $elemento->setRequired(true);
        }
        $this->addElement($elemento);

        // Fornecedores ......................................................................................
        $Fornecedores = new Admin_Model_Fornecedores();
        $lista = $Fornecedores->ListarFornecedores();

        $elemento = $this->createElement('select', 'fornecedor', array('id' => 'fornecedor', 'Label' => 'Fornecedor *', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione o fornecedor'));
        if ($lista) {
            foreach ($lista as $key => $cliente) {
                if ($cliente['id']) {
                    $elemento->addMultioptions(array($cliente['id'] => $cliente['nome']));
                }
            }
        }
        $elemento->setRequired(TRUE);
        $this->addElement($elemento);

        // Fornecedores ......................................................................................
        $clientes = new Admin_Model_Clientes();
        $lista = $clientes->ListarClientes();

        $elemento = $this->createElement('select', 'cliente', array('id' => 'cliente', 'Label' => 'Destino *', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione o destino'));
        if ($lista) {
            foreach ($lista as $key => $cliente) {
                if ($cliente['id']) {
                    $elemento->addMultioptions(array($cliente['id'] => $cliente['nome']));
                }
            }
        }
        $elemento->setRequired(TRUE);
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'peso_nota', array('id' => 'peso_nota', 'Label' => 'Peso Nota', 'class' => 'form-control'));
        $this->addElement($elemento);

        $elemento = $this->createElement('text', 'nota_fiscal', array('id' => 'nota_fiscal', 'Label' => 'Nota Fiscal', 'class' => 'form-control'));
        $this->addElement($elemento);

        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);

        $this->addDisplayGroup(array('id', 'carregado', 'caminhao', 'motorista', 'categoria', 'subcategoria', 'cabecas', 'peso_bruto', 'peso_tara', 'peso_nota', 'descricao', 'data_entrada', 'data_saida', 'fornecedor', 'cliente', 'nota_fiscal', 'Salvar'), 'FieldCarga', array('removeDecorator' => 'Label', 'class' => 'form-group'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }

}
