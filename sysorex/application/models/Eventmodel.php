<?php 
defined("BASEPATH") or exit("NO Direct Access Allowed");
class EventModel extends CI_Model{
    public function getEvent(){
        $eventData = array();
        // $this->db->where("event_status",1);
       $data =  $this->db->get("tbl_event");
       foreach($data->result() as $res){
            $dim['title'] = $res->event_title;
            $dim['desciption'] = $res->event_description;
            $dim['banner'] = $res->event_banner;
            $dim['status'] = $res->event_status;
            $dim['creation'] = $res->event_creation;
            $dim['categories'] = $this->getCategory($res->event_id);
            array_push($eventData,$dim);
       }
       return $eventData;
    }
    public function getCategory($id){
        $this->db->from("tbl_categorylog as tcl");
        $this->db->join("tbl_category as tc","tc.category_id=tcl.category_id","left");
        $this->db->where("tcl.event_id" ,$id);
        $data = $this->db->get();
        $categoryData = array();
        foreach($data->result() as $res){
            $dim['category'] = $res->category_name;
            array_push($categoryData,$dim);
        }
        return $categoryData;

    }
    public function checkEventEmail($email){
        $response= false;
       $data =  $this->db->get_where("tbl_eventregistration",array("registration_email"=>$email));
        if($data->num_rows() >0){
            $response = true;
        }
        return $response;
    }
    public function registerEvent($input){
        $status['response'] = false;
        if(!$this->checkEventEmail($input['registration_email'])){
            if($this->db->insert("tbl_eventregistration",$input)){
                $status['response'] = true;
            }
        }
        else{
            $status['msg'] = "Already Registered for this event";
        }
        return $status;
    }
    public function addInstructor($input){
        $status = false;
        if($this->db->insert("tbl_instructor",$input)){
            $status = true;
        }
        return $status;
    }
    public function getInstructor($event_id){
        $data = $this->db->get_where("tbl_instructor",array("event_id"=>$event_id));
        return $data->result();
    }
}