<?php
class ControllerVisitedMostFifteenVisitedPages extends Controller {
	private $error = array();

	public function index() {
	

		$this->load->language('visited/visited_pages');

		$this->load->model('visited/visited');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->getList();
	}

	// on va chercher toutes les pages
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
			'href'	=> $this->url->link('visited/most_fifteen_visited_pages','user_token='. $this->session->data['user_token'],true)
		);

		$data['allPages'] = array();
		$results = $this->model_visited_visited->getLastFifteenMostVisited();
		
		foreach($results as $result){
			$data['allPages'][]	= array(
				'url'	=> $result['url'],
				'title'	=> $result['title'],
				'date'	=> $result['date'],
				'ip_address'	=> $result['ip_address'],
				'url_modifie'	=> $result['url_modifie'],
                                'user_id'	=> $result['user_id'],
                                'nombreVisite'	=> $result['nb_visit'],
                                
				
			);
		}

		// on recupere le token
		$data['user_token']	= $this->session->data['user_token'];

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

		// on affiche la vue
		$this->response->setOutput($this->load->view('visited/most_fifteen_visited_pages',$data));
	}

	
}