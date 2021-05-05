<?php

class Admin_GeralController extends Zend_Controller_Action {

    public function topoAction() {
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        $ModelSistema = new Admin_Model_ConfSistema();

        $this->view->conf = $ModelSistema->GetDados($user->id);
        $this->view->user = $user;
    }

    public function menuAction() {
        $menus = new Admin_Model_Menus();

        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        $result = $menus->GeraMenu($user->perfil);
        $this->view->menus = $result;
    }

    public function menuLateralAction() {
        $ModelVisualizacao = new Admin_Model_MenusVisualizacao();
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        if ($user) {
            $this->view->menus = $ModelVisualizacao->GetMenu($user->perfil);
            $this->view->user = $user;
        }
    }

    public function rodapeAction() {
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        $ModelSistema = new Admin_Model_ConfSistema();
        $this->view->conf = $ModelSistema->GetDados($user->id);
    }

    public function ajaxIncluirAction() {
        $param = $this->_request->getParam('param');

        $this->_helper->layout()->setLayout('admin_branco');

        switch ($param) {
            case 1:
                $form = new TCS_Form_FormMotorista();
                $Model = new Admin_Model_Motoristas();
                $Url = '/admin/motoristas/adicionar';
                break;
            case 2:
                $form = new TCS_Form_FormCaminhao();
                $Model = new Admin_Model_Caminhoes();
                $Url = '/admin/caminhoes/adicionar';
                break;
            case 3:
                $form = new TCS_Form_FormCategorias();
                $Model = new Admin_Model_Categorias();
                $Url = '/admin/categorias/adicionar';
                break;
        }

        $form->setAction($Url);
        $this->view->form = $form;
    }

}
