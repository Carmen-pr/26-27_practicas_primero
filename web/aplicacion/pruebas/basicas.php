<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("pruebas basicas");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <br><br>esto es html // esto es un comentario;
    <?php 
        echo "klñfffdj"; 

        $var1=25;
        $cadena="esto es una cadena";

        $var1+=12;
        echo $var1;

        $una_cadena="hola";
        $unaCadena="adios";

        $var1-=17;

        echo "$var1";

        $unaCadena=45;
        echo $unaCadena; //$unaCadena = 45;
        if (isset($cadena2)) //$cadena2 = uninitialized;
            echo $cadena2;

        $real=1234.56789012345678901; $real = 1234.3456789012346;
        $real+=0.432109876542; $real = 1234.3456789012346;

        $real=1234.5678901; 
        $real+= 0.4321099;

        //$real=12 * "hola";

        echo "el numero es: $var1<br>";
        echo 'el numero es: $var1<br>';



?>
  
<?php
}
