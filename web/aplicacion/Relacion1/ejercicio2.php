<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2");
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

for ($i=1; $i<=6; $i++)
{
    echo "<br>Lanzamiento de un dado $i";
    for ($j=1; $j<=6; $j++)
    {
        echo "<br>$i x $j = ".($i*$j);
    }
}

}