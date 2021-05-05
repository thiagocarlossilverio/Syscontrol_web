<?php
class TCS_View_Helpers_Thumb {
    public function Thumb($crop = NULL, $width = NULL, $height = NULL, $type = NULL, $file = NULL) {
        require_once("TCS/Includes/canvas.php");
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $_view = $viewRenderer->view;
        // Monta o caminho do arquivo
        $file = ROOT_DIR . "/public_html/imagens/" . $type . "/" . $file;
        // $file = $_view->BaseUrl("imagens/" . $type . "/" . $file);
        // Cria o objeto canvas
        $canvas = new canvas($file);
        // Verifica se foi passada somente a largura
        if (($width != "") && ($height == "")) {
            $canvas->redimensiona($width);
        }
        // Verifica se foi passada somente a altura
        elseif ($width == "" && $height != "") {
            $canvas->redimensiona('', $height);
        }
        // Verifica se foram passadas as duas dimensoes
        elseif ($width != "" && $height != "") {
            if ($crop == 0) {
                $canvas->redimensiona($width, $height);
            } elseif ($crop == 1) {
                $canvas->redimensiona($width, $height, "crop");
            } elseif ($crop == 2) {
                $canvas->hexa("FFFFFF");
                $canvas->redimensiona($width, $height, "preenchimento");
            }
        } else {
            die('error');
            $canvas->redimensiona($thumbs->largura, $thumbs->altura, "preenchimento");
        }
        // Mostra a imagem
        $canvas->grava("", 75);
    }
}
