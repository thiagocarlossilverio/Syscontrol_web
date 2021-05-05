<?php

class Admin_Model_Menus extends Zend_Db_Table {

    protected $_name = 'menus';
    protected $_primary = 'id';

    public function insert(array $data) {
        if (!is_array($data))
            return false;

        if (empty($data['pai'])) {
            $data['pai'] = NULL;
        }

        if (is_numeric($data['id'])) {
            $this->update($data, "id = " . $data['id']);
            $ModelVisualizacao = new Admin_Model_MenusVisualizacao();
            $id = $data['id'];

            $ModelVisualizacao->delete("menu = " . $id);
            foreach ($data['permissao'] as $permissao) {
                $dados = array();
                $dados['menu'] = $id;
                $dados['perfil'] = $permissao;
                $ModelVisualizacao->insert($dados);
            }

            return $data['id'];
        }
        unset($data['id']);
        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);
        $idmenu = parent::insert($data_insert);
        $ModelVisualizacao = new Admin_Model_MenusVisualizacao();
        foreach ($data['permissao'] as $permissao) {
            $data = array();
            $data['menu'] = $idmenu;
            $data['perfil'] = $permissao;
            $ModelVisualizacao->insert($data);
        }
    }

    public function Popular($id) {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("m" => $this->_name), array('*'))
                ->where("m.id = ?", $id);
        if ($result = $this->fetchRow($sql)) {
            return $result->toArray();
        } else {
            return FALSE;
        }
    }

    public function GetDados($id) {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("m" => $this->_name), array('controller', 'action', 'param'))
                ->where("m.id = ?", $id);
        if ($result = $this->fetchAll($sql)) {
            return $result->toArray();
        } else {
            return FALSE;
        }
    }

    public function Categorias() {
        $sql = $this->select()->where("pai IS NULL");
        if ($result = $this->fetchAll($sql)) {
            return $result;
        }
    }

    public function update(array $data, $where) {
        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);
        parent::update($data_insert, $where);
    }

    public function GeraMenu($perfil) {
        $controller = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();

        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("m" => $this->_name), array("*"))
                ->joinLeft(array("mv" => "menus_visualizacao"), "m.id = mv.menu", array("menu", "perfil"))
                ->where("m.controller = ?", $controller)
                ->where("m.status = ?", 1)
                ->where("mv.perfil = ?", $perfil)
                ->group("mv.menu")
                ->order("m.nome");

        if ($result = $this->fetchAll($sql)) {
            return $result->toArray();
        } else {
            return FALSE;
        }
    }

    public function Lista() {
        $sql = $this->select()->order("controller");
        if ($result = $this->fetchAll($sql)) {
            return $result->toArray();
        } else {
            return FALSE;
        }
    }

    public function listarFilho($id, $perfil = FALSE) {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("m" => $this->_name), array("*"))
                ->joinLeft(array("mv" => "menus_visualizacao"), "m.id = mv.menu", array("perfil"))
                ->where("m.status = ?", 1)
                ->where('m.pai= ?', $id)
                ->group("m.id")
                ->order('m.nome');
        if ($perfil) {
            $sql->where('mv.perfil= ?', $perfil);
        }

        if ($result = $this->fetchAll($sql)) {
            return $result->toArray();
        } else {
            return FALSE;
        }
    }

}
