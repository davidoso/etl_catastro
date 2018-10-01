<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//session_start(); // We need to start session in order to access it through CI

class Etl extends CI_Controller {

	// Show login page
	public function index()
	{
		$this->load->view('login');
	}

	// Show welcome message after login
	public function welcome()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('welcome');
	}

	// Show login page after failed login or ETL welcome page after a succesful/failed signup
	public function login()
	{
		$this->load->model('login_model');

		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'success_message' => 'Acesso correcto'
		);

		$queryResult = $this->login_model->getUser($data);

		if(empty($queryResult)) {
			$data = array(
				'error_message' => 'Usuario y/o contraseña inválidos'
			);
			$this->load->view('login', $data);
		}
		else {
			//$username = $this->input->post('username');
			//$this->session->set_userdata('username', $username); // Save current session
			$this->session->set_userdata($queryResult); // Save current session
			$this->login_model->logUserLogin($data); // Save log
			$this->load->view('welcome'); // Load welcome page
		}
	}

	// Reload login page after a new user insertion (if the user doesn't exist before)
	public function signup()
	{
		$this->load->model('login_model');

		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'gender' => $this->input->post('gender')
		);

		$queryResult = $this->login_model->createUser($data);

		if($queryResult > 0) {
			$data = array(
				'signup_message' => 'Usuario creado.<br>Ahora puede iniciar sesión'
			);
			$this->load->view('login', $data);
		}
		else {
			$data = array(
				'signup_message' => 'Usuario ya existe.<br>Intente de nuevo'
			);
			$this->load->view('login', $data);
		}
	}

	// Close database connection and load login page
	public function signout()
	{
		$this->session->sess_destroy();
		//$this->db->close();
		redirect('Etl/#SignedOut', 'refresh');
	}

	// Show ETL main menu page
	public function etlhome()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('etlhome');
	}

	// Show ETL continue page
	public function etlload()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('etlload');
	}

	// Show Generales, capa bancos
	public function bancos()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/bancos');
	}

	// Show Generales, capa hoteles
	public function hoteles()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/hoteles');
	}

	// Show Generales, capa postes
	public function postes()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/postes');
	}

	// Show Generales, capa teléfonos
	public function telefonos()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/telefonos');
	}

	// Show INAH, capa monumentos
	public function monumentos()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/monumentos');
	}

	// Show Registro Civil, capa panteón
	public function panteon()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/panteon');
	}

	// Show Servicios Públicos, capa luminarias
	public function luminarias()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/luminarias');
	}

	// Show Comercio, capa mercados
	public function mercados()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/mercados');
	}

	// Show Comercio, capa locatarios mercados
	public function padronmercados()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->model('login_model');
		$data['locatarios'] = $this->login_model->getLocatariosMercados();
		$this->load->view('capas/padronmercados', $data);
	}

	// Show Comercio, capa tianguis
	public function tianguis()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/tianguis');
	}

	// Show Comercio, capa tianguistas
	public function padrontianguis()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->model('login_model');
		$data['tianguistas'] = $this->login_model->getTianguistas();
		$this->load->view('capas/padrontianguis', $data);
	}

	// Show Comercio, capa plazas comerciales
	public function plazas()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/plazas');
	}

	// Show Comercio, capa giros comerciales
	public function giroscomerciales()
	{
		if(!$this->session->userdata('username')) {
			redirect('Etl/#Login', 'refresh');
		}
		$this->load->view('capas/giroscomerciales');
	}

}
?>