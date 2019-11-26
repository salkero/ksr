<?php
class ModelVisitedVisited extends Model {
    
    public function addVisite($visited_id, $url, $title, $date, $ip_adress, $user_id) {

        $this->db->query("INSERT INTO ". DB_PREFIX . "visited (url, title, date,p_adress,user) 
                        VALUES (".$this->db->escape($visited_id).",
                         ".$this->db->escape($url).",
                         ".$this->db->escape($title).",
                         ".$this->db->escape($date).",
                         ".$this->db->escape($ip_adress).",
                         ".$this->db->escape($user_id).")");
        
    }
    
    

}