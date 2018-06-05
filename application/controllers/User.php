<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language','common'));
		$this->load->model('Common_model');
		$this->load->library('GoogleAuthenticator');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	public function index()
	{
		//echo "dgd";
		$this->session->set_flashdata('message',' ');
		$this->load->view('home/main_page');
	}

	public function login(){
		if($this->ion_auth->logged_in()){
			redirect('/');
			
		}
		$this->data['title'] = $this->lang->line('login_heading');

		// validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() === TRUE)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				//echo json_encode(array('msg' => 'login'));
				echo '1';
				die;
				// redirect('/');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				//echo json_encode(array('msg' => 'login' , 'message' => $this->ion_auth->errors()));
				echo $this->ion_auth->errors();
				die;
				//$this->load->view('home/main_page');
				//redirect('login'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
				);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				);
			//echo json_encode(array('msg' => 'login' , 'message' =>$this->data['message']));
			echo $this->data['message'];
			die;
			//$this->_render_page('user/login', $this->data);
			//$this->load->view('home/main_page');
		}

		
	}
	
	public function dashboard()
	{

		// set the flash data error message if there is one
		if($this->ion_auth->logged_in()){
			$userId= $this->session->userdata('user_id');
			$data = array(
				'user_id' => $userId
				);
			$result111 =$this->Common_model->select("2_veri",$userId);
			if($result111){

			}else{
				$gaobj = new GoogleAuthenticator();
				$secret =  $gaobj->createSecret();
				$datas =array(
					'secret' => $secret,
					'userId' => $userId,
					'status' => '0'
					);
				$this->Common_model->insert('2_veri',$datas);
			}
			$gaobj = new GoogleAuthenticator();
			$secret =urlencode(get_data_by_id('2_veri','userId',$this->session->userdata('user_id'),'secret'));
			$issuer = get_data_by_id('users','id',$this->session->userdata('user_id'),'username');
			$this->data['qrCode'] = $gaobj->getQRCodeGoogleUrl($issuer,$secret);
			
			$this->data['result'] =$this->Common_model->select('buy_token',$userId);
			$this->data['calculatebunny'] =$this->Common_model->calculatebunny($userId);
			$this->data['data_raised'] =$this->Common_model->calculate_rasied();
			$query = $this->db->get_where("popup",array('user_id' => $userId));
			$result = $query->result_array();

			//print_r($result);

			if(empty($result)){
				//echo '123456';
				$this->db->insert('popup',$data);
				$this->data['modal_open'] = '1';
			}else{
				//echo '789';
				$this->data['modal_open'] = '0';
			}
			$refreal =$this->Common_model->select("bonus_link",$userId); 
			if($refreal){

			}else{
				$num = rand();
				$link = BASE_URL().'?r_id='.$num;
				$ref = array(
					"userId" =>$userId,
					"link" =>$link,
					"created_at"=>date('Y-m-d')

					);			

				$this->Common_model->insert("bonus_link",$ref);

			}
			$result =$this->Common_model->select("user_address",$userId); 
			if($result){

			}else{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://api.blockcypher.com/v1/eth/main/addrs?token=07a38fb5a1b748598d5df8954a63f31e");
		//curl_setopt($ch, CURLOPT_PORT, $this->port);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
				curl_setopt($ch, CURLOPT_POST, TRUE);
				$ret = curl_exec($ch);
				$address  =(json_decode($ret));
				$data = array(
					"userId"=>$userId,
					"private_key"=>$address->private,
					"public_key"=>$address->public,
					"address"=>'0x'.$address->address);

				$this->Common_model->insert("user_address",$data);  
			}

			$result1 =$this->Common_model->select("btc_address",$userId); 
			if($result1){

			}else{
				$ch1 = curl_init();

				curl_setopt($ch1, CURLOPT_URL, "https://api.blockcypher.com/v1/btc/main/addrs?token=07a38fb5a1b748598d5df8954a63f31e");
		//curl_setopt($ch, CURLOPT_PORT, $this->port);
				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
				curl_setopt($ch1, CURLOPT_POST, TRUE);
				$ret1 = curl_exec($ch1);
				$address1  =(json_decode($ret1));
				$data1 = array(
					"userId"=>$userId,
					"private_key"=>$address1->private,
					"public_key"=>$address1->public,
					"address"=>$address1->address);
				$this->Common_model->insert("btc_address",$data1);  
			}
			$this->load->view('home/dash_head',$this->data);
			$this->load->view('user/dashboard',$this->data);
			$this->load->view('home/dash_foot',$this->data);
		}else{

			redirect('/');
		}

	}


	public function update_record(){

		$transc = file_get_contents('http://api-ropsten.etherscan.io/api?module=account&action=txlist&address='.$_POST['ethaddress'].'&sort=desc');
		$data =(json_decode($transc));
		$i=0;
		$user_address  =$this->Common_model->select_user_address("user_address",$_POST['ethaddress']); 
		$user_address1=($user_address[0]);
		$uuse =($user_address1->userId); 
		$calculatebunny=($this->Common_model->calculatebunny($uuse));
		foreach($data->result as $data1){
			if(count($data->result)>=$i){
				$tarnsaction_hash=(@$data1->hash);
				$ethaddress=$_POST['ethaddress'];
				if(@$data1->isError == '0'){
					$result =$this->Common_model->select_token("buy_token",$tarnsaction_hash,$ethaddress);
				//print_r($result); 
					if(empty($result)){
						$amount1 =((@$data1->value)/1000000000000000000);
					//echo $amount1;
						$final = $amount1 * get_data_by_id('total_supply','title','1ETH','supply');
						if($amount1>=1 && $amount1<5){

							$total = $final + ($final*0.10);

						}else if($amount1>=5 && $amount1<10){

							$total = $final + ($final*0.20);

						}else if($amount1>=10 && $amount1<20){

							$total = $final + ($final*0.50);

						}else if($amount1>=20 && $amount1<50){

							$total = $final + ($final*0.75);

						}else if($amount1>=50){

							$total = $final + ($final*0.75);

						}else{
							$total = $final;
						}
						$get_ref =$this->Common_model->get_user('users',$uuse);
						$referal_link =($get_ref[0]->refreal_link);
						if(!empty($referal_link)){
							$bunny = $total*0.10;
							$bunny1 = ($total-$bunny);
							$data12['userId']= $referal_link;
							$data12['value']= 0;
							$data12['transaction_hash']= '';
							$data12['address_to']= '';
							$data12['bunny']= $bunny;
							$data12['status']= '2';
							$data12['date'] = date('y-m-d');
							$data12['type'] = 'eth';
							$id =$this->Common_model->insert('buy_token',$data12);
						}else{
							$bunny1 = $total;
						}
					//echo $total;
						$reduce_supply = get_data_by_id('total_supply','title','PRE-ITS','supply')-($total);
						$update_query = $this->db->where("title",'PRE-ITS'); $this->db->update("total_supply",array('supply' => $reduce_supply));
						$data11['userId']= $uuse;
						$data11['value']= ((@$data1->value)/1000000000000000000);
						$data11['transaction_hash']= @$data1->hash;
						$data11['address_to']= @$data1->to;
						$data11['bunny']= $bunny1;
						$data11['status']= '1';
						$data11['date'] = date('y-m-d');
						$data11['type'] = 'eth';
						$id =$this->Common_model->insert('buy_token',$data11);
						$calculatebunny= $this->Common_model->calculatebunny($uuse);
						print_r($calculatebunny[0]->Total);
					}
				}


			}
			$i++;

		}


	}

	public function change_pass(){
	//print_r($_POST);die;
		if($this->ion_auth->logged_in()){
			$id= $this->session->userdata('user_id');
			$old = $this->input->post('oldPassword');
			$new = $this->input->post('newPassword');
			$this->load->model('ion_auth_model');
			if($old != '' && $new != ''){
				if($this->ion_auth_model->change_password($id, $old, $new))
				{
					echo "1"; 
				}else {
					echo "0";
				}
			}else{
				echo "2";
			}
			

       // $this->set_error('password_change_unsuccessful');

		}
	}

	public function enable(){
		$secr =($_POST['secr']);
		$token =($_POST['token']);
		$type =($_POST['type']);

		$this->load->library('GoogleAuthenticator');
		if($type == 'enable'){
			$gaobj = new GoogleAuthenticator();
            //print_r($gaobj);die;
			$secret =  $secr;
           // print_r($secret);
			$oneCode = $token;

			$token = $gaobj->getCode($secret);

            $checkResult = $gaobj->verifyCode($secret, $oneCode, 2); // 2 = 2*30sec clock tolerance
            //print_r($checkResult);die;
            if(!$checkResult)
            {

                echo ('Two-factor token Failed'); // index function load login page view

            }else{    

            	$update_query = $this->db->where("userId",$this->session->userdata('user_id')); $this->db->update("2_veri",array('status' => '1'));
                echo "1";// Two-factor code success and now steps for username and password verification

            } 
        }else{
        	$gaobj = new GoogleAuthenticator();
            //print_r($gaobj);die;
        	$secret =  $secr;
           // print_r($secret);
        	$oneCode = $token;

        	$token = $gaobj->getCode($secret);

            $checkResult = $gaobj->verifyCode($secret, $oneCode, 2); // 2 = 2*30sec clock tolerance
            //print_r($checkResult);die;
            if(!$checkResult)
            {

                echo ('Two-factor token Failed'); // index function load login page view

            }else{    
            	$update_query = $this->db->where("userId",$this->session->userdata('user_id')); $this->db->update("2_veri",array('status' => '0'));
                echo "1";// Two-factor code success and now steps for username and password verification
            } 
        }


    }

    public function bitcoin_hash(){
    	$userId= $this->session->userdata('user_id');
    	$get_address =$this->Common_model->select('btc_address',$userId);
    	$address = ($get_address[0]->address);
    	$transc = file_get_contents('https://blockchain.info/address/'.$address.'?format=json');
    	$data =(json_decode($transc));
    	if(!empty($data)){
    		$i=0;
    		foreach($data->txs as $data1){
    			if(count($data->txs)>=$i){
    				$hash =($data1->hash);
    				$result =$this->Common_model->select_token("buy_token",$hash,$address);
		//	print_r($result);die;
    				if(empty($result)){

    					foreach($data1->out as $aad){
    						$test  =@$aad->addr;
    						if($test == $address){
    							$address_to= $aad->addr;
    							$chek_add = $aad->value;
						//$address_to =($chek_add->addr);
    							$amount1 =(($chek_add)/100000000);

    							$final = $amount1 * get_data_by_id('total_supply','title','1BTC','supply');
    							if($amount1>=0.05 && $amount1<0.3){

    								$total = $final + ($final*0.10);

    							}else if($amount1>=0.3 && $amount1<0.6){

    								$total = $final + ($final*0.20);

    							}else if($amount1>=0.6 && $amount1<1){

    								$total = $final + ($final*0.50);

    							}else if($amount1>=1 && $amount1<3){

    								$total = $final + ($final*0.75);

    							}else if($amount1>=3){

    								$total = $final + ($final*0.75);

    							}else{
    								$total = $final;
    							}

    							$get_ref =$this->Common_model->get_user('users',$userId);
    							$referal_link =($get_ref[0]->refreal_link);
    							if(!empty($referal_link)){
    								$bunny = $total*0.10;
    								$bunny1 = ($total-$bunny);
    								$data12['userId']= $referal_link;
    								$data12['value']= 0;
    								$data12['transaction_hash']= '';
    								$data12['address_to']= '';
    								$data12['bunny']= $bunny;
    								$data12['status']= '2';
    								$data12['date'] = date('y-m-d');
    								$data12['type'] = 'eth';
    								$id =$this->Common_model->insert('buy_token',$data12);
    							}else{
    								$bunny1 = $total;
    							}
    							$today =  date('Y-m-d');
    							//if($today >= '2018-06-08' && $today <='2018-06-29'){
    								$reduce_supply = get_data_by_id('total_supply','title','PRE-ITS','supply')-($total);
    								$update_query = $this->db->where("title",'PRE-ITS'); $this->db->update("total_supply",array('supply' => $reduce_supply));
    							//}else if($today >= '2018-06-30' && $today <='2018-08-10'){
    								$reduce_supply = get_data_by_id('total_supply','title','ITS','supply')-($total);
    								$update_query = $this->db->where("title",'ITS'); $this->db->update("total_supply",array('supply' => $reduce_supply));
    							//}
    							$data11['userId']= $userId;
    							$data11['value']= (($chek_add)/100000000);
    							$data11['transaction_hash']= @$hash;
    							$data11['address_to']= @$address_to;
    							$data11['bunny']= $bunny1;
    							$data11['status']= '1';
    							$data11['date'] = date('y-m-d');
    							$data11['type'] = 'btc';
    							$id =$this->Common_model->insert('buy_token',$data11);
    							$calculatebunny= $this->Common_model->calculatebunny($userId);


    						}else{

    						}


    					}

    				}
    			}

    			$i++;
    			echo 'true';
    		}
	//print_r($calculatebunny[0]->Total);

    	}

    }
    public function raised(){
    	$today =  date('Y-m-d');
    	$data_raised =$this->Common_model->calculate_rasied();
	// /$data_raised_btc =$this->Common_model->calculate_btc();
    	//if($today >= '2018-06-08' && $today <='2018-08-10'){
    		if(($data_raised[0]->Total)<=1500000 || ($data_raised[0]->Total>=7000000)){

    			print_r($data_raised[0]->Total);
    		}
    	//}

    }

    public function get_eth_balance(){
	// date_default_timezone_set('Asia/Kolkata');
 //    $tomorrow = new DateTime('tomorrow');
    	$today =  date('Y-m-d');
    	if($today >= '2018-06-08' && $today <='2018-08-10'){
    		$query = $this->db->get_where("total_supply",array('title' => '1ETH'));
    		$result = $query->result_array();
    		$total_supply = $result[0];
    		$dec = $total_supply['supply']*(1/100);

    		$update_origninal = $total_supply['supply'] - $dec;
	//echo $update_origninal;
    		$update_query = $this->db->where("title",'1ETH'); $this->db->update("total_supply",array('supply' => $update_origninal));

    		$query1 = $this->db->get_where("total_supply",array('title' => '1Bunny'));
    		$result1 = $query1->result_array();
    		$total_supply1 = $result1[0];
    		$inc = $total_supply1['supply']*(1/100);

    		$update_origninal1 = $total_supply1['supply'] + $inc;
    		$update_query = $this->db->where("title",'1Bunny'); $this->db->update("total_supply",array('supply' => $update_origninal1));
    	}
    	


    }

	public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		// if ($returnhtml)
		// {
		return $view_html;
		// }
	}

	/**
	 * Log the user out
	 */
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();
		redirect('/');
		// redirect them to the login page
		// $this->session->set_flashdata('message', $this->ion_auth->messages());
		// $this->load->view('home/main_page');
	}


	public function register(){
		
      //  echo $ref_id;die;
		$this->data['title'] = $this->lang->line('create_user_heading');

		/*if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('/', 'refresh');
		}*/
		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;

		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');
		
		$this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');

		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$email = strtolower($this->input->post('identity'));
			$identity = $this->input->post('identity');
			$password = $this->input->post('password');
			$link = BASE_URL().'?r_id='.$this->input->post('link');
			$data['get_user_id'] = $this->Common_model->get_user_id('bonus_link',$link);
			$res =($data['get_user_id']->result());
			if($res[0]->userId!=''){
				$userId = $res[0]->userId;
			}else{
				$userId = '';
			}
			$additional_data = array(
				'first_name' => 'XXXXXXXXX',
				'last_name' => 'XXXXXXXXX',
				'company' => 'XXXXXXXXX',
				'phone' => 0000000000,
				'refreal_link' => $userId
				);
		}
             // echo $additional_data;die;
		if (($this->form_validation->run() === TRUE) && ($this->ion_auth->register($identity, $password, $email, $additional_data)))
		{
			
			//$this->session->set_flashdata('message', );
			// $response = array('message' => 'registered');
			// echo json_encode($response);;
			echo 'registered';
			
			//redirect("login");
		}else
		{	
			// display the create user form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			
			$this->data['identity'] = array(
				'name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
				);
			
			$this->data['password'] = array(
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password'),
				);
			$this->data['password_confirm'] = array(
				'name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
				);
			//$this->_render_page('user/register', $this->data);

			echo json_encode($this->data);
			die;
		}

	}


	/**
	 * Forgot password
	 */
	public function forgot_password()
	{
		// setting validation rules by checking whether identity is username or email
		if ($this->config->item('identity', 'ion_auth') != 'email')
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() === FALSE)
		{
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				);

			if ($this->config->item('identity', 'ion_auth') != 'email')
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('user/forgot_password', $this->data);
		}
		else
		{
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity))
			{

				if ($this->config->item('identity', 'ion_auth') != 'email')
				{
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}
				else
				{
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("forgot_password");
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("login"); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("forgot_password");
			}
		}
	}



	public function buy_token(){

		if($this->ion_auth->logged_in()){
			$reduce_supply = get_data_by_id('total_supply','title','PRE-ITS','supply')-($this->input->post('token'));
			$update_query = $this->db->where("title",'PRE-ITS'); $this->db->update("total_supply",array('supply' => $reduce_supply));
			$userId= $this->session->userdata('user_id');
			$get_ref =$this->Common_model->get_user('users',$userId);
			$referal_link =($get_ref[0]->refreal_link);
			if(!empty($referal_link)){
				$bunny = $this->input->post('token')*0.10;
				$bunny1 = ($this->input->post('token')-$bunny);
				$data12['userId']= $referal_link;
				$data12['value']= 0;
				$data12['transaction_hash']= '';
				$data12['address_to']= '';
				$data12['bunny']= $bunny;
				$data12['status']= '2';
				$data12['date'] = date('y-m-d');
				$data12['type'] = 'eth';
				$id =$this->Common_model->insert('buy_token',$data12);
			}else{
				$bunny1 = $this->input->post('token');
			}
			$data['userId']= $userId;
			$data['value']= $this->input->post('amount');
			$data['transaction_hash']= $this->input->post('txhash');
			$data['address_to']= $this->input->post('address');
			$data['bunny']= $bunny1;
			$data['status']= $this->input->post('status');
			$data['date'] = date('y-m-d');
			$data['type'] = 'eth';
			$id =$this->Common_model->insert('buy_token',$data);
			echo  $id;
		}
		
	}
	public function dashboard_new(){
		if($this->ion_auth->logged_in()){
				// /print_r($this->session->userdata());
			//echo $this->session->userdata('site_lang');
				//echo $this->session->userdata('user_id'); die;
			$userId= $this->session->userdata('user_id');
			$data = array(
				'user_id' => $userId
				);
			$this->data['result'] =$this->Common_model->select('buy_token',$userId);
			$this->data['calculatebunny'] =$this->Common_model->calculatebunny($userId);
			$this->load->view('home/dash_head',$this->data);
			$this->load->view('user/dashboard_copy',$this->data);
			$this->load->view('home/dash_foot',$this->data);
		}
	}
	/**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 */
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
					);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
					);
				$this->data['user_id'] = array(
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
					);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('user/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("login");
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('reset_password/' . $code);
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("forgot_password");
		}
	}


	public function edit_user($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			
			redirect('user');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim|required');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone'),
					);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					// Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData))
					{

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp)
						{
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data))
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					$this->redirectUser();

				}
				else
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					$this->redirectUser();

				}

			}
		}
				// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
			);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
			);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
			);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
			);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password'
			);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password'
			);

		$this->_render_page('user/edit_user', $this->data);
	}


	/**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id, $code = FALSE)
	{
		if ($code !== FALSE)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("user");
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("forgot_password");
		}
	}

	/**
	 * Deactivate the user
	 *
	 * @param int|string|null $id The user ID
	 */
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int)$id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('user/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					return show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('user', 'refresh');
		}
	}

	/**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	/**
	 * @return bool Whether the posted CSRF token matches
	 */

	public function _valid_csrf_nonce(){
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')){
			return TRUE;
		}
		return FALSE;
	}
	/**
	* Redirect a user checking if is admin
	*/
	public function redirectUser(){
		if ($this->ion_auth->is_admin()){
			redirect('user');
		}
		if (!$this->ion_auth->is_admin()){
			redirect('user');
		}
		redirect('/', 'refresh');
	}

	
}
