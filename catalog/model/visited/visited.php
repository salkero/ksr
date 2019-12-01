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

    public function getNameCategory($category_id){

        $this->db->query("SELECT * FROM ". DB_PREFIX . "category_description WHERE category_id = " .$category_id);
    }
    


}