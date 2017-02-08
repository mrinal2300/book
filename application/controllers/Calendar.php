<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function index(){


		$this->load->library('calendar');
	
		$data['side_calendar'] = $this->calendar->generate();
		$data['main_calendar'] = $this->calendar->generate_main_calendar();

		$this->load->template('calendar/list',$data);


	}
}
