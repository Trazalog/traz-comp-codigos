<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Codigo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model( COD.'Codigos' );
    }

		/**
		* Genera codigos Qr a artir de info recibida
		* @param array con datos para el contenido del QR, $config configuracion de los parametros del QR, $direccion ubicacion en donde se generan los QR
		* @return url donde esta guardado el QR generado
		*/
		public function generarQR(){

				$data = $this->input->post('data');
				$config = $this->input->post('config');
				$direccion = $this->input->post('direccion');

				log_message('DEBUG','#TRAZA|TRAZ-COMP-CODIGOS|generarQR()| $data >> '.json_encode($data));

				$resp = $this->Codigos->generarQR($data, $config, $direccion);
				echo json_encode($resp);
		}


		/**
		* Genera codigos Qr liviano sin los label solo trae los datos, se usa para el codigo qr de no consumibles
		* @param array con datos para el contenido del QR, $config configuracion de los parametros del QR, $direccion ubicacion en donde se generan los QR
		* @return url donde esta guardado el QR generado
		*/
		public function generarQRlite(){

			$data = $this->input->post('data');
			$config = $this->input->post('config');
			$direccion = $this->input->post('direccion');

			log_message('DEBUG','#TRAZA|TRAZ-COMP-CODIGOS|generarQR()| $data >> '.json_encode($data));

			$resp = $this->Codigos->generarQRlite($data, $config, $direccion);
			echo json_encode($resp);
	}


}
generarQRlite