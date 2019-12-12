<?php
class ModelVisitedVisited extends Model {
    //fonction d'ajout
    public function addVisite($url, $title, $date, $ip_adress, $user_id) {

        $this->db->query("INSERT INTO ". DB_PREFIX . "visited (url, title, date, ip_adress, user_id) 
                        VALUES (
                         ".$this->db->escape($url).",
                         ".$this->db->escape($title).",
                         ".$this->db->escape($date).",
                         ".$this->db->escape($ip_adress).",
                         ".$this->db->escape($user_id).")");
    }

    //fonction de suppression                    
    public function removeVisite($visited_id){

        $this->db->query("DELETE FROM ".DB_PREFIX. "visited  WHERE visited_id = " .$visited_id);
                            
    }

    //fonction de section de toute les visites. 
    public function getAllVisitedPages(){
        $resultat = $this->db->query("SELECT * FROM ". DB_PREFIX ."visited 
                                    WHERE title != 'Your Store' 
                                    AND title != 'Account Login' 
                                    AND title != 'Account Logout' 
                                    AND title != 'My Account'");
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
                                    GROUP BY url 
                                    ORDER BY nb_visit 
                                    DESC LIMIT 15");
        return $resultat->rows;
    }
    


}