<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Calendar extends REST_Controller {

	public function resources_get(){

		$sql = 'SELECT id,name FROM resources';
		$query = $this->db->query($sql);
	

		$output = array('total_count' => $query->num_rows() ,'items' => $query->result() );

		$this->response($output, REST_Controller::HTTP_OK);

	}

	public function update_calendar_resource_post(){

		$calendar_resources = $this->input->post('val');

		$this->db->where('user_id', 1);
		$this->db->update('user_settings', array('calendar_resources' => $calendar_resources));


	}


	public function resourcessss_get(){


		$sql = 'SELECT id,name FROM resources
				WHERE find_in_set(resources.id, (SELECT TRIM(calendar_resources) FROM user_settings WHERE user_settings.user_id = 1))';


		$sql = 'SELECT id,name FROM resources';

		$query = $this->db->query($sql);

		$result = $query->result_array();


		$this->response($result, REST_Controller::HTTP_OK);

	}

	
}