<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador 
// en el controlador solo va los conroladores lo demas va abajo, en el controlador va la esructura de la pagina, el resto va en la vista


//se crea una instancia de la clase prueba
$instancia=new ClasePrueba();

//accede a la propiedad pública de la instancia
$instancia->propPublica=50;


//se accede a la propiedad de clase (estática)
ClasePrueba::$propEstatica[1]=10;
$instancia::$propEstatica[2]=20;


//no hay constructor público por lo que tengo que
//llamar a las funciones de creacion estaticas
$p1 = Prueba::desdeDatos(5, `Objetos`);
$p2 = Prueba::desdeJson($datosJson);

$programa=Unica::crear(100);

$programa->numero=1;

$segunda=Unica::crear(300);

$ins=new Instituto;


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Clases e Instancias");
cuerpo();  //llamo a la vista
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

Class ClasePrueba{
//definición de constantes
public const PI=2.14;

//definición de propiedad
public int $propPublica=1;
private string $_propPrivada="hola";
protected float $_propProtegida=1.234;

//definición de propiedad estática
public static $propEstatica=array(1,2,3);

//definición de método
public function metodo(){
    //acceso a las propiedades desde el propio objeto
    $this->propPublica=13;
    $this->_propPrivada=100;
    $this->_propProtegida="adios";

    //acceso a la propiedad estática
    self::$propEstatica[0]="otra";

    return true;
    }
}

//Otro ejemplo de Clases
class Prueba {
    private ?int $_codigo;
    private ?string $_nombre;
 //el constructor es privado
    private function __construct(?int $codigo = null, ?string $nombre =
null) {
    $this->_codigo = $codigo;
    $this->_nombre = $nombre;
    }
//constructor estatico publico
public static function desdeDatos(int $codigo, string $nombre): static
{
    if ($codigo<0)
        $codigo =0;
//creo el objeto usando static
    $obj = new static($codigo, $nombre);
        return $obj;
    }
 //constructor estatico publico
 public static function desdeJson(string $json): static
{
    $datos = json_decode($json);
        return new static($datos->codigo, $datos->nombre);
    }
}


}

class Unica{
    private static bool $creada=false;
    public int $numeroÇ=12;

    private Unica $objeto = null;

    private __construct(int $val = 0)
    {
        $this->numero=12;
    }

    public static function crear(int $numero ):static
    {
        if (self::$_creada)
            return self::$_objeto;

        self::$_objeto=new static($numero);

    }

}