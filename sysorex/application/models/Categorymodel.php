<?php
defined("BASEPATH") or exit("No Direct Access Allowed");
class Categorymodel extends CI_Model{
    public function addEvent($input,$category){
        $status['response'] = false;
        if($this->db->insert("tbl_event",$input)){
            $status['id'] = $this->db->insert_id();
            $status['response'] = true;
            $inputdata['category_id'] = $category;
            $inputdata['event_id'] = $status['id'];
            $this->addCategory($inputdata);
        }
        return $status;
    }
    public function addCategory($input){
        $this->db->insert("tbl_categorylog",$input);
    }
    public function getCatgories(){
        $data = $this->db->get("tbl_category");
       return $data->result();
    }
}