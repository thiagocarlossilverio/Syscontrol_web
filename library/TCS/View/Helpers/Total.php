<?php
class TCS_View_Helpers_Total {
    public function Total($params, $campo) {
        if (is_array($params) && count($params) > 0) {
            $total = 0;
            foreach ($params as $key => $row) {
               $total += $row[$campo];
                
            }
            
            return $total;
        } else {
            return false;
        }
    }
}
