<?php 
defined("BASEPATH") or exit("Direct Access Not Allowed");
class Event extends CI_Controller{
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");  
        $this->load->model("Categorymodel","category");
        $this->load->model("Eventmodel","event");
    }
    public function addEvent(){
        $msg['response'] = false;
        $config['upload_path'] = "./assets/event/banner/";
        $config['allowed_types'] = "JPG|PNG|JPEG|jpg|png|jpeg";
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('file')){
            $msg['error'] = $this->upload->display_errors();
        }else{
            $data = $this->upload->data();
            $input['event_banner']=$data['file_name'];
            $input['event_title'] = $this->input->post("title");
            $input['event_description'] = $this->input->post("description");
            $input['event_status'] = 1;
            $input['event_creation'] = date("d/m/Y");
            $category = $this->input->post('category');
            $msg['response'] = $this->category->addEvent($input,$category);
            
        }
       echo json_encode($msg);  
    }
    public function getEvent(){
        $data = $this->event->getEvent();
        echo json_encode($data);
    }
    public function registerEvent(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
        header("Access-Control-Allow-Headers: X-Requested-With");
        
        $input['registration_name'] = $this->input->post("name");
        $input['registration_DOB'] = $this->input->post("dob");
        $input['registration_email'] = $this->input->post("email");
        $input['registration_phone'] =  $this->input->post("phone");
        $input['registration_address'] = $this->input->post("address");
        $input['registration_pincode'] = $this->input->post("pincode");
        $input['registration_country'] = $this->input->post("country");
        $input['registration_yearofexperience'] =  $this->input->post("yearofexperience");
        $input['registration_organization'] = $this->input->post("organization");
        $input['registration_skills'] = $this->input->post("skills");
        $input['registration_experiencedetail'] = $this->input->post("experiencedetail");
        $input['registration_goals'] =  $this->input->post("goals");
        $input['registration_intrest'] = $this->input->post("intrest");
        $input['registration_trainingdetail'] = $this->input->post("trainingdetail");
        $input['registration_status'] = 1;
        $input['event_id'] =  $this->input->post("eventid");
        $input['registration_creation'] = date("d/m/Y h:i A");
        $msg['response'] = $this->event->registerEvent($input);
        echo json_encode($msg);  
    }
    public function addInstructor(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
        header("Access-Control-Allow-Headers: X-Requested-With");
        
        $msg['response'] = false;
        $config['upload_path'] = "./assets/instructor/";
        $config['allowed_types'] = "png|jpg|jpeg|PNG|JPG|JPEG";
        $this->load->library("upload",$config);
        if(!$this->upload->do_upload("image")){
            $msg['error'] = $this->upload->display_errors();

        }else{
            $imgData = $this->upload->data();
        
            $input['instructor_image'] = base_url("assets/instructor/").$imgData['file_name'];
            $input['instructor_name'] = $this->input->post("name");
            $input['instructor_designation'] = $this->input->post("designation");
            $input['instructor_description'] = $this->input->post("description");
            $input['instructor_facebook'] = $this->input->post("facebook");
            $input['instructor_email'] = $this->input->post("email");
            $input['instructor_linkedin'] = $this->input->post("linkedin");
            $input['instructor_status'] = 1;
            $input['instructor_creation'] =date("d/m/Y");
            $input['event_id']=$this->input->post("event_id");
            $msg['response'] = $this->event->addInstructor($input);
            echo json_encode($msg);
        }
    }
    public function getInstructor(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
        header("Access-Control-Allow-Headers: X-Requested-With");
        $event_id = $this->input->post("event_id");
        $data = $this->event->getInstructor($event_id);
        echo json_encode($data);
    }
}