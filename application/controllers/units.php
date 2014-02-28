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
        
    public function save_unit() {
        $this->load->model('units_m');
        $this->load->model('materials_m');

        if (!$this->user || $this->user->status() !== 'active') {
            header("Location:" . base_url());
            exit();
        }

        if (isset($_POST['add_unit'])) {  // if user has clicked the Save button
            if ($this->chk_form()) {      // if the form has been validated
                $this->extract_id();    // call function to extract video IDs
                $this->units_m->save_unit($_POST);
                header('Location:' . base_url());
                exit();
            }
        }

        $page = new Page('unit');
        $page->Data('content_types', $this->materials_m->get_content_types());
        $page->content('save_unit-v');
        $page->show();
    }
	
}
