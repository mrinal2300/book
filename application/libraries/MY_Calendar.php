<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Calendar extends CI_Calendar {

	// public function __construct(){
 //        parent::__construct();
 //    }


    public function generate_main_calendar(){


    	if($this->CI->session->userdata('calendar_type') == 'd'){

    		return $this->day_html();

    	} elseif($this->CI->session->userdata('calendar_type') == 'm'){

    		return $this->month_html();

    	}  else {
    		return $this->week_html();
    	}

    }


     public function month_html(){

     	$out = "";
     	$out = '<button class="btn btn-primary btn-sm">Pre</button> ';
		$out .= ' <button class="btn btn-primary btn-sm">Next</button> ';
		$out .= date('d M Y') . ' ';
		$out .= '<span class="pull-right">';
		$out .= '<a class="btn btn-primary btn-sm" href="/?type=d">Day</a> ';
		$out .= '<a class="btn btn-primary btn-sm" href="/?type=w">Week</a> ';
		$out .= ' <a class="btn btn-primary btn-sm" href="/?type=m">Month</a> ';
		$out .= '</span>';
		$out .= '<hr>';

     	$out .= $this->generate();

     	return $out;

     }


    public function day_html(){

    	$out = "";

		$range=range(strtotime("00:00"),strtotime("23:59"),30*60);

    	$out = '<button class="btn btn-primary btn-sm">Pre</button> ';
		$out .= ' <button class="btn btn-primary btn-sm">Next</button> ';

		$out .= date('d M Y') . ' ';

		$out .= '<span class="pull-right">';
		$out .= '<a class="btn btn-primary btn-sm" href="/?type=d">Day</a> ';
		$out .= '<a class="btn btn-primary btn-sm" href="/?type=w">Week</a> ';
		$out .= ' <a class="btn btn-primary btn-sm" href="/?type=m">Month</a> ';
		$out .= '</span>';

		$out .= '<hr><table border="1" width="100%">';

		$out .= '<tr>';
		$out .= '<td>Time</td>';
		$out .= '<td>'.date('d M Y').'</td>';
		$out .= '</tr>';

		foreach($range as $time){

			$out .= '<tr><td>';
			$out .= date("H:i",$time);
			$out .= '</td>';
			
			$out .= '<td class="time-slot"></td>';

			$out .= '</tr>';
		}

    	return $out;


    }


    public function week_html(){


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
		$out .= '<a class="btn btn-primary btn-sm" href="/?type=d">Day</a> ';
		$out .= '<a class="btn btn-primary btn-sm" href="/?type=w">Week</a> ';
		$out .= ' <a class="btn btn-primary btn-sm" href="/?type=m">Month</a> ';
		$out .= '</span>';

		$out .= '<hr><table border="1" width="100%">';

		$out .= '<tr>';

		$out .= '<td>Time</td>';


		foreach($days as $day){
        		
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
		

		$out .='</table>';
		

    	return $out;

    }

}