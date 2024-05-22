<?php
class Services extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->username = 'foxusapi';
        $this->password = '3nJJdo!ryQcs';
        $this->soapUrl = 'https://api.emersion.com.au/Services.wsdl';
    }

    function serviceList(){
        $account_id = $this->input->post('account_id', TRUE);
        $status = $this->input->post('status', TRUE);
        $page = $this->input->post('page', TRUE);
        $page_size = $this->input->post('page_size', TRUE);

        $client = new SoapClient($this->soapUrl);
        $header = getSoapHeader($this->username, $this->password);
        $client->__setSoapHeaders([$header]);
        
        try {
            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => $client->serviceList([
                    'account_id' => $account_id,
                    'status' => $status,
                    'page' => $page,
                    'page_size' => $page_size
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