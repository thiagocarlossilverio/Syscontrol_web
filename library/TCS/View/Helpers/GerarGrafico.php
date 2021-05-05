<?php

class TCS_View_Helpers_GerarGrafico extends Zend_Controller_Action_Helper_Abstract {

    public function GerarGrafico($titulo = false, $tipo_grafico = false, $tituloY = false, $tituloX = false, $dados = false) {
        require_once "library/TCS/phplot/phplot.php";

        // Instanciar o gráfico com tamanho pré-definido
        // Deixar em branco faz com que o gráfico encaixe na janela
        $grafico = new PHPlot(1050, 525);

        // Definindo o formato final da imagem
        $grafico->SetFileFormat("png");

        // Definindo o título do gráfico
        $grafico->SetTitle($titulo);

        // Tipo do gráfico
        // Por ser: lines, bars, boxes, bubbles, candelesticks, candelesticks2, linepoints, ohlc, pie, points, squared, stackedarea, stackedbars, thinbarline
        $grafico->SetPlotType($tipo_grafico);

        // Título dos dados no eixo Y
        $grafico->SetYTitle($tituloY);

        // Título dos dados no eixo X
        $grafico->SetXTitle($tituloX);



        $grafico->SetDataValues($dados);

        //Exibimos o gráfico
        $grafico->DrawGraph();
    }

}
