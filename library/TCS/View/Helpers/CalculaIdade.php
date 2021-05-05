<?php
class TCS_View_Helpers_CalculaIdade {
    public function CalculaIdade($elemento, $data) {
        if ($elemento == '-') {
            $quebra = explode($elemento, $data);
            if (count($quebra) < 3)
                return NULL;
            $data_nasc = $quebra['2'] . '/' . $quebra['1'] . '/' . $quebra['0'];
        }
        $data_nasc = explode("/", $data_nasc);
        $data = date("d/m/Y");
        $data = explode("/", $data);
        $anos = $data[2] - $data_nasc[2];
        if ($data_nasc[1] > $data[1])
            return $anos - 1;
        if ($data_nasc[1] == $data[1]) {
            if ($data_nasc[0] <= $data[0]) {
                return $anos;
              
            } else {
                return $anos - 1;
                
            }
        }
        if ($data_nasc[1] < $data[1])
            return $anos;
    }
}
