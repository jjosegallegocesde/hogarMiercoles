<?php

namespace App\Controllers;

class Productos extends BaseController{
    
    public function index(){
        return view('registroProductos');
    }


    public function registrar(){
       
        //1. Recibo todos los datos enviados desde el formulario (vista)
        //Lo que tengo entre getPost("") es el name que puse a cada input
        $producto=$this->request->getPost("producto");
        $foto=$this->request->getPost("foto");
        $precio=$this->request->getPost("precio");
        $descripcion=$this->request->getPost("descripcion");
        $tipo=$this->request->getPost("tipo");

        //2. Crear un arreglo asociativo con los datos punto 1
        $datos=array(

            "producto"=>$producto,
            "foto"=>$foto,
            "precio"=>$precio,
            "descripcion"=>$descripcion,
            "tipo"=>$tipo
            
        );

        print_r($datos);




    }

}
