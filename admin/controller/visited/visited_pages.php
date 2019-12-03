<?php
class ControllerVisitedVisitedPages extends Controller {
	private $error = array();

	public function index() {
		echo("visited pages");

		$this->load->language('visited/visited');

		$this->load->model('visited/visited');
		$this->document->setitle($this->language->get('heading_title'));

		$this->getList();
	}

	// on va chercher toutes les news
	public function getList(){

		// on prepare le fil d'arianne
		$data['breadcrumbs'] = array();

		// on remplit le fil d'arianne avec le lien de la page d'accueil\
		$data['breadcrumbs'][] = array(
			'text'	=>	$this->language->get('text_home'),
			'href'		=>	$this->url->link('common/dashboard', 'user_token='. $this->session->data['user_token'],true)	
		);

		$data['breadcrumb'][]	=	array(
			'text'	=> $this->language->get('heading_title'),
			'href'	=> $this->url->link('visited/visited_pages','user_token='. $this->session->data['user_token'],true)
		);

		$data['AllPages'] = array();
		$results = $this->model_visited_visited->getAllVisits();
		
		foreach($results as $result){
			$data['allPages'][]	= array(
				''	=> $result[''],
				''	=> $result[''],
				''	=> $result[''],
				''	=> $result[''],
				''	=> $result[''],
				''	=> $result[''],
				''	=> $result['']
			);
		}

		// on recupere le token
		$data['user_token']	= $this->session->['user_token'];

		// on prepare le message d'avertissement
		if(isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}else{
			$data['error_warning'] = '';
		}

		//on prepare la resussite des actions
		if(isset($this->session->data['success'])){
			$data['selected'] = (array)$this->request->post['selectd'];
		}else {
			$data['selected'] = array();
		}

		// chargement des elements de la vue
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']	= $this->load->controller('common/footer');

		// ona ffiche la vue
		//$this->response->setOutput($this->load->view('visited/visited',$data));
	}

	
}