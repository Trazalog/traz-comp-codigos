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

		// public function generarQR($data, $config)
    // {
		// 		creo el directorio sino existe
    //     $dir = COD.'temp/codigosQR/';

    //     $dir = base_url().'application/modules/'.COD.'temp/codigosQR/';

    //     $permisos = decoct('%o', fileperms('http://localhost/traz-tools/'), -4);
    //     clearstatcache();
    //     if (!file_exists($dir)) {
    //       mkdir($dir);
    //       $directorio = mkdir($dir, 0775);
    //     }


    //     $archivo = '[' . $config['titulo'] . ']' . 'QR.png';
    //     $archivo = str_replace('/', '_', $archivo);
    //     $archivo = str_replace(':', '_', $archivo);
    //     $archivo = str_replace('*', '_', $archivo);
    //     $archivo = str_replace('|', '_', $archivo);
    //     $archivo = str_replace('<', '_', $archivo);
    //     $archivo = str_replace('>', '_', $archivo);
    //     $archivo = str_replace('?', '_', $archivo);
    //     $archivo = str_replace('"', '_', $archivo);
    //     $archivo = "archivo_QR.png";
    //     unlink($archivo);
    //     $filename = $dir . $archivo;
    //     $filename = $archivo;

    //     /* PARAMETROS DEL CODIGO QR*/
    //     $tamano = $config['tamaño']; //Tamaño de Pixel
    //     $level = $config['level']; //Precisión: L(Baja) ; M(Media) ; Q(Alta) ; H(máxima)
    //     $framSize = $config['framSize']; //Tamaño en blanco, borde
    //     $contenido = $config['titulo'];
    //     foreach ($data as $key => $value) {
    //       $contenido .= "\n".$key.": ".$value;
    //     }

    //     Generar código QR
    //     QRcode::png($contenido, $filename, $level, $tamano, $framSize);

    //     $rsp = $data;
    //     $rsp['filename'] = $filename;
    //     $rsp['dir'] = $dir;

    //     return $rsp;
    // }

    public function generarQR($data, $config)
    {
				// creo el directorio sino existe
        $dir = 'codigosQR/Traz-comp-Yudica';

        if (!file_exists($dir)) {

            $folder = mkdir($dir, 0777, TRUE);
            if ($folder) {
                log_message('INFO','#TRAZA|#TRAZA|TRAZ-COMP-CODIGOS|generarQR($data, $config)| >> El folder no fue creado (o existia o no se pdo crear... Ver permisos de Server');
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
        unlink($archivo);
        $filename = $dir .'/'. $archivo;
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

        $rsp = $data;
        $rsp['filename'] = $filename;
        $rsp['dir'] = $dir;

        return $rsp;
    }
}
