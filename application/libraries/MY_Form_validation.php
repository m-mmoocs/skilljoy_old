<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    public function error_array() {
        return $this->_error_array;
    }

    function is_valid_content($input) {  // defining a different set of rules to validate if primary content is not ONLY a URL
        $ci = &get_instance();
        $ci->load->library('mui');
        if ($ci->mui->is_valid_pdf($input)) {
            return TRUE;
        } else if ($ci->mui->is_valid_vimeo($input)) {
            return TRUE;
        } else if ($ci->mui->is_valid_youtube($input)) {
            return TRUE;
        } else {
            return FALSE;       // return false if it's not one of the three supported types for primary material
        }
    }

    function is_valid_url($url) {
        $ci = &get_instance();
        $ci->load->library('mui');
        if ($ci->mui->is_valid_url($url)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function is_real_url($url) {
        $url_data = parse_url($url); // scheme, host, port, path, query
        if (!@fsockopen($url_data['host'], isset($url_data['port']) ? $url_data['port'] : 80)) {
            return FALSE;
        }

        return TRUE;
    }

    function set_error($field, $message) {
        if (!isset($this->_field_data[$field])) {
            $this->_field_data[$field]['postdata'] = '';
        }

        $this->_field_data[$field]['error'] = $message;

        if (!isset($this->_error_array[$field])) {
            $this->_error_array[$field] = $message;
        }
    }

}
