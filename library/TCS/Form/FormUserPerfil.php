<?php
class TCS_Form_FormUserPerfil extends Zend_Form {
    public $imagem = array('y' => '800', 'x' => '800', 'dir' => 'imagens/usuarios/');
    public $view = NULL;    
    public function init() {
        
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
        $this->setAction('');
        $this->setMethod('post');
        $this->setAttribs(array('id' => 'FormUsuarios', 'nome' => 'FormUsuarios', 'enctype' => 'multipart/form-data'));
        $id = $this->createElement('hidden', 'id', array('id' => 'id'));
        $id->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($id);
        
        $elemento = $this->createElement('text', 'nome', array('label' => 'Nome completo', 'id' => 'nome', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $elemento ->setAttrib('disabled', 'disabled');
        $this->addElement($elemento);
        
        $elemento = $this->createElement('text', 'login', array('label' => 'Login *', 'id' => 'login', 'class' => 'form-control'));
        $where = array('table' => 'usuarios',
            'field' => 'login',
            'messages' => "O login '%value%' já existe na base de dados."
        );
        // CONDIÃ‡ÃƒO USADA AO EDITAR O REGISTRO
        if (isset($_POST['id']) and $_POST['id'] != '')
            $where[] = 'id != ' . $_POST['id'];
        $elemento->addValidator('Db_NoRecordExists', true, $where)
                ->setAttrib('required', 'required')
                 ->setAttrib('disabled', 'disabled')
                ->setRequired(true)
                ->addDecorator('Description', array('tag' => 'span', 'class' => 'btn', 'id' => 'botGerarCod', 'escape' => false));
        $this->addElement($elemento);
        
        $elemento = $this->createElement('password', 'senha', array('label' => 'Senha', 'id' => 'senha', 'class' => 'form-control'));
        $elemento->setRequired(true);
        $this->addElement($elemento);
        
        $elemento = $this->createElement('text', 'cpf', array('label' => 'CPF', 'id' => 'cpf', 'class' => 'form-control'));
        $where = array('table' => 'usuarios',
            'field' => 'cpf',
            'messages' => "O CPF '%value%' já existe na base de dados."
        );
        // CONDIÃ‡ÃƒO USADA AO EDITAR O REGISTRO
        if (isset($_POST['id']) and $_POST['id'] != '')
            $where[] = 'id != ' . $_POST['id'];
        
        if (isset($_POST['cpf']) and $_POST['cpf'] != ''){
        $elemento->addValidator(new TCS_validator_Cpf());
        $elemento->addValidator('Db_NoRecordExists', true, $where)
                ->addDecorator('Description', array('tag' => 'span', 'class' => 'btn', 'id' => 'botGerarCod', 'escape' => false));
        }
        $elemento->setRequired(true);
        $elemento->setAttrib('required', 'required');
        $this->addElement($elemento);
              
        // email .........................................................................
        $elemento = $this->createElement('text', 'email', array('label' => 'Email *', 'id' => 'email', 'class' => 'form-control'));
        $where = array('table' => 'usuarios',
            'field' => 'email',
            'messages' => "O E-mail '%value%' já existe na base de dados."
        );
        // CONDIÃ‡ÃƒO USADA AO EDITAR O REGISTRO
        if (isset($_POST['id']) and $_POST['id'] != '')
            $where[] = 'id != ' . $_POST['id'];
        
        $elemento->addValidator('Db_NoRecordExists', true, $where)
                ->setAttrib('required', 'required')
                ->setRequired(true)
                ->addValidator('emailAddress')
                ->addValidator('stringLength')
                ->addDecorator('Description', array('tag' => 'span', 'class' => 'btn', 'id' => 'botGerarCod', 'escape' => false));
        $this->addElement($elemento);
        
        /*whattsapp*/
        $elemento = $this->createElement('text', 'celular', array('label' => 'Celular', 'id' => 'celular', 'class' => 'form-control'))
        ->addDecorator('Description', array('tag' => 'span', 'class' => 'btn', 'id' => 'botGerarCod', 'escape' => false));
        //->setDescription('Insira os apenas numeros com o (DD)</span> <i class="infoTip" title="Insira apenas numeros com o (DD)"></i>');
        $this->addElement($elemento);
        
        // Imagens ....................................................................................
        $elemento = $this->createElement('file', 'imagem', array('label' => 'Foto', 'id' => 'imagem', 'class' => 'Upload '));
        try {
            $elemento->setDestination($this->imagem['dir']);
        } catch (Exception $e) {
            mkdir($this->imagem['dir']);
            $elemento->setDestination($this->imagem['dir']);
        }
        if ($_POST)
            $this->Upload($elemento);
        $this->addElement($elemento);
       
        $elemento = $this->createElement('submit', 'Salvar',array('class' => 'btn btn-success'));
        $elemento->removeDecorator('HtmlTag')->removeDecorator('Label');
        $this->addElement($elemento);
        $this->addDisplayGroup(array('id', 'nome', 'cpf', 'login', 'senha', 'email', 'celular', 'imagem', 'Salvar'), 'usuarios', array('removeDecorator' => 'Label'));
        $this->setDisplayGroupDecorators(array('FormElements', 'Fieldset'));
    }
    public function Upload($campo = NULL) {
        $config = array('nomeAleatorio' => true);
        $arquivo = Zend_Controller_Action_HelperBroker::getStaticHelper('Upload')->Upload($campo, $config);
        $_POST['imagem'] = $arquivo['novoNome'];
    }
}
