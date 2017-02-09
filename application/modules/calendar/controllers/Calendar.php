<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function index(){

		if($this->input->get('type')){
			$this->session->set_userdata(array('calendar_type' => $this->input->get('type')));
			redirect('/');
		} else if(!$this->session->userdata('calendar_type')){
			$this->session->set_userdata(array('calendar_type' => 'w'));
			redirect('/');
		}

		$prefs = array(
        	'start_day'    => 'monday',
        	'show_next_prev' => true
		);


		$this->load->library('calendar', $prefs);

		

	
		$data['side_calendar'] = $this->calendar->generate();
		$data['main_calendar'] = $this->calendar->generate_main_calendar();

		$this->load->template('calendar/list',$data);


	}
}
