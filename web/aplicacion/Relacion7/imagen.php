<?php
/*
   Página imagen.php de la Relación 7:
   Carga los puntos actuales del fichero puntos_dirip_navegador.dat del cliente,
   crea la imagen JPG al vuelo mediante GD (con fondo blanco, marco y los puntos)
   y fuerza su descarga en el navegador.
*/

// Cargo cabecera.php (para disponer de RUTABASE) y la clase Punto
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/clases/Punto.php");

// ---------- Nombre del fichero .dat del cliente (IP y navegador) ----------
$ip = $_SERVER["REMOTE_ADDR"] ?? "0_0_0_0";
$ipLimpia = str_replace([".", ":"], "_", $ip);

$agente = $_SERVER["HTTP_USER_AGENT"] ?? "";
$navegador = "otro";
if (stripos($agente, "Edg") !== false) {
    $navegador = "edge";
} elseif (stripos($agente, "Chrome") !== false) {
    $navegador = "chrome";
} elseif (stripos($agente, "Firefox") !== false) {
    $navegador = "firefox";
}

$rutaFichero = dirname(__FILE__) . "/datos/puntos_" . $ipLimpia . "_" . $navegador . ".dat";

// Cargo los puntos actuales desde el fichero del cliente
$puntos = [];
cargarPuntosImagen($rutaFichero, $puntos);

// Creo la imagen al vuelo en memoria con GD
$imagen = crearImagenAlVuelo($puntos);
if (!$imagen) {
    exit("No se ha podido generar la imagen");
}

// Nombre del fichero JPG que se descargará en el cliente
$nombreDescarga = "imagen_" . $ipLimpia . "_" . $navegador . ".jpg";

// Envío las cabeceras para devolver un JPG y forzar su descarga
header("Content-Type: image/jpeg");
header('Content-Disposition: attachment; filename="' . $nombreDescarga . '"');

// Envío la imagen JPG directamente a la salida, libero memoria y termino
imagejpeg($imagen);
imagedestroy($imagen);
exit;


// ======================= FUNCIONES DE IMAGEN.PHP =======================

/**
 * Carga en $puntos (por referencia) los puntos del fichero .dat del cliente.
 *
 * @param string $ruta Ruta completa del fichero puntos_dirip_navegador.dat.
 * @param array<int, Punto> &$puntos Array donde se cargan los puntos.
 * @return void
 */
function cargarPuntosImagen(string $ruta, array &$puntos): void
{
    $puntos = [];
    if (!file_exists($ruta)) {
        return;
    }

    // Abro el fichero en modo lectura
    $fic = fopen($ruta, "r");
    if (!$fic) {
        return;
    }

    // Leo línea a línea y creo cada objeto Punto válido
    while (($linea = fgets($fic)) !== false) {
        $linea = str_replace("\r", "", $linea);
        $linea = str_replace("\n", "", $linea);
        $linea = trim($linea);

        if ($linea !== "") {
            $partes = explode(";", $linea);
            if (count($partes) === 4) {
                try {
                    $puntos[] = new Punto(
                        (int) trim($partes[0]),
                        (int) trim($partes[1]),
                        trim($partes[2]),
                        (int) trim($partes[3])
                    );
                } catch (Exception $e) {
                    // Si alguna línea no es válida, la ignoro
                }
            }
        }
    }

    // Cierro el fichero
    fclose($fic);
}

/**
 * Crea al vuelo un recurso de imagen GD de 500x500 con fondo blanco,
 * marco y todos los puntos indicados.
 *
 * @param array<int, Punto> $puntos Array de objetos Punto a dibujar.
 * @return GdImage|false Recurso de imagen creado o false si falla.
 */
function crearImagenAlVuelo(array $puntos): GdImage|false
{
    $ancho = 500;
    $alto = 500;

    // Creo el lienzo en memoria
    $imagen = imagecreatetruecolor($ancho, $alto);
    if (!$imagen) {
        return false;
    }

    // Asigno el color blanco para el fondo y negro para el marco
    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);

    // Pinto el fondo blanco y el marco exterior
    imagefilledrectangle($imagen, 0, 0, $ancho - 1, $alto - 1, $blanco);
    imagerectangle($imagen, 0, 0, $ancho - 1, $alto - 1, $negro);

    // Dibujo cada punto según su color RGB y su grosor
    foreach ($puntos as $punto) {
        $rgb = Punto::COLORES[$punto->getColor()]["rgb"];
        $colorPunto = imagecolorallocate($imagen, $rgb[0], $rgb[1], $rgb[2]);

        $diametro = match ($punto->getGrosor()) {
            1 => 6,
            2 => 12,
            3 => 20,
            default => 10,
        };

        imagefilledellipse(
            $imagen,
            $punto->getX(),
            $punto->getY(),
            $diametro,
            $diametro,
            $colorPunto
        );
    }

    return $imagen;
}
