<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Test extends MY_Controller{

	public function index(){            
            $page = new Page('test');
            $page->show();
	}
	
        public function testurl()
        {
            if (isset($_POST['input']))
            {
                $this->load->library('mui');
                $output = $this->mui->material_check($_POST['input']);
                $page = new Page('test');
                if (isset($content_type))
                    $page->Data('type', $content_type);
                $page->Data('input', ($_POST['input']));
                $page->Data('output', $output);
                $page->show();
            }
            }
}
