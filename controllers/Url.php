<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Clase para generar links con token para ser enviados por correo a 
 */
class Url extends CI_Controller
{
  

    public function __construct()
    {
        parent::__construct();
        $this->load->model( COD.'Urls' );
    }

        /**
        * Obtiene Url asociada a un token y redirige a la pagina configurada en la tabla qru.urls
        * @author rruiz
        */
        public function index(){
            
            $token=$this->input->get('token');  
            log_message("DEBUG","#TRAZA | TRAZ-COMP-CODIGOS| URL | Token: ".$token);

            
            $respuesta = $this->Urls->obtener($token); 
            $redirect = $respuesta->funcionalidad->url;
            $id = $respuesta->funcionalidad->id;
            
            if( isset($redirect) ){
                // El token existia y tiene una url donde redirigir
            
                // reemplazo el %id por el valor de id de existir
                $redirect=str_replace("{id}",$id,$redirect);

                log_message("DEBUG","Redirigiendo a : ".$redirect);
                redirect(base_url($redirect));
            }
            else {
                log_message("DEBUG","Token inválido:".$token);
                // Si no exisitia la url, devuelve un código de error
                echo "7000-Token_invalido";
            }

        }


        /**
        * Genera y guarda un nuevo token para una funcionalidad determinada
        * @author rruiz
        */
        public function generarLink($funcionalidad, $id){

            log_message("DEBUG","#TRAZA | TRAZ-COMP-CODIGOS| URL | generarLink");
            $token = md5(uniqid() . microtime() . rand()).md5(date('m/d/Y h:i:s a', time()));
            log_message("DEBUG","Token generado: ".$token);

            $this->Urls->guardar($funcionalidad,$id,$token);
            log_message("DEBUG","Url generada: ".base_url('/traz-comp-codigos/Url?token='.$token));

            return base_url('/traz-comp-codigos/Url?token='.$token);

        }



        /**
        * para probar generacion link
        * @author rruiz
        */
        public function testgenerarLink(){
            log_message("DEBUG","#TRAZA | TRAZ-COMP-CODIGOS| URL | testgenerarlink");
            $this->generarLink('showholis','777');
        }
    }
