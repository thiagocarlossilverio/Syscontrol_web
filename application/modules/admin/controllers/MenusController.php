<?php

class Admin_MenusController extends Zend_Controller_Action {

    public function indexAction() {
        $menus = new Admin_Model_Menus();
        $result = $menus->Lista();
        $this->view->dados = $result;
    }

    public function adicionarAction() {
        $form = new TCS_Form_FormMenu();
        $menus = new Admin_Model_Menus();
        $post = $this->_request->GetPost();
        if ($this->_request->isPost() && $form->isValid($post)) {
            $menus->insert($post);

            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Adicionado com sucesso'));
            $this->redirect('admin/menus/');
        }

        $this->view->form = $form;
        $this->view->controller = $this->_request->getControllerName();
    }

    public function editarAction() {
        $id = $this->_request->getParam('id');
        $menus = new Admin_Model_Menus();
        $form = new TCS_Form_FormMenu();
        $ModelVisualizacao = new Admin_Model_MenusVisualizacao();
        if ($id) {
            $values = $menus->Popular($id);
            $values['permissao'] = $ModelVisualizacao->Populate($id);

            $form->populate($values);

            if ($this->_request->isPost() && $form->isValid($_POST)) {
                $menus->insert($_POST);
                $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Editado com sucesso'));
                $this->_helper->redirector('index');
            } else {
                $this->view->formData = $_POST;
            }

            $this->view->form = $form;
            $this->view->controller = $this->_request->getControllerName();
            $this->render('adicionar');
        } else {
            $this->_helper->redirector('index');
        }
    }

    public function excluirAction() {
        $id = $this->_request->getParam('id');
        $ModelMenus = new Admin_Model_Menus();
        $ModelVisualizacao = new Admin_Model_MenusVisualizacao();
        $ModelMenus->delete("id = " . $id);
        $ModelMenus->delete("pai = " . $id);
        $ModelVisualizacao->delete("menu = " . $id);

        //Adiciona a mensagem de sucesso
        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Excluido com sucesso'));
        $this->_redirect('admin/menus');
    }


    
    }
