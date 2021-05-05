<?php
class TCS_View_Helpers_LerCsv {
    public function LerCsv($filename) {
        $file_handle = NULL;
        $data = NULL;
        $keys = NULL;
        $record = NULL;
        if (file_exists($filename)) {
            $file_handle = fopen($filename, "r");
        } else {
            throw new Exception("File not found: " . $filename, null);
        }
        while (!feof($file_handle)) {
            $row = fgetcsv($file_handle, 1024);
            //verifica se é array
            if (is_array($row)) {
                //set record array keys from csv header
                if ($keys == NULL) {
                    $keys = array_flip($row);
                }
                //set record array values from csv row
                elseif ($keys != NULL) {
                    foreach ($keys as $key => $value) {
                        $record[] = $row[$value];
                    }
                }
            }
        }
        if ($file_handle)
            fclose($file_handle);
        return $record;
    }
}
?>