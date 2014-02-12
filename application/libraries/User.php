<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); class User{	private $data;	private $ci;        	//getter / setters	 public function Data(){ //args(array) or Data(key, value);	 	if(func_num_args()==0) return $this->data;		else if(func_num_args()==1) { $t=func_get_arg(0); return $this->data[$t];}		else if(func_num_args()==2) $this->data[func_get_arg(0)]=func_get_arg(1);	 }	          public function status(){ //args(array) or Data(key, value);	 	if(func_num_args()==0) return $this->data['status'];		else if(func_num_args()==1) $this->data['status']=func_get_arg(0);	 }                 function __construct($id=NULL) {            $this->ci = &get_instance();            $this->ci->load->model('user_m');             if($id){                $this->data = $this->ci->user_m->get_user_with_id($id);            }else{                $this->data['status'] = 'anonymous';            }        } // end __construct()	        public function login($email,$pass){              } // end login()                public function login_fb($user_profile){            // check if email in user table            $user = $this->ci->user_m->get_user_with_email($user_profile['email']);            if(!$user){ // first time login -> register user                $data = array(                    'firstname' => $user_profile['first_name'],                    'lastname' => $user_profile['last_name'],                    'email' => $user_profile['email'],                    'facebook_id' => $user_profile['id']                );                $user_id = $this->ci->user_m->add_user($data);            }else{                $user_id = $user['id'];            }            $this->_log_user_in($user_id,'facebook');        }                public function login_g($user_profile){            // check if email in user table            $user = $this->ci->user_m->get_user_with_email($user_profile['email']);            if(!$user){ // first time login -> register user                $data = array(                    'firstname' => $user_profile['given_name'],                    'lastname' => $user_profile['family_name'],                    'email' => $user_profile['email'],                    'google_id' => $user_profile['id']                );                $user_id = $this->ci->user_m->add_user($data);            }else{                $user_id = $user['id'];            }            $this->_log_user_in($user_id,'google');        }                private function _log_user_in($id,$method='system'){            // set session            $this->ci->session->set_userdata("user_id",$id);            // record login in user_login_log            $this->ci->user_m->log_user_login($id,$method);        }}