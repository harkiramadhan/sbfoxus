<?php

/* 
    Log In
    Get WME Balance
    Service Detail (End User)
    Get Current Usage Period Summary
    Get Package Subscriptions (End User)
    Add Bolt-on Add-on Subscription
    Add Bolt-on Subscription
    Get Package Plan Details (End User)
    Get Package Plans (End User)
    Get Terms And Conditions (End User)
    Activate Service 
*/

class Services extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->soapUrl = 'https://userapi.emersion.com/Services.wsdl';
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

    function getWMEBalance(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $service_id = $this->input->post('service_id', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("getWMEBalance", [[
                'loginToken' => $loginToken,
                'service_id' => $service_id
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

    function serviceDetail(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $service_id = $this->input->post('service_id', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("serviceDetail", [[
                'loginToken' => $loginToken,
                'service_id' => $service_id
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

    function GetCurrentUsagePeriodSummary(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $PackageSubscriptionID = $this->input->post('PackageSubscriptionID', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("GetCurrentUsagePeriodSummary", [[
                'loginToken' => $loginToken,
                'PackageSubscriptionID' => $PackageSubscriptionID
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

    function GetPackageSubscriptions(){
        $loginToken = $this->input->post('loginToken', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("GetPackageSubscriptions", [[
                'loginToken' => $loginToken
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

    function addBoltOnAddOnSubscription(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $service_bolt_on_subscription_id = $this->input->post('service_bolt_on_subscription_id', TRUE);
        $plan_bolt_on_add_on_id = $this->input->post('plan_bolt_on_add_on_id', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("addBoltOnAddOnSubscription", [[
                'loginToken' => $loginToken,
                'service_bolt_on_subscription_id' => $service_bolt_on_subscription_id,
                'plan_bolt_on_add_on_id' => $plan_bolt_on_add_on_id
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

    function addBoltOnSubscription(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $service_subscription_id = $this->input->post('service_subscription_id', TRUE);
        $plan_bolt_on_id = $this->input->post('plan_bolt_on_id', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("addBoltOnSubscription", [[
                'loginToken' => $loginToken,
                'service_subscription_id' => $service_subscription_id,
                'plan_bolt_on_id' => $plan_bolt_on_id
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

    function ActivateService(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $sq_id = $this->input->post('sq_id', TRUE);
        $service_identifier = $this->input->post('service_identifier', TRUE);
        $service_type_id = $this->input->post('service_type_id', TRUE);
        $sim_number = $this->input->post('sim_number', TRUE);
        $product_id = $this->input->post('product_id', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("ActivateService", [[
                'loginToken' => $loginToken,
                'sq_id' => $sq_id,
                'service_identifier' => $service_identifier,
                'service_type_id' => $service_type_id,
                'sim_number' => $sim_number,
                'product_id' => $product_id
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