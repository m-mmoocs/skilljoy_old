<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



class Mui{

     function __construct() {
     	
     }

     function material_check($input)
     {
         // check if URL is a youtube link
         if ($output = $this->is_valid_youtube($input))
         {
                 return array('content'=>$output, 'content_type'=>1);
         }
         if ($this->valid_url($this->is_valid_pdf($input)))
         {
             return array('content'=>$input, 'content_type'=>2);
         }
         if ($output = $this->is_valid_vimeo($input))
         {
                 return array('content'=>$output, 'content_type'=>3);
         }
         // finally simply check if it is a valid url and leave it as is
         if ($this->valid_url($input))
         {
             return array('content'=>$input, 'content_type'=>4);;
         }
     }
	

     // --- Function to test for youtube link and return only the video id ---
     function is_valid_youtube($input)
     {
        $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
        preg_match($pattern, $input, $result);
        return (isset($result[1])) ? $result[1] : false;
     }
     
     function is_valid_pdf($input)
     {
        if (preg_match('/\.pdf$/', $input))
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
        $result = array();
        preg_match('/(\d+)/', $input, $result);
        return (isset($result[1])) ? $result[1] : false;
     }
     
     function valid_url($input)
     {
       $pattern = "/(((http|ftp|https):\/\/){1}([a-zA-Z0-9_-]+)(\.[a-zA-Z0-9_-]+)+([\S,:\/\.\?=a-zA-Z0-9_-]+))igs/";
        if (preg_match($pattern, $input))
        {
            return TRUE;
        }
        return FALSE;
     }
 }