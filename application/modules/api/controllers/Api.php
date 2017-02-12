<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {

	public function calender_resources_get(){


		

		$data = array(1,1,2,3,4,5);


		$this->response($data, REST_Controller::HTTP_OK);

	}

	
}