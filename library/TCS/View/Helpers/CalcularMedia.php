<?

class TCS_View_Helpers_CalcularMedia {

    public function CalcularMedia($veiculo, $data_inicio, $data_fim) {
        $ModelAbastecimento = new Admin_Model_Abastecimentos();

        $result = $ModelAbastecimento->GetMedia($veiculo, $data_inicio, $data_fim);

        return $result;
    }

}

?>