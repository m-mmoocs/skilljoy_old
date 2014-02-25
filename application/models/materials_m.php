<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Materials_m extends MY_Model{	

	function __construct(){
		parent::__construct();
	}
        
	public function get_materials_with_unit_id($id){
            $sql = "SELECT * FROM materials WHERE unit_id = ? AND deleted_at IS NULL";
            $q = $this->db->query($sql,$id);
            $q = $q->result();
            return $q;
        } // end get_materials_with_unit_id
        
        public function get_primary_materials_with_unit_id($id){
            $sql = "SELECT * FROM materials WHERE unit_id = ? AND primary_mat = 1 AND deleted_at IS NULL";
            $q = $this->db->query($sql,$id);
            $q = $q->result();
            return $q;
        }
        
        public function get_secondary_materials_with_unit_id($id){
            $sql = "SELECT * FROM materials WHERE unit_id = ? AND primary_mat = 0 AND deleted_at IS NULL";
            $q = $this->db->query($sql,$id);
            $q = $q->result();
            return $q;
            
        }
        
        public function get_materials_with_id($id){ // used to retrieve material's details based on material id
            $sql = "SELECT * FROM materials WHERE id = ? AND deleted_at IS NULL";
            $q = $this->db->query($sql,$id);
            $q = $q->result();
            return $q;
        } // end get_materials_with_unit_id
        
        public function get_content_types(){
            $sql = "SELECT * FROM content_types";
            $q = $this->db->query($sql);
            return $q->result();
        }
        
        public function add_material($arr){
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

            $sql = "INSERT INTO materials ($field_names) VALUES ($values)";
            if($this->db->query($sql,$args)){
                // return newly created user id
                $sql = "SELECT LAST_INSERT_ID() AS id FROM materials";
                $q = $this->db->query($sql);
                $q = $q->result();
                return $q[0]->id;
            }
            else return FALSE;
        } // end function add_material
        
        public function update_material($args){
            $a = array();
            $sql = "UPDATE materials SET";
            foreach ($args as $key => $value) {
                    $sql .= " ".$key."= ?,";
                    $a[]=$value;
            }
            $sql = trim($sql,',');
            $sql .= " WHERE id = ?";
            $a[] = $id;
            return $this->db->query($sql,$a);    
        } // end function update_material
        
        public function delete_material($id){
            $sql = "UPDATE materials SET
            deleted_at = ?, deleted_by = ? WHERE id = ?";
            return $this->db->query($sql,array(date('',time()),  ip2long($_SERVER['REMOTE_ADDR']),$id));            
        } // end function delete_material
        
}

