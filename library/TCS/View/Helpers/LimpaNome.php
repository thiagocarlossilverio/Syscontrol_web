<?php
class TCS_View_Helpers_LimpaNome {
    public function LimpaNome($string = NULL, $tipo = NULL, $qnt_caracteres = 10) {
        //return $string;
        if ($this->codificacao($string) == 'UTF-8')
            $string = utf8_decode($string);
        $CaracteresAceitos = 'abcdxywzABCDZYWZ0123456789';
        $caracteres = array("�", "�", "~", "^", "]", "[", "{", "}", ";", ":", "�", ",", ">", "<", "/", "|", "@", "$", "%", "�", "�", "�", "�", "�", "�", "�", "�", "+", "=", "*", "&", "(", ")", "!", "#", "?", "`", "�", "�", "�", " ", "  ", "-", "�", "�", "�", "�");
        $subistitue = array("c", "c", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "a", "a", "a", "a", "e", "e", "o", "o", "", "", "", "", "", "", "", "", "", "", "a", "", "o", "_", "", "_", "", "", "u", "u");
        if ($tipo == 'limpa') {
            $string = str_replace($caracteres, $subistitue, $string);
            $expReg = preg_replace('/\s[\s]+/', '-', $string);    // Procurando por MULTIPLOS espa�os
            $expReg = preg_replace('/\_[\_]+/', '-', $expReg);    // Procurando por MULTIPLOS underlines
            $expReg = preg_replace('/[\s\W]+/', '-', $expReg);    // Strip off spaces and non-alpha-numeric
            $expReg = preg_replace('/^[\-]+/', '', $expReg);    // Strip off the starting hyphens
            $expReg = preg_replace('/[\-]+$/', '', $expReg);    // Strip off the ending hyphens
            $expReg = strtolower($expReg);
            $novo_nome = str_replace($caracteres, $subistitue, $expReg);
        } else {
            $novo_nome = null;
            $max = strlen($CaracteresAceitos) - 1;
            for ($i = 0; $i < $qnt_caracteres; $i++) {
                $novo_nome .= $CaracteresAceitos{mt_rand(0, $max)};
            }
        }
        return $novo_nome;
    }
   
    function codificacao($string) {
        return mb_detect_encoding($string . 'x', 'UTF-8, ISO-8859-1');
    }
}
