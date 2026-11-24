<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//controlador
// en el conmtrolador solo va los conroladores lo demas va abajo, en el controlador va la esructura de la pagina, el resto va en la vista



$barra = [
    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    [
        "TEXTO" => "pruebas",
        "ENLACE" => "./index.php" // Permite volver a la carpeta pruebas
    ],
    [
        "TEXTO" => "pruebacookie-sesiones"
    ]
];


/*************************************** COOKIES ************************************/
//setcookie("numero", mt_rand(1, 100), time() + 60 * 60 * 24 * 2);

//$valor = $_COOKIE["numero"];


/**************************************** SESIONES *******************************************/
//Las sesiones se guardan mediante ficheros
//Hay dos metodos para pasar el identificador de la sesion, mediante una cookie o mediante 

$valor = 0;
//$valor = $_COOKIE["numero"];


//Iniciamos/cargamos la sesion con:
session_start();
//$_SESSION["nombre"] = "Carmen";

//Se guarda la sesion con alguna informacion


/**
 * Como se destruye una sesion: se eliminan todas las variables de sesión y se borra el id de sesión
 * session_destroy();
 */


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Prueba imagen", $barra);
cuerpo($valor); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo(int $valor)
{
?>

    <br><br>

<?php

    echo "leido la cookie con valor $valor";
}
