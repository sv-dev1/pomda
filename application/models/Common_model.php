<?php 
class Common_model extends CI_Model
{
  public function insert($table,$data){
    $this->db->insert($table,$data);
    $query = $this->db->insert_id();
    return $query;
// $q = $this->db->get_where($table, array('id' => $id));
// return $q->result();
  }
  public function select($table,$id){
   $this->db->select('*');
   $this->db->from($table);
   $this->db->where('userId',$id);
   $query = $this->db->get();
   return $query->result();

 }
 public function select_user_address($table,$address){
   $this->db->select('*');
   $this->db->from($table);
   //$this->db->where('transaction_hash',$hash);
   $this->db->where('address',$address);
   $query = $this->db->get();
   return $query->result();

 }
 public function select_token($table,$hash,$address){
   $this->db->select('*');
   $this->db->from($table);
   $this->db->where('transaction_hash',$hash);
   $this->db->where('address_to',$address);
   $query = $this->db->get();
   return $query->result();

 }
 public function calculatebunny($userid){
   $query =$this->db->query("SELECT
    id,
    SUM(bunny) AS Total
    FROM
    buy_token
    WHERE
    userid = $userid
    GROUP BY
    userid");
   return $query->result();
 }
 public function calculate_rasied(){
   $query =$this->db->query("SELECT
    id,
    SUM(value) AS Total
    FROM
    buy_token
    WHERE
    type = 'eth'
   ");
   return $query->result();
 }
 public function get_user_id($table,$link){
   $this->db->select('*');
   $this->db->from($table);
   $this->db->where('link',$link);
   $query = $this->db->get();
   return $query;
 }
  public function get_user($table,$id){
   $this->db->select('*');
   $this->db->from($table);
   $this->db->where('id',$id);
   $query = $this->db->get();
   return $query->result();

 }
 public function insert_bonus($table,$bunny,$refrel){
     $this->db->where('id',$refrel);
 }
}


?>