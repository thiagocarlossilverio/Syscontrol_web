<?php

class Admin_PermissoesController extends Zend_Controller_Action {

    public function indexAction() {
        $Model_permissoes = new Admin_Model_MenusPerfil();
        $ModelPerfil = new Admin_Model_Perfil();

        $perfis = $ModelPerfil->Lista();
        $result = $Model_permissoes->Lista();
        $this->view->menus = $result;
        $this->view->perfis = $perfis;
        $this->view->permissoes = new Admin_Model_MenusPerfilPermissoes();
    }

    public function atualizarAction() {
        $Model_permissoes = new Admin_Model_MenusPerfil();
        $front = $this->getFrontController();
        $acl = array();
        foreach ($front->getControllerDirectory() as $module => $path) {
            if ($module == 'admin') {
                foreach (scandir($path) as $file) {

                    if (strstr($file, "Controller.php") !== false) {

                        include_once $path . DIRECTORY_SEPARATOR . $file;

                        foreach (get_declared_classes() as $class) {
                            if (is_subclass_of($class, 'Zend_Controller_Action')) {

                                $controller = strtolower(substr($class, 0, strpos($class, "Controller")));
                                $NameController = explode('_', $controller);
                                $controller = strtolower($NameController[1]);

                                $actions = array();
                                foreach (get_class_methods($class) as $action) {
                                    if (strstr($action, "Action") !== false) {
                                        $NameAction = explode('Action', $action);
                                        $actions[] = strtolower($NameAction[0]);
                                    }
                                }
                            }
                        }
                        $acl[$controller] = $actions;
                    }
                }
            }
        }

        $i = 0;
        foreach ($acl as $controlador => $acoes) {
            foreach ($acoes as $acao) {
                $verifica = $Model_permissoes->VerificaModulos($controlador, $acao);
                $data = array('controlador' => $controlador, 'acao' => strtolower($acao));
                if ($verifica) {
                    $Model_permissoes->update($data, "controlador = '" . $controlador . "' AND acao = '" . $acao . "'");
                } else {
                    $Model_permissoes->insert($data);
                }
            }
            $i ++;
        }
        $this->_helper->FlashMessenger->addMessage(array('sucesso' => 'Módulos atualizados com sucesso!'));
        $this->redirect('/admin/permissoes');
    }

    public function ajaxPerfilAction() {
        $this->_helper->layout()->disableLayout();

        $ModelPermissao = new Admin_Model_MenusPerfilPermissoes();

        $menu = $this->_request->getParam('id');
        $perfil = $this->_request->getParam('perfil');

        $result = $ModelPermissao->VerificaPerfil($menu, $perfil);

        if ($result) {
            $ModelPermissao->delete("menu = '" . $menu . "' AND perfil = '" . $perfil . "'");
        } else {
            $result = $ModelPermissao->insert(array('menu' => $menu, 'perfil' => $perfil));
        }
        if ($result) {
            die('1');
        } else {
            die('0');
        }
    }

}
