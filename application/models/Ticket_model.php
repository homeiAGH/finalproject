<?php
class Ticket_model extends CI_Model{

     /*
     * get rows from the tickets table
     */
    public function get_tickets($limit,$offset){
        return  $this->db->get('list_ticket',$limit,$offset)->result();
    }
    function count_tickets(){
        return $this->db->from("list_ticket")->count_all_results();
    }
    public function get_cars(){
        return  $this->db->get('list_car')->result();
    }
    public function get_drivers(){
        $this->db->select(['id','name','lastname']);
        $this->db->from('driver');
        $this->db->where('status','active');
        $query=$this->db->get();
        return  $query->result();
    }
    public function insert_ticket($passenger,$ticket){
      
        $passenger_id = $this->insert_passenger($passenger);
        $ticket['passenger_id'] = $passenger_id;
        return $this->db->insert('ticket',$ticket) ;
    }
    public function insert_passenger($data){
        $this->db->insert('passenger',$data);
        return $this->db->insert_id();

    }
    public function delete_ticket($id){
        return  $this->db->where('id',$id)->delete('ticket');

       // return  $this->db->delete('ticket',['id'=>$id]);
    }
    public function select_Ticket($id){
       
        $this->db->select(['ticket_id','ticket_travel_date','from_to','car_id','driver_id','passenger_id','passenger_name','passenger_lastname','p_passportNumber','passenger_phone','passenger_address','p_gender']);
        $this->db->from('list_ticket');
        $this->db->where('ticket_id',$id);
        $query=$this->db->get();
       
        return  $query->row();
    }
    public function update_passenger($data,$id){
        return  $this->db->where('id',$id)->update('passenger',$data);
    }
    
    public function update_ticket($ticket,$passenger){
        $p_id = $passenger['id'];
        $t_id = $ticket['id'];
        if($this->update_passenger($passenger,$p_id)){
            return  $this->db->where('id',$t_id)->update('ticket',$ticket);
        }else{
            return false;
        }
       
        
    }
    
}


?>