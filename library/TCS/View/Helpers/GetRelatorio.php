<?php

class TCS_View_Helpers_GetRelatorio {

    public function GetRelatorio($param) {
        $ModelViagens = new Admin_Model_Viagens();
        $result = $ModelViagens->GetRelatorioSemanal($param);
        return $result;
    }

}
