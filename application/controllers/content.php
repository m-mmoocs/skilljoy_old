<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// decided to make a controller to decide what content to show 
// to allow for future flexibility for future content types
// and to minimize the checking required in view
class Content extends MY_Controller{

	public function index(){
            
	}
        
        public function show($id){
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
            // --- Note: URLs are being handled by the unit-v page to get around 
            // codeigniter's check for questionable characters in URI strings
            // unit-v will make href="http:// link rather than direct to controller
            // if a web page was requested
	}
}
