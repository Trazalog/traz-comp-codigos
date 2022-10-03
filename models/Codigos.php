<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
* Representa la clase Codigos que genera
* y lee codigos QR y de Barras
* @autor Hugo Gallardo
*/
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
//Agregamos la libreria para genera códigos QR
require APPPATH . "/libraries/codigo_qr/phpqrcode/qrlib.php";

class Codigos extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

		public function generarQR($data, $config, $dir)
    {
				// creo el directorio sino existe
        // $dir = 'codigosQR/Traz-comp-Yudica';

        if (!file_exists($dir)) {

            $folder = mkdir($dir, 0777, TRUE);
            if ($folder) {
                log_message('DEBUG','#TRAZA|TRAZ-COMP-CODIGOS|generarQR($data, $config, $dir)| >> El folder no fue creado (o existia o no se pdo crear... Ver permisos de Server');
            }
        }

        $archivo =  $config['titulo'] . 'QR.png';
        $archivo = str_replace('/', '_', $archivo);
        $archivo = str_replace(':', '_', $archivo);
        $archivo = str_replace('*', '_', $archivo);
        $archivo = str_replace('|', '_', $archivo);
        $archivo = str_replace('<', '_', $archivo);
        $archivo = str_replace('>', '_', $archivo);
        $archivo = str_replace('?', '_', $archivo);
        $archivo = str_replace('"', '_', $archivo);
        $archivo = str_replace(' ', '_', $archivo);
        //$archivo = "archivo_QR.png";
        $filename = $dir .'/'. $archivo;
        unlink($filename);
        //$filename = $archivo;

        /* PARAMETROS DEL CODIGO QR*/
        $pixel = $config['pixel']; //Tamaño de Pixel
        $level = $config['level']; //Precisión: L(Baja) ; M(Media) ; Q(Alta) ; H(máxima)
        $framSize = $config['framSize']; //Tamaño en blanco, borde
        $contenido = $config['titulo'];
        foreach ($data as $key => $value) {
          $contenido .= "\n".$key.": ".$value;
        }

        //Generar código QR
        QRcode::png($contenido, $filename, $level, $pixel, $framSize);

        //El randomize concatenado es para que el navegador tome el cambio en el servidor y actualice el QR
        $rsp = $data;
        $rsp['filename'] = $filename . "?". rand(1, 3000);
        $rsp['dir'] = $dir;

        return $rsp;
    }



 //esta funcion crea el QR sin Label en los campos, se usa para el QR de No consumibles
 public function generarQRlite($data, $config, $dir)
 {
   

     if (!file_exists($dir)) {

         $folder = mkdir($dir, 0777, TRUE);
         if ($folder) {
             log_message('DEBUG','#TRAZA|TRAZ-COMP-CODIGOS|generarQR($data, $config, $dir)| >> El folder no fue creado (o existia o no se pdo crear... Ver permisos de Server');
         }
     }

     $archivo =  $config['titulo'] . 'QR.png';
     $archivo = str_replace('/', '_', $archivo);
     $archivo = str_replace(':', '_', $archivo);
     $archivo = str_replace('*', '_', $archivo);
     $archivo = str_replace('|', '_', $archivo);
     $archivo = str_replace('<', '_', $archivo);
     $archivo = str_replace('>', '_', $archivo);
     $archivo = str_replace('?', '_', $archivo);
     $archivo = str_replace('"', '_', $archivo);
     $archivo = str_replace(' ', '_', $archivo);
     //$archivo = "archivo_QR.png";
     $filename = $dir .'/'. $archivo;
     unlink($filename);
     //$filename = $archivo;

     /* PARAMETROS DEL CODIGO QR*/
     $pixel = $config['pixel']; //Tamaño de Pixel
     $level = $config['level']; //Precisión: L(Baja) ; M(Media) ; Q(Alta) ; H(máxima)
     $framSize = $config['framSize']; //Tamaño en blanco, borde
     $contenido = $config['titulo'];
     
     foreach ($data as $key => $value) {
       $contenido = $value;
     }
    
     //Generar código QR
     QRcode::png($contenido, $filename, $level, $pixel, $framSize);

     //El randomize concatenado es para que el navegador tome el cambio en el servidor y actualice el QR
     $rsp = $data;
     $rsp['filename'] = $filename . "?". rand(1, 3000);
     $rsp['dir'] = $dir;

     return $rsp;
 }



}
