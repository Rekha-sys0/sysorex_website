<?php
defined("BASEPATH") or exit("No Direct Access Allowed");
class Testimonial extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Testimonialmodel", "testimonial");
	}
	public function addTestimonial()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
		header("Access-Control-Allow-Headers: X-Requested-With");

		$msg['response'] = false;
		$config['upload_path'] = "./assets/testimonial/";
		$config['allowed_types'] = "png|jpg|jpeg|PNG|JPG|JPEG";
		$this->load->library("upload", $config);
		if (!$this->upload->do_upload("image")) {
			$msg['error'] = $this->upload->display_errors();
		} else {
			$imgData = $this->upload->data();
			$input['testimonial_image'] = base_url("assets/testimonial/") . $imgData['file_name'];
			$input['testimonial_title'] = $this->input->post("title");
			$input['testimonial_subtitle'] = $this->input->post("subtitle");
			$input['testimonial_rating'] = $this->input->post("rating");
			$input['testimonial_comment'] = $this->input->post("comment");
			$input['testimonial_status'] = 1;
			$msg['response'] = $this->testimonial->addTestimonial($input);
		}
		echo json_encode($msg);
	}
	public function  getTestimonial()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
		header("Access-Control-Allow-Headers: X-Requested-With");

		$data = $this->testimonial->getTestimonial();
		echo json_encode($data);
	}
}
