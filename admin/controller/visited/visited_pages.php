<?php
class ControllerVisitedVisitedPages extends Controller {
	private $error = array();

	public function index() {
		echo("visited pages");

		$this->load->language('visited/visited');

        $this->load->model('visited/visited');
	}

	
}