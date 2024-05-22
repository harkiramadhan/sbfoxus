<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS, POST, GET, PUT");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

class Accounts extends CI_Controller{
    function __construct(){
        parent::__construct();
    
        $this->username = 'foxusapi';
        $this->password = '3nJJdo!ryQcs';
        $this->soapUrl = 'https://external.emersion.com.au/Accounts.wsdl';
    }   

    function index(){
        try{
            $client = new SoapClient($this->soapUrl);
            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => $client->__getFunctions()
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

    function GetAccount(){
        $AccountID = $this->input->post('AccountID', TRUE);
        $client = new SoapClient($this->soapUrl);
        $header = getSoapHeader($this->username, $this->password);
        $client->__setSoapHeaders([$header]);
        
        try {
            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => $client->GetAccount(['AccountID' => $AccountID])
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

    function GetAccounts(){
        $client = new SoapClient($this->soapUrl);
        $header = getSoapHeader($this->username, $this->password);
        $client->__setSoapHeaders([$header]);
        try {
            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => $client->GetAccounts()
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

    function GetAccountBalance(){
        $AccountID = $this->input->post('AccountID', TRUE);
        $client = new SoapClient($this->soapUrl);
        $header = getSoapHeader($this->username, $this->password);
        $client->__setSoapHeaders([$header]);
        
        try {
            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => $client->GetAccountBalance(['AccountID' => $AccountID])
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