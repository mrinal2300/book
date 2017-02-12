<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller {

	public function index()
	{

	}

	public function new()
	{
		$query = $this->db->get("resources");
		$data['resources'] = $query->result();
		$this->load->template('list',$data);


	}

	public function create($resource_id){

		
		

		$query = $this->db->get_where("resources",array("id"=>$resource_id));
		$resource = $query->row();
		$data['resource'] = $resource;

		$this->load->template('create', $data);



		
	}

	public function booking_dates($date, $repeat){


		$start_date = new DateTime($date);
		$end_date   = new DateTime($repeat['end_on']);

		if(in_array($repeat['type'], array("day", "month", "year"))){

			for($i = $start_date; $start_date <= $end_date; $i->modify('+'.$repeat['frequency'].' ' .$repeat['type'])){

				$days[] = $i->format("Y-m-d");
					
			}

		} elseif($repeat['type'] == "week"){

			for($i = $start_date; $start_date <= $end_date; $i->modify('+'.$repeat['frequency'].' week')){

					
				foreach ($repeat['week_day'] as $week_day) {

					$dowMap = array('1' => 'next monday', '2' => 'next tuesday','3' =>  'next wednesday', '4' => 'next thursday', '5' => 'next friday', '6' => 'next saturday', '7' => 'next sunday');
    				$days[] = date('Y-m-d', strtotime($dowMap[$week_day], strtotime($i->format('Y-m-d'))));
				}
	
			}

		
		}

		
		return  $days;

	}

	public function check_database($resource_id, $dates, $start_time, $end_time){


		foreach ($dates as $date) { 
							


		$slots_sql = "SELECT resources.start_date, resources.end_date, slots.start_time, slots.end_time
						FROM resources 
						INNER JOIN slots ON resources.id = slots.resource_id 
						WHERE resources.id = ".$resource_id." 
						AND ('".$date."' BETWEEN resources.start_date AND resources.end_date) 
						AND (slots.start_time <= '".$start_time."' AND slots.end_time >= '".$end_time."')";
							

						$slots_query = $this->db->query($slots_sql);

						echo $slots_query->num_rows();
							
						}


		return true;


	}

	public function do_book(){

		return "booking done";

	}

	public function test(){


					$resource_id = 1;
					$booking_date = '2017-02-10';
					$start_time = '09:00:00';
					$end_time = '11:00:00';
					$repeat = array('type' => "month", 'frequency' => 1, 'week_day' => array(1,4,5), 'end_on' => '2019-03-19' );

					//for daily booking
					if(!empty($repeat)){

						//step 1 find all booking dates
						$dates = $this->booking_dates($booking_date,$repeat);
						
						//step 2 check in database
						$database_check = $this->check_database($resource_id, $dates, $start_time, $end_time);
						//step 3 book or return error
						if($database_check){

							echo $this->do_book();

						} else {

							echo "Booking not avialable";

						}

						echo "<pre>";
						print_r($dates);
						die();

						$startTimeStamp = strtotime($date);
						$endTimeStamp = strtotime($end_date);
						$timeDiff = abs($endTimeStamp - $startTimeStamp);
						$number_days = $timeDiff/86400; 
						$booking_days = floor($number_days/$repeat_number);
						$booking_dates = '';

						for ($i=0; $i <= $booking_days ; $i++) { 
							
							$booking_dates = $date;

		$sql_between = "SELECT resources.start_date, resources.end_date, slots.start_time, slots.end_time, bookings.start_time, bookings.end_time 
						FROM resources 
						INNER JOIN slots ON resources.id = slots.resource_id 
						LEFT JOIN bookings ON resources.id = bookings.resource_id 
						WHERE resources.id = ".$resource_id." 
						AND ('".$booking_dates."' BETWEEN resources.start_date AND resources.end_date) 
						AND (slots.start_time <= '".$start_time."' AND slots.end_time >= '".$end_time."')
						AND (bookings.end_time BETWEEN '".$start_time."' AND '".$end_time."')
						AND (bookings.start_time BETWEEN '".$start_time."' AND '".$end_time."')";


		$sql_over_lap ="SELECT resources.start_date, resources.end_date, slots.start_time, slots.end_time, bookings.start_time, bookings.end_time
						FROM resources 
						INNER JOIN slots ON resources.id = slots.resource_id
						LEFT JOIN bookings ON resources.id = bookings.resource_id
						WHERE resources.id = ".$resource_id."
						AND ('".$booking_dates."' BETWEEN resources.start_date AND resources.end_date)
						AND (slots.start_time <= '".$start_time."' AND slots.end_time >= '".$end_time."')
						AND ('".$start_time."' BETWEEN bookings.start_time AND bookings.end_time)
						OR ('".$end_time."' BETWEEN bookings.start_time AND bookings.end_time)";

						echo $sql_between;
						echo "</br>";
						$booking_dates = date('Y-m-d', strtotime($date . ' +'.$repeat_number.' day'));
						$date = $booking_dates;
							

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

		
			//$this->db->insert('bookings', $insert);
				
			}
							
						}

					}

					

		$daily =       "SELECT resources.start_date, resources.end_date, slots.start_time, slots.end_time, bookings.start_time, bookings.end_time 
						FROM resources 
						INNER JOIN slots ON resources.id = slots.resource_id 
						LEFT JOIN bookings ON resources.id = bookings.resource_id 
						WHERE resources.id = ".$resource_id." 
						AND ('".$date."' BETWEEN resources.start_date AND resources.end_date)
						AND ('".$end_date."' BETWEEN resources.start_date AND resources.end_date) 
						AND (slots.start_time <= '".$start_time."' AND slots.end_time >= '".$end_time."')
						AND (bookings.end_time BETWEEN '".$start_time."' AND '".$end_time."')
						AND (bookings.start_time BETWEEN '".$start_time."' AND '".$end_time."')";
					

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

		
			//$this->db->insert('bookings', $insert);
				
			}


		
		
	}

	public function insert(){



		// $resource_id = $this->input->post('resource');
		// echo $resource_id;
		// $date = $this->input->post('date');
		// $start_time = $this->input->post('start_time');
		// $end_time = $this->input->post('end_time');

		// $sql_between = "SELECT resources.start_date, resources.end_date, slots.start_time, slots.end_time, bookings.start_time, bookings.end_time 
		// 				FROM resources 
		// 				INNER JOIN slots ON resources.id = slots.resource_id 
		// 				LEFT JOIN bookings ON resources.id = bookings.resource_id 
		// 				WHERE resources.id = ".$resource_id." 
		// 				AND ('".$date."' BETWEEN resources.start_date AND resources.end_date) 
		// 				AND (slots.start_time <= '".$start_time."' AND slots.end_time >= '".$end_time."')
		// 				AND (bookings.end_time BETWEEN '".$start_time."' AND '".$end_time."')
		// 				AND (bookings.start_time BETWEEN '".$start_time."' AND '".$end_time."')";


		// $sql_over_lap ="SELECT resources.start_date, resources.end_date, slots.start_time, slots.end_time, bookings.start_time, bookings.end_time
		// 				FROM resources 
		// 				INNER JOIN slots ON resources.id = slots.resource_id
		// 				LEFT JOIN bookings ON resources.id = bookings.resource_id
		// 				WHERE resources.id = ".$resource_id."
		// 				AND ('".$date."' BETWEEN resources.start_date AND resources.end_date)
		// 				AND (slots.start_time <= '".$start_time."' AND slots.end_time >= '".$end_time."')
		// 				AND ('".$start_time."' BETWEEN bookings.start_time AND bookings.end_time)
		// 				OR ('".$end_time."' BETWEEN bookings.start_time AND bookings.end_time)";

		// 				//echo $sql_over_lap;


		// $query_between = $this->db->query($sql_between);
		// $query_over_lap = $this->db->query($sql_over_lap);

		

		// if($query_over_lap->num_rows || $query_between->num_rows != 0){

		// 	echo "Booking not avialable";

		// }else{

		// 	$insert = array('resource_id' => $resource_id,
		// 					'booking_date' => $date,
		// 					'start_time' => $start_time,
		// 					'end_time' => $end_time,
		// 					'created_at' => date('Y-m-d H:i:s'));

		
		// 	//$this->db->insert('bookings', $insert);
				
		// 	}

		

		
		
	}
}