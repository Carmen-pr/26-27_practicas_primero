<?php
/*
   Relación 7: gestión de puntos guardados en puntos_dirip_navegador.dat
   y dibujados en /imagenes/puntos/imagen_dirip_navegador.jpg.
   Permite dar de alta puntos con validación y errores junto a cada campo,
   mostrarlos en un textarea y debajo la imagen con su enlace de descarga,
   borrar puntos desde un combo, descargar la imagen al vuelo desde imagen.php
   y subir un fichero .txt.
*/

// Cargo la plantilla y la clase Punto
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/clases/Punto.php");

// ---------- Nombre de ficheros personalizado por IP y navegador ----------
// Saco la IP del cliente y sustituyo caracteres conflictivos para el nombre de archivo
$ip = $_SERVER["REMOTE_ADDR"] ?? "0_0_0_0";
$ipLimpia = str_replace([".", ":"], "_", $ip);

// Miro el navegador desde HTTP_USER_AGENT
$agente = $_SERVER["HTTP_USER_AGENT"] ?? "";
$navegador = "otro";
if (stripos($agente, "Edg") !== false) {
    $navegador = "edge";
} elseif (stripos($agente, "Chrome") !== false) {
    $navegador = "chrome";
} elseif (stripos($agente, "Firefox") !== false) {
    $navegador = "firefox";
}

// Preparo la carpeta de datos y la ruta del fichero puntos_dirip_navegador.dat
$carpetaDatos = dirname(__FILE__) . "/datos";
if (!file_exists($carpetaDatos)) {
    mkdir($carpetaDatos, 0777, true);
}
$rutaFichero = $carpetaDatos . "/puntos_" . $ipLimpia . "_" . $navegador . ".dat";

// Preparo la carpeta /imagenes/puntos/ y las rutas de la imagen personalizada
$carpetaImagenes = RUTABASE . "/imagenes/puntos";
if (!file_exists($carpetaImagenes)) {
    mkdir($carpetaImagenes, 0777, true);
}
$nombreImagen = "imagen_" . $ipLimpia . "_" . $navegador . ".jpg";
$rutaImagen = $carpetaImagenes . "/" . $nombreImagen;
$urlImagen = "/imagenes/puntos/" . $nombreImagen;


// controlador
// Primero cargo los puntos del fichero del cliente en $puntos.
// Si la imagen aún no existe al conectarse el usuario, la creo inicialmente.
// Después, si llega POST, ejecuto la acción que corresponda.

$puntos = [];
cargarPuntos($rutaFichero, $puntos);

if (!file_exists($rutaImagen)) {
    generarImagenFichero($rutaImagen, $puntos);
}

$valores = [
    "x" => "",
    "y" => "",
    "color" => "",
    "grosor" => "",
];
$errores = [];

// Compruebo si se ha enviado algún formulario por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = textoPost("accion");

    if ($accion === "guardar") {
        // Valido y añado el nuevo punto; si es correcto, actualizo .dat e imagen
        procesarAlta($rutaFichero, $rutaImagen, $puntos, $valores, $errores);
    } elseif ($accion === "borrar") {
        // Borro el punto seleccionado y actualizo .dat e imagen
        procesarBorrado($rutaFichero, $rutaImagen, $puntos);
    } elseif ($accion === "subir") {
        // Leo el .txt subido, añado los puntos válidos y actualizo .dat e imagen
        procesarSubidaTxt($rutaFichero, $rutaImagen, $puntos);
    }
}

// Preparo el array de datos que recibe la vista
$datos = [
    "puntos" => $puntos,
    "valores" => $valores,
    "errores" => $errores,
    "urlImagen" => $urlImagen,
];

// Barra de ubicación
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php", "ADICIONAL" => " &gt; "],
    ["TEXTO" => "Relación 7", "ENLACE" => "index.php", "ADICIONAL" => " &gt; "],
    ["TEXTO" => "Ejercicio 7"],
];

// dibuja la plantilla de la vista
inicioCabecera("Relación 7");
cabecera();
finCabecera();
inicioCuerpo("Relación 7", $ubicacion);
cuerpo($datos);   // llamo a la vista y le paso los datos por parámetro
finCuerpo();
// **********************************************************

// ======================= FUNCIONES DEL CONTROLADOR =======================

/**
 * Coge un dato de $_POST y lo devuelve siempre como string.
 * Si no existe o no es string, devuelve una cadena vacía.
 *
 * @param string $campo Nombre del campo en $_POST.
 * @return string
 */
