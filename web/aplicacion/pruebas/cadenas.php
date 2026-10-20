<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Cadenas", []);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{

    ?>

    El ni&ntilde;o me ha escrito una carta.
    Qué&eacute &lt;&gt; bonita

<?php
}
