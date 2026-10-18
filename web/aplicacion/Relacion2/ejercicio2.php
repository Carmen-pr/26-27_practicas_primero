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
$len = mb_strlen($cadena);            // 20 (strlen daría 22)
 
// --- Formas NO válidas para recorrer la cadena (trabajan con bytes) ---
// Con []: $cadena[$i] devuelve UN BYTE y la á o la ñ salen como �
// for ($i = 0; $i < strlen($cadena); $i++) { echo $cadena[$i]; }
// Con substr: también trabaja con bytes, mismo problema
// for ($i = 0; $i < strlen($cadena); $i++) { echo substr($cadena, $i, 1); }
 
// --- Forma válida: mb_substr. Cada carácter con tantos espacios como su posición ---
$lineasA = [];
for ($i = 0; $i < $len; $i++) {
    $lineasA[] = ['espacios' => $i, 'caracter' => mb_substr($cadena, $i, 1)];
}
 
// --- Orden inverso con índices negativos (-1 es el último carácter) ---
// Posiciones pares (0, 2, ...) en mayúscula e impares en minúscula
$lineasB = [];
for ($i = 0; $i < $len; $i++) {
    $c = mb_substr($cadena, -1 - $i, 1);
    $c = ($i % 2 == 0) ? mb_strtoupper($c) : mb_strtolower($c);
    $lineasB[] = ['espacios' => $i, 'caracter' => $c];
}
 
// --- Separar por la letra a (la última parte queda vacía) ---
// mb_split es la versión multibyte de explode
$partes = mb_split("a", $cadena);
 
// --- Cambiar el carácter siguiente a "niña" (el espacio) por "/mujer " ---
$palabra = "niña";
$pos = mb_strpos($cadena, $palabra);
if ($pos !== false) {
    $fin = $pos + mb_strlen($palabra);          // posición del espacio
    $nueva = mb_substr($cadena, 0, $fin)        // hasta el final de "niña"
           . "/mujer "                          // texto nuevo
           . mb_substr($cadena, $fin + 1);      // saltando el espacio original
} else {
    $nueva = $cadena;                           // la palabra no estaba
}
 
//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO_2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2: Mostrar cadenas", $ubicacion);
cuerpo($lineasA, $lineasB, $partes, $nueva); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{
    
}
//vista
function cuerpo($lineasA, $lineasB, $partes, $nueva)
{
?>
    <h2>Cada carácter en una línea (mb_substr)</h2>
    <?php foreach ($lineasA as $linea) { ?>
        <p><?= str_repeat("&nbsp;", $linea['espacios']) . htmlspecialchars($linea['caracter']) ?></p>
    <?php } ?>
 
    <h2>En orden inverso con índices negativos</h2>
    <?php foreach ($lineasB as $linea) { ?>
        <p><?= str_repeat("&nbsp;", $linea['espacios']) . htmlspecialchars($linea['caracter']) ?></p>
    <?php } ?>
 
    <h2>Separar la cadena por la letra a</h2>
    <?php foreach ($partes as $clave => $valor) { ?>
        <p><?= "Parte " . ($clave + 1) . ": " . htmlspecialchars($valor) ?></p>
    <?php } ?>
 
    <h2>Cambiar el espacio detrás de «niña» por «/mujer »</h2>
    <p><?= htmlspecialchars($nueva) ?></p>
 
    <p><a href="index.php">Volver a la Relación 2</a></p>
<?php
}
