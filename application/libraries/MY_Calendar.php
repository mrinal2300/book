<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Calendar extends CI_Calendar {

	public function __construct(){
        parent::__construct();
    }


    public function generate_main_calendar(){


    	$out = "";


    	$type = 'week';

    	//strtotime('first day of this month');

		$current_week = date('W');
		$week_start = date('Y-m-d', strtotime('monday this week'));
		$week_end = date('Y-m-d', strtotime('sunday this week'));

		

		$begin = new DateTime($week_start);
		$end   = new DateTime($week_end);

		for($i = $begin; $begin <= $end; $i->modify('+1 day')){
			$days[] = $i->format("Y-m-d");
		}



		$range=range(strtotime("00:00"),strtotime("23:59"),30*60);

		$out = '<button class="btn btn-primary btn-sm">Pre</button> ';
		$out .= ' <button class="btn btn-primary btn-sm">Next</button> ';


		$out .= 'Week '.$current_week;

		$out .= '<span class="pull-right">';
		$out .= '<button class="btn btn-primary btn-sm">Day</button> ';
		$out .= '<button class="btn btn-primary btn-sm">Week</button> ';
		$out .= ' <button class="btn btn-primary btn-sm">Month</button> ';
		$out .= '</span>';

		$out .= '<hr><table border="1" width="100%">';

		$out .= '<tr>';

		$out .= '<td>Time</td>';


		foreach($days as $day){
        		//$times[] = date("H:i",$time);


				
				$out .= '<td>'.$day.'</td>';
				

		}

		$out .= '</tr>';

		foreach($range as $time){

			$out .= '<tr><td>';

			$out .= date("H:i",$time);


			$out .= '</td>';


			 foreach($days as $day){
						$out .= '<td class="time-slot"></td>';

					 }


			$out .= '</tr>';

			
               	 

		}
		
		

			


			//$out .= '<td>'.$i->format("Y-m-d").'</td>';

			

			//$arr[] = array('date' => $i->format("Y-m-d"), 'main' => $times);


			

	

		$out .='</table>';
		

		//echo '<pre>'; print_r($arr); echo '</pre>';


		

		

    	return $out;

    }

}