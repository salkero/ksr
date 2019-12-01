<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		// Visited
		$this->load->model('setting/extension');
		$this->load->model('visited/visited');

		// fonction pour aller chercher le nom du produit
		$this->load->model('catalog/product');
		
		//print_r($this->request->get['route']);
		
		//$productSalah = $this->model_catalog_product->getProduct('49');
		//print_r($productSalah['name']);

		$uri= ($_SERVER["REQUEST_URI"]);
		
		if (strstr( $uri, 'path=')){
            // path=20_27&
			$pathPos = strpos($uri,"path=");
			$lastEperluet = strrpos($uri,"&");
			$endPos = $lastEperluet - $pathPos;

			$pathAndId = substr($uri,$pathPos,$endPos);
			
			// on enleve le mot path donc il va rester '&'
			$testId = substr(strrchr($pathAndId, "="), 1);
			
			//20_27
			$lesId = explode("_", $testId);
			echo($lesId[0]." ".$lesId[1]);

			$infoCategorie = $this->model_visited_visited->getNameCategory($lesId[0]);
			
			echo($infoCategorie);
			// foreach($infoCategorie as $category){
			// 	echo($category[0]);
			// }


		}




		if ( strstr( $uri, 'product_id=' ) ) {
			$productId =	substr(strrchr($uri, "="), 1);
			//echo($productId);
			$infoProduct = $this->model_catalog_product->getProduct($productId);
			
			$newUri= str_replace("&", "/", $uri);
			
			//print_r($infoProduct['name']);
			$newUri = str_replace("product_id=".$productId, $infoProduct['name'], $newUri);
            //echo ($newUri);
		  
		} else {
			echo ($uri);
		  }
		

	    // transformer cette url :
		//tp2opencart/index.php?route=product/product&path=20_27&product_id=41
		// a cette url:
		//tp2opencart/index.php?route=product/product&path=20_27&samsung10gti


		



		$data['analytics'] = array();

		$analytics = $this->model_setting_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get('analytics_' . $analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get('analytics_' . $analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts('header');
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}

		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));
		
		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');
		
		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');
		$data['menu'] = $this->load->controller('common/menu');

		return $this->load->view('common/header', $data);
	}
}
