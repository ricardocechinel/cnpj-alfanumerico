<?php   
require __DIR__ . '/vendor/autoload.php';

use RicardoCechinel\CnpjAlfanumerico\CnpjAlfa;

$cnpj = "12ABC34501DE35";

if (CnpjAlfa::validar($cnpj)) {
    echo "Válido!";
} else {
    echo "Inválido!";
}
