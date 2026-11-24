<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//controlador
// en el conmtrolador solo va los conroladores lo demas va abajo, en el controlador va la esructura de la pagina, el resto va en la vista



$barra = [
    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    [
        "TEXTO" => "pruebas",
        "ENLACE" => "./index.php" // Permite volver a la carpeta pruebas
    ],
    [
        "TEXTO" => "pruebas_fichero"
    ]
];


$nombreFichero = RUTABASE . "/imagenes/pruebaImagen.jpg";
$crear = false;

if ($crear) {
    $imagen = imagecreatetruecolor(250, 250);

    //genero el color indigo

    $color = imagecolorallocate($imagen, 75, 0, 130);
    //rellena un rectangulo
    imagefilledrectangle($imagen, 10, 10, 190, 190, $color);

    //dibujo una linea blanca
    $color = imagecolorallocate($imagen, 255, 255, 255);
    imagefilledrectangle($imagen, 10, 10, 100, 15, $color);

    imagejpeg($imagen, $nombreFichero);
}

if (isset($_GET["descargar"])) {

    $imagen = imagecreatefromjpeg($nombreFichero);
    $color = imagecolorallocate($imagen, 255, 255, 255);
    imagestring($imagen, 2, 10, 150, "marca agua", $color); //El string sirve para que muestre lo de la marca de agua
    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename="pruebaImagen.jpg"');
    imagejpeg($imagen);
    exit;
}


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Prueba imagen", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <!-- Aqui es donde va la imagen -->
    <br>
    <br>

    <img src="/imagenes/pruebaImagen.jpg" alt="imagen">
    <a href="?descargar">Descargar</a>
<?php


}
