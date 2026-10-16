<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "relacion1.php", "ADICIONAL" => " &gt;&gt; "],
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
    foreach ($cadenas as $titulo => $texto) {
?>
        <h3><?= $titulo ?></h3>
        <pre><?= htmlspecialchars($texto, ENT_QUOTES, 'UTF-8') ?></pre>
<?php
    }
}
