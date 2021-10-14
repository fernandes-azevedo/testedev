<?php

#  Retorna a área total sobreposta entre dois retângulos num plano cartesiano

$pontosRetangulos = [
    [0,0],
    [2,2],
    [2,0],
    [0,2],

    [1,0],
    [1,2],
    [6,0],
    [6,2]
];

echo areaSobreposta($pontosRetangulos);

function areaSobreposta(array $PR)
{
    list($retangulo1, $retangulo2) = array_chunk($PR, 4);
    $v1 = retornarVerticesOpostos($retangulo1);
    $v2 = retornarVerticesOpostos($retangulo2);

    $x = 0;
    $y = 1;

    // Área do primeiro retângulo
    $area1 = abs($v1['min'][$x] - $v1['max'][$x]) * abs($v1['min'][$y] - $v1['max'][$y]);

    // Área do segundo retângulo
    $area2 = abs($v2['min'][$x] - $v2['max'][$x]) * abs($v2['min'][$y] - $v2['max'][$y]);

    //Comprimento da parte de interseção
    $x_aresta = (
        min($v1['max'][$x], $v2['max'][$x]) -
        max($v1['min'][$x], $v2['min'][$x])
    );

    $y_aresta = (
        min($v1['max'][$y], $v2['max'][$y]) -
        max($v1['min'][$y], $v2['min'][$y])
    );


    return ($x_aresta > 0 && $y_aresta > 0) ? $x_aresta * $y_aresta : 0;
}

function retornarVerticesOpostos(array $PR){
    $x = 0;
    $y = 1;
    $min_x = $max_x = $PR[0][$x];
    $min_y = $max_y = $PR[0][$y];

    for ($i = 1; $i < 4; $i++){
        $min_x = min($min_x, $PR[$i][$x]);
        $min_y = min($min_y, $PR[$i][$y]);
        $max_x = max($max_x, $PR[$i][$x]);
        $max_y = max($max_y, $PR[$i][$y]);
    }

    $v['min'] = [$min_x, $min_y];
    $v['max'] = [$max_x, $max_y];

    return $v;
}