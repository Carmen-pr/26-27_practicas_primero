<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// CONTROLADOR

// Barra de ubicación
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 1"]
];

$nombre = "Carmen";

// Comillas dobles: interpreta la variable $nombre
$dobles = "Hola $nombre:
<b>negrita</b>
'simples', \"dobles\"
á é ñ, ¿ ¡";

// Comillas simples: $nombre se muestra literalmente
$simples = 'Hola $nombre:
<b>negrita</b>
\'simples\', "dobles"
á é ñ, ¿ ¡';

// HEREDOC: interpreta la variable y permite varias líneas
$heredoc = <<<fin1
Hola $nombre:
<b>negrita</b>
'simples', "dobles"
á é ñ, ¿ ¡
fin1;

// NOWDOC: no interpreta la variable y permite varias líneas
$nowdoc = <<<'fin2'
Hola $nombre:
<b>negrita</b>
'simples', "dobles"
á é ñ, ¿ ¡
fin2;

$datos = [
    "Comillas dobles"  => $dobles,
    "Comillas simples" => $simples,
    "HEREDOC"          => $heredoc,
    "NOWDOC"           => $nowdoc
];

// Dibuja la plantilla de la vista
inicioCabecera("EJERCICIO_1");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 1", $ubicacion);
cuerpo($datos);
finCuerpo();


// VISTA

function cabecera()
{
}

function cuerpo($datos)
{
    echo "<h3>Comillas dobles</h3>\n";
    echo '<pre>' . htmlspecialchars($datos["Comillas dobles"], ENT_QUOTES, "UTF-8") . "</pre>\n";

    echo "<h3>Comillas simples</h3>\n";
    echo '<pre>' . htmlspecialchars($datos["Comillas simples"], ENT_QUOTES, "UTF-8") . "</pre>\n";

    echo "<h3>HEREDOC</h3>\n";
    echo '<pre>' . htmlspecialchars($datos["HEREDOC"], ENT_QUOTES, "UTF-8") . "</pre>\n";

    echo "<h3>NOWDOC</h3>\n";
    echo '<pre>' . htmlspecialchars($datos["NOWDOC"], ENT_QUOTES, "UTF-8") . "</pre>\n";
}
