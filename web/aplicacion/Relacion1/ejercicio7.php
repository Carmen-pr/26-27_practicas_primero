<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 7");
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

//Mostrar la fecha actual en el formato “d/m/Y”
$fecha = new DateTime();
echo $fecha->format("d/m/Y")."<br>";

//Mostrar la fecha actual en el formato “dia d, mes mmmm, año yyyy, dia de la semana dd”.
$fecha2 = new DateTime();
echo $fecha2->format("d/m/Y/w")."<br>";

//Mostrar la hora actual en el formato “hh:mm:ss”
$fecha3 = new DateTime();
echo $fecha3->format("H:i:s")."<br>";

// Mostrar los tres apartados anteriores para la fecha 29/3/2024 a 12:45.
date_default_timezone_set('Europe/Berlin');
$fecha4 =new DateTime();


// Mostrar los tres apartados anteriores para la fecha actual menos 12 días y 4 horas












}