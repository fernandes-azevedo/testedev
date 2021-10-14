<?php

# Calcula a diferença de dias entre duas datas

$data_incio = "07/12/1955";
$data_fim = "17/10/2029";

// 1ª Alternativa
var_dump(calcularDias($data_incio, $data_fim));

// 2ª Alternativa
list($diferenca, $periodo) = calcularDiasAlternativa($data_incio, $data_fim);
var_dump("Se passou " .  $periodo['anos'] . " ano(s), " . $periodo['meses'] . " mes(es) e " . $periodo['dias'] . " dia(s), totalizando uma diferença de " . $diferenca . " dia(s).");


function calcularDias($data_incio, $data_fim)
{
    //Converte o formato
    list($dia_i,$mes_i,$ano_i) = explode("/", $data_incio);
    list($dia_f,$mes_f,$ano_f) = explode("/", $data_fim);

    $diferenca = strtotime($ano_f.$mes_f.$dia_f) - strtotime($ano_i.$mes_i.$dia_i);
    return round($diferenca / (60 * 60 * 24)); //Converte segundos para dias
}

function calcularDiasAlternativa($data_incio, $data_fim)
{

    $data_incio = explode("/", $data_incio);
    $data_fim = explode("/", $data_fim);
    $diferenca = 0; //Quantidade de dias entre uma data e outra
    $meses = 0;
    $dias = 0;
    $periodo = [];
    $tipo_meses = array(1 => 31, 2 => 28, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31);

    list($diferenca, $periodo['anos']) = contabilizarAnos($data_incio, $data_fim, $diferenca);

    list($diferenca, $periodo['dias'], $periodo['meses']) = contabilizarDias($data_incio, $data_fim[0], $tipo_meses[(int)$data_incio[1]], $dias, $diferenca, $meses);

    list($diferenca, $periodo['meses']) = contabilizarMeses($tipo_meses, $data_incio, $data_fim, $diferenca, $meses);

    return array($diferenca, $periodo);
}

function contabilizarAnos($data_incio, $data_fim, int $diferenca): array
{

    $anos = ($data_fim[2] - $data_incio[2]) ;

    if ($anos < 2 && $data_fim[1] != $data_incio[1] && $data_fim[0] != $data_incio[0]) {
        $anos = 0;
    }
    if ($data_fim[1] < $data_incio[1]) {
        $anos--;
    }
    $diferenca += $anos * 365;

    //Anos Bisextos
    for ($ano = (int)$data_incio[2]; $ano < $data_fim[2]; $ano++) {
        if ((($ano % 4 == 0) && ($ano % 100 != 0)) || ($ano % 400 == 0)) {
            $diferenca++;
        }
    }

    return array($diferenca, $anos);
}

function contabilizarDias($data_incio, $data_fim, $tipo_meses, $dias, $diferenca, int $meses): array
{
    if ($data_incio[0] != $data_fim) {
        $dias_restantes = $tipo_meses - $data_incio[0];
        $dias = ($data_fim + $dias_restantes);
        $diferenca += $dias;

        if ($dias > $tipo_meses) {
            $dias = $dias - $tipo_meses;
            $meses++;
        }
    }
    return array($diferenca, $dias, $meses);
}

function contabilizarMeses(array $tipo_meses, $data_incio, $data_fim, int $diferenca, int $meses): array
{
    foreach ($tipo_meses as $mes => $qdt) {

        if (($data_incio[1] < $data_fim[1] && ($mes > $data_incio[1] && $mes < $data_fim[1]))
            ||
            ($data_incio[1] > $data_fim[1] && ($mes > $data_incio[1] || $mes < $data_fim[1]))) {

            $diferenca += $qdt;
            $meses++;

        } elseif (($mes == $data_fim[1]) && ($data_incio[0] == $data_fim[0]) && ($data_incio[1] != $data_fim[1])) {
            $diferenca += $data_fim[0];
            $meses++;
        }
    }
    return array($diferenca, $meses);
}