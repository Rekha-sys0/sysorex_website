<?php 
defined("BASEPATH") or exit("No Direct Access Allowed");
class Contactus extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Contactusmodel","contact");
        date_default_timezone_set('Asia/kolkata');
    }
    public function addMessage(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
        header("Access-Control-Allow-Headers: X-Requested-With");
        
        $msg['response'] = false;
        $input['contact_name'] = $this->input->post("name");
        $input['contact_email'] = $this->input->post("email");
        $input['contact_phone'] = $this->input->post("phone");
        $input['contact_subject'] = $this->input->post("subject");
        $input['contact_message'] = $this->input->post("message");
        $input['contact_date'] = date("d/m/Y h:i A");
        $msg['response'] = $this->contact->addMessage($input);
       
        echo json_encode($msg);
    }
}