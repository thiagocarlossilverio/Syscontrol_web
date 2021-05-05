<?php

class Admin_ClientesController extends Zend_Controller_Action {

    public function indexAction() {
        $Model = new Admin_Model_Clientes();
        $result = $Model->Lista();
        $this->view->dados = $result;
    }

    public function adicionarAction() {
        $form = new TCS_Form_FormCliente();
        $Model = new Admin_Model_Clientes();
        $data = $this->_request->getPost();
        if ($this->_request->isPost() && $form->isValid($data)) {
            $Model->insert($data);
            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Adicionado com sucesso'));
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        $this->view->form = $form;
        $this->view->controller = $this->_request->getControllerName();
    }

    public function editarAction() {
        $id = (int) $this->_request->getParam('id');
        $form = new TCS_Form_FormCliente();
        $Model = new Admin_Model_Clientes();

        if ($id) {
            $values = $Model->GetDados($id);
            if (!$values) {
                //Adiciona a mensagem de sucesso
                $this->_helper->FlashMessenger->addMessage(array('erro' => 'Ação não Permitida!'));
                $this->_helper->redirector('index');
            }
            $form->populate($values);
            $data = $this->_request->getPost();
            if ($this->_request->isPost() && $form->isValid($data)) {
                $Model->insert($data);
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

        $Model = new Admin_Model_Clientes();

        $Model->delete("id = " . $id);

        //Adiciona a mensagem de sucesso
        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Excluido com sucesso'));

        $this->_redirect('admin/clientes');
    }

}
