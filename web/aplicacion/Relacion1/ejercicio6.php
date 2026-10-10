<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
/* ejercicio6.php
   Simula un foreach de dos formas: con las funciones de recorrido
   (reset, key, current, next) y con array_keys / array_values. */


function obtenerVector() {
    return array("primera" => 12.56, 24 => true, 67 => 23.76);
}

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 6");
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

// Convierte un valor a texto: los booleanos se escriben como true/false
function textoValor($valor) {
    if (is_bool($valor)) {
        return $valor ? "true" : "false";
    }
    return $valor;
}

// Forma 1: funciones de recorrido
function mostrarConPuntero($vector) {
    echo "<h2>Con funciones de recorrido (reset, key, current, next)</h2>";
    reset($vector);                        // coloca el puntero en el primer elemento
    while (key($vector) !== null) {        // key devuelve null cuando se acaba el array
        $indice = key($vector);            // clave del elemento actual
        $valor = current($vector);         // valor del elemento actual
        echo $indice . " => " . textoValor($valor) . "<br>";
        next($vector);                     // avanza el puntero al siguiente elemento
    }
}

// Forma 2: array_keys y array_values
function mostrarConKeysValues($vector) {
    echo "<h2>Con array_keys y array_values</h2>";
    $indices = array_keys($vector);        // lista solo con las claves
    $valores = array_values($vector);      // lista solo con los valores
    for ($i = 0; $i < count($indices); $i++) {
        echo $indices[$i] . " => " . textoValor($valores[$i]) . "<br>";
    }
}

// ---------- LLAMADAS ----------
$vector = obtenerVector();
mostrarConPuntero($vector);
mostrarConKeysValues($vector);


}