<?php

class Admin_Model_MenusPerfilPermissoes extends Zend_Db_Table {

    protected $_name = 'menus_perfil_permissoes';
    protected $_primary = 'id';

    public function insert(array $data) {

        $info = $this->info();
        $data_insert = array_intersect_key($data, $info['metadata']);
        $lastId = parent::insert($data_insert);
        return $lastId;
    }
    public function VerificaPerfil($menu, $perfil) {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array("p" => $this->_name), array('*'))
                ->where("p.menu = ?", $menu)
                ->where("p.perfil = ?", $perfil);
        if ($result = $this->fetchRow($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
}
