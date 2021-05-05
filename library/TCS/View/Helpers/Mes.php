<?php

class TCS_View_Helpers_Mes {

    public function Mes($param) {

        switch ($param) {
            case 1:
                $mes = "Jan";
                break;
            case 2:
                $mes = "Fev";
                break;
            case 3:
                $mes = "Mar";
                break;
            case 4:
                $mes = "Abr";
                break;
            case 5:
                $mes = "Mai";
                break;
            case 6:
                $mes = "Jun";
                break;
            case 7:
                $mes = "Jul";
                break;
            case 8:
                $mes = "Ago";
                break;
            case 9:
                $mes = "Set";
                break;
            case 10:
                $mes = "Out";
                break;
            case 11:
                $mes = "Nov";
                break;
            case 12:
                $mes = "Dez";
                break;
        }
        
        return $mes;
    }

}
