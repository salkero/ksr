<?php
class ControllerErrorVisitedErrorPage extends Controller {
	private $error = array();

	public function index() {
	

		$this->load->language('extension/module/visited_pages');

	
		


		// chargement des elements de la vue
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']	= $this->load->controller('common/footer');

		// on affiche la vue
		$this->response->setOutput($this->load->view('error/error_visited',$data));
	}


	
}