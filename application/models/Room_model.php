<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

    public function Add($data)
	{
	    $this->db->insert('roomkit', $data);
	}
	
	public function Update($room_id = '1222', $room_field_name = 'price', $room_info_value = '8tryyy')
	{

		$data = array($room_field_name => $room_info_value);
		$this->db->where('id', $room_id);
		$this->db->update('roomkit', $data);

		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$dateup = date('H:i, d-m-Y');
		// $this->db->where('id', $room_id);
		// $this->db->update('apartment', array('dateup'=>$dateup));
	}
	public function Delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete('roomkit');
	}

	

}

/* End of file room_model.php */
/* Location: ./application/models/room_model.php */