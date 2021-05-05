<?php

class Admin_Model_Logs extends Zend_Db_Table {

    protected $_name = 'logs';
    protected $_primary = 'id';
    public $_view;

    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->_view = $viewRenderer->view;
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

    public function Lista() {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("l" => $this->_name))
                ->joinLeft(array("u" => "usuarios"), "l.user = u.id", array("user" => "u.nome"))
                ->order('l.data DESC');
        if ($result = $this->fetchAll($sql)->toArray()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function delete($where) {
        return parent::delete($where);
    }

}
