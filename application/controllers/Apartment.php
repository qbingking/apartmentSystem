<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apartment extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('account') == "")
		{
			$this->session->sess_destroy();
			return redirect('Login');
		}

		$this->load->model('apartment_model');
		$this->load->helper('giohang/main'); // helper
		$this->load->helper('giohang/vendors'); // helper

	}

	public function index()
	{
		$this->Show();
	}

	public function Show()
	{
		$menu = array();
		$data = array();

		$data = [
			'list_apm' => $this->apartment_model->Show(),
			'list_district' => get_list_districts(), // main helper
			'list_service' => get_list_services(), // main helper
			'template' => 'body-contents/apm-list',
			'quote' => get_random_quote(),
			'district_active' => $this->session->district_active,
			'list_district_editable' => get_districts_CRUD($this->session->status, $this->session->account) != null ? get_districts_CRUD($this->session->status, $this->session->account): null,
			'editable' => get_districts_CRUD(
							$this->session->status, 
							$this->session->account) != null ? true : false
		];
		// echo "<pre>",print_r($data),"</pre>";

		$menu = [
			'list_menu' => get_menubar($this->session->status),
			'account' => $this->session->account
		];

	    $referlink['base_url_plugins'] = base_url()."templates";
    	$referlink['base_url_assets'] =  base_url()."templates/example/assets/";
    	$referlink['title_head'] = "GH - Sinva";

    	$footer = [
    		'vendors' => load_vendors(array(
    						'jquery-bottom',
    						'form-bottom',
    						'data-table-bottom',
    						'buttons-bottom',
    						'Xeditable-bottom',
    						'core-bottom'
    						))
    	];

		$this->load->view('components/header',$referlink);
		$this->load->view('components/header-content', $menu);
		$this->load->view('main-content-page', $data);
		$this->load->view('components/footer', $footer);
		
		// control loading footer js scripts file, that splited by role user
		if($data['editable'] == true)
		{
			$this->load->view('ajax-scripts/apm-editable'); // yummy
			$this->load->view('ajax-scripts/apm-add-new-item'); // yummy
			$this->load->view('ajax-scripts/apm-delete'); // yummy
			$this->load->view('ajax-scripts/apm-order-item'); // yummy
		}
		else
		{
			$this->load->view('ajax-scripts/apm-datatable'); // yummy
		}
		
	}

	public function updateWithoutRoom()
	{
		$apm_id = $this->input->post('pk');
		$apm_field_name = $this->input->post('name');
		$apm_info_value = $this->input->post('value');
		$this->apartment_model->Update($apm_id, $apm_field_name, $apm_info_value);
	}

	public function Delete()
	{
		$apm_id = $this->input->post('apm_id');
		$this->apartment_model->Delete($apm_id);
	}

	public function showNewForm($district_key)
	{
		$menu = array();
		$data['district_key'] = $district_key;
		$data['template'] = 'body-contents/apm-addnew';

		$referlink['base_url_plugins'] = base_url()."templates";
    	$referlink['base_url_assets'] =  base_url()."templates/example/assets/";
    	$referlink['title_head'] = "GH - Sinvahome";

		$json_menu = configMenu();
		$json_menu = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $json_menu);
		$json_menu = json_decode($json_menu,true);
		$menu['list_menu'] = $json_menu;
		
		$this->load->view('components/header',$referlink);
		$this->load->view('components/header-content', $menu);
		$this->load->view('main-content-page', $data);
		$this->load->view('components/footer', $referlink);
	}

	public function new($district_key){
		$data = array();
		$data['address'] = "[Căn Hộ Mới]";
		$data['id_district'] = $district_key;
		$this->session->set_userdata(array('district_active' => (string)$district_key));
		$this->apartment_model->Add($data);
		redirect('Apartment/Show','refresh');

	}
	public function newRoom()
	{
		$data = array();
		$data['id_apartment'] = $this->input->post('apm_id');
		$data['maphong'] = "000";
		
		$this->load->model('room_model');
		$this->room_model->Add($data);
	}
	public function updateRoom()
	{	
		echo "<scripts>";
		echo "This is updateRoom - APM controller";
		echo "</script>";
		

		$room_id = $this->input->post('id');
		$apm_id = $this->input->post('apm_id');

		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$dateup = date('H:i, d-m-Y');
		$this->apartment_model->updateOneField($apm_id, 'dateup', $dateup );
		
		$data_room = [
			$this->input->post('fieldName') => $this->input->post('content')
		];
		$this->load->model('room_model');
		$this->room_model->Update($room_id, $data_room);
	}
	public function deleteRoom()
	{
		$room_id = $this->input->post('room_id');
		$this->load->model('room_model');
		$this->room_model->Delete($room_id);
	}

	public function OrderItem()
	{
		$array_id = $this->input->post('page_id_array');
		$district_order = $this->input->post('district');
		for($i = 0; $i<count($array_id); $i++)
		{
			 $this->apartment_model->OrderItem($array_id[$i], $district_order, $i);
		}
	}
}

/* End of file Apartment.php */
/* Location: ./application/controllers/Apartment.php */