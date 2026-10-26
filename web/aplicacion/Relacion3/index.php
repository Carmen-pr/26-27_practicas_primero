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

    /**
     *  EJERCICIO 1 ***********************************************************************************
     */

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

    /**
     *  EJERCICIO 2 ***********************************************************************************
     */
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

    /**
     *  EJERCICIO 3 ***********************************************************************************
     */

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

    /**
     *  EJERCICIO 4 *************************************************************************************
     */

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

    /**
     *  EJERCICIO 5 ***********************************************************************************
     */

    echo ("<h1>Ejercicio 5</h1>");

    foreach (["resta", "suma", "multiplicacion", "division"] as $operacion) {
        $resultado = hacerOperacion($operacion, 3, 1);
    if($resultado === false) {
    echo "hacerOperacion(\"$operacion\", 3, 1): ERROR (operación no válida)<br>";
    } else {
    echo "hacerOperacion(\"$operacion\", 3, 1) = $resultado<br>";
    }
    }

    /**
     *  EJERCICIO 6 ***********************************************************************************
     */

    echo ("<h1>Ejercicio 6</h1>");

    echo "<h3>Con funciones flecha</h3>";
    echo "Suma: " . llamadaAFuncion(2, 4, fn($a, $b) => $a + $b) . "<br>";
    echo "Resta: " . llamadaAFuncion(6, 4, fn($a, $b) => $a - $b) . "<br>";
    echo "Multiplicación: " . llamadaAFuncion(2, 4, fn($a, $b) => $a * $b) . "<br>";
    echo "<h3>Con funciones anónimas asignadas a variables</h3>";
        $sumar = function (int $a, int $b): int {
    return $a + $b;
    };
        $restar = function (int $a, int $b): int {
    return $a - $b;
    };
        $multiplicar = function (int $a, int $b): int {
    return $a * $b;
    };
    echo "Suma: " . llamadaAFuncion(2, 4, $sumar) . "<br>";
    echo "Resta: " . llamadaAFuncion(6, 4, $restar) . "<br>";
    echo "Multiplicación: " . llamadaAFuncion(2, 4, $multiplicar) . "<br>";

    /**
     *  EJERCICIO 7 ***********************************************************************************
     */

    echo ("<h1>Ejercicio 7</h1>");

        $palabras = ["uno", "grande", "caminos", "a"];
    if (ordenar($palabras)) {
    echo "Ordenado de más a menos caracteres: " . implode(", ", $palabras) ."<br>";
    } else {
    echo "ERROR: el array debe contener solo cadenas<br>";
    }
        $mezcla = ["uno", 5, "caminos"];
    if (ordenar($mezcla)) {
    echo "Ordenado: " . implode(", ", $mezcla) . "<br>";
    } else {
    echo "Ordenar con un elemento que no es cadena: ERROR" ."<br>";
    }
    
}
    