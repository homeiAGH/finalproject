<?php
class Car_model extends CI_Model{

     /*
     * get rows from the users table
     */
    public function get_cars($limit,$offset){
        return  $this->db->get('list_car',$limit,$offset)->result();
    }
    function count_cars(){
        return $this->db->where(['status'=>'active'])->from("car")->count_all_results();
    }
    public function insert_car($data){
        return  $this->db->insert('car',$data);
    }

    public function delete_car($id){
        return  $this->db->where('id',$id)->update('car',['status'=>'Deactive']);
    }
    public function select_car($id){
        $this->db->select(['id','palete','car_type_id']);
        $this->db->from('car');
        $this->db->where('id',$id);
        $query=$this->db->get();
        return  $query->row();
    }
    public function get_car_type(){
        return  $this->db->get('car_type')->result();
    }
    public function update_car($data,$id){
        return  $this->db->where('id',$id)->update('car',$data);
    }
    
}


?>