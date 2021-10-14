<?php

# Reordena um array em números pares de forma crescente e depois números ímpares de forma decrescente

$dados = array(8, 5, 1, 3, 2, 8, 6, 9);
var_dump(reordenar($dados));

function reordenar($dados)
{

    foreach ($dados as $dado) {

        if ($dado % 2 == 0) {
            $pares[] = $dado;
        } else {
            $impares[] = $dado;
        }
    }

    $pares = ordenar($pares, true);
    $impares = ordenar($impares, false);

    return array_merge($pares, $impares);
}

function ordenar($array, $crescente)
{

    $tamanho = count($array);

    for ($i = 0; $i < $tamanho; $i++) {
        for ($x = 0; $x < $tamanho; $x++) {
            if ($crescente) {
                if ($array[$i] < $array[$x]) {
                    $temp = $array[$i];
                    $array[$i] = $array[$x];
                    $array[$x] = $temp;
                }
            } else {
                if ($array[$i] > $array[$x]) {
                    $temp = $array[$i];
                    $array[$i] = $array[$x];
                    $array[$x] = $temp;
                }
            }
        }
    }

    return $array;
}
