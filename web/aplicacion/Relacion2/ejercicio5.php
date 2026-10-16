<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "relacion1.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 5"]
];

// Cadena de varias líneas con HEREDOC
$cadena = <<<HTML
<div class="contenedor">
    <p>Este es un párrafo con número 42 y otro número 123456.</p>
    <span>Contacto: juan@example.com</span>
    <section>
        <h1>Bienvenido</h1>
        <p>Correo alternativo: maria.gomez@correo.es</p>
        <p>Otro número: 7</p>
    </section>
</div>
HTML;


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 5", $ubicacion);
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


}