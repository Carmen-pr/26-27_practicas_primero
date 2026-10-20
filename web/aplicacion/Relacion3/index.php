<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include ("./libreria.php");

//controlador

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 3"]
];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{

    echo ("<h1>Ejercicio 1</h1>");

    echo ("<h1>Ejercicio 2</h1>");

    echo ("<h1>Ejercicio 3</h1>");

    echo ("<h1>Ejercicio 4</h1>");

    echo ("<h1>Ejercicio 5</h1>");

    echo ("<h1>Ejercicio 6</h1>");

    echo ("<h1>Ejercicio 7</h1>");

    
}
    