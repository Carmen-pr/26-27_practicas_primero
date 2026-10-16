<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 2", "ENLACE" => "relacion1.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Ejercicio 3"]
];

// a) Desde un array con todos los caracteres válidos
$caracteres = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'));
$cadenaA = "";
for ($i = 0; $i < 20; $i++) {
    $cadenaA .= $caracteres[mt_rand(0, count($caracteres) - 1)];
}

// b) Desde el código ASCII: rango amplio y se descartan los no válidos
$cadenaB = "";
while (mb_strlen($cadenaB) < 20) {
    $caracter = chr(mt_rand(48, 122));   // del '0' (48) a la 'z' (122)
    if (ctype_alnum($caracter)) {        // descarta : ; < = > ? @ [ \ ] ^ _ `
        $cadenaB .= $caracter;
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
<?php

}