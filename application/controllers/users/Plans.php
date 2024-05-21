<?php
class Plans extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->soapUrl = 'https://userapi.emersion.com/Plans.wsdl';
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

    function getPackagePlanDetails(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $PackagePlanId = $this->input->post('PackagePlanId', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("getPackagePlanDetails", [[
                'loginToken' => $loginToken,
                'PackagePlanId' => $PackagePlanId
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

    function getPackagePlans(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $serviceTypes = $this->input->post('serviceTypes', TRUE);
        $saleable = $this->input->post('saleable', TRUE);
        $saleableInUserPortal = $this->input->post('saleableInUserPortal', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("getPackagePlans", [[
                'loginToken' => $loginToken,
                'serviceTypes' => $serviceTypes,
                'saleable' => $saleable,
                'saleableInUserPortal' => $saleableInUserPortal
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

    function getTermsAndConditions(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $ObjectMapping = $this->input->post('ObjectMapping', TRUE);
        $DateEffective = $this->input->post('DateEffective', TRUE);
        $TermsAndConditionsID = $this->input->post('TermsAndConditionsID', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("getTermsAndConditions", [[
                'loginToken' => $loginToken,
                'ObjectMapping' => $ObjectMapping,
                'DateEffective' => $DateEffective,
                'TermsAndConditionsID' => $TermsAndConditionsID
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