function textoPost(string $campo): string
{
    $valor = $_POST[$campo] ?? "";
    return is_string($valor) ? $valor : "";
}

/**
 * Carga en $puntos (por referencia) los puntos guardados en el fichero .dat.
 * Si el fichero no existe, deja $puntos vacío.
 *
 * @param string $ruta Ruta completa del fichero .dat.
 * @param array<int, Punto> &$puntos Array donde se cargan los puntos.
 * @return bool true si se pudo leer (o no existía), false si hubo error al abrir.
 */
function cargarPuntos(string $ruta, array &$puntos): bool
{
    foreach ($puntos as $pos => $valor) {
        unset($puntos[$pos]);
    }
    $puntos = [];

    if (!file_exists($ruta)) {
        return true;
    }

    // Abro el fichero en modo lectura
    $fic = fopen($ruta, "r");
    if (!$fic) {
        return false;
    }

    // Leo línea a línea y creo los objetos Punto válidos
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
                    // Si alguna línea no cumple las reglas de Punto, la omito
                }
            }
        }
    }

    // Cierro el fichero
    fclose($fic);
    return true;
}

/**
 * Guarda todos los puntos del array en el fichero .dat (uno por línea).
 *
 * @param string $ruta Ruta completa del fichero .dat.
 * @param array<int, Punto> $puntos Array de objetos Punto.
 * @return bool true si se guardó correctamente, false si falló la apertura.
 */
function guardarPuntos(string $ruta, array $puntos): bool
{
    // Abro el fichero en modo escritura (truncando su contenido anterior)
    $fic = fopen($ruta, "w");
    if (!$fic) {
        return false;
    }

    foreach ($puntos as $punto) {
        fputs($fic, $punto . PHP_EOL);
    }

    // Cierro el fichero
    fclose($fic);
    return true;
}

/**
 * Crea o actualiza en disco la imagen JPG personalizada del cliente
 * con fondo blanco, marco y los puntos actuales.
 *
 * @param string $rutaImagen Ruta completa del fichero imagen_dirip_navegador.jpg.
 * @param array<int, Punto> $puntos Array de objetos Punto a dibujar.
 * @return bool true si se generó correctamente, false en caso contrario.
 */
