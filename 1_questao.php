<?php

# Rotaciona um array em n vezes em sentido

$dados = array(1, 2, 3, 4, 5, 6);
$posicoes = 2;

var_dump(rotacionar($dados, $posicoes));

function rotacionar($dados, $posicoes = null)
{
    $tamanho = count($dados);

    for ($i = 0; $i < $posicoes; $i++) {
        $dados[$tamanho + $i] = $dados[$i];
        unset($dados[$i]);
    }

    return $dados;
}