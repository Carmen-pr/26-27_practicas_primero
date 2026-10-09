<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//Genera un triángulo de números con bucles for y lo muestra con foreach. 
// Versión 1: el número de filas (5) está escrito directamente en el código
function obtenerTriangulo() {
    $triangulo = [];
    for ($i = 1; $i <= 5; $i++) {          // bucle de las filas
        for ($j = 1; $j <= $i; $j++) {     // bucle de las columnas
            $triangulo[$i][] = $i;         // añade el número i a la fila i
        }
    }
    return $triangulo;
}

// Versión 2: el número de filas viene de la constante FILAS
const FILAS = 5;

function obtenerTrianguloConstante() {
    $triangulo = [];
    for ($i = 1; $i <= FILAS; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            $triangulo[$i][] = $i;
        }
    }
    return $triangulo;
}

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 4");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{
    
}
//vista
function cuerpo()
{
?>
<?php

function mostrarTriangulo($triangulo, $titulo) {
    echo "<h2>$titulo</h2>";
    foreach ($triangulo as $fila) {
        foreach ($fila as $valor) {
            echo $valor . " ";
        }
        echo "<br>";                       // salto de línea al acabar cada fila
    }
}

// ---------- LLAMADAS ----------
mostrarTriangulo(obtenerTriangulo(), "Triángulo con 5 filas fijas");
mostrarTriangulo(obtenerTrianguloConstante(), "Triángulo con FILAS = " . FILAS);


}