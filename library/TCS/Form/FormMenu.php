<?php

class TCS_Form_FormMenu extends Zend_Form {

    public $view = NULL;    // Vou atribuir os Helpers de Vis�o aqui.

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormMenus', 'nome' => 'FormMenus', 'enctype' => 'multipart/form-data'));
        $id = $this->createElement('hidden', 'id', array('id' => 'id'));
        $id->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($id);
        $elemento = $this->createElement('text', 'nome', array('label' => 'Nome', 'id' => 'nome', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        $elemento = $this->createElement('textarea', 'descricao', array('label' => 'Descrição', 'rows' => '3', 'id' => 'descricao', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);

        // categorias .......................................................................
        $categoria = new Admin_Model_Menus();
        $elemento = $this->createElement('select', 'pai', array('label' => 'Categoria', 'id' => 'pai', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => '-- Selecione uma categoria -- '));
        foreach ($categoria->Categorias() as $key => $row)
            if ($row['id'])
                $elemento->addMultioptions(array($row['id'] => $row['nome']));

        $this->addElement($elemento);
        // permissoes ......................................................................................
        $perfil = new Admin_Model_Perfil();
        $lista = $perfil->Lista();

        $elemento = $this->createElement('select', 'permissao', array('id' => 'permissao', 'multiple' => 'multiple', 'Label' => 'Perfil', 'class' => 'form-control'));
        $elemento->setRegisterInArrayValidator(false);
        if ($lista) {
            foreach ($lista as $key => $local) {
                if ($local['id']) {
                    $elemento->addMultioptions(array($local['id'] => $local['nome']));
                }
            }
        }
        $elemento->setRequired(false);
        $this->addElement($elemento);

        $elemento = $this->createElement('select', 'controller', array('label' => 'Controlador', 'id' => 'controller', 'class' => 'form-control'));
        $elemento->addMultioptions(array('' => 'Selecione o Controller'));
        $elemento->addMultioptions($this->getController());
        $elemento->setRequired(true);
        $this->addElement($elemento);
        $elemento = $this->createElement('text', 'action', array('label' => 'Ação', 'id' => 'action', 'class' => 'form-control'));
        $elemento->setRequired(false);
        $this->addElement($elemento);
       
        // ICONE  ................................................................
        $elemento = $this->createElement('hidden', 'icone', array('id' => 'icone'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);
        $elemento = $this->createElement('radio', 'status', array('MultiOptions' => array('1' => 'Ativo', '0' => 'Inativo'), 'Label' => 'Situação', 'class' => 'label_radio'));
        $elemento->setSeparator('');
        $elemento->setRequired(true);
        $elemento->setValue(1);
        $this->addElement($elemento);
        $elemento = $this->createElement('submit', 'Salvar', array('class' => 'btn btn-success'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);
        $this->addDisplayGroup(array('id', 'nome', 'descricao', 'pai', 'permisoes_idpermisoes', 'permissao', 'url', 'controller', 'action', 'param', 'icone', 'status', 'Salvar'), 'menus', array('removeDecorator' => 'Label', 'class' => 'form-group'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }

    public function Checkbox() {
        $permissoes = new Admin_Model_Perfil();
        $lista = $permissoes->Lista();
        foreach ($lista as $indice => $row) {
            $data[$indice] = $row['id'];
            $data[$indice] = $row['nome'];
            return $data;
        }
    }

    public function getController() {
        $path = APPLICATION_PATH . '/modules/admin/controllers/';

        $diretorio = dir($path);
        $arr = array();
        while ($arquivo = $diretorio->read()) {
            if (!is_dir($arquivo) && $arquivo != '.' && $arquivo != '..') {
                $values = str_replace('.php', '', $arquivo);
                $value = explode('Controller', $values);
                $arr[strtolower($value[0])] = $arquivo;
            }
        }
        $diretorio->close();
        asort($arr);
        return $arr;
    }

}
