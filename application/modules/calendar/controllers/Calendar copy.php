<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function index(){





	if($this->uri->segment(3) &&
		$this->uri->segment(4) &&
		is_numeric($this->uri->segment(3)) &&
		is_numeric($this->uri->segment(4)) &&
		(strlen($this->uri->segment(3)) == 4) &&
		(strlen($this->uri->segment(4)) == 2)
		){

		$this->session->set_userdata(
			array(
				'side_calendar_year' => $this->uri->segment(3),
				'side_calendar_month' => $this->uri->segment(4)
				)
			);
		redirect('/');
	} else if(!$this->session->userdata('side_calendar_year') || !$this->session->userdata('side_calendar_month')){
		$this->session->set_userdata(
			array(
				'side_calendar_year' => date('Y'),
				'side_calendar_month' => date('m')
				)
			);
	}

	




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


		$datas = array(
        3  => 'http://example.com/news/article/2006/06/03/',
        7  => 'http://example.com/news/article/2006/06/07/',
        13 => 'http://example.com/news/article/2006/06/13/',
        26 => 'http://example.com/news/article/2006/06/26/'
		);


		$this->load->library('calendar', $prefs);
		$data['side_calendar'] = $this->calendar->generate($this->session->userdata('side_calendar_year'),$this->session->userdata('side_calendar_month'), $datas);
		$data['main_calendar'] = $this->calendar->generate_main_calendar();
		$this->load->template('list',$data);


	}
}
