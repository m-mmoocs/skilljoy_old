<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller{

	public function index(){
		
	}
        
        public function login(){
            $this->load->library('Fbconnect');	
            $this->load->library('Gconnect');
            // get login urls
            $fb_url = $this->fbconnect->getLoginUrl(array('redirect_uri' => 'http://localhost/skilljoy/users/fb_login','scope' => 'email'));
            $g_url = $this->gconnect->createAuthUrl();
            $page = new Page('login');
            $page->Data('fb_url',$fb_url);
            $page->Data('g_url',$g_url);
            $page->show();
        }
	
        public function fb_login(){
            $this->load->library('Fbconnect');
            // if facebook login
            if($this->fbconnect->getUser()){
                // get user info
                $user_profile = $this->fbconnect->api('/me','GET');
                $this->user->login_fb($user_profile);
                header('Location:'.base_url());
                exit();
            }else{
                // handle error
            }
        }
        
        public function g_login(){
            $this->load->library('Gconnect');
            if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
                $this->gconnect->authenticate();
                // get user info	
                $user_profile = $this->gconnect->oauth2->userinfo->get();
                $this->user->login_g($user_profile);
                header('Location:'.base_url());
                exit();
            }else{
                // handle error
            }
        }
        
        public function logout(){
            $this->session->sess_destroy();
            // logout fb		
            $this->load->library('Fbconnect');
            $this->fbconnect->destroySession(null);
            header("Location: ".base_url());  exit;
        }
}