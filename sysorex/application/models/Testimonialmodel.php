<?php
defined("BASEPATH") or exit("NO Direct Access Allowed");
class Testimonialmodel extends CI_Model
{
	public function getTestimonial()
	{


		$data =  $this->db->get("tbl_testimonial");
		return $data->result();
	}

	public function addTestimonial($input)
	{
		$status = false;
		if ($this->db->insert("tbl_testimonial", $input)) {
			$status = true;
		}
		return $status;
	}
	public function getInstructor($event_id)
	{
		$data = $this->db->get_where("tbl_instructor", array("event_id" => $event_id));
		return $data->result();
	}
}
