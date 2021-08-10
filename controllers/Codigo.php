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
		* @param array con datos
		* @return url donde esta guardado el QR generado
		*/
		public function generarQR(){

				$data = $this->input->post('data');
				$config = $this->input->post('config');

				log_message('DEBUG','#TRAZA|TRAZ-COMP-CODIGOS|generarQR()| $data >> '.json_encode($data));

				$resp = $this->Codigos->generarQR($data, $config);
				echo json_encode($resp);
		}

}