function generarImagenFichero(string $rutaImagen, array $puntos): bool
{
    $carpeta = dirname($rutaImagen);
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    // Creo el lienzo de 500x500 y asigno blanco para el fondo y negro para el marco
    $ancho = 500;
    $alto = 500;
    $imagen = imagecreatetruecolor($ancho, $alto);
    if (!$imagen) {
        return false;
    }

    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);

    // Relleno el fondo de blanco y dibujo el marco exterior
    imagefilledrectangle($imagen, 0, 0, $ancho - 1, $alto - 1, $blanco);
    imagerectangle($imagen, 0, 0, $ancho - 1, $alto - 1, $negro);

    // Dibujo cada punto con su color RGB de Punto::COLORES y su grosor
    foreach ($puntos as $punto) {
        $rgb = Punto::COLORES[$punto->getColor()]["rgb"];
        $colorPunto = imagecolorallocate($imagen, $rgb[0], $rgb[1], $rgb[2]);

        $diametro = match ($punto->getGrosor()) {
            1 => 3,
            2 => 6,
            3 => 10,
            default => 5,
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

    // Guardo la imagen JPG en disco y libero memoria
    $ok = imagejpeg($imagen, $rutaImagen);
    imagedestroy($imagen);

    return $ok;
}

/**
 * Valida el formulario de alta (x e y entre 0 y 500, color y grosor).
 * Si no hay errores, crea el Punto, actualiza .dat e imagen y redirige.
 * Si hay errores, rellena $valores y $errores por referencia.
 *
 * @param string $rutaFichero Ruta del fichero .dat.
 * @param string $rutaImagen Ruta del fichero .jpg.
 * @param array<int, Punto> &$puntos Array de puntos.
 * @param array &$valores Valores introducidos en el formulario.
 * @param array &$errores Mensajes de error por campo.
 * @return void
 */
function procesarAlta(string $rutaFichero, string $rutaImagen, array &$puntos, array &$valores, array &$errores): void
{
    $xTexto = trim(textoPost("x"));
    $yTexto = trim(textoPost("y"));
    $color = textoPost("color");
    $grosorTexto = trim(textoPost("grosor"));

    $valores = [
        "x" => $xTexto,
        "y" => $yTexto,
        "color" => $color,
        "grosor" => $grosorTexto,
    ];
    $errores = [];

    // ---- Coordenada X: entero entre 0 y 500 ----
    if ($xTexto === "" || preg_match('/^-?\d+$/', $xTexto) !== 1) {
        $errores["x"] = "La coordenada X debe ser un número entero";
    } else {
        $xNum = (int) $xTexto;
        if ($xNum < 0 || $xNum > 500) {
            $errores["x"] = "La coordenada X debe estar entre 0 y 500";
        }
    }

    // ---- Coordenada Y: entero entre 0 y 500 ----
    if ($yTexto === "" || preg_match('/^-?\d+$/', $yTexto) !== 1) {
        $errores["y"] = "La coordenada Y debe ser un número entero";
    } else {
        $yNum = (int) $yTexto;
        if ($yNum < 0 || $yNum > 500) {
            $errores["y"] = "La coordenada Y debe estar entre 0 y 500";
        }
    }

    // ---- Color: debe existir en Punto::COLORES ----
    if ($color === "" || !array_key_exists($color, Punto::COLORES)) {
        $errores["color"] = "Debe seleccionar un color válido";
    }

    // ---- Grosor: debe existir en Punto::GROSORES ----
    $grosorNum = 0;
    if ($grosorTexto === "" || !ctype_digit($grosorTexto)) {
        $errores["grosor"] = "Debe seleccionar un grosor";
    } else {
        $grosorNum = (int) $grosorTexto;
        if (!array_key_exists($grosorNum, Punto::GROSORES)) {
            $errores["grosor"] = "El grosor seleccionado no es válido";
        }
    }

    // Si todo es válido, añado el punto, actualizo el fichero y la imagen, y redirijo
    if (count($errores) === 0) {
        try {
            $puntos[] = new Punto((int) $xTexto, (int) $yTexto, $color, $grosorNum);
            guardarPuntos($rutaFichero, $puntos);
            generarImagenFichero($rutaImagen, $puntos);
            header("Location: index.php");
            exit();
        } catch (Exception $e) {
            $errores["x"] = $e->getMessage();
        }
    }
}

/**
 * Borra el punto seleccionado en el desplegable, actualiza el fichero .dat
 * y la imagen personalizada, y recarga index.php.
 *
 * @param string $rutaFichero Ruta del fichero .dat.
 * @param string $rutaImagen Ruta del fichero .jpg.
 * @param array<int, Punto> &$puntos Array de puntos.
 * @return void
 */
function procesarBorrado(string $rutaFichero, string $rutaImagen, array &$puntos): void
{
    $indiceTexto = trim(textoPost("indice_borrar"));
    if ($indiceTexto !== "" && ctype_digit($indiceTexto)) {
        $indice = (int) $indiceTexto;
        if (isset($puntos[$indice])) {
            unset($puntos[$indice]);
            $puntos = array_values($puntos);
            guardarPuntos($rutaFichero, $puntos);
            generarImagenFichero($rutaImagen, $puntos);
            header("Location: index.php");
            exit();
        }
    }
}

/**
 * Lee el fichero .txt subido mediante $_FILES, añade los puntos válidos
 * y actualiza el fichero .dat y la imagen personalizada.
 *
 * @param string $rutaFichero Ruta del fichero .dat.
 * @param string $rutaImagen Ruta del fichero .jpg.
 * @param array<int, Punto> &$puntos Array de puntos.
 * @return void
 */
function procesarSubidaTxt(string $rutaFichero, string $rutaImagen, array &$puntos): void
{
    if (!isset($_FILES["fichero_txt"]) || $_FILES["fichero_txt"]["error"] !== UPLOAD_ERR_OK) {
        return;
    }

    $ficTxt = fopen($_FILES["fichero_txt"]["tmp_name"], "r");
    if (!$ficTxt) {
        return;
    }

    $hayCambios = false;
    while (($linea = fgets($ficTxt)) !== false) {
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
                    $hayCambios = true;
                } catch (Exception $e) {
                    // Si alguna línea no es válida, no la añado
                }
            }
        }
    }

    // Cierro el fichero temporal
    fclose($ficTxt);

    if ($hayCambios) {
        guardarPuntos($rutaFichero, $puntos);
        generarImagenFichero($rutaImagen, $puntos);
        header("Location: index.php");
        exit();
    }
}


// ======================= VISTA =======================

/**
 * Cosas extra de la cabecera (de momento no hay nada).
 *
 * @return void
 */
