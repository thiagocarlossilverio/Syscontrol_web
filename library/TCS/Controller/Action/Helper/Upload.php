<?php

class Zend_Controller_Action_Helper_Upload extends Zend_Controller_Action_Helper_Abstract {

    var $destino;
    var $nomeAleatorio;
    var $prefixo;
    var $imagemY;
    var $imagemX;
    var $renomear;
    public $view = '';

    public function __construct() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
    }

    
    public function Upload($campo, $config = NULL, $files = NULL) {
       
        //$campo->getName(); // � a propriedade do ZEND FORM. Ela retorna o nome do CAMPO (input) que chamou a fun��o UPLOAD
        if (!is_object($campo))
            return false;
        if (empty($_FILES[$campo->getName()]['tmp_name']))
            return false;
        //die('teste');
        if ($config)
            $this->getConfig($config);
        $img = Zend_Controller_Action_HelperBroker::getStaticHelper('ClassUpload');  // Class Upload para trabalhar com Imagens.

        $upload = new Zend_File_Transfer_Adapter_Http();         // Chamo a Zend_File para tratar os arquivos enviados.
        $info = $this->fileInfo($campo); //print_r($info); die(); 
        /*
         * 	Chegou a Hora de manipular e iniciar o UPLOAD
         * 	se preciso redimensionar as imagens enviadas (Proporcionalmente) Por fim, atribuo um nome para imagem e envio para a pasta.
         * 	definida no campo do formul�rio EX: ($arquivo ->setDestination("img/");)
         */
        if ($info['type'] == 'image' && in_array($info['extensao'], $info['extAceitas'])) {
            $img->Upload($info['file']);   // Metodo da Class Upload. Envio o arquivo para o tempor�rio e inicio a manipula��o dele.
            // Se os parametros X e Y foram passados, vou redimensionar as imagens PROPORCIONALMENTE (image_ratio=true)
            
          /*  if (isset($config->img) && $config->img) {
            $img->image_watermark = 'marcadagua/' . $config->img;
            $img->image_watermark_position = $config->posicao;
            }*/
            $img->image_watermark = 'assets\images\logo1.png';
            $img->image_watermark_position = 'bottom, right';
            
            if (is_numeric($this->imagemY) > 0 || is_numeric($this->imagemX) > 0) {
                 $img->image_resize = true;   // Aceitar redimensionamento.
                $img->image_ratio = true;    // Manter a Propor��o
                $img->image_y = $this->imagemY; // Defino um Array no TOPO da Classe, passando Y Maximo da Imagem
                $img->image_x = $this->imagemX; // Defino um Array no TOPO da Classe, passando X Maximo da Imagem
            }
            $img->no_script = false;
            $img->file_new_name_body = $info['novoNome']; // Renomeio a Imagem com o nome Gerado ou Manipulado.
            $img->process($info['destino']);      // Envio a Imagem, para o DESTINO marcado no Filtro do Campo. ($arquivo ->setDestination("img/");)


            $nome_final = $img->file_dst_name;        // Armazeno o nome final do arquivo final. Aqui o $novo_nome j� est� com a extens�o final.
        } else {
            // Adiciono um FILTRO no campo para renomear o Arquivo. E envio para ele o NOVO NOME do arquivo.
            $nome_final = $info['novoNome'] . '.' . $info['extensao'];
            $upload->addFilter('Rename', array('target' => $nome_final, 'overwrite' => true));
            $upload->setDestination($info['destino']);
            ($upload->receive()) ? (print('Arquivo Enviado com Sucesso!')) : (print('Erro ao enviar arquivo.'));
        }
        $info['novoNome'] = $nome_final;
        return $info;
    }

    public function getConfig($config) {
        foreach ($config as $key => $var):
            $this->$key = $var;
        endforeach;
    }

    public function fileInfo($campo) {
        if (!$this->destino)
            $this->destino = $campo->getDestination();
        $arquivo = $_FILES[$campo->getName()];


        $info = getimagesize($arquivo['tmp_name']);
        $info = $info['mime'];
        $tipo = explode('/', $info);   // Defino o tipo de arquivo com o Qual estou trabalhando.
        $infoFile = explode('.', $arquivo['name']); // Pego apenas o NOME do arquivo para TRATAR posteriormente.
        $nomeOriginal = $infoFile[0];
        $extensao = strtolower($infoFile[count($infoFile) - 1]);

        $extAceitas = array('gif', 'bmp', 'png', 'jpg', 'jpeg', 'jpe');
        $novo_nome = $this->nomeArquivo($nomeOriginal);
        return array('campo' => $arquivo, 'file' => $arquivo, 'type' => $tipo[0], 'extAceitas' => $extAceitas, 'extensao' => $extensao, 'nome' => $nomeOriginal, 'destino' => $this->destino, 'nomeOriginal' => $nomeOriginal, 'novoNome' => $novo_nome);
    }

    public function nomeArquivo($nomeOriginal) {
        // Limpa nome � uma Fun��o Auxiliar da View (Helper View). Se n�o passar nenhum parametro, ele gera aleat�rio. Caso contr�rio ele limpa caracteres inv�lidos do nome.
        if ($this->renomear)
            return $novo_nome = $this->view->LimpaNome($this->prefixo . $this->renomear, 'limpa');
        if ($this->nomeAleatorio)
            $novo_nome = $this->view->LimpaNome();
        else
            $novo_nome = $this->view->LimpaNome($this->prefixo . $nomeOriginal, 'limpa');
        return strtolower($novo_nome);
    }

}
