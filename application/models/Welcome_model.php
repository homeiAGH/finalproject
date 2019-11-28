<?php
class Welcome_model extends CI_Model{

     /*
     * count rows from the users table
     */
   
    function count_users(){
        return $this->db->where(['status'=>'active'])->from("admin")->count_all_results();
    }
    function count_drivers(){
        return $this->db->where(['status'=>'active'])->from("driver")->count_all_results();
    }
    function count_cars(){
        return $this->db->where(['status'=>'active'])->from("car")->count_all_results();
    }
    function count_tickets(){
        return $this->db->from('list_ticket')->count_all_results();
    }
   
    
}


?>