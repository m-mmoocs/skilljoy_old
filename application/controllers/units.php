<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Units extends MY_Controller{

	public function index(){
            
	}
        
        public function show($id){
            $this->load->model('units_m');
            $page = new Page('unit');
            $page->Data('unit',$this->units_m->get_unit_with_id($id));
            $page->show();
	}
        
        public function save_unit(){
            $this->load->model('units_m');
            $this->load->model('materials_m');
            if(isset($_POST['add_unit'])){
//                $this->smrke->debug($_POST);
                $this->units_m->save_unit($_POST);
                header('Location:'.base_url());
                exit();
            }
            
            $page = new Page('unit');
            $page->Data('content_types',$this->materials_m->get_content_types());
            $page->content('save_unit-v');
            $page->show();
        }
	
}
