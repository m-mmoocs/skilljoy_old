<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home extends MY_Controller{

	public function index(){
            $this->load->model('units_m');
            $page = new Page('home');
            $page->Data('units',$this->units_m->get_all_units());
            $page->show();
	}
	
}
