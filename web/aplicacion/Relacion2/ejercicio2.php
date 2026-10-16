<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "relacion1.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 2"]
];

$cadena = "Está la niña en casa";
$len = mb_strlen($cadena);            // 20 (strlen daría 22)

// Separar por la letra a (la última parte queda vacía)
$partes = explode("a", $cadena);

// Cambiar el carácter siguiente a "niña" (el espacio) por "/mujer "
$palabra = "niña";
$pos = mb_strpos($cadena, $palabra);
if ($pos !== false) {
    $fin = $pos + mb_strlen($palabra);          // posición del espacio
    $nueva = mb_substr($cadena, 0, $fin)        // hasta el final de "niña"
           . "/mujer "                          // texto nuevo
           . mb_substr($cadena, $fin + 1);      // saltando el espacio original
} else {
    $nueva = $cadena;
}

//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO_2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2: Mostrar cadenas", $ubicacion);
cuerpo($cadena, $len, $partes, $nueva); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{
    
}
//vista
function cuerpo($cadena, $len, $partes, $nueva)
{
?>
    <h2>Cada carácter en una línea (mb_substr)</h2>
    <?php
    // NO VÁLIDO con []: $cadena[$i] devuelve UN BYTE y la á sale como �
    // for ($i = 0; $i < strlen($cadena); $i++) { echo $cadena[$i]; }
    // NO VÁLIDO con substr: también trabaja con bytes
    // for ($i = 0; $i < strlen($cadena); $i++) { echo substr($cadena, $i, 1); }
    ?>
    <?php for ($i = 0; $i < $len; $i++) { ?>
        <p><?= str_repeat("&nbsp;", $i) . htmlspecialchars(mb_substr($cadena, $i, 1)) ?></p>
    <?php } ?>

    <h2>En orden inverso con índices negativos</h2>
    <?php for ($i = 0; $i < $len; $i++) {
        $c = mb_substr($cadena, -1 - $i, 1);    // -1 = último, -2 = penúltimo...
        $c = ($i % 2 == 0) ? mb_strtoupper($c) : mb_strtolower($c);
    ?>
        <p><?= str_repeat("&nbsp;", $i) . htmlspecialchars($c) ?></p>
    <?php } ?>

    <h2>Separar la cadena por la letra a</h2>
    <?php foreach ($partes as $clave => $valor) { ?>
        <p><?= "Parte " . ($clave + 1) . ": " . htmlspecialchars($valor) ?></p>
    <?php } ?>

    <h2>Cambiar el espacio detrás de «niña» por «/mujer »</h2>
    <p><?= htmlspecialchars($nueva) ?></p>
<?php

}