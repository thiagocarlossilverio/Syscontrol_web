<?php

class TCS_View_Helpers_Porcentagem {

    function Porcentagem($parcial, $porcentagem) {
        return ( $parcial / $porcentagem ) * 100;
    }

}
