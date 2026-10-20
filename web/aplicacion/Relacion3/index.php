<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/libreria.php");

//controlador

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt;&gt; "],
    ["TEXTO" => "Relación 3"]
];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relación 3: Funciones", $ubicacion);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{

    echo ("<h1>Ejercicio 1</h1>");
    
    $vector = []; // el array empieza vacío
    $numero = 0; // aquí la función devuelve el número de llamada
    $llamadas = [["posicion", 7], ["otra", 2], ["posicion", 2], ["2daw", 5], ["primera", 1]];
    foreach ($llamadas as [$clave, $valor]) {
    // Se comprueba si la llamada ha sido correcta o errónea
    if (cuentaVeces($vector, $clave, $valor, $numero)) {
    echo "Llamada $numero con '$clave': correcta<br>";
    } else {
    echo "Llamada $numero con '$clave': ERROR (posición no válida)<br>";
    }
    }
    echo "<pre>" . print_r($vector, true) . "</pre>";

    echo ("<h1>Ejercicio 2</h1>");

    foreach ([7, 20, -1, 0] as $longitud) {
        $cadena = generarCadena($longitud);
        if ($cadena === false) {
    echo "generarCadena($longitud): ERROR (longitud no válida)<br>";
    } else {
    echo "generarCadena($longitud): $cadena<br>";
    }
    }
    echo "generarCadena() con el valor por defecto: " . generarCadena() . "<br>";

    echo ("<h1>Ejercicio 3</h1>");

        $resultado = operaciones(1, 2, 5, 7, 3, 4);
    echo "operaciones(1, 2, 5, 7, 3, 4) suma todos: $resultado<br>";
        $resultado = operaciones(2, 20, 5, 3);
    echo "operaciones(2, 20, 5, 3) al primero le resta el resto: $resultado<br>";
        $resultado = operaciones(3, 2, 5, 7);
    echo "operaciones(3, 2, 5, 7) multiplica todos: $resultado<br>";
        $resultado = operaciones(5, 2, 5, 7, 3, 4);
    echo "operaciones(5, 2, 5, 7, 3, 4) pares menos impares: $resultado<br>";
        $resultado = operaciones(1, 5);
// Aquí 0 sería un resultado válido, por eso se compara con === false
    echo "operaciones(1, 5): " . ($resultado === false ? "ERROR (faltan operandos)" : $resultado) . "<br>";

    echo ("<h1>Ejercicio 4</h1>");
    
        $valor = 7;
        $producto = devuelve($valor, 4, 8); // los tres parámetros
    echo "devuelve(\$valor, 4, 8): producto $producto, \$valor ahora vale $valor<br>";
        $valor = 7;
        $producto = devuelve($valor); // solo el primero
    echo "devuelve(\$valor): producto $producto, \$valor ahora vale $valor<br>";
        $valor = 7;
        $producto = devuelve($valor, 4); // el primero y el segundo
    echo "devuelve(\$valor, 4): producto $producto, \$valor ahora vale $valor<br>";
        $valor = 7;
        $producto = devuelve($valor, num3: 6); // el primero y el tercero (argumento con nombre)
    echo "devuelve(\$valor, num3: 6): producto $producto, \$valor ahora vale $valor<br>";

    echo ("<h1>Ejercicio 5</h1>");

    echo ("<h1>Ejercicio 6</h1>");

    echo ("<h1>Ejercicio 7</h1>");

    
}
    