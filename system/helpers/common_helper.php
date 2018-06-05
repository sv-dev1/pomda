<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('get_data_by_id'))
{
	/**
	 * Element
	 *
	 * Lets you determine whether an array index is set and whether it has a value.
	 * If the element is empty it returns NULL (or whatever you specify as the default value.)
	 *
	 * @param	string
	 * @param	array
	 * @param	mixed
	 * @return	mixed	depends on what the array contains
	 */
	function get_data_by_id($table,$field,$id,$field_name)
	{
		 $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       $query = $ci->db->get_where($table,array($field=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result[$field_name];
       }else{
           return false;
       }
	}
}





?>