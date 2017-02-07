<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {

	public function index(){


		$this->load->dbforge();

        //Create resource table
        $fields = array(
            'id' => array(
                    'type' => 'INT',
                    'auto_increment' => TRUE
            ),
            'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 150
            ),
            'description' => array(
                    'type' =>'TEXT'
            ),
            'start_date' => array(
                    'type' =>'DATE'
            ),
            'end_date' => array(
                    'type' =>'DATE'
            ),
            'created_at' => array(
                    'type' => 'DATETIME'
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('resources', TRUE);


        $fields = array(
            'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
            ),
            'start_time' => array(
                    'type' => 'TIME'
            ),
            'end_time' => array(
                     'type' => 'TIME'
            ),
            'past_booking_allowed' => array(
                    'type' => 'tinyint',
                    'constraint' => '1',
                    'default' => 1,
            ),
            'resource_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('resource_slots', TRUE);


	}
}
