<?php
class Contacts extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->username = 'foxusapi';
        $this->password = '3nJJdo!ryQcs';
        $this->soapUrl = 'https://api.emersion.com.au/Contacts.wsdl';
    }

    function SearchAddresses(){
        $SearchString = $this->input->post('SearchString', TRUE);
        $client = new SoapClient($this->soapUrl);
        $header = getSoapHeader($this->username, $this->password);
        $client->__setSoapHeaders([$header]);
        
        try {
            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => $client->SearchAddresses([
                    'Country' => 113,
                    'SearchString' => $SearchString 
                ])
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