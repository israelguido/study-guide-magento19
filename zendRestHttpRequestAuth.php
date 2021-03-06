<?php
require_once 'app/Mage.php';
Mage::app();

//config
$username = 'xxxxx';
$password = 'xxxxx';
$url = 'http://homologacao.xxx.com.br/api/';

//Exemplo 1
$client = new Zend_Http_Client();
$client->setUri('http://xxx.com/api');
$client->setHeaders('Content-Type: application/json');
$client->setAuth('xxx', 'xxx!', Zend_Http_Client::AUTH_BASIC);
$response = $client->request('GET');
print_r($response->getBody());

//Exemplo 2
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);
print_r($response);

//Exemplo 3 com negotiate
$client = new Zend_Http_Client($url);
$client->setHeaders('WWW-Authenticate', 'Negotiate');
$client->setAuth($username, $password, Zend_Http_Client::AUTH_BASIC);
$response = $client->request('GET');
print_r($response->getBody());