<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index(){
		$this->output->set_content_type('application/json')->set_output(json_encode([
			'status' => 200,
			'messages' => 'API Online'
		]));
	}

	function login(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://myaccount.foxus.com.au/login',
			CURLOPT_HEADER => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => http_build_query(array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
			)),
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
		));

		$response = curl_exec($curl);

		if ($response === false) {
			$error = curl_error($curl);
			curl_close($curl);
			die("cURL Error: $error");
		}

		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$header = substr($response, 0, $header_size);
		$body = substr($response, $header_size);

		curl_close($curl);

		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
		$cookies = array();
		foreach($matches[1] as $item) {
			parse_str($item, $cookie);
			$cookies = array_merge($cookies, $cookie);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($cookies));
	}
}
