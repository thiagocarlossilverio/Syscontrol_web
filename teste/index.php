<?php
/*
$vogais = array('a','e','i','o','u');
$consoantes = array('b','c','d','f','g','h','nh','lh','ch','j','k','l','m','n','p','qu','r','rr','s','ss','t','v','w','x','y','z',);
 
$palavra = '';
$tamanho_palavra = rand(2,5);
$contar_silabas = 0;
while($contar_silabas < $tamanho_palavra){
   $vogal = $vogais[rand(0,count($vogais)-1)];
   $consoante = $consoantes[rand(0,count($consoantes)-1)];
   $silaba = $consoante.$vogal;
   $palavra .=$silaba;
   $contar_silabas++;
   unset($vogal,$consoante,$silaba);
}
echo "<h3>A palavra aleatória gerado foi: $palavra</h3>";*/

function tirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}


$nomes = array(
	'Daniel', 
	'Carlos',
	'Francisco',
	'Ananias', 
	'Damião', 
	'Marciano Cicero',
	'Jose', 
	'Mariovaldo', 
	'Roberto',
	'fernando', 
	'federico', 
	'jessica', 
	'alexandre', 
	'roberto', 
	'cristifer', 
	'osmair', 
	'reinaldo', 
	'tatiane', 
	'everson', 
	'adriano', 
	'creuza', 
	'alison', 
	'cleunice', 
	'jorge', 
	'barbabe', 
	'claudinei', 
	'odeir', '
	vagner', 
	'fernando', 
	'jeferson',
	'Thiago',
	'Rogerio'
	);

	$sobrenomes = array('
		Tibutino de Souza Lima', 
		'Melo Rêgo', 
		'Vasconcelos', 
		'do Caixão', 
		'Cornélio da Silva',
		'Sauro',
		'Salem', 
		'Doidin de Mamain', 
		'Silvério', 
		'Pedrozo',
		'Moraes', 
		'Neto', 
		'pereira',
		'abrão',
		'marão',
		'tibão',
		'medeiros',
		'Raimundo', 
		'Moraes Neto',
		'barão',
		'tufani',
		'Flores',
		'Pedra',
		'Arcandido', 
		'Ferreira', 
		'Souza', 
		'Maril', 
		'Maldonado'
		);

	$emails = array(
		'gmail.com.br',
		'gmail.com',
		'yahoo.com.br',
		'yahoo.com',
		'uol.com',
		'uol.com.br',
		'bol.com.br',
		'bol.com',
		'terra.com.br',
		'terra.com',
		'live.com',
		'live.com.br',
		'hotmail.com',
		'hotmail.com.br',
		'outlook.com',
		'outlook.com.br',
		'sercontel.com.br',
		'schoeler.com.br');
	
	$randNome = rand(0,count($nomes));
	$randSobre = rand(0,count($sobrenomes));
	$randEmail = rand(0,count($emails));
	
	$nome = $nomes[$randNome];
	$email = $emails[$randEmail];
	$sobrenome = $sobrenomes[$randSobre];

	$completo = ucfirst($nome)." ".ucfirst($sobrenome);
	$nome = tirarAcentos($nome);

	
$post = [
    'nome' => $completo,
    'email' => strtolower($nome).'@'.$email,
    'voto1'=>'Diego Schoeler',
    'voto9'=>'Auri Schoeler',
    'voto10'=>'Schoeler Suínos'
];

print_r($post);

$ch = curl_init('http://porkexpo.com.br/submit/contato/envia_voto.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

unset($vogais,$consoantes,$palavra,$tamanho_palavra,$contar_silabas);

// do anything you want with your response
var_dump($response);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="pb">
<head>
<meta http-equiv="refresh" content="30">

</head>

<body>

      
</body>
</html>
