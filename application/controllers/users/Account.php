<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS, POST, GET, PUT");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

class Account extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->username = 'foxusapi';
        $this->password = '3nJJdo!ryQcs';
        $this->soapUrl = 'https://userapi.emersion.com/Account.wsdl';
    }

    function makeAdHocPayment(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $amount = $this->input->post('amount', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("makeAdHocPayment", [[
                'loginToken' => $loginToken,
                'amount' => $amount
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

    function getAccountBalanceSummaryInfo(){
        $loginToken = $this->input->post('loginToken', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("getAccountBalanceSummaryInfo", [[
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

    function getContactByType(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $contactTypeName = $this->input->post('contactTypeName', TRUE);
        $ContactId = $this->input->post('ContactId', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("getContactByType", [[
                'loginToken' => $loginToken,
                'contactTypeName' => $contactTypeName,
                'ContactId' => $ContactId
            ]]);

            $xml_response = $response->contactList;
            $xml_object = simplexml_load_string($xml_response, "SimpleXMLElement", LIBXML_NOCDATA);

            $res = [
                'status' => 200,
                'messages' => 'OK',
                'data' => [
                    'contactList' => json_decode(json_encode($xml_object), true)
                ]
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

    function getInvoiceById(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $invoice_id = $this->input->post('invoice_id', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("getInvoiceById", [[
                'loginToken' => $loginToken,
                'invoice_id' => $invoice_id
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

    function invoices(){
        $loginToken = $this->input->post('loginToken', TRUE);
        $Page = $this->input->post('Page', TRUE);
        $PageSize = $this->input->post('PageSize', TRUE);

        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("invoices", [[
                'loginToken' => $loginToken,
                'Page' => $Page,
                'PageSize' => $PageSize
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

    function updateAccount(){
        $params = [
            'loginToken' => $this->input->post('loginToken', TRUE),
            'AccountType' => $this->input->post('AccountType', TRUE),
            'PrimaryContact' => [
                'Detail' => [
                    'Title' => $this->input->post('PrimaryContactTitle', TRUE),
                    'FirstName' => $this->input->post('PrimaryContactFirstName', TRUE),
                    'LastName' => $this->input->post('PrimaryContactLastName', TRUE),
                    'AddressLine1' => $this->input->post('PrimaryContactAddressLine1', TRUE),
                    'AddressLine2' => ($this->input->post('PrimaryContactAddressLine2', TRUE)) ? $this->input->post('PrimaryContactAddressLine2', TRUE) : '',
                    'AddressLine3' => ($this->input->post('PrimaryContactAddressLine3', TRUE)) ? $this->input->post('PrimaryContactAddressLine3', TRUE) : '',
                    'Suburb' => ($this->input->post('PrimaryContactSuburb', TRUE)) ? $this->input->post('PrimaryContactSuburb', TRUE) : '',
                    'State' => ($this->input->post('PrimaryContactState', TRUE)) ? $this->input->post('PrimaryContactState', TRUE) : '',
                    'StateOther' => ($this->input->post('PrimaryContactStateOther', TRUE)) ? $this->input->post('PrimaryContactStateOther', TRUE) : '',
                    'Postcode' => ($this->input->post('PrimaryContactPostcode', TRUE)) ? $this->input->post('PrimaryContactPostcode', TRUE) : '',
                    'Country' => ($this->input->post('PrimaryContactCountry', TRUE)) ? $this->input->post('PrimaryContactCountry', TRUE) : '',
                    'EmailAddress' => ($this->input->post('PrimaryContactEmailAddress', TRUE)) ? $this->input->post('PrimaryContactEmailAddress', TRUE) : '',
                    'PhoneNumber' => ($this->input->post('PrimaryContactPhoneNumber', TRUE)) ? $this->input->post('PrimaryContactPhoneNumber', TRUE) : '',
                    'MobileNumber' => ($this->input->post('PrimaryContactMobileNumber', TRUE)) ? $this->input->post('PrimaryContactMobileNumber', TRUE) : '',
                    'FaxNumber' => ($this->input->post('PrimaryContactFaxNumber', TRUE)) ? $this->input->post('PrimaryContactFaxNumber', TRUE) : '',
                    'Website' => ($this->input->post('PrimaryContactWebsite', TRUE)) ? $this->input->post('PrimaryContactWebsite', TRUE) : ''
                ], 'CumulusUser' => [
                    'UserName' => $this->input->post('PrimaryContactUserName', TRUE),
                    'Password' => $this->input->post('PrimaryContactPassword', TRUE)
                ]
            ],
            'AccountContactType' => [
                'Type' => $this->input->post('AccountContactTypeType', TRUE)
            ],
            'AccountOrganisation' => [
                'OrgName' => ($this->input->post('AccountOrganisationOrgName', TRUE)) ? $this->input->post('AccountOrganisationOrgName', TRUE) : '',
                'OrgTradingName' => ($this->input->post('AccountOrganisationOrgTradingName', TRUE)) ? $this->input->post('AccountOrganisationOrgTradingName', TRUE) : '',
                'OrgType' => ($this->input->post('AccountOrganisationOrgType', TRUE)) ? $this->input->post('AccountOrganisationOrgType', TRUE) : '',
                'OrgIdentifier' => ($this->input->post('AccountOrganisationOrgIdentifier', TRUE)) ? $this->input->post('AccountOrganisationOrgIdentifier', TRUE) : '',
                'OrgIdentifierType' => ($this->input->post('AccountOrganisationOrgIdentifierType', TRUE)) ? $this->input->post('AccountOrganisationOrgIdentifierType', TRUE) : ''
            ],
            'BillingContact' => [
                'Detail' => [
                    'Title' => ($this->input->post('BillingContactTitle', TRUE)) ? $this->input->post('BillingContactTitle', TRUE) : '',
                    'FirstName' => ($this->input->post('BillingContactFirstName', TRUE)) ? $this->input->post('BillingContactFirstName', TRUE) : '',
                    'LastName' => ($this->input->post('BillingContactLastName', TRUE)) ? $this->input->post('BillingContactLastName', TRUE) : '',
                    'AddressLine1' => ($this->input->post('BillingContactAddressLine1', TRUE)) ? $this->input->post('BillingContactAddressLine1', TRUE) : '',
                    'AddressLine2' => ($this->input->post('BillingContactAddressLine2', TRUE)) ? $this->input->post('BillingContactAddressLine2', TRUE) : '',
                    'AddressLine3' => ($this->input->post('BillingContactAddressLine3', TRUE)) ? $this->input->post('BillingContactAddressLine3', TRUE) : '',
                    'Suburb' => ($this->input->post('BillingContactSuburb', TRUE)) ? $this->input->post('BillingContactSuburb', TRUE) : '',
                    'State' => ($this->input->post('BillingContactState', TRUE)) ? $this->input->post('BillingContactState', TRUE) : '',
                    'StateOther' => ($this->input->post('BillingContactStateOther', TRUE)) ? $this->input->post('BillingContactStateOther', TRUE) : '',
                    'Postcode' => ($this->input->post('BillingContactPostcode', TRUE)) ? $this->input->post('BillingContactPostcode', TRUE) : '',
                    'Country' => ($this->input->post('BillingContactCountry', TRUE)) ? $this->input->post('BillingContactCountry', TRUE) : '',
                    'EmailAddress' => ($this->input->post('BillingContactEmailAddress', TRUE)) ? $this->input->post('BillingContactEmailAddress', TRUE) : '',
                    'PhoneNumber' => ($this->input->post('BillingContactPhoneNumber', TRUE)) ? $this->input->post('BillingContactPhoneNumber', TRUE) : '',
                    'MobileNumber' => ($this->input->post('BillingContactMobileNumber', TRUE)) ? $this->input->post('BillingContactMobileNumber', TRUE) : '',
                    'FaxNumber' => ($this->input->post('BillingContactFaxNumber', TRUE)) ? $this->input->post('BillingContactFaxNumber', TRUE) : '',
                    'Website' => ($this->input->post('BillingContactWebsite', TRUE)) ? $this->input->post('BillingContactWebsite', TRUE) : '',
                ],
            ],
            'AccountReference' => ($this->input->post('AccountReference', TRUE)) ? $this->input->post('AccountReference', TRUE) : '',
        ];
        try{
            $client = new SoapClient($this->soapUrl);
            $response = $client->__soapCall("updateAccount", [$params]);
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