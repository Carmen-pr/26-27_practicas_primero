<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
 
// Barra de ubicación
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 4"]
];
 
$num1 = 17.5;
$num2 = 379987.24;
 
// number_format da el formato: coma decimal y punto de miles
$formateado1 = number_format($num1, 1, ',', '.');
$formateado2 = number_format($num2, 2, ',', '.');
 
// Cada valor ocupa 15 caracteres: ceros en el primero y espacios en el segundo.
$valor1_final = str_pad($formateado1, 15, '0', STR_PAD_LEFT);
$valor2_final = str_pad($formateado2, 15, ' ', STR_PAD_LEFT);
 
$frase = "el primer valor -{$valor1_final}-, el segundo valor -{$valor2_final}-";

// Datos que se pasan a la vista.
$datos = [
    'frase' => $frase
];
 
//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO_4");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 4: Formato de números", $ubicacion);
cuerpo($datos);
finCuerpo();

// **********************************************************
// VISTA: Funciones debajo del cierre del cuerpo
function cabecera()
{
    
}

function cuerpo($datos)
{
    echo "<h2>Números mostrados con 15 caracteres totales</h2>\n";
    // <pre> conserva los espacios que preceden al segundo número.
    echo '<pre>' . htmlspecialchars($datos['frase'], ENT_QUOTES, 'UTF-8') . "</pre>\n";
}
