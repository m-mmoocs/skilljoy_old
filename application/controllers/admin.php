<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller{

	public function index(){
            
            if($this->user && $this->user->status()=='active'){
                $page = new Page('admin');
                $page->content('admin/admin-v');
                $page->scripts('admin');
            }
            else{
                $page = new Page('login');
                $page->content('admin/login-v');
            }
            $page->show('admin_template');
	}
        
        public function login(){
//            if(isset($_POST['pass']))
//                $this->m_user->login($_POST['pass']);
//            header('Location: '.base_url('admin'));
//            exit();
        } // end login()
        
        public function logout(){
//            $this->user->logout();            
        } // end logout();
	
}
