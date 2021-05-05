<?php

class Admin_PerfisController extends Zend_Controller_Action {

    public function indexAction() {
        $ModelPerfil = new Admin_Model_Perfil();
        $result = $ModelPerfil->Lista();
        $this->view->dados = $result;
    }

    public function adicionarAction() {
        $form = new TCS_Form_FormPerfil();
        $ModelPerfil = new Admin_Model_Perfil();
        if ($this->_request->isPost() && $form->isValid($_POST)) {
            $ModelPerfil->insert($_POST);
            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Adicionado com sucesso'));
            $this->redirect('admin/perfis/');
        }
        $this->view->form = $form;
        $this->view->controller = $this->_request->getControllerName();
    }

    public function editarAction() {
        $id = (int) $this->_request->getParam('id');
        $form = new TCS_Form_FormPerfil();
        $ModelPerfil = new Admin_Model_Perfil();
        if ($id) {
            $values = $ModelPerfil->GetDados($id);
            $form->populate($values);
            if ($this->_request->isPost() && $form->isValid($_POST)) {
                $ModelPerfil->insert($_POST);
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
        $ModelPerfil = new Admin_Model_Perfil();
        $ModelPerfil->delete("id = " . $id);
        //Adiciona a mensagem de sucesso
        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Excluido com sucesso'));
        $this->_redirect('admin/perfis');
    }

}
