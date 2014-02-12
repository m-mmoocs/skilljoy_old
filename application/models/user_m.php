<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User_m extends MY_Model{	

	function __construct(){
		parent::__construct();
	}
	
        public function get_user_with_id($id){
            $sql = "SELECT * FROM users WHERE id = ?";
            $q = $this->db->query($sql,$id);
            if($q->num_rows!==1) return false;
            $q = $q->result_array();
            return $q[0];
        } // end get_user
        
        public function get_user_with_email($email){
            $sql = "SELECT * FROM users WHERE email = ?";
            $q = $this->db->query($sql,$email);
            if($q->num_rows!==1) return false;
            $q = $q->result_array();
            return $q[0];
        } // end get_user_with_email
        
        public function add_user($arr){
            $args = array();
            $field_names = "";
            $values = "";
            foreach($arr as $key => $value){
                $field_names .= $key.",";
                $args[] = $value;
                $values .= "?,";
            }
            $field_names.='created_at,';
            $args[] = date( 'Y-m-d H:i:s',time());
            $field_names.='created_by';
            $args[] = ip2long($_SERVER['REMOTE_ADDR']);
            $values .= "?,?";
         
            $sql = "INSERT INTO users ($field_names) VALUES ($values)";
            if($this->db->query($sql,$args)){
                // return newly created user id
                $sql = "SELECT LAST_INSERT_ID() AS id FROM users";
                $q = $this->db->query($sql);
                $q = $q->result();
                return $q[0]->id;
            }
            else return FALSE;
        } // end function add_user
        
        public function update_user($args){
            $a = array();
            $sql = "UPDATE users SET";
            foreach ($args as $key => $value) {
                    $sql .= " ".$key."= ?,";
                    $a[]=$value;
            }
            $sql = trim($sql,',');
            $sql .= " WHERE id = ?";
            $a[] = $id;
            return $this->db->query($sql,$a);    
        }
        
        public function delete_user($id){
            $sql = "UPDATE users SET deleted_at = ?, deleted_by = ? WHERE id = ?";
            return $this->db->query($sql,array(date('',time()),  ip2long($_SERVER['REMOTE_ADDR']),$id));
        }
        
        public function log_user_login($id,$method){
            $sql = "INSERT INTO user_login_log (user_id,method) VALUES(?,?)";
            $this->db->query($sql,array($id,$method));
        }
        
        
	private function random_string($len){
		mt_srand((double)microtime()*1000000);
		$base ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$max = strlen($base) - 1;
		$string = '';
		while(strlen($string)<$len){
			$string .= $base{mt_rand(0, $max)};
		} 
		return $string;
	}
}

