<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
    echo "<br><br>Relación 1: arrays, fechas, libreria math";
?>
    <br><br>
    <a href="../Relacion1/ejercicio1.php">Ejercicio 1</a><br>
    <a href="../Relacion1/ejercicio2.php">Ejercicio 2</a><br>
    <a href="../Relacion1/ejercicio3.php">Ejercicio 3</a><br>
    <a href="../Relacion1/ejercicio4.php">Ejercicio 4</a><br>
    <a href="../Relacion1/ejercicio5.php">Ejercicio 5</a><br>   
    <a href="../Relacion1/ejercicio6.php">Ejercicio 6</a><br>
    <a href="../Relacion1/ejercicio7.php">Ejercicio 7</a><br>
<?php
}