<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
/* Rellena un array con valores de distintos tipos y muestra, según el tipo,
una información distinta de cada elemento.*/

function obtenerVector() {
    $vector = array();
    $vector[1] = "esto es una cadena";   // posición 1: cadena
    $vector["posi1"] = 25.67;            // posición "posi1": real
    $vector[] = false;                   // sin clave: PHP usa la siguiente (la 2)
    $vector["ultima"] = array(2, 5, 96); // un array dentro del array
    $vector[56] = 23;                    // posición 56: entero
    return $vector;
}


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 5");
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

function mostrarVector($vector) {
    foreach ($vector as $posicion => $contenido) {
        echo "posicion $posicion contenido (" . gettype($contenido) . ") ";

        if (is_array($contenido)) {
            // Array: se recorre con otro foreach
            foreach ($contenido as $elemento) {
                echo "$elemento ";
            }
        } elseif (is_int($contenido)) {
            // Entero: su valor y su representación en binario
            echo "Entero con valor $contenido, en binario " . decbin($contenido);
        } elseif (is_float($contenido)) {
            // Real: el número y su cuadrado
            echo "Real $contenido que al cuadrado es " . ($contenido * $contenido);
        } elseif (is_string($contenido)) {
            // Cadena de texto
            echo "Cadena - $contenido";
        } elseif (is_bool($contenido)) {
            // Booleano: su valor y su opuesto, convertidos a texto
            $valor = $contenido ? "true" : "false";
            $opuesto = !$contenido ? "true" : "false";
            echo "Booleano $valor y su opuesto $opuesto";
        }
        echo "<br>";
    }
}

// ---------- LLAMADAS ----------
mostrarVector(obtenerVector());

}