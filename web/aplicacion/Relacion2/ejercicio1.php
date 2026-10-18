<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
 
// Barra de ubicación: cada elemento lleva TEXTO, ENLACE y ADICIONAL (separador).
// El último (la página actual) solo lleva TEXTO porque no es un enlace.
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 1"]
];
 
$nombre = "Carmen";
 
// Comillas dobles: interpreta $nombre y los escapes (\" es una comilla doble)
$dobles = "Hola $nombre: <b>negrita</b>, 'simples', \"dobles\", á é ñ";
 
// Comillas simples: todo literal; solo se escapa \'
$simples = 'Hola $nombre: <b>negrita</b>, \'simples\', "dobles", á é ñ';
 
// HEREDOC: como comillas dobles, en varias líneas
$heredoc = <<<fin1
Hola $nombre:
<b>negrita</b>, 'simples', "dobles", á é ñ
fin1;
 
// NOWDOC: como comillas simples, en varias líneas
$nowdoc = <<<'fin2'
Hola $nombre:
<b>negrita</b>, 'simples', "dobles", á é ñ
fin2;
 
// Array con todas las cadenas para pasárselo a la vista
$cadenas = [
    'Comillas dobles'  => $dobles,
    'Comillas simples' => $simples,
    'HEREDOC'          => $heredoc,
    'NOWDOC'           => $nowdoc
];
 
//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO_1");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 1", $ubicacion);
cuerpo($cadenas); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{
    
}
//vista
function cuerpo($cadenas)
{
    // Se recorre el array y se muestra cada cadena con su título.
    // htmlspecialchars hace que las etiquetas HTML se vean y no se ejecuten;
    // <pre> mantiene los saltos de línea del HEREDOC y del NOWDOC.
    foreach ($cadenas as $titulo => $texto) {
?>
        <h3><?= $titulo ?></h3>
        <pre><?= htmlspecialchars($texto, ENT_QUOTES, 'UTF-8') ?></pre>
<?php
    }
?>
    <p><a href="index.php">Volver a la Relación 2</a></p>
<?php
}
