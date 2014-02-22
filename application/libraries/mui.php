<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



class Mui{

     function __construct() {
     	
     }

     function material_check($input)
     {
         $output = array();
         if ($this->valid_url($this->is_valid_pdf($input))) // does true/false url test, then tests if it ends in pdf
         {
             return array('content'=>$input, 'content_type'=>2);
         }
         // finally simply check if it is a valid url and leave it as is
         else if ($output = $this->is_valid_youtube($input))    // returns extracted video code
         {
             
                 return array('content'=>$output, 'content_type'=>1);
         }
         else if ($output = $this->is_valid_vimeo($input))  // returns extracted video code
         {
                 return array('content'=>$output, 'content_type'=>3);
         }
         else if ($this->valid_url($input)) // true/false test, passes on url if it's a valid type
         {
             return array('content'=>$input, 'content_type'=>4);
         }
         else // assuming no match was found
         {      // using this to check if material type can be added
             return array('content_type' =>0);
         }
     }
	

     // --- Functions for testing various formats ---
     function is_valid_youtube($input)
     {
        $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
        preg_match($pattern, $input, $result);
        return (isset($result[1])) ? $result[1] : false;
     }
     
     function is_valid_pdf($input)
     {
         $url = parse_url($input);
        if (preg_match('/\.pdf$/', $url['path']))
        {            
            return $input;
        }
            else
        {
            return false;
        }
     }
     
     function is_valid_vimeo($input)
     {
         if (stripos($input, 'vimeo'))
         {
        $result = array();
        preg_match('/(\d+)/', $input, $result);
        return (isset($result[1])) ? $result[1] : false;
         }
     }
     
     function valid_url($input)
     {
        $url = $input;
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
     }
 }