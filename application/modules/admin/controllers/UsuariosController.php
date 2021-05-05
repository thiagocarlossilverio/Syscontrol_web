<?php

class Admin_UsuariosController extends Zend_Controller_Action {

    public function indexAction() {
        $usuarios = new Admin_Model_Usuarios();
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        $result = $usuarios->Lista($user->perfil);

        $this->view->user = $user->id;
        $this->view->lista = $result;
    }

    public function adicionarAction() {
        $form = new TCS_Form_FormUsuarios();
        $usuarios = new Admin_Model_Usuarios();

        $data = $this->_request->getPost();
        if ($this->_request->isPost() && $form->isValid($data)) {
            $usuarios->insert($data);

            $conteudo = array('nome' => $data['nome'], 'email' => $data['email'], 'login' => $data['login'], 'senha' => $data['senha']);
            $assunto = "SysControl | Dados de Acesso";
            Zend_Controller_Action_HelperBroker::getStaticHelper('Emails')->Emails('', $data['email'], $assunto, $conteudo, false, 'emails/cadastro.phtml');

            //Adiciona a mensagem de sucesso
            $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Adicionado com sucesso'));

            $this->redirect('admin/usuarios/');
        }
        $this->view->form = $form;
        $this->view->controller = $this->_request->getControllerName();
    }

    public function editarAction() {

        $id = $this->_request->getParam('id');
        $menus = new Admin_Model_Usuarios();
        $form = new TCS_Form_FormUsuarios();

        if ($id) {

            $values = $menus->GetDados($id);
            $form->populate($values);

            if ($this->_request->isPost()) {
                $data = $this->_request->getPost();

                $menus->insert($data);

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
        $id = $this->_request->getParam('id');
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        $ModelUsuarios = new Admin_Model_Usuarios();
        $ModelSistema = new Admin_Model_ConfSistema();


        $user_img = $ModelUsuarios->GetDados($id);

        if ($user_img['imagem']) {

            $caminho = 'imagens/usuarios/' . $user_img['imagem'];

            if (file_exists($caminho)) {
                unlink($caminho);
            }
        }

        $ModelUsuarios->delete("id = " . $id);
        $ModelSistema->delete("user = " . $id);

        //Adiciona a mensagem de sucesso
        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Excluido com sucesso'));

        if ($id == $user->id) {
            $auth = Zend_Auth::getInstance();
            $auth->clearIdentity();
            $this->_redirect('/admin');
        }

        $this->_redirect('admin/usuarios');
    }

    public function perfilAction() {
        $id_usuario = $this->_request->getParam('id');
        $ModelUsuario = new Admin_Model_Usuarios();

        if (!$id_usuario) {
            $auth = Zend_Auth::getInstance();
            $user = $auth->getIdentity();
            $id_usuario = $user->id;
        }
        $result = $ModelUsuario->getPerfil($id_usuario);

        $this->view->dados = $result;
    }

    public function perfilEditarAction() {
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        $id = $this->_request->getParam('id');
        $menus = new Admin_Model_Usuarios();
        $form = new TCS_Form_FormUserPerfil();

        if ($user->id != $id) {
            $this->_helper->FlashMessenger->addMessage(array('erro' => 'Ação não permitida'));
            $this->redirect('/admin/usuarios/perfil');
        }

        if ($id) {
            $values = $menus->GetDados($id);
            $form->populate($values);

            if ($this->_request->isPost()) {
                $data = $this->_request->getPost();

                $menus->insert($data);

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

}
