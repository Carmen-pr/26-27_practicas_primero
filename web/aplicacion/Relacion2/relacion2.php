<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2"]
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
    echo "<br><br>Relación 2: Gestión de Cadenas";
?>
    <br><br>
    <a href="../Relacion2/ejercicio1.php">Ejercicio 1</a><br>
    <a href="../Relacion2/ejercicio2.php">Ejercicio 2</a><br>
    <a href="../Relacion2/ejercicio3.php">Ejercicio 3</a><br>
    <a href="../Relacion2/ejercicio4.php">Ejercicio 4</a><br>
    <a href="../Relacion2/ejercicio5.php">Ejercicio 5</a><br>   
<?php
}