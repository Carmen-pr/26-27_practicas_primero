<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
const N = 1000;   // número de lanzamientos grandes

function obtenerDatosDado() {
    // Parte 1: 6 tiradas con for y mt_rand(min, max)
    $tiradas = [];
    for ($i = 1; $i <= 6; $i++) {
        $tiradas[$i] = mt_rand(1, 6);
    }

    // Parte 2: N tiradas con while y mt_rand() sin parámetros
    $contador = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];
    $i = 0;
    while ($i < N) {
        $cara = mt_rand() % 6 + 1;   // el resto de dividir entre 6 va de 0 a 5; sumamos 1
        $contador[$cara]++;          // sumamos 1 a esa cara
        $i++;
    }

    return ["tiradas" => $tiradas, "contador" => $contador];
}

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{
    
}
//vista
function cuerpo()
{
?>
<?php
function mostrarDado($datos) {
    echo "<h1>LANZAMIENTO DE UN DADO</h1>";

    foreach ($datos["tiradas"] as $numero => $valor) {
        echo "lanzamiento $numero del dado: $valor<br>";
    }

    echo "<br>lanzado el dado " . N . " veces<br>";
    foreach ($datos["contador"] as $cara => $veces) {
        $porcentaje = round($veces / N * 100, 1);
        echo "el $cara ha salido $veces con un porcentaje de $porcentaje%<br>";
    }
}


$datos = obtenerDatosDado();
mostrarDado($datos);


}
?>
