<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function generateNonce($length = 16) {
    return bin2hex(openssl_random_pseudo_bytes($length));
}

function createPasswordDigest($nonce, $created, $password) {
    $digest = sha1($nonce . $created . $password, true);
    return base64_encode($digest);
}

function getSoapHeader($username, $password) {
    $nonce = generateNonce();
    $encodedNonce = base64_encode($nonce);
    $created = date('Y-m-d\TH:i:s\Z');
    $passwordDigest = createPasswordDigest($nonce, $created, $password);
    $usernameToken = new stdClass();
    $usernameToken->Username = new SoapVar($username, XSD_STRING, null, null, null, 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd');
    $usernameToken->Password = new SoapVar($passwordDigest, XSD_STRING, null, null, null, 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd');
    $usernameToken->Nonce = new SoapVar($encodedNonce, XSD_STRING, null, null, null, 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd');
    $usernameToken->Created = new SoapVar($created, XSD_STRING, null, null, null, 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd');

    $security = new stdClass();
    $security->UsernameToken = new SoapVar($usernameToken, SOAP_ENC_OBJECT, null, null, 'UsernameToken', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd');

    $header = new SoapHeader(
        'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security',
        new SoapVar($security, SOAP_ENC_OBJECT, null, null, null, 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd'),
        true
    );

    return $header;
}