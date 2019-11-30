<?php
class ControllerVisitedMostFifteenVisitedPages extends Controller {
	private $error = array();

	public function index() {
        echo("most 15 pages");

        $this->load->language('visited/visited');

        $this->load->model('visited/visited');
	}

	
}