<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Units extends MY_Controller{

	public function index(){
            
	}
        
        public function show($id){
            $this->load->model('units_m');
            $page = new Page('unit');
        
            $page->show();
	}
        
        public function save_unit(){
            $this->load->model('units_m');
            
            $page = new Page('unit');
            $page->show();
        }
	
}
