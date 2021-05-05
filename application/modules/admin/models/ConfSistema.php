<?php
class Admin_Model_ConfSistema extends Zend_Db_Table {
    protected $_name = 'conf_sistema';
    protected $_primary = 'id';
    public $_view;
    public function init() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->_view = $viewRenderer->view; 

    }
    public function GetDados($user) {
        $sql = $this->select()->where("user = ?", $user);
        if ($result = $this->fetchRow($sql)) {
            return $result->toArray();
        }
    }
    public function insert(array $data) {
        $result = $this->GetDados($data['user']);

         if (!empty($result['user'])) {
            $this->update($data, "user = " . $data['user']);
            return $data['id'];
          }

        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);

       return parent::insert($data_insert);

    }
   public function update(array $data, $where) {
        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);
        parent::update($data_insert, $where);
        
    }
    public function delete($where) {
        return parent::delete($where);
    }
}
