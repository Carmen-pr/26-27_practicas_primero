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
<?php
//Ejemplo de round
//Redondea un número de punto flotante
echo "<br>".round(3.14159, 2);

//Ejemplo de floor
//Redondea hacia el entero inferior
echo "<br>".floor(4.3);

//Ejemplo de pow 
//Expresión exponencial
echo "<br>".pow(2, 3);

//Ejemplo de sqrt
//Raíz cuadrada
echo "<br>".sqrt(16);

//Ejemplo de entero a hexadecimal
//Convierte un número decimal a hexadecimal
echo "<br>".dechex(47); 

//Ejemplo de base 4 a base 8.
//La base 4 empieza en 0,1,2,3 y la base 8 empieza en 0,1,2,3,4,5,6,7.
//MIRAR EN CASA
$base4 = '33';
echo "<br>".base_convert($base4, 4, 8);

////Escogemos dos funciones distintas a las demas que ya hemos utilizado.
//Ejemplo de decimal a binario
echo "<br>".decbin(26);

//Ejemplo de octal a decimal
echo "<br>".octdec(decoct(45));

//Definir variables inicializadas con valores en binario, octal y hexadecimal
$binario = '11010';
$octal = '32';
$hexadecimal = '2F';

//Mostrar el valor de esas variables tanto en decimal como en la base en la que se han definido. 
//MIRAR EN CASA
echo "<br>".bindec($binario).base_convert($binario, 2, 2);
echo "<br>".octdec($octal).base_convert($octal, 8, 8);
echo "<br>".hexdec($hexadecimal).base_convert($hexadecimal, 16, 16);

}