<?

class  TCS_View_Helpers_Real {

    public function Real($valor, $decimais = 2) {

        if (is_numeric($valor))
            return number_format($valor, $decimais, ',', '.');
        else
            return $valor;
    }

}

?>