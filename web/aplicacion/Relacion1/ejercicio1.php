<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 1");
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
<h1>Funciones Matemáticas</h1>
<?php
//Ejemplo de round
//Redondea un número de punto flotante
echo "round(3.567, 2) = " . round(3.567, 2) . "<br>";   // 3.57

//Ejemplo de floor
//Redondea hacia el entero inferior
echo "floor(4.9) = " . floor(4.9) . "<br>";             // 4

//Ejemplo de pow 
//Expresión exponencial
echo "pow(2, 8) = " . pow(2, 8) . "<br>";               // 256

//Ejemplo de sqrt
//Raíz cuadrada
echo "sqrt(81) = " . sqrt(81) . "<br>";                 // 9

//Ejemplo de entero a hexadecimal
//Convierte un número decimal a hexadecimal
echo "dechex(255) = " . dechex(255) . "<br>";           // ff (entero a hexadecimal)

//Ejemplo de base 4 a base 8.
//La base 4 empieza en 0,1,2,3 y la base 8 empieza en 0,1,2,3,4,5,6,7.
//MIRAR EN CASA
echo "base_convert('123', 4, 8) = " . base_convert("123", 4, 8) . "<br>"; // de base 4 a 8

//Escogemos dos funciones distintas a las demas que ya hemos utilizado.
// abs: devuelve el valor absoluto (el número sin signo)
echo "abs(-5) = " . abs(-5) . "<br>";                   // función extra 1

// max: devuelve el mayor de los valores indicados
echo "max(3, 9, 2) = " . max(3, 9, 2) . "<br>";         // función extra 2

//Definir variables inicializadas con valores en binario, octal y hexadecimal
$bin = 0b1010;   // binario
$oct = 0755;     // octal
$hex = 0xFF;     // hexadecimal

//Mostrar el valor de esas variables tanto en decimal como en la base en la que se han definido. 
//MIRAR EN CASA
echo "Binario: decimal " . $bin . ", en binario " . decbin($bin) . "<br>";
echo "Octal: decimal " . $oct . ", en octal " . decoct($oct) . "<br>";
echo "Hexadecimal: decimal " . $hex . ", en hexadecimal " . dechex($hex) . "<br>";

}