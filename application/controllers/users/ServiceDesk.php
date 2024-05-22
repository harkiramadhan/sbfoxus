<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS, POST, GET, PUT");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

class ServiceDesk extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->soapUrl = 'https://userapi.emersion.com/ServiceDesk.wsdl';
    }

    function getServiceDeskList(){
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        
        try {
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("getServiceDeskList", [[
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