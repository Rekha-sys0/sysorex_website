<?php 
defined("BASEPATH") or exit("NO Direct Access Allowed");
class Contactusmodel extends CI_Model{
    public function addMessage($input){
        $response = false;
        if($this->db->insert("tbl_contact",$input)){
            $response = true;
        }
        return $response;
    }
}