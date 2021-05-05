<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://10.1.1.6/cron/notifica-viagens-semanal");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);

//Envia o cabeçalho do seu browser para o site
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$pagina = curl_exec($ch);


echo $pagina;
