<?php
class Plans extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->username = 'foxusapi';
        $this->password = '3nJJdo!ryQcs';
        $this->soapUrl = 'https://api.emersion.com.au/Plans.wsdl';
    }

    function GetPackagePlanDetails(){
        $PackagePlanId = $this->input->post('PackagePlanId', TRUE);
        $client = new SoapClient($this->soapUrl);
        $header = getSoapHeader($this->username, $this->password);
        $client->__setSoapHeaders([$header]);
        
        try {
            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => $client->GetPackagePlanDetails([
                    'PackagePlanId' => $PackagePlanId
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

    function GetPackagePlans(){
        $client = new SoapClient($this->soapUrl);
        $header = getSoapHeader($this->username, $this->password);
        $client->__setSoapHeaders([$header]);
        
        try {
            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => $client->GetPackagePlans()
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

    function GetTermsAndConditions(){
        $PackagePlanID = $this->input->post('PackagePlanID', TRUE);
        $client = new SoapClient($this->soapUrl);
        $header = getSoapHeader($this->username, $this->password);
        $client->__setSoapHeaders([$header]);
        
        try {
            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => $client->GetTermsAndConditions([
                    'PackagePlanID' => $PackagePlanID
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