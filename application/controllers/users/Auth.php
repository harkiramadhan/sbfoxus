<?php
class Auth extends CI_Controller{
    function __construct(){
        parent::__construct();

    }

    function login(){
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        try{
            $client = new SoapClient("https://userapi.emersion.com/Authentication.wsdl");
            $response = $client->__soapCall("login", [[
                'username' => $username,
                'password' => $password
            ]]);
            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => $response
            ];
        } catch (Exception $e) {
            $res = [
                'status' => 400,
                'messages' => @$e->getMessage(),
                'detail' => @$e->detail
            ];
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }
    
}