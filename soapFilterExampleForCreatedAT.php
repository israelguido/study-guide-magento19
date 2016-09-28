<?php

require_once 'app/Mage.php';
Mage::app();

$api_url_v2 = "http://yourmagento.com/api/v2_soap/?wsdl=1";

$username = 'username';
$password = 'apiKey';

$client = new SoapClient($api_url_v2, array('trace' => 1));

$session = $client->login($username, $password);
$complexFilter->complex_filter = array(
    array(
        'key' => 'CREATED_AT',
        'value' => array('key' => 'from', 'value' => '2016-09-21 00:00:00')
    ),
    array(
        'key' => 'created_at',
        'value' => array('key' => 'to', 'value' => '2016-09-27 12:02:02')
    ),
);
$result = $client->salesOrderList($session, $complexFilter);

Zend_Debug::dump($result);

echo $client->__getLastRequest();