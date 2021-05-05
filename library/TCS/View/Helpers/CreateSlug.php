<?php
class TCS_View_Helpers_CreateSlug extends Zend_Controller_Action_Helper_Abstract {
    /**
     * Plugin para conversÃ£o dos caracteres especiais para link
     *
     * @param string $SEO_text Texto para converter
     * @return string
     */
    public function createslug($SEO_text) {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $_view = $viewRenderer->view;
        // Verifica se tem texto
        if (empty($SEO_text)) {
            return;
        }
        // Remove os espaÃ§os das bordas
        $SEO_text = rtrim(ltrim($SEO_text));
        // Decodifica o html entities
        $SEO_text = html_entity_decode($SEO_text, ENT_QUOTES, 'UTF-8');
        // Diminui o tamanho da letra
        $SEO_text = mb_strtolower($SEO_text, "UTF-8");
        // Troca os caracteres especiais
        $trans = array(
            'Ã§' => "c",
            'Ã¡' => "a",
            'Ã¢' => "a",
            'Ã ' => "a",
            'Ã£' => "a",
            'Ã©' => "e",
            'Ãª' => "e",
            'Ã¨' => "e",
            'áº½' => "e",
            'Ã­' => "i",
            'Ã®' => "i",
            'Ã¬' => "i",
            'Ä©' => "i",
            'Ã³' => "o",
            'Ã´' => "o",
            'Ã²' => "o",
            'Ãµ' => "o",
            'Ãº' => "u",
            'Ã»' => "u",
            'Ã¹' => "u",
            'Å©' => "u"
        );
        $SEO_text = strtr($SEO_text, $trans);
        // Trocar o que nÃ£o Ã© especial
        $SEO_text = preg_replace("@[^a-zA-Z0-9\_]@", "-", $SEO_text);
        // Troca varios espacos por 1 sÃ³
        $SEO_text = preg_replace("/__+/", "-", $SEO_text);
        // Troca varios espacos por 1 sÃ³
        $SEO_text = str_replace("--", "-", str_replace("--", "-", str_replace("--", "-", $SEO_text)));
        $SEO_text = rtrim($SEO_text, "-");
        $SEO_text = ltrim($SEO_text, "-");
        // Retorna o texto
        return $SEO_text;
    }
}
