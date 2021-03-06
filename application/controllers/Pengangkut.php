<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Pengangkut extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library('encryption');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('User_model', 'user');

		$this->cont = "pengangkut";
	}

	public function index()
	{
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Dashboard",
			'maintitle' => "Dashboard",
			'user' => $this->user->getUser(),
			'ref' => $this->user->getTrackings1('rksp'),
			'refmanifes' => $this->user->getTrackings1('manifes')
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/index', $data);
		$this->load->view('modals/rksp');
		$this->load->view('modals/manifes');
		$this->load->view('modals/bongkar');
		$this->load->view('modals/track');
		$this->load->view('templates/footer');
	}

	public function tracking()
	{
		$nomor = $this->input->post('nomor');
		$jenis = $this->input->post('jenis');

		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Tracking",
			'maintitle' => "Result for ".$jenis." nomor ".$nomor,
			'user' => $this->user->getUser(),
			'tracking' => $this->user->getTrackingsByNomor($nomor, $jenis)
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/tracking', $data);
		$this->load->view('modals/track');
		$this->load->view('templates/footer');
	}

	public function rksp()
	{
		$config = [
			'base_url' => base_url('pengangkut/rksp'),
			'total_rows' => $this->user->numTrackings('rksp'),
			'per_page' => 10
		];
		$this->config->load('pagination');
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "RKSP",
			'maintitle' => "Data RKSP",
			'page' => $page,
			'pagination' => $this->pagination->create_links(),
			'user' => $this->user->getUser(),
			'ref' => $this->user->getTrackings1('rksp'),
			'refmanifes' => $this->user->getTrackings1('manifes'),
			'documents' => $this->user->getTrackings('rksp', $page, $config['per_page']),
			'modal' => "RKSP"
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents', $data);
		$this->load->view('modals/rksp');
		$this->load->view('modals/manifes');
		$this->load->view('modals/bongkar');
		$this->load->view('modals/upload');
		$this->load->view('modals/track');
		$this->load->view('templates/footer');
	}

	public function manifes()
	{
		$config = [
			'base_url' => base_url('pengangkut/manifes'),
			'total_rows' => $this->user->numTrackings('manifes'),
			'per_page' => 10
		];
		$this->config->load('pagination');
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Manifes",
			'maintitle' => "Data Manifes",
			'page' => $page,
			'pagination' => $this->pagination->create_links(),
			'user' => $this->user->getUser(),
			'ref' => $this->user->getTrackings1('rksp'),
			'refmanifes' => $this->user->getTrackings1('manifes'),
			'documents' => $this->user->getTrackings('manifes', $page, $config['per_page']),
			'modal' => "Manifes"
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents', $data);
		$this->load->view('modals/rksp');
		$this->load->view('modals/manifes');
		$this->load->view('modals/bongkar');
		$this->load->view('modals/upload');
		$this->load->view('modals/track');
		$this->load->view('templates/footer');
	}

	public function bongkar()
	{
		$config = [
			'base_url' => base_url('pengangkut/bongkar'),
			'total_rows' => $this->user->numTrackings('bongkar'),
			'per_page' => 10
		];
		$this->config->load('pagination');
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Pembongkaran",
			'maintitle' => "Data Pembongkaran",
			'page' => $page,
			'pagination' => $this->pagination->create_links(),
			'user' => $this->user->getUser(),
			'ref' => $this->user->getTrackings1('rksp'),
			'refmanifes' => $this->user->getTrackings1('manifes'),
			'documents' => $this->user->getTrackings('bongkar', $page, $config['per_page']),
			'modal' => "Bongkar"
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents', $data);
		$this->load->view('modals/rksp');
		$this->load->view('modals/manifes');
		$this->load->view('modals/bongkar');
		$this->load->view('modals/upload');
		$this->load->view('modals/track');
		$this->load->view('templates/footer');
	}
}