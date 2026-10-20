<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
 
// Barra de ubicación
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 3"]
];
 
// a) Array con todos los dígitos y letras permitidos.
$caracteres = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'));
$cadenaA = "";
for ($i = 0; $i < 20; $i++) {
    $cadenaA .= $caracteres[random_int(0, count($caracteres) - 1)];
}
 
// b) Códigos ASCII del 48 al 122; se descartan los símbolos intermedios.
$cadenaB = "";
while (mb_strlen($cadenaB, 'UTF-8') < 20) {
    $codigo = random_int(48, 122);
    if (($codigo >= 48 && $codigo <= 57)
        || ($codigo >= 65 && $codigo <= 90)
        || ($codigo >= 97 && $codigo <= 122)) {
        $cadenaB .= mb_chr($codigo, 'UTF-8');
    }
}

// Datos que se pasan a la vista.
$datos = [
    'cadenaA' => $cadenaA,
    'cadenaB' => $cadenaB
];
 
//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO_3");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3: Cadenas aleatorias", $ubicacion);
cuerpo($datos);
finCuerpo();

// **********************************************************
// VISTA: Funciones debajo del cierre del cuerpo
function cabecera()
{
    
}

function cuerpo($datos)
{
    echo "<h2>a) Desde un array de caracteres</h2>\n";
    echo '<p>' . htmlspecialchars($datos['cadenaA'], ENT_QUOTES, 'UTF-8') . "</p>\n";

    echo "<h2>b) Desde el código ASCII</h2>\n";
    echo '<p>' . htmlspecialchars($datos['cadenaB'], ENT_QUOTES, 'UTF-8') . "</p>\n";
}
