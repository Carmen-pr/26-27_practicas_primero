<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include ("./mis_funciones.php"); //ruta relativa

include_once ("./mis_funciones.php");


//controlador


$barra=[
    [
        "TEXTO"=> "inicio", 
        "ENLACE" => "/index.php",
    ],
        [
        "TEXTO"=> "pruebas",
        "ENLACE" => "/aplicacion/pruebas/index.php",
    ],
        [
        "TEXTO"=> "eje.funciones",
    ]
];

$numero=doble(25);
//Comprobacion
if ($numero===false)
    {
        //hay un error, lo resuelve
        $numero=5;

    }

//if ($numero=doble($numero)===false)
if (!$numero=doble($numero))
    {
        exit;
    }



//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("pruebas basicas");
cuerpo($numero); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}


//vista
function cuerpo(int $n)
{
        echo "el doble el numero es $n".PHP_EOL;
        echo "el numero $n es el doble de otr".PHP_EOL;
}
