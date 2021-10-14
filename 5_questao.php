<?php

# Busca uma string dentro de outra string

$encontrado = buscarTexto("Lucas Fernandes", "LUCAS");
var_dump($encontrado);

function buscarTexto($texto, $subtexto)
{

    $texto = str_split(strtoupper($texto));
    $subtexto = str_split(strtoupper($subtexto));
    $i = 0;
    $tamanho = count($subtexto);

    foreach ($texto as $letra) {
        if ($letra == $subtexto[$i]) {
            $i++;
        } else {
            $i = 0; // Caso as letras não estejam em sequência
        }
        if ($i == $tamanho) {
            return true;
        }
    }
    return false;
}