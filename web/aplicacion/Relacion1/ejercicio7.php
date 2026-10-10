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
echo "<h2>Con funciones de fecha</h2>";

//Mostrar la fecha actual en el formato “d/m/Y”
$fecha = new DateTime();
echo $fecha->format("d/m/Y") . "<br>";

//Mostrar la fecha actual en el formato “dia d, mes mmmm, año yyyy, dia de la semana dd”.
$fecha2 = new DateTime();
echo "dia " . $fecha2->format("d") . ", mes " . $fecha2->format("F") . ", año " . $fecha2->format("Y") . ", dia de la semana " . $fecha2->format("l") . "<br>";

//Mostrar la hora actual en el formato “hh:mm:ss”
$fecha3 = new DateTime();
echo $fecha3->format("H:i:s") . "<br>";

// Mostrar los tres apartados anteriores para la fecha 29/3/2024 a 12:45.
date_default_timezone_set('Europe/Berlin');
$fecha4 = new DateTime('2024-03-29 12:45:00'); // <--- Pasamos la fecha exacta aquí

echo $fecha4->format("d/m/Y") . "<br>";
echo "dia " . $fecha4->format("d") . ", mes " . $fecha4->format("F") . ", año " . $fecha4->format("Y") . ", dia de la semana " . $fecha4->format("l") . "<br>";
echo $fecha4->format("H:i:s") . "<br>";


// Mostrar los tres apartados anteriores para la fecha actual menos 12 días y 4 horas
$fecha5 = new DateTime();
$fecha5->modify('-12 days -4 hours'); // <--- Restamos el tiempo

echo $fecha5->format("d/m/Y") . "<br>";
echo "dia " . $fecha5->format("d") . ", mes " . $fecha5->format("F") . ", año " . $fecha5->format("Y") . ", dia de la semana " . $fecha5->format("l") . "<br>";
echo $fecha5->format("H:i:s") . "<br>";











}