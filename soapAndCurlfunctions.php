<?php
public function getFieldIntegration($order)
    {
        /*
        $order->setOrderIntegratorId('10003204885');
        $order->save();
        Zend_Debug::dump($order->getData()); die;
        */

        $customer = Mage::getModel('customer/customer')->load($order->getCustomerId());

        $integrator = new stdClass();
        $integrator->createOrder = new stdClass();
        $ordered = new stdClass();
        $customerInformation = new stdClass();
        $addressInformation = new stdClass();
        $deviceInformation = new stdClass();
        $listOfQuestions = new stdClass();
        $item = new stdClass();
        //$paymentInformation = new stdClass();

        $ordered->currencyCode = Mage::app()->getStore()->getCurrentCurrencyCode();
        $ordered->activationDate = $order->getCreatedAtStoreDate()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        //array customer information
        $customerInformation->acceptsBeContactedViaEmail = 1;
        $customerInformation->address = $order->getBillingAddress()->getStreet();
        $customerInformation->city = $order->getBillingAddress()->getCity();
        $customerInformation->complement = $order->getBillingAddress()->getStreet();
        $customerInformation->district = 'Vl. Nogueira';
        $customerInformation->number = '405';
        $customerInformation->state = $order->getBillingAddress()->getRegion();

        //adress information in order

        $addressInformation->zipCode = $order->getBillingAddress()->getPostcode();
        $addressInformation->anotherMobileNumber = $order->getShippingAddress()->getTelephone();
        $addressInformation->brazilianDocumentForCitizens = $customer->getData('taxvat');
        $addressInformation->brazilianIdentificationDocument = $customer->getTaxvat();
        $addressInformation->customerType = 'PF';
        $addressInformation->email = $customer->getEmail();
        $addressInformation->homePhoneNumber = $order->getShippingAddress()->getTelephone();
        $addressInformation->name = $order->getBillingAddress()->getName();

        //device Information
        $deviceInformation->currentHandsetColor = 'Preto';
        $deviceInformation->currentOperator = 99;
        $deviceInformation->invoiceNumber = $order->getId();
        $deviceInformation->operationType = 'Venda';
        $deviceInformation->grading = 1;
        $deviceInformation->grossPrice = '1010';
        $deviceInformation->handsetQuoteId = '200014';
        $deviceInformation->IMEI = '999000000000004';

        //list of Questions
        $listOfQuestions->externalReference = '123';
        $listOfQuestions->isOk = '1';
        $listOfQuestions->questionId = '2';

        //Item option
        $item->lockedByCarrier = '';
        $item->quoteDate = $order->getCreatedAtStoreDate()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
        $item->region = 'SOU_BARATO';
        $item->regionId = '1';
        $item->storeId = Mage::app()->getStore()->getWebsiteId();
        $item->storeName = Mage::app()->getStore()->getName();
        $item->voucher = '3450983';
        $item->account = 'a';
        $item->bank = 'a';
        $item->branch = 'a';
        $item->recipientIdentification = 'a';
        $item->recipientName = 'a';
        $item->type = 'DEPOSIT';
        $item->value = '800.80';

        //'paymentInformation' = array();

        $ordered->customerNetPrice = $order->getGrandTotal();
        $ordered->dealType = 'SOU_BARATO';

        $integrator->createOrder->ordered = $ordered;
        $integrator->createOrder['customerInformation'] = $customerInformation;
        $integrator->createOrder->addressInformation = $addressInformation;
        $integrator->createOrder->deviceInformation = $deviceInformation;
        $integrator->createOrder->listOfQuestions = $listOfQuestions;
        $integrator->createOrder->item = $item;

        /*echo "<pre>";
        var_dump($integrator); die; */
        Mage::log($integrator,null,'integrator.log',true);
        return $integrator;
    }

    public function sendCurlXml()
    {
        $soapUrl = "http://yourhost.com/jRMAOnline/services/BuybackMpxOrderWebservice?wsdl";
        $soapUser = "XXXXXXXXX";
        $soapPassword = "XXXXXXX";

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:buy="http://buyback.webservice.jrma.brightstar.com" xmlns:buy1="http://buyback.ws.bean.model.jrma.brightstar.com">
                               <soapenv:Header/>
                               <soapenv:Body>
                                  <buy:createOrder>
                                     <buy:order>
                                        <buy1:FMIP>1001</buy1:FMIP>
                                        <buy1:MPN>1002</buy1:MPN>
                                        <buy1:activationDate>2016/05/13 08:45:00</buy1:activationDate>
                                        <buy1:agentId>1003</buy1:agentId>
                                        <buy1:capacity>1004</buy1:capacity>
                                        <buy1:color>1005</buy1:color>
                                        <buy1:country>246</buy1:country>
                                        <buy1:currencyCode>1006</buy1:currencyCode>
                                        <buy1:customerInformation>
                                           <buy1:acceptsBeContactedViaEmail>1</buy1:acceptsBeContactedViaEmail>
                                           <buy1:addressInformation>
                                              <buy1:address>Rua Dom Afonso Henrique</buy1:address>
                                              <buy1:city>Campinas</buy1:city>
                                              <buy1:complement>Casa</buy1:complement>
                                              <buy1:district>Vl. Nogueira</buy1:district>
                                              <buy1:number>64</buy1:number>
                                              <buy1:state>SP</buy1:state>
                                              <buy1:zipCode>13088004</buy1:zipCode>
                                           </buy1:addressInformation>
                                           <buy1:anotherMobileNumber>996072249</buy1:anotherMobileNumber>
                                           <buy1:brazilianDocumentForCitizens>37633778911</buy1:brazilianDocumentForCitizens>
                                           <buy1:brazilianDocumentForCompanies>37633778911</buy1:brazilianDocumentForCompanies>
                                           <buy1:brazilianIdentificationDocument>37633778911</buy1:brazilianIdentificationDocument>
                                           <buy1:customerType>PF</buy1:customerType>
                                           <buy1:email>herbert.barbieri2@brightstarcorp.com</buy1:email>
                                           <buy1:homePhoneNumber>996072249</buy1:homePhoneNumber>
                                           <buy1:messageNumber>11111</buy1:messageNumber>
                                           <buy1:name>Herbert Ricardo Barbieri</buy1:name>
                                           <buy1:workPhoneNumber>996072249</buy1:workPhoneNumber>
                                        </buy1:customerInformation>
                                        <buy1:customerNetPrice>1006</buy1:customerNetPrice>
                                        <buy1:dealType>1007</buy1:dealType>
                                        <buy1:deduction>1008</buy1:deduction>
                                        <buy1:deviceInformation>
                                           <buy1:currentHandsetColor>Black</buy1:currentHandsetColor>
                                           <buy1:currentOperator>123</buy1:currentOperator>
                                           <buy1:invoiceNumber>34345234234</buy1:invoiceNumber>
                                           <buy1:lineType>POS</buy1:lineType>
                                           <buy1:operationType>12312</buy1:operationType>
                                        </buy1:deviceInformation>
                                        <buy1:grading>1</buy1:grading>
                                         <buy1:grossPrice>1010</buy1:grossPrice>
                                        <buy1:handsetQuoteId>202071</buy1:handsetQuoteId>
                                        <buy1:iMEI>999000000001003</buy1:iMEI>
                                        <buy1:listOfQuestions>
                                           <buy:item>
                                              <buy1:externalReference>123</buy1:externalReference>
                                              <buy1:isOk>1</buy1:isOk>
                                              <buy1:questionId>2</buy1:questionId>
                                           </buy:item>
                                        </buy1:listOfQuestions>
                                        <buy1:lockedByCarrier>0</buy1:lockedByCarrier>
                                        <buy1:make>1011</buy1:make>
                                        <buy1:messageId>234</buy1:messageId>
                                        <buy1:model>IPHONE 3GS 8GB</buy1:model>
                                        <buy1:netPrice>1012</buy1:netPrice>
                                        <buy1:networkId>22</buy1:networkId> <!-- VIVO:22, CLARO:20, TIM:23, OI:24, NEXTEL:25  -->
                                        <buy1:phoneModelId>31629</buy1:phoneModelId>
                                        <buy1:program>1014</buy1:program>
                                        <buy1:quoteDate>2016/05/13 08:45:00</buy1:quoteDate>
                                        <buy1:region>CAC-BUYBACK</buy1:region>
                                        <buy1:regionId>1</buy1:regionId>
                                        <buy1:storeId>1</buy1:storeId>
                                        <buy1:storeName>1</buy1:storeName>
                                        <buy1:upgradedMake>1015</buy1:upgradedMake>
                                        <buy1:upgradedModel>IPHONE 3GS 8GB</buy1:upgradedModel>
                                        <buy1:upgradedModelId>31629</buy1:upgradedModelId>
                                        <buy1:upgradedPrice>1016</buy1:upgradedPrice>
                                        <buy1:upgradedSize>1017</buy1:upgradedSize>
                                        <buy1:voucher>563456</buy1:voucher>
                                        <buy1:paymentInformation>
                                           <buy1:account>a</buy1:account>
                                           <buy1:bank>a</buy1:bank>
                                           <buy1:branch>a</buy1:branch>
                                           <buy1:recipientIdentification>a</buy1:recipientIdentification>
                                           <buy1:recipientName>a</buy1:recipientName>
                                           <buy1:type>DEPOSIT</buy1:type>
                                           <buy1:value>100.25</buy1:value>
                                        </buy1:paymentInformation>
                                     </buy:order>
                                  </buy:createOrder>
                               </soapenv:Body>
                            </soapenv:Envelope>';

           $headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: ".$soapUrl,
                        "Authentication : Basic " . $soapUser.":".$soapPassword,
                        "Content-length: ".strlen($xml_post_string),
                    ); //SOAPAction: your op URL

            $url = $soapUrl;

            // PHP cURL  for https connection with auth
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // converting
            $response = curl_exec($ch);
            curl_close($ch);

            // converting
            $response1 = str_replace("<soap:Body>","",$response);
            $response2 = str_replace("</soap:Body>","",$response1);

            // convertingc to XML
            $parser = simplexml_load_string($response2);
            Mage::log($parser,null,'parser.log',true);
        return $response;
    }

    public function sendSoap($order)
    {
        $customer = Mage::getModel('customer/customer')->load($order->getCustomerId());
        $soapURL = "http://integration1.brightstarcorp.com:8380/jRMAOnline/services/BuybackMpxOrderWebservice?wsdl";
        $soapParameters = Array('login' => "XXXXXX", 'password' => "XXXXX", 'trace' => 1, 'encoding'=>' UTF-8') ;
        $soapFunction = "createOrder" ;


        $integrator['createOrder'] = array(
            'order' => array(
                'currencyCode' => utf8_encode(Mage::app()->getStore()->getCurrentCurrencyCode()),
                'activationDate' => utf8_encode($order->getCreatedAtStoreDate()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT)),

                //array customer information
                'customerInformation' => array(
                    'acceptsBeContactedViaEmail' => 1,
                    'address' => utf8_encode("xxxxx"),
                    'city' => utf8_encode($order->getBillingAddress()->getCity()),
                    'complement' => utf8_encode(";kejfs;dfjdf;klsdjfkl"),
                    'district' => 'Vl. Nogueira',
                    'number' => '405',
                    'state' => utf8_encode($order->getBillingAddress()->getRegion()),
                ),

                //adress information in order
                'addressInformation' => array(
                    'zipCode' => utf8_encode($order->getBillingAddress()->getPostcode()),
                    'anotherMobileNumber' => utf8_encode($order->getShippingAddress()->getTelephone()),
                    'brazilianDocumentForCitizens' => utf8_encode($customer->getData('taxvat')),
                    'brazilianIdentificationDocument' => utf8_encode($customer->getTaxvat()),
                    'customerType' => 'PF',
                    'email' => $customer->getEmail(),
                    'homePhoneNumber' => $order->getShippingAddress()->getTelephone(),
                    'name' => utf8_encode($order->getBillingAddress()->getName()),
                ),

                //device Information
                'deviceInformation' => array(
                    'currentHandsetColor' => 'Preto',
                    'currentOperator' => '99',
                    'invoiceNumber' => $order->getId(),
                    'operationType' => 'Venda',
                    'grading' => '1',
                    'grossPrice' => '1010',
                    'handsetQuoteId' => 203446,
                    'IMEI' => '999000000000004',
                ),

                //list of Questions
                'listOfQuestions' => array(
                    'externalReference' => 123,
                    'isOk' => 1,
                    'questionId' => 2,

                ),

                //Item option
                'item' => array(
                    'lockedByCarrier' => '',
                    'quoteDate' => $order->getCreatedAtStoreDate()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT),
                    'region' => 'SOU_BARATO',
                    'regionId' => '1',
                    'storeId' => Mage::app()->getStore()->getWebsiteId(),
                    'storeName' => utf8_encode(Mage::app()->getStore()->getName()),
                    'voucher' => '3450983',
                    'account' => 'a',
                    'bank' => 'a',
                    'branch' => 'a',
                    'recipientIdentification' => 'a',
                    'recipientName' => 'a',
                    'type' => 'DEPOSIT',
                    'value' => '800.80',
                ),

                //payment information
                //'paymentInformation' => array(),

                'customerNetPrice' => $order->getGrandTotal(),
                'dealType' => 'SOU_BARATO',
            )
        );

        $soapClient = new SoapClient($soapURL, $soapParameters);

        $soapResult = $soapClient->__soapCall($soapFunction, $integrator) ;
        header('Content-Type: text/xml; charset=UTF-8');
        echo($soapClient->__getLastRequest()); die;
        Mage::log($soapResult,null,'sopResult.log',true);
        Mage::log($soapClient->__getLastRequest(),null,'__getLastRequest().log',true);
        Mage::log($soapClient->__getLastRequestHeaders(),null,'__getLastRequestHeaders().log',true);

        if(is_array($soapResult) && isset($soapResult['someFunctionResult'])) {
            // Process result.
            Zend_Debug::dump($soapResult); die;
        } else {
            // Unexpected result
            if(function_exists("debug_message")) {
                debug_message("Unexpected soapResult for {$soapFunction}: ".print_r($soapResult, TRUE)) ;
            }
        }
    }