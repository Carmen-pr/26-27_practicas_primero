<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
 
// Barra de ubicación
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 3"]
];
 
// a) Desde un array con todos los caracteres válidos.
// range() rellena el array con los números, las minúsculas y las mayúsculas (62 caracteres).
$caracteres = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'));
$cadenaA = "";
for ($i = 0; $i < 20; $i++) {
    // El último índice válido es count() - 1 (los índices empiezan en 0)
    $cadenaA .= $caracteres[mt_rand(0, count($caracteres) - 1)];
}
 
// b) Desde el código ASCII: rango amplio ('0' = 48 hasta 'z' = 122)
// y se descartan los caracteres que no son letra ni número.
$cadenaB = "";
while (mb_strlen($cadenaB) < 20) {
    $codigo = mt_rand(48, 122);          // del '0' (48) a la 'z' (122)
    // Solo valen: números (48-57), mayúsculas (65-90) y minúsculas (97-122).
    // Se descartan los símbolos intermedios : ; < = > ? @ [ \ ] ^ _ `
    if ($codigo <= 57 || ($codigo >= 65 && $codigo <= 90) || $codigo >= 97) {
        $cadenaB .= mb_chr($codigo);     // mb_chr es la versión multibyte de chr
    }
}
 
//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO_3");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3: Cadenas aleatorias", $ubicacion);
cuerpo($cadenaA, $cadenaB); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{
    
}
//vista
function cuerpo($cadenaA, $cadenaB)
{
?>
    <h2>a) Desde un array de caracteres</h2>
    <p><?= $cadenaA ?></p>
 
    <h2>b) Desde el código ASCII</h2>
    <p><?= $cadenaB ?></p>
 
    <p><a href="index.php">Volver a la Relación 2</a></p>
<?php
}
 