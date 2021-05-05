<?php

class Admin_CaminhoesController extends Zend_Controller_Action {

    public function indexAction() {
        $Model = new Admin_Model_Caminhoes();
        $result = $Model->Lista();
        $this->view->dados = $result;
    }

    public function adicionarAction() {
        $form = new TCS_Form_FormCaminhao();
        $Model = new Admin_Model_Caminhoes();
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
        $form = new TCS_Form_FormCaminhao();
        $Model = new Admin_Model_Caminhoes();

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

        $ModelCaminhoes = new Admin_Model_Caminhoes();
        $ModelCargas = new Admin_Model_Cargas();

        $result = $ModelCargas->VerificaCaminhao($id);

        if ($result) {
            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Não é possível excluir o caminhão, ele está em uso!'));
            $this->_redirect('admin/caminhoes');
        }

        $ModelCaminhoes->delete("id = " . $id);

        //Adiciona a mensagem de sucesso
        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Excluido com sucesso'));

        $this->_redirect('admin/caminhoes');
    }

}
