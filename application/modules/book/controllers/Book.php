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

		$query = $this->db->get_where('slots', array( 'resource_id' => $resource_id, 'day' => 0 ));


		foreach ($dates as $date) { 
							
			$day_name = date('N', strtotime($date));

			$slots_sql = "SELECT resources.id 
						FROM resources INNER JOIN slots ON resources.id = slots.resource_id 
						WHERE resources.id = ".$resource_id;

							if($query->num_rows() == 0){
								$slots_sql = $slots_sql." AND slots.day = ".$day_name;
							}

							$slots_sql = $slots_sql." AND ('".$date."' BETWEEN resources.start_date AND resources.end_date) 
							AND (slots.start_time <= '".$start_time."' AND slots.end_time >= '".$end_time."')";
							
							
						$slots_query = $this->db->query($slots_sql);


						if($slots_query->num_rows() == 0){

							return false;
							break;
						} 

						 $start_time = date('H:i:s', strtotime($start_time) +1);
						 $end_time = date('H:i:s', strtotime($end_time) -1);

						 
						
			$booking_check ="SELECT * FROM bookings 
							WHERE (booking_date = '".$date."' AND ('".$start_time."' BETWEEN start_time AND end_time))
							OR (booking_date = '".$date."' AND ('".$end_time."' BETWEEN start_time AND end_time))
							OR (booking_date = '".$date."' AND (start_time BETWEEN '".$start_time."' AND '".$end_time."'))
							OR (booking_date = '".$date."' AND (end_time BETWEEN '".$start_time."' AND '".$end_time."'))";

							
							$booking_query = $this->db->query($booking_check);

							if($booking_query->num_rows() > 0){

								return false;
								break;
							} 
		}


		return true;


	}

	public function do_book($resource_id, $dates, $start_time, $end_time){

		foreach ($dates as $date) {

			$insert = array('resource_id' => $resource_id,
							'booking_date' => $date,
							'start_time' => $start_time,
							'end_time' => $end_time,
							'created_at' => date('Y-m-d H:i:s'));

			$this->db->insert('bookings', $insert);

		}

			return "booking done";

	}

	public function insert(){


					$resource_id = 2;
					$booking_date = '2017-02-23';
					$start_time = '12:00:00';
					$end_time = '13:00:00';
					$repeat = array('type' => "day", 'frequency' => 1, 'week_day' => array(1,4,5), 'end_on' => '2017-02-27' );
					//$repeat = array();

					//for daily booking
					if(!empty($repeat)){

						//step 1 find all booking dates
						$dates = $this->booking_dates($booking_date,$repeat);
						
						//step 2 check in database
						$database_check = $this->check_database($resource_id, $dates, $start_time, $end_time);
						//step 3 book or return error
						if($database_check){

							echo $this->do_book($resource_id, $dates, $start_time, $end_time);

						} else {

							echo "Booking not avialable";

						}
						

					} else {


						$database_check = $this->check_database($resource_id, array($booking_date), $start_time, $end_time);
						//step 3 book or return error
						if($database_check){

							echo $this->do_book();

						} else {

							echo "Booking not avialable";

						}

					}


		
		
	}

	public function test(){


		

		
		
	}
}