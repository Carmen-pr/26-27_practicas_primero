<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
 
// Barra de ubicación
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 2"]
];
 
$cadena = "Está la niña en casa";
$len = mb_strlen($cadena, 'UTF-8');
 
// [] y substr trabajan con bytes: parten caracteres como á y ñ.
// Por eso estas pruebas no sirven para recorrer la cadena por caracteres:
// for ($i = 0; $i < strlen($cadena); $i++) { echo $cadena[$i]; }
// for ($i = 0; $i < strlen($cadena); $i++) { echo substr($cadena, $i, 1); }
 
// --- Forma válida: mb_substr ---
$lineasA = [];
for ($i = 0; $i < $len; $i++) {
    $lineasA[] = ['espacios' => $i, 'caracter' => mb_substr($cadena, $i, 1, 'UTF-8')];
}
 
// --- Orden inverso con índices negativos ---
$lineasB = [];
for ($i = 0; $i < $len; $i++) {
    $c = mb_substr($cadena, -1 - $i, 1, 'UTF-8');
    $c = ($i % 2 == 0) ? mb_strtoupper($c, 'UTF-8') : mb_strtolower($c, 'UTF-8');
    $lineasB[] = ['espacios' => $i, 'caracter' => $c];
}
 
// --- Separar por la letra a ---
$partes = mb_split("a", $cadena);
 
// --- Cambiar el carácter siguiente a "niña" ---
$palabra = "niña";
$pos = mb_strpos($cadena, $palabra, 0, 'UTF-8');
if ($pos !== false) {
    $fin = $pos + mb_strlen($palabra, 'UTF-8');
    $nueva = mb_substr($cadena, 0, $fin, 'UTF-8')
           . "/mujer "
           . mb_substr($cadena, $fin + 1, $len, 'UTF-8');
} else {
    $nueva = $cadena;
}

// Datos que se pasan a la vista.
$datos = [
    'lineasA' => $lineasA,
    'lineasB' => $lineasB,
    'partes'  => $partes,
    'nueva'   => $nueva
];
 
//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO_2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2: Mostrar cadenas", $ubicacion);
cuerpo($datos);
finCuerpo();

// **********************************************************
// VISTA: Funciones debajo del cierre del cuerpo
function cabecera()
{
    
}

function cuerpo($datos)
{
    echo "<h2>Cada carácter en una línea (mb_substr)</h2>\n<pre>";
    foreach ($datos['lineasA'] as $linea) {
        echo str_repeat(' ', $linea['espacios']);
        echo htmlspecialchars($linea['caracter'], ENT_QUOTES, 'UTF-8');
        echo "\n";
    }
    echo "</pre>\n";

    echo "<h2>En orden inverso con índices negativos</h2>\n<pre>";
    foreach ($datos['lineasB'] as $linea) {
        echo str_repeat(' ', $linea['espacios']);
        echo htmlspecialchars($linea['caracter'], ENT_QUOTES, 'UTF-8');
        echo "\n";
    }
    echo "</pre>\n";

    echo "<h2>Separar la cadena por la letra a</h2>\n";
    foreach ($datos['partes'] as $indice => $parte) {
        echo '<p>Parte ' . ($indice + 1) . ': «'
           . htmlspecialchars($parte, ENT_QUOTES, 'UTF-8') . "»</p>\n";
    }

    echo "<h2>Cambiar el espacio detrás de «niña» por «/mujer »</h2>\n";
    echo '<p>' . htmlspecialchars($datos['nueva'], ENT_QUOTES, 'UTF-8') . "</p>\n";
}
