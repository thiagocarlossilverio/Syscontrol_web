<?

class TCS_View_Helpers_RemoverAcentos {

    public function RemoverAcentos($str) {

        $from = "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ";
        $to = "aaaaeeiooouucAAAAEEIOOOUUC";

        $keys = array();
        $values = array();

        preg_match_all('/./u', $from, $keys);
        preg_match_all('/./u', $to, $values);

        foreach ($keys[0] as $key => $row)
            $keys[0][$key] = utf8_decode($row);

        $mapping = array_combine($keys[0], $values[0]);

        return strtr($str, $mapping);
    }

}

?>