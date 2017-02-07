<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function index(){


		$this->load->library('calendar');

	
		$data['calendar'] = $this->calendar->generate();

		$this->load->template('calendar/list',$data);


	}
}
