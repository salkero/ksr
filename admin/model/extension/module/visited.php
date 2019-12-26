<?php
class ModelExtensionModuleVisited extends Model {

    //verification de la présence de la table
    public function checkVisitedTable() {

        $resultat = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "visited'");
        return $resultat;
    }



    //fonction d'ajout d'une visite.
    public function addVisit($url, $title, $date, $ip_address, $url_modifie, $user_id) {


                         $this->db->query("INSERT INTO ". DB_PREFIX . "visited (url, title, date, ip_address, url_modifie, user_id) 
                         VALUES (
                          '".$this->db->escape($url)."',
                          '".$this->db->escape($title)."',
                          '".$this->db->escape($date)."',
                          '".$this->db->escape($ip_address)."',
                          '".$this->db->escape($url_modifie)."',
                          ".$this->db->escape($user_id).")");
    }

    //fonction de suppression.                    
    public function removeVisit($visited_id){

        $this->db->query("DELETE FROM ".DB_PREFIX. "visited  WHERE visited_id = " .$visited_id);
                            
    }
    
    //fonction selection du nom de la categorie en fonction de son id.
    public function getNameCategory($category_id){

        $resultat = $this->db->query("SELECT name FROM ". DB_PREFIX . "category_description WHERE category_id = " .$category_id);
        return $resultat->row['name'];
    }
    
    //fonction de section de toute les visites. 
    public function getAllVisitedPages(){
        $resultat = $this->db->query("SELECT * FROM ". DB_PREFIX ."visited 
                                    WHERE title != 'Your Store' 
                                    AND title != 'Account Login' 
                                    AND title != 'Account Logout' 
                                    AND title != 'My Account'
                                    AND title != 'Register Account'
                                    AND title != 'Votre compte'
                                    AND title != 'Se connecter au compte'
                                    AND title != 'Se d&eacute;connecter du compte'
                                    AND title != 'Cr&eacute;er un compte'
                                    ");
        return $resultat->rows;
     }
     
    // fonction de section des dernieres 15 visites. 
    public function getLastFifteenMostVisited(){

     
        $resultat = $this->db->query("SELECT *, COUNT(*) as nb_visit 
                                    FROM " .DB_PREFIX."visited 
                                    WHERE title != 'Your Store' 
                                    AND title != 'Account Login' 
                                    AND title != 'Account Logout' 
                                    AND title != 'My Account'
                                    AND title != 'Register Account'
                                    AND title != 'Votre compte'
                                    AND title != 'Se connecter au compte'
                                    AND title != 'Se d&eacute;connecter du compte'
                                    AND title != 'Cr&eacute;er un compte'

                                    GROUP BY url 
                                    ORDER BY nb_visit 
                                    DESC LIMIT 15");
        return $resultat->rows;
    }

    public function install() {
        
        $this->db->query("CREATE TABLE IF NOT EXISTS " .DB_PREFIX. "visited (visited_id int NOT NULL AUTO_INCREMENT,
        url varchar(150),
        title varchar(35),
        date DATETIME,
        ip_address varchar(15),
        user_id int,
        url_modifie varchar(150),
        PRIMARY KEY (visited_id))");    
      
    }
    
    public function uninstall() {
        $this->db->query("DROP TABLE ".DB_PREFIX. "visited"); 
      
    }
     
    


}