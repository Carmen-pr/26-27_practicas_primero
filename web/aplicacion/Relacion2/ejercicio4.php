<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "relacion1.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 4"]
];

$num1 = 17.5;
$num2 = 379987.24;

$formateado1 = number_format($num1, 1, ',', '.');   // "17,5"
$formateado2 = number_format($num2, 2, ',', '.');   // "379.987,24"

$valor1_final = str_pad($formateado1, 15, '0', STR_PAD_LEFT);
$valor2_final = str_pad($formateado2, 15, ' ', STR_PAD_LEFT);

$frase = "el primer valor -{$valor1_final}-, el segundo valor -{$valor2_final}-";

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 4: Formato de números");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 4", $ubicacion);
cuerpo($frase); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{
    
}
//vista
function cuerpo($frase)
{
?>
    <h2>Números mostrados con 15 caracteres totales</h2>
    <!-- <pre> para que se vean los espacios de relleno -->
    <pre><?= $frase ?></pre>
<?php

}