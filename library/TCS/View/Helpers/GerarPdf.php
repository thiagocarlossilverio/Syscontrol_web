<?php

class TCS_View_Helpers_GerarPdf extends Zend_Controller_Action_Helper_Abstract {

    /**
     * Plugin para conversÃ£o dos caracteres especiais para link
     *
     * @param string $SEO_text Texto para converter
     * @return string
     */
    public function GerarPdf($html, $dirPDF, $namePdf, $css = '') {
        require_once "library/TCS/MPDF/mpdf.php";

        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $_view = $viewRenderer->view;

        // Verifica se tem parametro
        if (empty($html)) {
            return;
        }
        $file = $dirPDF . '/' . $namePdf . '.pdf';
        /* ---------------------------------------------------
          cria um novo container PDF no formato A4 com orientação customizada
         */
        $mpdf = new mPDF('pt', 'A4', 12, '', 8, 8, 5, 14, 9, 9, 'P');
        /* ----------------------------------------------------
         * muda o charset para aceitar caracteres acentuados iso 8859-1
         * utilizados por mim no banco de dados e na geracao do conteudo
         * PHP com HTML
          --------------------------------------------------------- */
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        /* -----------------------------------------------------
         * Algumas configurações do PDF
         */
        $mpdf->SetDisplayMode('fullpage');
        /* ----------------------------------------------------
         *  modo de visualização
         */
        $mpdf->SetFooter('{DATE j/m/Y - H:i}|{PAGENO}/{nb}|SysControl');
        /* ---------------------------------------------
         *  carrega uma folha de estilo'./stylesheets/estilosPDF.css'
         */
        // $stylesheet = file_get_contents($css);
        /* -----------------------------------------------
         *  incorpora a folha de estilo ao PDF O parâmetro 1
         * diz que este é um css/style e deverá ser interpretado
         *  como tal
         */
        // $mpdf->WriteHTML($stylesheet, 1);
        /* ---------------------------------------------
         *  incorpora o corpo ao PDF na posição 2 e deverá
         * ser interpretado como footage. Todo footage é
         * posicao 2 ou 0(padrão).
         */
        $mpdf->WriteHTML($html, 2);
        /* ---------------------------------------------
         *  Exibe o pdf:
         * 1º parâmetro: Nome do arquivo pdf. O nome que você quer dar ao pdf gerado.
         * 2º parâmetro: Tipo de saída:
          I: Abre o pdf gerado no navegador.
          D: Abre a janela para você realizar o download do pdf.
          F: Salva o pdf em alguma pasta do servidor. */
        /* ----------------------------------------------
         * gera o pdf
         */
        //$mpdf->charset_in='windows-1252';
//        $mpdf->allow_charset_conversion = true;
//        $mpdf->charset_in = 'UTF-8';

        $pdf = $mpdf->Output($file, 'D');

        if (isset($pdf)) {
            // Retorna o texto
            return $pdf;
        } else {
            return FALSE;
        }
    }

}
