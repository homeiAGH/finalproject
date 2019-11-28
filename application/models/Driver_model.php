<?php
class Driver_model extends CI_Model{

     /*
     * get rows from the users table
     */
    public function get_drivers($limit,$offset){
        $this->db->where('status','active');
        return  $this->db->get('driver',$limit,$offset)->result();
    }
    function count_drivers(){
        return $this->db->where(['status'=>'active'])->from("driver")->count_all_results();
    }
    public function insert_driver($data){
        return  $this->db->insert('driver',$data);
    }

    public function delete_driver($id){
        return  $this->db->where('id',$id)->update('driver',['status'=>'Deactive']);

       // return  $this->db->delete('admin',['id'=>$id]);
    }
    public function select_driver($id){
        $this->db->select(['id','name','lastname','phone','address']);
        $this->db->from('driver');
        $this->db->where('id',$id);
        $query=$this->db->get();
        return  $query->row();
    }

    public function update_driver($data,$id){
        return  $this->db->where('id',$id)->update('driver',$data);
    }
    
}


?>