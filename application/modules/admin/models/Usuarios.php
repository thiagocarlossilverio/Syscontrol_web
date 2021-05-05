<?php

class Admin_Model_Usuarios extends Zend_Db_Table {

    protected $_name = 'usuarios';
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

        if (!empty($data['senha'])) {
            $data['senha'] = md5($data['senha']);
        }
        $data_insert = array_intersect_key($data, $info['metadata']);
        return parent::insert($data_insert);
    }

    public function Dados() {
        $sql = $this->select();
        if ($result = $this->fetchRow($sql)) {
            return $result;
        }
    }

    public function getUsers() {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => $this->_name), array("nome_user" => "u.nome", "user_email" => "u.email"));

        if ($data = $this->fetchAll($sql)) {
            return $data->toArray();
        } else {
            return FALSE;
        }
    }

    public function GetDados($id) {
        $sql = $this->select()->where("id = ?", $id);
        if ($result = $this->fetchRow($sql)) {
            $result['senha'] = '';
            return $result->toArray();
        }
    }

    public function BuscarUser($login) {

        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => $this->_name), array("*"))
                ->where("u.login = ?", $login);

        if ($busca = $this->fetchRow($sql)) {
            return $busca;
        } else {
            return false;
        }
    }

    public function BuscarEmail($email) {

        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => $this->_name), array("*"))
                ->where("u.email = ?", $email);

        if ($busca = $this->fetchRow($sql)) {
            return $busca;
        } else {
            return false;
        }
    }

    public function GetUsuarios() {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => $this->_name), array('nome', 'email', 'perfil'))
                ->where("u.status = ?", 1);
        if ($lista = $this->fetchAll($sql)) {
            return $lista->toArray();
        } else {
            return false;
        }
    }

    public function UsrNotificar() {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => $this->_name), array('id', 'nome', 'email', 'perfil'))
                ->where("u.notificacao = ?", 1)
                ->where("u.status = ?", 1);


        if ($lista = $this->fetchAll($sql)) {
            return $lista->toArray();
        } else {
            return false;
        }
    }

    public function getPerfil($id) {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => $this->_name), array("*"))
                ->joinLeft(array("p" => "perfil"), "p.id = u.perfil", array("perfil" => "p.nome"))
                ->where("u.id = ?", $id);
        if ($result = $this->fetchRow($sql)) {
            $result['senha'] = '';
            return $result->toArray();
        }
    }

    public function update(array $data, $where) {
        $info = $this->info();
        if (empty($data['senha'])) {
            unset($data['senha']);
        } else {
            $data['senha'] = md5($data['senha']);
        }
        if (empty($data['imagem'])) {
            unset($data['imagem']);
        }
        $data_insert = array_intersect_key($data, $info['metadata']);
        parent::update($data_insert, $where);
    }

    public function Lista($perfil = FALSE) {
        $sql = $this->select()
                ->order("ultimo_acesso DESC");
        if ($perfil != '3') {
            $sql->where("perfil !=?", 3);
        }

        if ($result = $this->fetchAll($sql)) {
            return $result->toArray();
        } else {
            return false;
        }
    }

    public function BuscarUsuarios($param = false) {

        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => $this->_name), array("id", "text" => "nome"))
                ->where('u.status = ?', 1);

        if ($param) {
            $sql->where('u.nome LIKE ?', '%' . $param . '%');
        }

        $sql->order('u.nome ASC');

        if ($data = $this->fetchAll($sql)) {
            return $data->toArray();
        } else {
            return FALSE;
        }
    }

    public function Verificaemail($email) {
        $sql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => 'usuarios'), array("*"))
                ->where('u.email = ?', $email);
        if ($result = $this->fetchRow($sql)) {
            return $result;
        } else {
            return false;
        }
    }

}
