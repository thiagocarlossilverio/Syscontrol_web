<?php
class TCS_View_Helpers_LerPeso {
    public function LerPeso() {
        set_time_limit(1);
        $fp = fsockopen("10.1.1.2", 23);
        if (!$fp) {
            echo "$errstr ($errno)<br />\n";
        } else {
            fwrite($fp, "You message");
        while (!feof($fp)) {
            $result = fgets($fp, 1);
        }
            fclose($fp);
        }
        return $result;
    }
}
