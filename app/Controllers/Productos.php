<?php

namespace App\Controllers;

//Se trae (importa) el modelo de datos
use App\Models\ProductoModelo;

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

        //2. Valido que llego
        if($this->validate('producto')){

            //3. se organizan los datos en un array
            //los naranjados (claves) deben coindicir
            //con el nombre de las columnas de BD
            $datos=array(
                "producto"=>$producto,
                "foto"=>$foto,
                "precio"=>$precio,
                "descripcion"=>$descripcion,
                "tipo"=>$tipo
            );

            //4 intentamos grabar los datos en BD
            try{

                $modelo=new ProductoModelo();
                $modelo->insert($datos);
                return redirect()->to(site_url('/productos/registro'))->with('mensaje',"exito agregando el producto");



            }catch(\Exception $error){

                return redirect()->to(site_url('/productos/registro'))->with('mensaje',$error->getMessage());
            }
           

        }else{

            $mensaje="tienes datos pendientes";
            return redirect()->to(site_url('/productos/registro'))->with('mensaje',$mensaje);
        }


        




    }

    public function buscar(){
        try{

            $modelo=new ProductoModelo();
            $resultado=$modelo->findAll();
            $productos=array('productos'=>$resultado);
            return view('listaProductos',$productos);


        }catch(\Exception $error){
            return redirect()->to(site_url('/productos/registro'))->with('mensaje',$error->getMessage());

        }
       
    }

    public function eliminar($id){

       try{

        $modelo=new ProductoModelo();
        $modelo->where('id',$id)->delete();
        return redirect()->to(site_url('/productos/registro'))->with('mensaje',"exito eliminando el producto");




       }catch(\Exception $error){
            return redirect()->to(site_url('/productos/registro'))->with('mensaje',$error->getMessage());

        }
    }

    public function editar($id){

        //recibo datos
        $producto=$this->request->getPost("producto");
        $precio=$this->request->getPost("precio");

        //validacion de datos

        //Organizo los datos en un array asociativo
        $datos=array(
            'producto'=>$producto,
            'precio'=>$precio
        );

        //echo("estamos editando el producto ".$id);
        //print_r($datos);

        //crear un objeto del modelo
        try{

            $modelo=new ProductoModelo();
            $modelo->update($id,$datos);
            return redirect()->to(site_url('/productos/registro'))->with('mensaje',"exito editando el producto");



        }catch(\Exception $error){

            return redirect()->to(site_url('/productos/registro'))->with('mensaje',$error->getMessage());
        }

    }

}
