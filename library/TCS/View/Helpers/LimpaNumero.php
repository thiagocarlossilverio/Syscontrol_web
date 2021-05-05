<?php

class TCS_View_Helpers_LimpaNumero {

    public function LimpaNumero($NUM) {
        // exemplo limpanumero(1.200,00);
        // Retiro o ponto
        $LIMP = explode('.', $NUM);
        $count = count($LIMP);
        $TEXT = '';
        for ($i = 0; $i < $count; $i++) {
            if ($TEXT == "") {
                $TEXT = $LIMP[$i];
            } else {
                $TEXT = $TEXT . $LIMP[$i];
            }
        }
        //  Retiro a virgula e substituo as vari�veis
        $NUM = $TEXT;
        $LIMP = explode(',', $NUM);
        $count = count($LIMP);
        $TEXT = '';
        for ($i = 0; $i < $count; $i++) { // fa�o o for para juntar a array
            if ($TEXT == "") {
                $TEXT = $LIMP[$i];
            } else {
                $TEXT = $TEXT . '.' . $LIMP[$i];
            }
        }
        return $TEXT;
    }

}

?>