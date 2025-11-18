<?php   
require __DIR__ . '/vendor/autoload.php';

use RicardoCechinel\CnpjAlfanumerico\CnpjAlfa;

$base = "12ABC34501DE"; // 12 caracteres
$dv = CnpjAlfa::gerarDV($base);

echo $dv; // exemplo: "35"
