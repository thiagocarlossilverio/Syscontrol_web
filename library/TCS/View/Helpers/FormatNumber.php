<?

class TCS_View_Helpers_FormatNumber {

    public function FormatNumber($valor, $decimais = 2) {

        if (is_numeric($valor) && strlen($valor) > 3) {
            return number_format($valor, $decimais, ',', '.');
        } else {
            return $valor;
        }
    }

}

?>