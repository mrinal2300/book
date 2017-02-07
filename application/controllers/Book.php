<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller {

	public function index()
	{

	}

	public function create($resource_id){

		
		

		$query = $this->db->get_where("resources",array("id"=>$resource_id));
		$resource = $query->row();
		$data['resource'] = $resource;

		$this->load->view('create_booking', $data);



		
	}

	public function test(){

		
		
	}

	public function insert(){



		$resource_id = $this->input->post('resource');
		echo $resource_id;
		$date = $this->input->post('date');
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');

		$sql_between = "SELECT resources.start_date, resources.end_date, slots.start_time, slots.end_time, bookings.start_time, bookings.end_time 
						FROM resources 
						INNER JOIN slots ON resources.id = slots.resource_id 
						LEFT JOIN bookings ON resources.id = bookings.resource_id 
						WHERE resources.id = ".$resource_id." 
						AND ('".$date."' BETWEEN resources.start_date AND resources.end_date) 
						AND (slots.start_time <= '".$start_time."' AND slots.end_time >= '".$end_time."')
						AND (bookings.end_time BETWEEN '".$start_time."' AND '".$end_time."')
						AND (bookings.start_time BETWEEN '".$start_time."' AND '".$end_time."')";


		$sql_over_lap ="SELECT resources.start_date, resources.end_date, slots.start_time, slots.end_time, bookings.start_time, bookings.end_time
						FROM resources 
						INNER JOIN slots ON resources.id = slots.resource_id
						LEFT JOIN bookings ON resources.id = bookings.resource_id
						WHERE resources.id = ".$resource_id."
						AND ('".$date."' BETWEEN resources.start_date AND resources.end_date)
						AND (slots.start_time <= '".$start_time."' AND slots.end_time >= '".$end_time."')
						AND ('".$start_time."' BETWEEN bookings.start_time AND bookings.end_time)
						OR ('".$end_time."' BETWEEN bookings.start_time AND bookings.end_time)";

						//echo $sql_over_lap;


		$query_between = $this->db->query($sql_between);
		$query_over_lap = $this->db->query($sql_over_lap);

		

		if($query_over_lap->num_rows || $query_between->num_rows != 0){

			echo "Booking not avialable";

		}else{

			$insert = array('resource_id' => $resource_id,
							'booking_date' => $date,
							'start_time' => $start_time,
							'end_time' => $end_time,
							'created_at' => date('Y-m-d H:i:s'));

		
			$this->db->insert('bookings', $insert);
				
			}

		

		
		
	}
}