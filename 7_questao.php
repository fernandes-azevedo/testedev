<?php

# Lista os caminhos entre dois pontos

// Array das adjacências
$rotas = [];

addRota('A', 'B', 7);
addRota('A', 'D', 5);
addRota('B', 'C', 8);
addRota('B', 'D', 9);
addRota('B', 'E', 7);
addRota('C', 'E', 5);
addRota('D', 'E', 15);
addRota('D', 'F', 6);
addRota('F', 'E', 8);
addRota('F', 'G', 11);
addRota('G', 'E', 9);

$origem = 'A';
$destino = 'E';
echo "<pre>";
$caminhos = listarCaminhos($origem, $destino);
print_r($caminhos);
echo "</pre>";

// Adiciona um ponto adjacente a outro (rota)
function addRota(string $origem_rota, string $destino_rota, int $distancia)
{
    global $rotas;
    $rotas[$origem_rota][$destino_rota]
        = $rotas[$destino_rota][$origem_rota]
        = $distancia;
}

// Método recursivo para listar todos os caminhos entre dois pontos
function listarCaminhos(string $origem_rota, string $destino_caminho, array $rotas_anteriores = [])
{
    global $rotas;

    $caminhos = null;
    // Se rota chegar ao destino do caminho
    if ($origem_rota == $destino_caminho) {
        return 'FIM';
    } // Recorre para todos os vértices adjacentes ao ponto origem_rota
    else {
        if (!in_array($origem_rota, $rotas_anteriores)) {
            $rotas_anteriores[] = $origem_rota;
            foreach ($rotas[$origem_rota] as $destino_rota => $distancia) {

                $caminhos[$origem_rota . $destino_rota] = listarCaminhos($destino_rota, $destino_caminho, $rotas_anteriores);
            }
        }
    }

    return $caminhos ? array_filter($caminhos) : null;
}