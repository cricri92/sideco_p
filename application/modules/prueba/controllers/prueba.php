<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prueba extends MX_Controller{

	//CONSTRUCTOR DE LA CLASE
	public function __construct()
	{
		parent::__construct();
		$this->load->library('mpdf');
	}

	public function index()
	{
		$planilla = $this->load->view('hola', $data, TRUE);

		$mpdf = new mPDF();
		$mpdf->WriteHTML($planilla);
		$mpdf->Output('planilla.pdf','I');
	}
}

?>