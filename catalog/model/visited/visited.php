<?php
class ModelVisitedVisited extends Model {
    //fonction d'ajout d'une visite.
    public function addVisit($url, $title, $date, $ip_address, $user_id, $url_modifie) {


                         $this->db->query("INSERT INTO ". DB_PREFIX . "visited (url, title, date, ip_address, user_id, url_modifie) 
                         VALUES (
                          '".$this->db->escape($url)."',
                          '".$this->db->escape($title)."',
                          '".$this->db->escape($date)."',
                          '".$this->db->escape($ip_address)."',
                          ".$this->db->escape($user_id).",
                          '".$this->db->escape($url_modifie)."')");
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
        $resultat = $this->db->query("SELECT * FROM ". DB_PREFIX ."visited");
        return $resultat;
     }
     
     // //fonction de section des dernieres 15 visites. 
     public function getLastFifteenVisits(){
        //SELECT * FROM ksr_visited ORDER BY `ksr_visited`.`visited_id` DESC LIMIT 15 
        $resultat = $this->db->query("SELECT * FROM " .DB_PREFIX . "visited ORDER BY " .DB_PREFIX ."visited"."visited_id" DESC LIMIT 15);
        return $resultat;
     }

     
    


}