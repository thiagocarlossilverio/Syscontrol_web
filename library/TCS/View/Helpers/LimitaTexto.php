<?php
class TCS_View_Helpers_LimitaTexto {
    public function LimitaTexto($texto, $limita, $final = true) {
        $conta = strlen($texto);
        if ($conta > $limita) {
            if ($final)
                $mostra = substr($texto, 0, $limita) . '...';
            else
                $mostra = substr($texto, 0, $limita);
        } else {
            $mostra = $texto;
        }
        return $mostra;
    }
}
?>