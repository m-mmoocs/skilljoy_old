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
            $this->fix_url();   // add http:// to content if it hasn't already been added
            $validation_str1 = '';
            $validation_str2 = '';
            if ( strlen($_POST['materials'][0]['content']) > 5 )
            {
                if ( strlen($_POST['materials'][1]['content']) > 5 )
                {
                    $validation_str1 = 'xss_clean|is_valid_url|valid_content|real_url';
                }
                if ( strlen($_POST['materials'][2]['content']) > 5 )
                {
                    $validation_str2 = 'xss_clean|is_valid_url|valid_content|real_url';
                }
            }
            // setting up validation rules
            $this->form_validation->set_rules('title', 'Unit Title', 'required|xss_clean');
            $this->form_validation->set_rules('materials[0][content]', 'Primary Material', 'required|xss_clean|is_valid_url|valid_content|real_url');
            $this->form_validation->set_rules('materials[1][content]', 'Supporting Material 1', $validation_str1);
            $this->form_validation->set_rules('materials[2][content]', 'Supporting Material 2', $validation_str2);
            $this->form_validation->set_message('is_valid_url', 'Invalid URL format.');
            $this->form_validation->set_message('valid_content', 'Invalid Content.');
            $this->form_validation->set_message('real_url', 'URL is not accessible.');
            
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
    
    
    public function fix_url()
    {
        if (strlen($_POST['materials'][0]['content']) > 5) {
            $_POST['materials'][0]['content'] = prep_url($_POST['materials'][0]['content']);
        }
        if (strlen($_POST['materials'][1]['content']) > 5) {
            $_POST['materials'][1]['content'] = prep_url($_POST['materials'][1]['content']);
        }
        if (strlen($_POST['materials'][2]['content']) > 5) {
            $_POST['materials'][2]['content'] = prep_url($_POST['materials'][2]['content']);
        }
    }
    
    public function show_link($id){
            $this->load->model('materials_m');
            $result = $this->materials_m->get_materials_with_id($id); // get material details
            $result = $result[0];
            if ($result->content_type == 1) // -------- if it's a youtube video id
            {
                $this->load->view('materials/youtube-v', $result);
            }
            elseif ($result->content_type == 2) // -------- if it's a pdf URL
            {
                $this->load->view('materials/pdf-v', $result);
            }
            elseif ($result->content_type == 3) // -------- if it's a vimeo URL
            {
                $this->load->view('materials/vimeo-v', $result);
            }
	}
}
