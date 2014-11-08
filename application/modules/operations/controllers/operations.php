<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OPerations extends MX_Controller
{
	//CONSTRUCTOR DE LA CLASE
	public function __construct()
	{
		parent::__construct();
	}

	//CREA UN NUEVO SLUG
	public function createSlug($incoming_string){        
        $tofind = "ÀÁÂÄÅàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
        $replac = "AAAAAaaaaOOOOooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
        $string =  utf8_encode(strtr(utf8_decode($incoming_string), 
                                utf8_decode($tofind),
                                $replac));
        $string =  strtolower($string);
        $string = str_replace(' ', '-', $string);

        return $string;
    } 	
}
