<?php

class TCS_View_Helpers_ConvercaoDate {

    public function ConvercaoDate($elemento, $data, $tipo) {
        $confere = explode(' ', $data);
        if (count($confere) == 2) {
            $data = $confere[0];
            $hora = $confere[1];
        }
        $quebra = explode($elemento, $data);
        if (count($quebra) < 3)
            return NULL;
        // elemento - tra�o ou barra
        // Tipo 1   =   dia/mes
        // Tipo 2   =   Dia / Mes / Ano
        // Tipo 4   =   Mes / Ano
        // Tipo 3   =   Ano - Mes - Dia
        if ($tipo == 1) {
            $dia = $quebra['2'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];
            $mostra = "$dia/$mes";
        }
        if ($tipo == 2) {
            $dia = $quebra['2'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];
            $mostra = "$dia/$mes/$ano";
        }
        if ($tipo == 4) {
            $dia = $quebra['2'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];
            $mostra = "$mes/$ano";
        }
        if ($tipo == 3) {
            $dia = $quebra['0'];
            $mes = $quebra['1'];
            $ano = $quebra['2'];
            $mostra = "$ano-$mes-$dia";
        }
        if ($tipo == 4) {
            $dia = $quebra['2'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];

            $mostra = "$dia/$mes/$ano " . ' - ' . $hora;
        }
        if ($tipo == 5) {
            $quebra2 = explode(' ', $quebra['2']);
            $dia = $quebra2['0'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];
            $mostra = "$dia/$mes/$ano";
        }
        if ($tipo == 6) {
            $quebra2 = explode(' ', $quebra['2']);
            $dia = $quebra2['0'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];
            $mostra = "$dia/$mes/$ano " . '<br>' . $quebra2[1];
        }
        if ($tipo == 7) {
            $quebra2 = explode(' ', $quebra['2']);
            $dia = $quebra2['0'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];
            $mostra = "$dia/$mes/$ano " . substr($hora, 0, 5);
        }
        if ($tipo == 8) {
            $quebra2 = explode(' ', $quebra['2']);
            $dia = $quebra2['0'];
            $mes = $quebra['1'];
            $ano = substr($quebra['0'], 2);
            $mostra = "$dia/$mes - " . substr($hora, 0, 5);
        }


        if ($tipo == 9) {
            $dia = $quebra['2'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];

            $mostra = "$dia-$mes-$ano" . ' ' . $hora;
        }


        if ($tipo == 10) {
            $dia = $quebra['2'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];


            $mostra = "$dia/$mes/$ano" . ' ' . $hora;
        }

        if ($tipo == 11) {
            $dia = $quebra['2'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];


            $mostra = $hora;
        }

        if ($tipo == 12) {
            $dia = $quebra['2'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];


            $mostra = "$dia/$mes" . ' ' . $hora;
        }

        if ($tipo == 'USA') {
            $quebra2 = explode(' ', $quebra['2']);
            $dia = $quebra2['0'];
            $mes = $quebra['1'];
            $ano = $quebra['0'];
            $mostra = "$mes/$dia/$ano";
        }
        return $mostra;
    }

}
