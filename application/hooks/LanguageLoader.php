<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
       $ci->load->library('session');
       if($ci->session->userdata('site_lang')){
         $ci->lang->load('message',$ci->session->userdata('site_lang'));
       }else{
       	$ci->lang->load('message','portuguese');
       }
        
      
    }
}


?>