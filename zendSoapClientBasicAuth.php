<?php
$wsdl = "https://homologacao.xxx.org.br/xxx/remoting/ws/consulta/consultaWebService?wsdl";
        $username = 'XXXX';
        $password = 'XXXX';
        $ns   = "http://spcnet.itelioscom.br/";

        $client = new Zend_Soap_Client($wsdl,
            array(
                'soap_version' => SOAP_1_1,
                'login' => $username,
                'password' => $password
            )
        );

        $data = array(
            'codigo-produto'        => '321',
            'tipo-consumidor'       => 'F',
            'documento-consumidor'  => '03818693692',
            'cep-consumidor'        => '08375000',
            'utiliza-CMC7'          => false,
            'codigo-insumo-opcional'=> array(5122,55),
        );

        try {
            $results = $client->consultar($data);
            Zend_Debug::dump($results); die;
        }
        catch (Exception $e) {
            Zend_Debug::dump($e->getMessage()); die;
        }
