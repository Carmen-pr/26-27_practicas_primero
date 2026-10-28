<?php


/**
 * Clase sobrecarga con el siguiente comportamiento:
 * - Si la propiedad empiza por m o M la doy por buena
 * - una propiedad sobrecargada siempre tendra el valor 234
 * 
 */

class ClaseSobrecargada{

    public int $numero=10;


    //metodos magicos para control de la sobrecarga
    public function __set( string $name, mixed $value):void
    {
        if (mb_substr(mb_strtoupper($name),0,1)!=='M')
                    throw new \Exception("La propiedad $name no existe");
        
    }

    public function __get(string $name):mixed
    {
        if (mb_substr(mb_strtoupper($name),0,1)!=='M')
                    throw new \Exception("La propiedad $name no existe");
        
        return 234;

    }

    public function __isset(string $name):bool  //Comprobar el metodo con la funcion __isset
    {
        //throw new \Exception('Not implemented')
        return (mb_substr(mb_strtoupper($name),0,1) ==='M'); //__iset false si no exite no lanza nada y por eso no salta la excepcion 
    }

    public function __unset(string $name):void //Se llama al metodo con la funcion __unset
    {
        //throw new \Exception('Not implemented')
        ;
    }

}