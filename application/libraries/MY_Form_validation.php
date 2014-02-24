<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    public function error_array() {
        return $this->_error_array;
    }

    function valid_url($url)
    {
        $pattern = "/^((ht|f)tp(s?)\:\/\/|~/|/)?([w]{2}([\w\-]+\.)+([\w]{2,5}))(:[\d]{1,5})?/";
        if (!preg_match($pattern, $url))
        {
            return FALSE;
        }

        return TRUE;
    }
    
    function real_url($url)
    {
        return @fsockopen("$url", 80, $errno, $errstr, 30);
    } 
    
    function set_error($field, $message)
    {
        if(! isset($this->_field_data[$field]))
        {
            $this->_field_data[$field]['postdata'] = '';
        }
        
        $this->_field_data[$field]['error'] = $message;
        
        if ( ! isset($this->_error_array[$field]))
        {
            $this->_error_array[$field] = $message;
        }
    }
}

	