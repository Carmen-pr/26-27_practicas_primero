<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//Crea el mismo array de tres formas distintas y lo muestra con foreach.
function obtenerArrays() {

    // FORMA 1: varias sentencias, una por cada dato
    $varias = array();                 // a) array vacío
    $varias[1] = "a";                  // b) posiciones concretas
    $varias[16] = "b";
    $varias[54] = "c";
    $varias[] = 34;                    // c) al final (será la posición 55)
    $varias["uno"] = "cadena";         // d) posiciones con nombre
    $varias["dos"] = true;
    $varias["tres"] = 1.345;
    $varias["ultima"] = array(1, 34, "nueva");  // e) un array dentro de otro

    // FORMA 2: una sola sentencia con array(...)
    $unaSentencia = array(
        1 => "a",
        16 => "b",
        54 => "c",
        34,                            // sin clave: PHP le asigna la 55
        "uno" => "cadena",
        "dos" => true,
        "tres" => 1.345,
        "ultima" => array(1, 34, "nueva")
    );

    // FORMA 3: una sola sentencia con [] (es lo mismo, con otra sintaxis)
    $corchetes = [
        1 => "a",
        16 => "b",
        54 => "c",
        34,
        "uno" => "cadena",
        "dos" => true,
        "tres" => 1.345,
        "ultima" => [1, 34, "nueva"]
    ];

    // Devolvemos los tres arrays juntos dentro de otro array
    return ["Varias sentencias" => $varias,
            "Con array()" => $unaSentencia,
            "Con []" => $corchetes];
}

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3");
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

function mostrarArrays($datos) {
    foreach ($datos as $titulo => $array) {
        echo "<h2>$titulo</h2>";

        foreach ($array as $posicion => $valor) {
            if (is_array($valor)) {
                // Si el valor es otro array, lo recorremos con otro foreach
                echo "posición $posicion: ";
                foreach ($valor as $elemento) {
                    echo "$elemento ";
                }
                echo "<br>";
            } elseif (is_bool($valor)) {
                // Los booleanos hay que convertirlos a texto para verlos
                echo "posición $posicion: " . ($valor ? "true" : "false") . "<br>";
            } else {
                echo "posición $posicion: $valor<br>";
            }
        }
    }
}

// ---------- LLAMADAS ----------
$datos = obtenerArrays();
mostrarArrays($datos);



}
?>

