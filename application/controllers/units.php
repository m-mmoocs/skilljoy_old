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
            if(!$this->user || $this->user->status()!=='active'){
                header("Location:".base_url());
                exit();
            }
            $this->load->model('units_m');
            $this->load->model('materials_m');
            
            if(isset($_POST['add_unit'])){
                if ($this->chk_form())
                {
                    $this->units_m->save_unit($_POST);
                    header('Location:'.base_url());
                    exit();
                }
            }
            
            $page = new Page('unit');
            $page->Data('content_types',$this->materials_m->get_content_types());
            $page->content('save_unit-v');
            $page->show();
        }
	
        public function chk_form()      // returns true/false
        {
            $this->load->library('form_validation');
            $this->load->library('mui');
            $flag = FALSE;  // this is to ensure at least one of the content types filled in are valid
            $this->form_validation->set_rules('title', 'Unit Title', 'required|xss_clean');
            if ($this->form_validation->run() == TRUE) {    // if the title field was indeed filled in
                foreach ($_POST['materials'] as $mat) {     // loop through the material fields
                    if (strlen($mat['content']) > 0) {      // if something had been entered in the field
                        $test = $this->mui->material_check($mat['content']);    // run lib checker to see if it's actually content
                        if ($test['content_type'] != '0')   // if it's recognized as a type
                            $flag = TRUE;                   // then mark it as okay to continue
                    }
                }

                if ($flag) {        // if at least one of the fields were valid, then flag=true
                    return TRUE;    // so indicate that it can continue to save_unit
                }
            } else {
                return FALSE;
            }
    }
}
