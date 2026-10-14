<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "relacion1.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 1"]
];




//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 1", $ubicacion);
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
echo "<h2>Escribir distintas cadenas</h2>";

$cadena1 = mundo;
$cadena2 = "Comillas Dobles";
$cadena3 = <<<END
Equivale a una cadena de comillas dobles
END;
$cadena4 = <<<'EOD'
Equivale a una cadena de comillas simples
EOD;


echo $cadena1 'Hola ' . PHP_EOL;





}