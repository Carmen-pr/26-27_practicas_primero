<?php


// Clase sin sobre cargar

class ClaseSinsobrecargar{

    public int $numero=10;


    //metodos magicos para control de la sobrecarga
    public function __set( string $name, mixed $value):void
    {
        throw new \Exception("La propiedad $name no existe");
        
    }

    public function __get(string $name):mixed
    {
        throw new \Exception("La propiedad $name no existe");

    }

    public function __isset(string $name):bool  //Comprobar el metodo con la funcion __isset
    {
        //throw new \Exception('Not implemented')
        return false; //__iset false si no exite no lanza nada y por eso no salta la excepcion 
    }

    public function __unset(string $name):void //Se llama al metodo con la funcion __unset
    {
        //throw new \Exception('Not implemented')
        ;
    }

}