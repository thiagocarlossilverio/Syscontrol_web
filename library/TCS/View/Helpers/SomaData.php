<?php
class TCS_View_Helpers_SomaData {
    public function SomaData($data_ini, $soma, $periodo) {
        /*
         * $data_ini	= � a data cujo a Fun�ao vai somar
         * $soma		= � a quantidade que vai ser somada (Depende do Periodo para somar dia, mes ou ano)
         * $periodo	= Serve para informar o que vai ser somado (dia, mes, ano) se Periodo for = soma ele pega
         * a variavel $data_inicial (� passado aqui a data inicial e a final uninco com -) e ve quantos dias de
         * diferen�a entre o Per�odo.
         *
         * Ex1: SomaData('2010-01-01'.'-'.'2010-01-05', '', 'soma');  ->  Retorna a diferen�a entre as datas (4 dias)
         * Ex2: SomaData('2010-01-01', 1, 'mes') 	-> Retorna a data somado 1 Mese	(2010-02-01)
         * Ex3: SomaData('2010-01-01', 2, 'dias') 	-> Retorna a data somado 2 dias	(2010-01-03)
         * Ex4: SomaData('2010-01-01', 3, 'anos') 	-> Retorna a data somado 3 anos	(2013-01-01)
         */
        $data = explode('-', $data_ini);
        $dia = $data[2];
        $mes = $data[1];
        $ano = $data[0];
        if ($periodo == 'dia') {
            $data2 = date("Y-m-d", mktime(0, 0, 0, $mes, $dia + $soma, $ano));
            return $data2;
        }
        if ($periodo == 'mes') {
            $data2 = date("Y-m-d", mktime(0, 0, 0, $mes + $soma, $dia, $ano));
            return $data2;
        }
        if ($periodo == 'ano') {
            $data2 = date("Y-m-d", mktime(0, 0, 0, $mes, $dia, $ano + $soma));
            return $data2;
        }
        if ($periodo == 'soma') {
            // Explodo e Separo Data inicial e Data Final a ser subtraido
            $data = explode('-', $data_ini);
            $dia1 = $data[2];
            $dia2 = $data[5];
            $mes1 = $data[1];
            $mes2 = $data[4];
            $ano1 = $data[0];
            $ano2 = $data[3];
            // Transformo em timestamp UNIX
            $data_inicial = mktime(0, 0, 0, $mes1, $dia1, $ano1);
            $data_final = mktime(0, 0, 0, $mes2, $dia2, $ano2);
            $dias = ($data_final - $data_inicial) / 86400;
            // Pega a parte inteira da variavel $dias
            return floor($dias);
        }
        if ($periodo == 'idade') {
            // Explodo e Separo Data inicial e Data Final a ser subtraido
            $data = explode('-', $data_ini);
            $dia1 = $data[2];
            $dia2 = $data[5];
            $mes1 = $data[1];
            $mes2 = $data[4];
            $ano1 = $data[0];
            $ano2 = $data[3];
            // Transformo em timestamp UNIX
            $data_inicial = mktime(0, 0, 0, $mes1, $dia1, $ano1);
            $data_final = mktime(0, 0, 0, $mes2, $dia2, $ano2);
            $dias = ($data_final - $data_inicial) / 86400;
            // Pega a parte inteira da variavel $dias
            return floor($dias / 365);
        }
    }
    /* 	public function SomaData($data, $dias, $periodo)
      {
      if($periodo == 'mes'){
      $data_e		= explode("-",$data);
      $data_final	=
      }
      $data_e 	= explode("/",$data);
      $data2 		= date("m/d/Y", mktime(0,0,0,$data_e[1],$data_e[0] + $dias,$data_e[2]));
      $data2_e 	= explode("/",$data2);
      $data_final = $data2_e[2] . "-". $data2_e[0] . "-" . $data2_e[1];
      return $data_final;
      } */
}
?>