function cabecera() {}

/**
 * Escapa un valor para mostrarlo de forma segura en HTML.
 *
 * @param mixed $valor Valor a mostrar.
 * @return string Texto escapado.
 */
function esc(mixed $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}

/**
 * Si el campo tiene un error, escribe el mensaje correspondiente.
 *
 * @param array $errores Errores por campo.
 * @param string $campo Nombre del campo.
 * @return void
 */
function mostrarError(array $errores, string $campo): void
{
    if (isset($errores[$campo])) {
        echo '<span style="color:red;">' . esc($errores[$campo]) . '</span>';
    }
}

/**
 * Vista principal: muestra los formularios de alta, borrado y subida de .txt,
 * el textarea con los puntos almacenados y debajo la imagen con descarga.
 *
 * @param array $datos Datos preparados por el controlador.
 * @return void
 */
function cuerpo(array $datos): void
{
    $puntos = $datos["puntos"];
    $valores = $datos["valores"];
    $errores = $datos["errores"];
    $urlImagen = $datos["urlImagen"];
?>
    <h2>Relación 7: gestión de puntos</h2>

    <!-- Formulario 1: añadir un punto (x e y entre 0 y 500, color y grosor) -->
    <form method="post" action="index.php">
        <input type="hidden" name="accion" value="guardar">
        <p>
            <label>Coordenada X (0 a 500):
                <input type="text" name="x" value="<?php echo esc($valores["x"]); ?>">
            </label>
            <?php mostrarError($errores, "x"); ?>
        </p>
        <p>
            <label>Coordenada Y (0 a 500):
                <input type="text" name="y" value="<?php echo esc($valores["y"]); ?>">
            </label>
            <?php mostrarError($errores, "y"); ?>
        </p>
        <p>
            <label>Color:
                <select name="color">
                    <option value="">-- Elige un color --</option>
                    <?php foreach (Punto::COLORES as $clave => $info) { ?>
                        <option value="<?php echo esc($clave); ?>"
                            <?php if ($valores["color"] === $clave) {
                                echo "selected";
                            } ?>>
                            <?php echo esc($info["nombre"]); ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <?php mostrarError($errores, "color"); ?>
        </p>
        <p>
            Grosor:
            <?php foreach (Punto::GROSORES as $codigo => $nombre) { ?>
                <label>
                    <input type="radio" name="grosor" value="<?php echo $codigo; ?>"
                        <?php if ($valores["grosor"] === (string) $codigo) {
                            echo "checked";
                        } ?>>
                    <?php echo esc($nombre); ?>
                </label>
            <?php } ?>
            <?php mostrarError($errores, "grosor"); ?>
        </p>
        <p><input type="submit" value="Guardar punto"></p>
    </form>

    <hr>

    <!-- Textarea con todos los puntos almacenados, uno por línea -->
    <p>
        <label for="puntos_guardados">Puntos almacenados:</label><br>
        <textarea id="puntos_guardados" rows="8" cols="45" readonly><?php
                                                                    foreach ($puntos as $punto) {
                                                                        echo esc((string) $punto) . PHP_EOL;
                                                                    }
                                                                    ?></textarea>
    </p>

    <!-- Imagen generada y enlace de descarga debajo del textarea -->
    <p>
        <label>Imagen generada:</label><br>
        <img src="<?php echo esc($urlImagen); ?>?v=<?php echo time(); ?>"
            alt="Imagen de puntos" width="300" height="300"><br>
        <a href="imagen.php">Descargar imagen</a>
    </p>

    <!-- Formulario 2: borrar el punto seleccionado -->
    <?php if (count($puntos) > 0) { ?>
        <form method="post" action="index.php">
            <input type="hidden" name="accion" value="borrar">
            <p>
                <label>Punto a borrar:
                    <select name="indice_borrar">
                        <?php foreach ($puntos as $indice => $punto) { ?>
                            <option value="<?php echo $indice; ?>">
                                <?php echo esc((string) $punto); ?>
                            </option>
                        <?php } ?>
                    </select>
                </label>
                <input type="submit" value="Borrar">
            </p>
        </form>
    <?php } ?>

    <hr>

    <!-- Formulario 3: subir fichero .txt con puntos -->
    <form method="post" action="index.php" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="subir">
        <p>
            <label>Fichero .txt:
                <input type="file" name="fichero_txt" accept=".txt">
            </label>
            <input type="submit" value="Subir fichero">
        </p>
    </form>
<?php
}
