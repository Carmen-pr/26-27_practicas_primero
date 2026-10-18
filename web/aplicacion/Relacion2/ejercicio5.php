<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
 
// Barra de ubicación
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 5"]
];
 
// Cadena de varias líneas con NOWDOC (no lleva variables, así que no hay que interpretar nada).
// Cada tipo de elemento está en líneas distintas: etiquetas, números y correos.
$cadena = <<<'HTML'
<div class="contenedor"> <p> </p> <h1> </h1>
42 7 123456 2026
juan@example.com
maria.gomez@correo.es
HTML;
 
// Expresiones regulares
$regex_etiquetas = '/<[^>]+>/';                                          // < ... >
$regex_numeros = '/\b\d+\b/';                                            // dígitos que no forman parte de una palabra
$regex_emails = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';      // aaaa@aaaa.aa
 
// Array con los resultados de cada búsqueda (elemento y posición)
$resultados = [
    'Etiquetas HTML' => buscar($regex_etiquetas, $cadena),
    'Números' => buscar($regex_numeros, $cadena),
    'Direcciones de email' => buscar($regex_emails, $cadena)
];
 
//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO_5");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 5: Expresiones regulares", $ubicacion);
cuerpo($resultados); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{
 
}
//vista
function cuerpo($resultados)
{
    foreach ($resultados as $titulo => $lista) {
?>
        <h3><?= $titulo ?></h3>
        <ul>
            <?php foreach ($lista as $r) { ?>
                <li><?= htmlspecialchars($r['elemento']) . " Posición: " . $r['posicion'] ?></li>
            <?php } ?>
        </ul>
<?php
    }
?>
    <p><a href="index.php">Volver a la Relación 2</a></p>
<?php
}
 
// Devuelve todas las coincidencias de un patrón usando preg_match en un bucle.
// preg_match solo encuentra la primera, así que se repite empezando tras la anterior.
function buscar($regex, $cadena)
{
    $encontrados = [];
    $desde = 0;
    while (preg_match($regex, $cadena, $m, PREG_OFFSET_CAPTURE, $desde) === 1) {
        $bytes = $m[0][1];                                         // posición en bytes (así la da preg_match)
        $encontrados[] = [
            'elemento' => $m[0][0],
            // mb_strcut corta por bytes sin partir caracteres; mb_strlen cuenta los caracteres
            'posicion' => mb_strlen(mb_strcut($cadena, 0, $bytes))
        ];
        // mb_strlen con '8bit' cuenta bytes (el desplazamiento de preg_match va en bytes)
        $desde = $bytes + mb_strlen($m[0][0], '8bit');
    }
    return $encontrados;
}
 