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

/* $datos = [
    [
        "nombre",
        "vicente",
        16
    ],

    [
        "noemi",
        "ordenador",
        1234,
        12
    ]
];

if (!escribirAFichero("datos.txt", $datos)) {
    paginaError("No se han podido guradar los datos");
    exit;
} */






//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Prueba de ficheros", $barra);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{
?>

<?php
}

//vista
function cuerpo()
{
?>
<?php
}

/**
 * funcion para escribir en un fichero
 * @param string $nombre nombre del fichero
 * @param mixed $datos valores
 * @return bool devuelve si ejecuta correctamente o hay algún error
 */
function escribirAFichero(string $nombre, ?array $datos = null): bool
{
    //ruta en la que se guardará el fichero
    $ruta = RUTABASE . "/ficheros";
    //si no existe la ruta se crea
    if (!file_exists($ruta))
        mkdir($ruta);
    $ruta .= $nombre;

    //se abre el fichero para escritura
    //si existe se borra el contenido
    $fic = fopen($ruta, "w");
    if (!$fic)
        return false;

    //se recorre el array con los datos
    foreach ($datos as $fila) {
        $linea = "";
        foreach ($fila as $columna) {
            $linea .= $columna . ",";
        }
        $linea .= "\r\n";
        //se escribe en el fichero una linea
        fputs($fic, $linea);
    }
    //se cierra el fichero
    fclose($fic);
    return true;
}

/**
 * funcion para leer de un fichero
 * @param string $nombre nombre del fichero
 * @param mixed $datos valores
 * @return bool devuelve si ejecuta correctamente o hay algún error
 */
function leerDeFichero(string $nombre, array &$datos): bool
{
    //ruta en la que se guardará el fichero
    $ruta = RUTABASE . "/ficheros";
    //si no existe la ruta se crea
    if (!file_exists($ruta))
        mkdir($ruta);
    $ruta .= $nombre;
    //se abre el fichero para lectura
    //debe existir
    $fic = fopen($ruta, "r");
    if (!$fic)
        return false;
    //borro el contenido del array
    foreach ($datos as $pos => $valor) {
        unset($datos[$pos]);
    }
    //leo el fichero linea a linea
    while ($linea = fgets($fic)) {
        $linea = str_replace("\r", "", $linea);
        $linea = str_replace("\n", "", $linea);
        if ($linea != "") {
            $linea = explode(",", $linea);
            $datos[] = $linea;
        }
    }
    //se cierra el fichero
    fclose($fic);

    return true;
}
