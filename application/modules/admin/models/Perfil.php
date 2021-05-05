<?php
class Admin_Model_Perfil extends Zend_Db_Table {
    protected $_name = 'perfil';
    protected $_primary = 'id';
 
    public function insert(array $data) {
        if (!is_array($data))
            return false;
        if (is_numeric($data['id'])) {
            $this->update($data, "id = " . $data['id']);
            return $data['id'];
        }
        unset($data['id']);
        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);
        parent::insert($data_insert);
    }
    
     public function GetDados($id) {
        $sql = $this->select()->where("id = " . $id);
        $data = $this->fetchRow($sql)->toArray();
        return $data;
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
         $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        
        $sql = $this->select()->order("id");
        
        if($user->perfil != 3){
            $sql->where("id != ?", 3);
        }
        if ($result = $this->fetchAll($sql)) {
            return $result->toArray();
        } else {
            return FALSE;
        }
    }
}
