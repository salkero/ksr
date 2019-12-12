<?php
class ModelVisitedVisited extends Model {
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
    public function getAllVisits(){
        $resultat = $this->db->query("SELECT * FROM ". DB_PREFIX ."visited 
                                    WHERE title != 'Your Store' 
                                    AND title != 'Account Login' 
                                    AND title != 'Account Logout' 
                                    AND title != 'My Account'");
        return $resultat->rows;
     }
     
    // fonction de section des dernieres 15 visites. 
    public function getLastFifteenMostVisited(){

     
        $resultat = $this->db->query("SELECT *, COUNT(*) as nbVisit 
                                    FROM " .DB_PREFIX."visited 
                                    WHERE title != 'Your Store' 
                                    AND title != 'Account Login' 
                                    AND title != 'Account Logout' 
                                    AND title != 'My Account' 
                                    GROUP BY url 
                                    ORDER BY nbVisit 
                                    DESC LIMIT 15");
        return $resultat->rows;
    }

     
    


}