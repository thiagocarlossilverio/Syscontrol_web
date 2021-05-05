<?php

class Admin_Model_Erros extends Zend_Db_Table {

    protected $_name = 'erros';
    protected $_primary = 'id';
    public $_view;

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->_view = $viewRenderer->view; // Atribuo os Helper de Visão para  $this->view
    }

    public function GetDados($id) {
        $sql = $this->select()->where("id = ?", $id);
        if ($result = $this->fetchRow($sql)->toArray()) {
            return $result;
        }
    }

    public function insert(array $data) {
        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);
        parent::insert($data_insert);
    }

    public function GetAll() {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("e" => $this->_name))
                ->order('e.data_execucao DESC');
        if ($result = $this->fetchAll($sql)->toArray()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function Lista() {
        $ontem = date('Y-m-d', strtotime(-1 . "days"));
        $hoje = date('Y-m-d');
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("a" => $this->_name))
                ->where("DATE(data_acesso) = ?", $hoje)
                ->orWhere("DATE(data_acesso) = ?", $ontem)
                ->order('a.data_acesso DESC');
        if ($result = $this->fetchAll($sql)->toArray()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function getIPTotal($ip) {

        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('l' => $this->_name), array("total" => "count(l.id)"))
                ->where("l.ip = ?", $ip);

        if ($data = $this->fetchRow($sql)) {
            return $data->total;
        }
    }

    public function Rastrear($ip) {
        $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
        if ($query && $query['status'] == 'success') {
            return json_encode($query);
        }
    }

    public function delete($where) {
        return parent::delete($where);
    }

}
