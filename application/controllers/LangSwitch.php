<?php
class LangSwitch extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }
  
    function switchLanguage($language = "") {
       
        $language = ($language != "") ? $language : "portuguese";
        $this->session->set_userdata('site_lang', $language);
        //$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        redirect(base_url());
    }
}
