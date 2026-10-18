<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
 
// Barra de ubicación
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 5"]
];
 
// Las etiquetas, los números y los correos aparecen en líneas distintas.
$cadena = <<<'HTML'
<div class="contenedor">
<p>Ejemplo</p>
<h1>Prueba</h1>
</div>
42 7 123456 2026
juan@example.com
maria.gomez@correo.es
HTML;

// Expresiones regulares
$regex_etiquetas = '/<\/?[a-z][^>]*>/iu';
$regex_numeros = '/\b[0-9]+\b/u';
$regex_emails = '/\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\b/u';
 
// Buscar cada tipo de elemento antes de pasar los datos a la vista.
$etiquetas = buscar($regex_etiquetas, $cadena);
$numeros   = buscar($regex_numeros, $cadena);
$emails    = buscar($regex_emails, $cadena);

$datos = [
    'cadena'               => $cadena,
    'Etiquetas HTML'       => $etiquetas,
    'Números'              => $numeros,
    'Direcciones de email' => $emails
];
 
//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO_5");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 5: Expresiones regulares", $ubicacion);
cuerpo($datos);
finCuerpo();

// **********************************************************
// VISTA
function cabecera()
{
 
}

function cuerpo($datos)
{
    echo "<h2>Cadena analizada</h2>\n";
    echo '<pre>' . htmlspecialchars($datos['cadena'], ENT_QUOTES, 'UTF-8') . "</pre>\n";

    echo "<h3>Etiquetas HTML</h3>\n<ul>\n";
    foreach ($datos['Etiquetas HTML'] as $resultado) {
        echo '<li>' . htmlspecialchars($resultado['elemento'], ENT_QUOTES, 'UTF-8')
           . ' — posición: ' . $resultado['posicion'] . "</li>\n";
    }
    echo "</ul>\n";

    echo "<h3>Números</h3>\n<ul>\n";
    foreach ($datos['Números'] as $resultado) {
        echo '<li>' . htmlspecialchars($resultado['elemento'], ENT_QUOTES, 'UTF-8')
           . ' — posición: ' . $resultado['posicion'] . "</li>\n";
    }
    echo "</ul>\n";

    echo "<h3>Direcciones de email</h3>\n<ul>\n";
    foreach ($datos['Direcciones de email'] as $resultado) {
        echo '<li>' . htmlspecialchars($resultado['elemento'], ENT_QUOTES, 'UTF-8')
           . ' — posición: ' . $resultado['posicion'] . "</li>\n";
    }
    echo "</ul>\n";
}
 
// Devuelve todas las coincidencias de un patrón usando preg_match en un bucle.
function buscar($regex, $cadena)
{
    $encontrados = [];
    $desde = 0;
    while (preg_match($regex, $cadena, $m, PREG_OFFSET_CAPTURE, $desde) === 1) {
        $bytes = $m[0][1];                                         // posición en bytes
        $encontrados[] = [
            'elemento' => $m[0][0],
            // mb_strcut corta por bytes sin partir caracteres; mb_strlen cuenta los caracteres
            'posicion' => mb_strlen(mb_strcut($cadena, 0, $bytes, 'UTF-8'), 'UTF-8')
        ];
        // mb_strlen con '8bit' cuenta bytes (el desplazamiento de preg_match va en bytes)
        $desde = $bytes + mb_strlen($m[0][0], '8bit');
    }
    return $encontrados;
}
