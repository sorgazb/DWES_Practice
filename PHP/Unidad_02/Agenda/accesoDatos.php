<?php
require_once 'contacto.php';

class AccesoDatos
{
    private $nombre;

    function __construct($n)
    {
        $this->nombre = $n;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }


    function insertarContacto(Contacto $c)
    {
        try {
            //Abrir el fichero
            $fichero = fopen($this->nombre, 'a+');
            //Insertar al final
            fwrite($fichero, $c->getIndice() . ';' . $c->getNombre() . ';' . $c->getTlf() . ';' . $c->getTipo() . ';' . $c->getFoto() . PHP_EOL);
        } catch (Throwable $e) {
            echo $e->getMessage();
        } finally {
            //Cerrar el fichero
            fclose($fichero);
        }
    }

    function obtenerContacto()
    {
        $resultado = array();
        try {
            if (file_exists($this->nombre)) { {
                    if (file_exists($this->nombre));
                    $tmp = file($this->nombre);
                    foreach ($tmp as $linea) {
                        $campos = explode(';', $linea);
                        //Creamos el objeto ticket
                        $resultado[] = new Contacto($campos[0], $campos[1], $campos[2],$campos[3],$campos[4]);
                    }
                }
            }
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerID(){
        $resultado = 0;
        try{
            if(file_exists($this->nombre)){
                $registros = file($this->nombre);
                //Obtengo el ultimo registro.
                $pos=sizeof($registros)-1;
                $campos = explode(';',$registros[$pos]);
                $resultado = $campos[0]+1;
            }
        }catch(Throwable $t){
            echo $t->getMessage();
        }
        return $resultado;
    }
}
