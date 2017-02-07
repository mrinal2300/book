<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller {

	public function index()
	{

	}

	public function create($resource_id){

		
		

		$query = $this->db->get_where("resources",array("id"=>$resource_id));
		$resource = $query->row();
		$data['resource'] = $resource;

		$this->load->template('create_booking', $data);



		
	}

	public function insert(){

		echo $this->input->post('resource');
		
	}

	public function test(){

		$resource_id = 1;
		$date = '2017-02-10';
		$start_time = '12:01:00';
		$end_time = '12:30:00';

		$sql = "SELECT resources.start_date, resources.end_date, slots.start_time, slots.end_time, bookings.start_time, bookings.end_time
				FROM resources 
				INNER JOIN slots ON resources.id = slots.resource_id
				LEFT JOIN bookings ON resources.id = bookings.resource_id
				WHERE resources.id = ".$resource_id."
				AND ('".$date."' BETWEEN resources.start_date AND resources.end_date)
				AND (slots.start_time <= '".$start_time."' AND slots.end_time >= '".$end_time."')
				AND ('".$start_time."' NOT BETWEEN bookings.start_time AND bookings.end_time)
				AND ('".$end_time."' NOT BETWEEN bookings.start_time AND bookings.end_time)";



		$query = $this->db->query($sql);

		if($query->num_rows() == 0){

			echo "booking not avialable";

		}else{

			$insert = array('resource_id' => $resource_id,
							'booking_date' => $date,
							'start_time' => $start_time,
							'end_time' => $end_time,
							'created_at' => date('Y-m-d H:i:s'));

			echo $sql;
			

			//$this->db->insert('bookings', $insert);

		}

		
		
	}
}