<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Urls extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Obtiene la url asociada al token solicitado, siendo null si el token es invalido
     * @author RRuiz 
     * @param   $token, token provisto por url
     */
	public function obtener($token)
    {
        log_message('DEBUG', '#TRAZA | TRAZ-COMP-CODIGOS| URL | obtener()');
        $resource = '/token/'.$token;
        $url = REST_COD . $resource;
        $array = $this->rest->callApi('GET', $url);
        log_message('DEBUG','>> Respuesta ->'.json_encode($array['data']));
        return json_decode($array['data']);
    }


    /**
     * Obtiene la urls asociadas a funcionalidades
     * @author RRuiz 
     */
	public function obtenerUrls()
    {
        log_message('DEBUG', '#TRAZA | TRAZ-COMP-CODIGOS| URL | obtenerUrls()');
        $resource = '/urls';
        $url = REST_COD . $resource;
        $array = $this->rest->callApi('GET', $url);
        log_message('DEBUG','>> Respuesta ->'.json_encode($array['data']));
        return json_decode($array['data'])->urls->url;
    }
    
    /**
     * Guardar el token e id asociado a una determinada funcionalidad
     * @author RRuiz 
     * @param   $token, token provisto por url
     */
	public function guardar($funcionalidad,$id,$token)
    {        
        log_message("DEBUG", "#TRAZA | TRAZ-COMP-CODIGOS| URL | guardar()");
        $post['_post_token'] = array(   
            'funcionalidad' => $funcionalidad,
            'empr_id' => empresa(),
            'id' => $id,
            'token' => $token,
            'usuario_app' => userNick()
        );
        return wso2(REST_COD. '/token', 'POST', $post);
    }

}
