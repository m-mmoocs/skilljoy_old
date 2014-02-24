<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    public function error_array() {
        return $this->_error_array;
    }
    
    function valid_content($input) {
        if ($this->is_valid_url($input)) {      // check if this is a real URL
            if ($this->is_valid_pdf($input)) {  // then tests if it ends in pdf
                return TRUE;
            } else if ($this->is_valid_vimeo($input)) {  // tests if it's a valid Vimeo
                return TRUE;
            } else {
                return TRUE;                    // since it passed real URL, it should pass this
            }
        } else if ($this->is_valid_youtube($input)) {    // returns extracted video code if it's valid youtube
            return TRUE;
        } else { // assuming no match was found
            return FALSE;
        }
    }

    function is_valid_url($url)
    {
        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
        if (!preg_match($pattern, $url))
        {
            return FALSE;
        }
        else {return TRUE;}
        
    }
    
    function is_valid_youtube($input) {
        $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
        if( preg_match($pattern, $input))
        {
            return TRUE;
        }
        else {return FALSE;}
        }

    function is_valid_pdf($input) {
        $url = parse_url($input);
        if ( isset($url['path'])) // bypass preg_match if path doesn't seem to be valid
        {
            if (preg_match('/\.pdf$/', $url['path'])) {
                return TRUE;
            } else {
                return false;
            }
        }
        else
        {
            return FALSE;
        }
    }

    function is_valid_vimeo($input) {
        $pattern = '#(http://vimeo.com)/([0-9]+)#i';
        if( preg_match($pattern, $input))
        {
            return TRUE;
        }
 else {return FALSE;}
        }
    
    
    function real_url($url)
    {
        $url_data = parse_url($url); // scheme, host, port, path, query
        if (!@fsockopen($url_data['host'], isset($url_data['port']) ? $url_data['port'] : 80)) {
            return FALSE;
        }               
         
        return TRUE;
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

	