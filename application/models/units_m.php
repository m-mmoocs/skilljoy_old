<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Units_m extends MY_Model{	

	function __construct(){
		parent::__construct();
	}

        public function get_all_units(){
            $sql = "SELECT * FROM units WHERE deleted_at IS NULL";
            $q = $this->db->query($sql);
            return $q->result();
        }
        
        public function get_unit_with_id($id){
            $sql = "SELECT * FROM units WHERE id = ? AND deleted_at IS NULL";
            $q = $this->db->query($sql,$id);
            if($q->num_rows == 1){
                $q = $q->result();
                $unit = $q[0];
                $this->load->model('materials_m');
                $unit->materials = $this->materials_m->get_materials_with_unit_id($unit->id);
                $unit->primary_material = $this->materials_m->get_primary_materials_with_unit_id($unit->id);
                $unit->secondary_material = $this->materials_m->get_secondary_materials_with_unit_id($unit->id);
                return $unit;
            }
            else return FALSE;
        } // end get_unit_with_id
       
        
        public function save_unit($arr){
            $unit = array(
                'user_id' => $this->user->Data('id'),
                'title' => $arr['title'],
                'description' => $arr['description'] );
            $unit_id = $this->add_unit($unit);
            foreach($arr['materials'] as $material){
                if( strlen($material['content']) > 5 ){ // string length check is needed or it tries to load content of empty field
                        $material = array(
                            'unit_id' => $unit_id,
                            'content' => $material['content'],    // insert trimmed content or url here
                            'content_type' => $material['content_type'],   // insert the content_type id
                            'primary_mat' => $material['primary_mat'] );
                    $this->materials_m->add_material($material);
                }
            }
        } // end save_unit
        
        public function add_unit($arr){
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
         
            $sql = "INSERT INTO units ($field_names) VALUES ($values)";
            if($this->db->query($sql,$args)){
                // return newly created user id
                $sql = "SELECT LAST_INSERT_ID() AS id FROM units";
                $q = $this->db->query($sql);
                $q = $q->result();
                return $q[0]->id;
            }
            else return FALSE;
        } // end function add_unit
        
        public function update_unit($args){
            $a = array();
            $sql = "UPDATE units SET";
            foreach ($args as $key => $value) {
                    $sql .= " ".$key."= ?,";
                    $a[]=$value;
            }
            $sql = trim($sql,',');
            $sql .= " WHERE id = ?";
            $a[] = $id;
            return $this->db->query($sql,$a);    
        } // end function update_unit
        
        public function delete_unit($id){
            $sql = "UPDATE units SET
            deleted_at = ?, deleted_by = ? WHERE id = ?";
            return $this->db->query($sql,array(date('',time()),  ip2long($_SERVER['REMOTE_ADDR']),$id));            
        } // end function delete_unit
        
}

