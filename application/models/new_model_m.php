<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class New_model_m extends MY_Model{	

	function __construct(){
		parent::__construct();
	}
	
        public function add_item($arr){
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
         
            $sql = "INSERT INTO items ($field_names) VALUES ($values)";
            if($this->db->query($sql,$args)){
                // return newly created user id
                $sql = "SELECT LAST_INSERT_ID() AS id FROM items";
                $q = $this->db->query($sql);
                $q = $q->result();
                return $q[0]->id;
            }
            else return FALSE;
        } // end function add_item
        
        public function update_item($args){
            $a = array();
            $sql = "UPDATE items SET";
            foreach ($args as $key => $value) {
                    $sql .= " ".$key."= ?,";
                    $a[]=$value;
            }
            $sql = trim($sql,',');
            $sql .= " WHERE id = ?";
            $a[] = $id;
            return $this->db->query($sql,$a);    
        } // end function update_item
        
        public function delete_item($id){
            $sql = "UPDATE items SET
            deleted_at = ?, deleted_by = ? WHERE id = ?";
            return $this->db->query($sql,array(date('',time()),  ip2long($_SERVER['REMOTE_ADDR']),$id));            
        } // end function delete_item
        
}

