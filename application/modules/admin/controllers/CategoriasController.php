<?php

class Admin_CategoriasController extends Zend_Controller_Action {

    public function indexAction() {
        $categorias = new Admin_Model_Categorias();
        $result = $categorias->ListarAll();
        $this->view->dados = $result;
    }

    public function adicionarAction() {
        $form = new TCS_Form_FormCategorias();
        $ModelCategorias = new Admin_Model_Categorias();

        $data = $this->_request->getPost();
        if ($this->_request->isPost() && $form->isValid($data)) {
            $ModelCategorias->insert($data);
            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Adicionado com sucesso'));
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        $this->view->form = $form;
        $this->view->controller = $this->_request->getControllerName();
    }

    public function editarAction() {
        $id = (int) $this->_request->getParam('id');
        $form = new TCS_Form_FormCategorias();
        $ModelCategorias = new Admin_Model_Categorias();
        if ($id) {
            $values = $ModelCategorias->GetDados($id);
            $form->populate($values);
            if ($this->_request->isPost() && $form->isValid($_POST)) {
                $ModelCategorias->insert($_POST);
                $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Editado com sucesso'));
                $this->_helper->redirector('index');
            }
            $this->view->form = $form;
            $this->view->controller = $this->_request->getControllerName();
            $this->render('adicionar');
        } else {
            $this->_helper->redirector('index');
        }
    }

    public function excluirAction() {
        $id = (int) $this->_request->getParam('id');

        $ModelCategorias = new Admin_Model_Categorias();
        $ModelCargas = new Admin_Model_Cargas();

        $resultc = $ModelCargas->VerificaCategoria($id);

        if ($resultc) {
            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não foi possível excluir a categoria, ela se encontra em uso!'));
            $this->_redirect('admin/categorias');
        }


        $results = $ModelCargas->VerificaSubcategoria($id);

        if ($results) {
            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não é possível excluir a subcategoria, ela se encontra em uso!'));
            $this->_redirect('admin/categorias');
        }


        $ModelCategorias->delete("id = " . $id);

        //Adiciona a mensagem de sucesso
        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Excluido com sucesso'));
        $this->_redirect('admin/categorias');
    }

    public function ajaxSubCategoriasAction() {
        $id = $this->_request->getParam('categoria');
        $db = new Admin_Model_Categorias();
        $res = $db->getChildrens($id);
        $new_arr = array();
        foreach ($res as $array) {
            $new_arr[] = array('id' => $array['id'], 'nome' => $array['nome'], 'pai' => $array['pai']);
        }
        
        die(json_encode($new_arr));
        
    }

    public function ajaxSubAction() {
        $id = $this->_request->getParam('categoria');
        $db = new Admin_Model_Categorias();
        $data = $db->getSubs($id);

        die(json_encode($data));
    }

}
