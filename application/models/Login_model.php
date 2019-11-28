<?php
class Login_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }
    
    public function validate($username,$password){
        $array = array('username' => $username, 'password' => $password);

        $this->db->where($array);
		$query = $this->db->get('admin');

			if($query->num_rows()>0){
				return $query->row_array();
			}
    }
        
    




    
}


?>