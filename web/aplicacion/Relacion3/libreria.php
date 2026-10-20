<?php

/**
* Posiciones (claves) que no se aceptan en cuentaVeces().
*/
const POSICIONES_NO_VALIDAS = ["2daw", "primera"];
/**
* 1. Añade un número a la posición asociativa indicada y devuelve el número de llamada.
* Si la posición ya existe en el array, el número se suma al valor que había.
*
* @param array $vector Array que se actualiza (paso por referencia).
* @param string $clave Posición asociativa donde se guarda el número.
* @param int|float $valor Número que se añade en esa posición.
* @param int $llamada Aquí se devuelve el número de llamada actual (paso por referencia).
* @return bool true si todo ha ido bien; false si la posición no es válida.
*/
function cuentaVeces(array &$vector, string $clave, int|float $valor, int
&$llamada): bool
{
// static: la variable conserva su valor entre una llamada y la siguiente
static $contadorLlamadas = 0;
$contadorLlamadas++;
$llamada = $contadorLlamadas; // se cuenta toda llamada, sea correcta o errónea
// Comprobación de argumentos
if ($clave === "" || in_array($clave, POSICIONES_NO_VALIDAS, true)) {
    return false;
}
// Si la posición ya existe se suma; si no, se crea
if (isset($vector[$clave])) {
    $vector[$clave] += $valor;
} else {
    $vector[$clave] = $valor;
}
    return true;
}


/**
* 2. Genera una cadena aleatoria con letras mayúsculas, minúsculas y números.
*
* @param int $longitud Número de caracteres de la cadena (por defecto 10).
* @return string|false La cadena generada; false si la longitud es 0 o negativa.
*/
function generarCadena(int $longitud = 10): string|false
{
if ($longitud <= 0) {
    return false;
}
// Todos los caracteres válidos: minúsculas, mayúsculas y números
    $caracteres = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
    $ultimo = count($caracteres) - 1;
    $cadena = "";
for ($i = 0; $i < $longitud; $i++) {
    $cadena .= $caracteres[mt_rand(0, $ultimo)];
}
    return $cadena;
}


/**
* 3. Realiza una operación con los operandos indicados.
* Tipos de operación:
* 1: suma todos los operandos.
* 2: al primer operando le resta el resto.
* 3: multiplica todos los operandos.
* otro: suma los operandos de posición par y resta los de posición impar (el primero es la posición 1).
*
* @param int $tipo Tipo de operación.
* @param int|float ...$operandos Valores numéricos (al menos dos).
* @return int|float|false El resultado; false si hay menos de dos operandos.
*/
function operaciones(int $tipo, int|float ...$operandos): int|float|false
{
// La función recibe al menos tres parámetros: el tipo y dos operandos como mínimo
if (count($operandos) < 2) {
    return false;
    }
switch ($tipo) {
    case 1:
        return array_sum($operandos);
    case 2:
        $resultado = $operandos[0];
        for ($i = 1; $i < count($operandos); $i++) {
        $resultado -= $operandos[$i];
        }
        return $resultado;
    case 3:
        return array_product($operandos);
    default:
        $resultado = 0;
        foreach ($operandos as $indice => $operando) {
            $posicion = $indice + 1; // el primer operando es la posición 1
            if ($posicion % 2 == 0) {
            $resultado += $operando; // posición par: se suma
            } else {
            $resultado -= $operando; // posición impar: se resta
            }
        }
        return $resultado;
    }   
}


/**
* 4. Devuelve el producto de tres números y deja la suma en el primer parámetro.
*
* @param int $num1 Primer número (paso por referencia): al salir contiene la suma de los tres.
* @param int $num2 Segundo número (por defecto 5).
* @param int $num3 Tercer número (por defecto 10).
* @return int El producto de los tres números.
*/
function devuelve(int &$num1, int $num2 = 5, int $num3 = 10): int
{
    $producto = $num1 * $num2 * $num3; // se calcula antes de modificar $num1
    $num1 = $num1 + $num2 + $num3; // la suma queda en el primer parámetro
    return $producto;
}


