<?php
/**
 * @package     Itelios_PagSeguro_Sign
 * @author      Israel Guido Itelios Core Team <israel.guido@itelios.com>
 * @copyright   2016 Itelios (http://www.itelios.com.br)
 * @license     http://www.itelios.com.br  Copyright
 * @link        http://www.itelios.com.br
 */

class Itelios_PagSeguro_Sign
{
    private $status;

    private $response;

    public function post($url, array $data = array())
    {
        $this->curlConnection('POST', $url, $timeout = 20, $charset = 'ISO-8859-1', $data);
    }

    protected function curlConnection($method, $url, $timeout, $charset, $data)
    {
        if (strtoupper($method) === 'POST') {
            $postFields = ($data ? http_build_query($data, '', '&') : "");
            $contentLength = "Content-length: " . strlen($postFields);
            $methodOptions = array(
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postFields,
            );
        } else {
            $contentLength = null;
            $methodOptions = array(
                CURLOPT_HTTPGET => true
            );
        }

        $options = array(
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded; charset=" . $charset,
                "Name: Accept Value: application/vnd.pagseguro.com.br.v3+{xml,json};charset=".$charset,
                $contentLength,
                'lib-description: php: 1.1.3',
                'language-engine-description: php:' . phpversion()
            ),
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => $timeout,
            //CURLOPT_TIMEOUT => $timeout
        );

        $options = ($options + $methodOptions);
        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $resp = curl_exec($curl);
        $info = curl_getinfo($curl);
        $error = curl_errno($curl);
        $errorMessage = curl_error($curl);
        curl_close($curl);
        $this->setStatus((int) $info['http_code']);
        $this->setResponse((String) $resp);
        if ($error) {
            throw new Exception("CURL can't connect: $errorMessage");
        } else {
            return true;
        }
    }

    public function curlJson($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data),
                'Accept: application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'
            )
        );
        $result = curl_exec($ch);
        var_dump($result);
    }

    /** set's */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }

    /** get's */
    public function getStatus()
    {
        return $this->status;
    }

    public function getResponse()
    {
        return $this->response;
    }

    /** parse Data */
    public function parseData()
    {
        //montar as infomações a serem enviadas
        $data = array();
        $data['email']                      = 'israelguido@gmail.com';
        $data['token']                      = 'XXXXXX71CDC4B6695DC331795951F8D';
        $data['senderName']                 = 'Israel Guido';
        $data['senderAreaCode']             = '11';
        $data['senderPhone']                = '25554189';
        $data['senderEmail']                = 'israel@sandbox.pagseguro.uol.com.br';
        $data['senderAddressStreet']        = 'Haddock Lobbo';
        $data['senderAddressNumber']        = '131';
        $data['senderAddressComplement']    = 'A14 S1411';
        $data['senderAddressDistrict']      = 'Jardim Paulistano';
        $data['senderAddressPostalCode']    = '01452002';
        $data['senderAddressCity']          = 'São Paulo';
        $data['senderAddressState']         = 'SP';
        $data['senderAddressCountry']       = 'BRA';
        $data['preApprovalCharge']          = 'auto';
        $data['preApprovalName']            = 'Sign Teste for Brasil';
        $data['preApprovalDetails']         = 'Sistema de assinaturas criado para Brasil todos os direitos reservados a Itelios do Brasil';
        $data['preApprovalAmountPerPayment']= '1.00';
        $data['preApprovalPeriod']          = 'Monthly';
        $data['preApprovalFinalDate']       = '2018-01-21T00:00:000-03:00';
        $data['preApprovalMaxTotalAmount']  = '2400.00';
        $data['reference']                  = 'REF1234';
        $data['redirectURL']                = 'http://www.xxx.dev/retorno.php';
        $data['reviewURL']                  = 'http://www.xxx.dev/revisao.php';

        return $data;
    }

    /** parse XML Response */
    public function loadXML($xml_string)
    {
        return simplexml_load_string($xml_string);
    }

}
//inicia a class curl
$post = new Itelios_PagSeguro_Sign();

//inicia a sessão
$url_session = 'https://ws.sandbox.pagseguro.uol.com.br/sessions';
$data_session = array(
    'email' => 'israelguido@gmail.com',
    'token' => 'XXXXXX71CDC4B6695DC331795951F8D'
);
$post->post($url_session,$data_session);
$response = $post->loadXML($post->getResponse());
?>
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script type="text/javascript">

    //Pega os id para iniciar sessão
    PagSeguroDirectPayment.setSessionId('<?php echo $response->id; ?>');

    /*PagSeguroDirectPayment.getPaymentMethods({
        carBin: 411111,
        amount: 10.00,
        success: function(response) {
            console.log(response)
        },
        error: function(response) {
            console.log(response)
        },
        complete: function(response) {
            //console.log(response)
        }
    });*/

    //Obter o token para o cartão de credito
    var param = {
        cardNumber: '4111111111111111',
        cvv: '123',
        expirationMonth: 12,
        expirationYear: 2030,
        //brand: 'VISA',
        success: function(response) {
            console.log(response.card.token)
        },
        error: function(response) {
            console.log(response)
        },
        complete: function(response) {
            //tratamento comum para todas chamadas
        }
    }

    PagSeguroDirectPayment.createCardToken(param);
</script>
<?php
$url = 'https://ws.sandbox.pagseguro.uol.com.br/pre-approvals?email=israelguido@gmail.com&token=XXXXXX71CDC4B6695DC331795951F8D';
$data = '{
    "plan":"403EE6E60101B40444E8EFBE080075F3",
    "reference":"ID-CND",
    "sender":{
        "name":"Itelios Teste",
        "email":"c49359523703863350419@sandbox.pagseguro.com.br",
        "ip":"192.168.0.12",
        "hash":"hash",
        "phone":{
            "areaCode":"11",
            "number":"988881234"
        },
        "address":{
            "street":"Av. Brigadeira Faria Lima",
            "number":"1384",
            "complement":"3 andar",
            "district":"Jd. Paulistano",
            "city":"São Paulo",
            "state":"SP",
            "country":"BRA",
            "postalCode":"01452002"
        },
        "documents":[
        {
            "type":"CPF",
            "value":"28620687808"
        }
        ]
    },
    "paymentMethod":{
        "type":"CREDITCARD",
        "creditCard":{
            "token":"e5b1e1f981ad432dbf849b1689b7fa1b",
            "holder":{
                "name":"Nome",
                "birthDate":"11/01/1984",
                "documents":[
                {
                    "type":"CPF",
                    "value":"28620687808"
                }
                ],
                "billingAddress":{
                    "street":"Av. Brigadeiro Faria Lima",
                    "number":"1384",
                    "complement":"3 andar",
                    "district":"Jd. Paulistano",
                    "city":"São Paulo",
                    "state":"SP",
                    "country":"BRA",
                    "postalCode":"01452002"
                },
                "phone":{
                    "areaCode":"11",
                    "number":"988881234"
                }
            }
        }
    }
}';
echo "<pre>";
var_dump(json_decode($data)); die;
?>
<?php $post->curlJson($url, $data)?>

