<?php

const MIA=56;

/**
 * Funcion que devuelve un numero
 * Si el numero es menor de 10 se dara un error
 *
 * @param integer $num Numero al que aplicar el doble
 * @return integer|false Devuelve el doble del argumento o false en caso de error
 */
function doble(int $num): int|false
{
    //$num es menor de 10, consideramos que hay un error
    if ($num < 10)
        return false;

    return 2 * $num;
}


function variosParametros(int $par1, string $par2="", float $par3=10.0):int|float
{
    static $cadena="";

    $cadena.=$par2;
     
    if (is_integer($par2))
        $par2=intval($par2);
      else 
        $par2=0;
    $par2=is_integer($par2)?intval($par2):0;


    $par3+=$par1+$par2;
    return $par3;
}


function suma(float $a, float $b, float ...$resto): float
{
    $res = $a + $b;
    foreach ($resto as $num)
        $res += $num;
    return $res;
}

function suma1(float $a, float $b, float ...$resto): float
{
    $res=0;
    for ($i=0; $i<func_num_args();$i++)
        $res += func_get_arg($i);
    return $res;
}
