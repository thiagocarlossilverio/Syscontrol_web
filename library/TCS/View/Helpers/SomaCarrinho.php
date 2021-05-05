<?php

class TCS_View_Helpers_SomaCarrinho {

    public function SomaCarrinho($params) {
        if (is_array($params) && count($params) > 0) {
            $total = 0;
            // Zend_Debug::dump($params);die;
            foreach ($params as $key => $produto) {
               
                if ($produto['desconto'] > 0.00) {
                    
                    //se a data atual estiver entre a data inicio e a data final de promoção se a data estiver cadastrada
                    if ($produto['data_inicio_promocao'] != '0000-00-00' && $produto['data_fim_promocao'] != '0000-00-00') {
                        if (date("Y-m-d") >= $produto['data_inicio_promocao'] && date("Y-m-d") <= $produto['data_fim_promocao']) {

                            if ($produto['pedaco'] > 0) {
                                $desconto = ($produto['preco_venda'] - $produto['desconto']);
                                $valor = ($desconto / $produto['total_fatias']);
                                $total += ($valor * $produto['pedaco']);
                            } else {
                                $valor = ($produto['preco_venda'] - $produto['desconto']);
                                $total += ($valor * $produto['quantidade']);
                            }
                        } else {

                            if ($produto['pedaco'] > 0) {
                                $valor = ($produto['preco_venda'] / $produto['total_fatias']);
                                $total += ($valor * $produto['pedaco']);
                            } else {
                                $valor = $produto['preco_venda'];
                                $total += ($valor * $produto['quantidade']);
                            }
                        }
                    } else {

                        if ($produto['pedaco'] > 0) {
                            $valor = ($produto['preco_venda'] / $produto['total_fatias']);
                            $total += ($valor * $produto['pedaco']);
                        } else {
                            $valor = $produto['preco_venda'];
                            $total += ($valor * $produto['quantidade']);
                        }
                    }
                } else {


                    if ($produto['pedaco'] > 0) {
                        $valor = ($produto['preco_venda'] / $produto['total_fatias']);
                        $total += ($valor * $produto['pedaco']);
                    } else {
                        $valor = $produto['preco_venda'];
                        $total += ($valor * $produto['quantidade']);
                    }
                }
            }

            return $total;
        } else {
            return false;
        }
    }

}
