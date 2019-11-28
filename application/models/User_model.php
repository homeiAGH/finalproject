<?php
class User_model extends CI_Model{

     /*
     * get rows from the users table
     */
    public function get_users($limit,$offset){
        $this->db->where('status','active');
        return  $this->db->get('admin',$limit,$offset)->result();
    }
    function count_users(){
        return $this->db->where(['status'=>'active'])->from("admin")->count_all_results();
    }
    public function insert_user($data){
        return  $this->db->insert('admin',$data);
    }

    public function delete_user($id){
        return  $this->db->where('id',$id)->update('admin',['status'=>'Deactive']);

       // return  $this->db->delete('admin',['id'=>$id]);
    }
    public function select_user($id){
        $this->db->select(['id','name','lastname','username','password','photo_name','role']);
        $this->db->from('admin');
        $this->db->where('id',$id);
        $query=$this->db->get();
        return  $query->row();
    }

    public function get_user_photo_name($id){
        $this->db->select(['photo_name']);
        $this->db->from('admin');
        $this->db->where('id',$id);
        $query=$this->db->get();
        return  $query->row();
    }
    public function update_user($data,$id){
        return  $this->db->where('id',$id)->update('admin',$data);
    }
    
}


?>