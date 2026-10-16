<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "index.php", "ADICIONAL" => " &gt;&gt; "],
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

// Expresiones regulares
$regex_etiquetas = '/<[^>]+>/';
$regex_numeros = '/\b\d+\b/';
$regex_emails = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';
// Devuelve todas las coincidencias usando preg_match en bucle
function buscar($regex, $cadena)
{
$encontrados = [];
$desde = 0;
while (preg_match($regex, $cadena, $m, PREG_OFFSET_CAPTURE, $desde) === 1) {
$bytes = $m[0][1]; // posición en bytes
$encontrados[] = [
'elemento' => $m[0][0],
'posicion' => mb_strlen(substr($cadena, 0, $bytes)) // en caracteres
];
$desde = $bytes + strlen($m[0][0]); // seguir tras lo encontrado
}
return $encontrados;
}
$resultados = [
'Etiquetas HTML' => buscar($regex_etiquetas, $cadena),
'Números' => buscar($regex_numeros, $cadena),
'Direcciones de email' => buscar($regex_emails, $cadena)
];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
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


}