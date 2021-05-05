<?php

class Admin_Model_MenusVisualizacao extends Zend_Db_Table {

    protected $_name = 'menus_visualizacao';
    protected $_primary = 'id';

    public function insert(array $data) {
        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);
        parent::insert($data_insert);
    }

    public function Dados() {
        $sql = $this->select();
        if ($result = $this->fetchRow($sql)) {
            return $result;
        }
    }

    public function update(array $data, $where) {
        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);
        parent::update($data_insert, $where);
    }

    public function Lista() {
        $sql = $this->select()->order("perfil");
        $result = $this->fetchAll($sql);
        return $result;
    }

    public function GetMenu($perfil) {
        $Model = new Admin_Model_Menus();
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("mv" => $this->_name), array("menu", "perfil"))
                ->joinLeft(array("m" => "menus"), "m.id = mv.menu", array("*"))
                ->where('m.pai IS NULL')
                ->where("m.status = ?", 1)
                ->where("mv.perfil = ?", $perfil)
                ->group("mv.menu")
                ->order('m.ordem');


        if ($result = $this->fetchAll($sql)) {
            $result = $result->toArray();
            foreach ($result as $key => $dado) {
                $result[$key]['filho'] = $Model->listarFilho($dado['id'], $dado['perfil']);
            }

            return $result;
        }else{
            return FALSE;
        }
    }

    public function GetALL($perfil) {
        $model = new Admin_Model_Menus();
        $sql = $this->select()->where("perfil = ?", $perfil);
        if ($result = $this->fetchAll($sql)->toArray()) {
            foreach ($result as $key => $row) {
                $result[$key]['params'] = $model->GetDados($row['menu']);
            }
            return $result;
        } else {
            return FALSE;
        }
    }

    public function GetId($id) {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("mp" => $this->_name))
                ->joinLeft(array("p" => "perfil"), "mp.perfil = p.id", array("p.nome"))
                ->where('mp.menu = ?', $id);
        if ($result = $this->fetchAll($sql)->toArray()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function Populate($id) {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("mp" => $this->_name))
                ->joinLeft(array("p" => "perfil"), "mp.perfil = p.id", array("p.nome"))
                ->where('mp.menu = ?', $id);
        $arr = $this->fetchAll($sql)->toArray();
        $data = array();
        foreach ($arr as $value) {
            $data[$value['perfil']] = $value['perfil'];
        }
        return $data;
    }

}
