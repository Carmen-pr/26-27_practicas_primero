<?php
/*
   Clase Punto: representa un punto con coordenadas x e y, color y grosor.
   Valida cada valor en los setters, lanza una excepción en el constructor
   si algún dato no es válido y bloquea propiedades dinámicas con __set.
*/

class Punto
{
    // ---------- Constantes públicas de la clase ----------
    public const COLORES = [
        "black" => ["nombre" => "negro", "rgb" => [0, 0, 0]],
        "red"   => ["nombre" => "rojo",  "rgb" => [255, 0, 0]],
        "green" => ["nombre" => "verde", "rgb" => [0, 255, 0]],
        "blue"  => ["nombre" => "azul",  "rgb" => [0, 0, 255]],
    ];

    public const GROSORES = [
        1 => "fino",
        2 => "medio",
        3 => "grueso",
    ];

    // ---------- Propiedades privadas ----------
    private int $_x;
    private int $_y;
    private string $_color;
    private int $_grosor;

    /**
     * Constructor de Punto: llama a los setters para validar cada parámetro.
     * Si algún setter devuelve false, lanza una excepción.
     *
     * @param int $x Coordenada X (0 a 20000).
     * @param int $y Coordenada Y (0 a 20000).
     * @param string $color Clave del color en COLORES.
     * @param int $grosor Código del grosor en GROSORES.
     * @throws Exception Si algún valor no cumple las restricciones.
     */
    public function __construct(int $x, int $y, string $color, int $grosor)
    {
        // Compruebo todos los setters; si alguno falla, lanzo excepción
        if (!$this->setX($x) || !$this->setY($y) || !$this->setColor($color) || !$this->setGrosor($grosor)) {
            throw new Exception("Datos no válidos para crear el punto");
        }
    }

    // ---------- Getters ----------

    /**
     * Devuelve la coordenada X.
     *
     * @return int
     */
    public function getX(): int
    {
        return $this->_x;
    }

    /**
     * Devuelve la coordenada Y.
     *
     * @return int
     */
    public function getY(): int
    {
        return $this->_y;
    }

    /**
     * Devuelve el color del punto.
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->_color;
    }

    /**
     * Devuelve el grosor del punto.
     *
     * @return int
     */
    public function getGrosor(): int
    {
        return $this->_grosor;
    }

    // ---------- Setters ----------

    /**
     * Asigna la coordenada X si está entre 0 y 20000.
     *
     * @param int $x
     * @return bool true si es correcto, false si no.
     */
    public function setX(int $x): bool
    {
        if ($x >= 0 && $x <= 20000) {
            $this->_x = $x;
            return true;
        }
        return false;
    }

    /**
     * Asigna la coordenada Y si está entre 0 y 20000.
     *
     * @param int $y
     * @return bool true si es correcto, false si no.
     */
    public function setY(int $y): bool
    {
        if ($y >= 0 && $y <= 20000) {
            $this->_y = $y;
            return true;
        }
        return false;
    }

    /**
     * Asigna el color si existe en la constante COLORES.
     *
     * @param string $color
     * @return bool true si es correcto, false si no.
     */
    public function setColor(string $color): bool
    {
        if (array_key_exists($color, self::COLORES)) {
            $this->_color = $color;
            return true;
        }
        return false;
    }

    /**
     * Asigna el grosor si existe en la constante GROSORES.
     *
     * @param int $grosor
     * @return bool true si es correcto, false si no.
     */
    public function setGrosor(int $grosor): bool
    {
        if (array_key_exists($grosor, self::GROSORES)) {
            $this->_grosor = $grosor;
            return true;
        }
        return false;
    }

    // ---------- Métodos mágicos ----------

    /**
     * Impide la creación de propiedades dinámicas lanzando una excepción.
     *
     * @param string $nombre Nombre de la propiedad.
     * @param mixed $valor Valor que se intenta asignar.
     * @throws Exception Siempre que se intente crear una propiedad dinámica.
     */
    public function __set(string $nombre, mixed $valor): void
    {
        throw new Exception("No se permiten propiedades dinámicas: " . $nombre);
    }

    /**
     * Devuelve el punto formateado como "x; y; color; grosor".
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->_x . "; " . $this->_y . "; " . $this->_color . "; " . $this->_grosor;
    }
}
