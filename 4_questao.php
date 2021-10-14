<?php

# Calcula as combinações possíveis sem repetições

$triangulos = array("A", "B", "C", "D", "E", "F");

$cominacoesPossiveis = combinacaoTrinagulos($triangulos);

var_dump($cominacoesPossiveis);


function combinacaoTrinagulos($numeros)
{
    $tamanho = count($numeros);
    $qtdCombinacao = 0;
    $cominacoesPossiveis = [];

    for ($j = 0; $j < $tamanho; $j++) {
        $combinacoes[0] = $numeros[$j];

        for ($k = $j + 1; $k < $tamanho; $k++) {
            $combinacoes[1] = $numeros[$k];

            for ($t = $k + 1; $t < $tamanho; $t++) {
                $qtdCombinacao++;
                $combinacoes[2] = $numeros[$t];

                $cominacoesPossiveis[] = $combinacoes[0] .  $combinacoes[1] .  $combinacoes[2];
            }
        }
    }
    return $cominacoesPossiveis;
}
