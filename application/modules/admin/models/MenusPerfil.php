<?php

class Admin_Model_MenusPerfil extends Zend_Db_Table {

    protected $_name = 'menus_perfil';
    protected $_primary = 'id';

    public function insert(array $data) {

        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);
        $lastId = parent::insert($data_insert);
        return $lastId;
    }

    public function VerificaModulos($controlador, $acao) {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("m" => $this->_name), array('*'))
                ->where("m.controlador = ?", $controlador)
                ->where("m.acao = ?", $acao);
        if ($result = $this->fetchRow($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function Lista() {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("m" => $this->_name), array('controlador'))
                ->group("m.controlador")
                ->distinct("m.controlador");
        if ($result = $this->fetchAll($sql)) {
            $result = $result->toArray();
            foreach ($result as $key => $controlador) {
                $result[$key]['acoes'] = $this->GetAcoes($controlador['controlador']);
            }
            return $result;
        } else {
            return FALSE;
        }
    }

    public function update(array $data, $where) {
        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);
        parent::update($data_insert, $where);
    }

    public function GetAcoes($controller) {
        $sql = $this->select()
                ->where("controlador = ?", $controller)
                ->order("acao");
        if ($result = $this->fetchAll($sql)) {
            return $result->toArray();
        } else {
            return FALSE;
        }
    }

    public function VerificaPerfil($controller, $action, $perfil) {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("m" => $this->_name))
                ->joinLeft(array("mp" => "menus_perfil_permissoes"), "m.id = mp.menu")
                ->where('m.controlador = ?', $controller)
                ->where('m.acao = ?', $action)
                ->where('mp.perfil = ?', $perfil);
        if ($result = $this->fetchRow($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
