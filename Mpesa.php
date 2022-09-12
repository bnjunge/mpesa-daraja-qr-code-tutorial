<?php

class Mpesa
{
    public static $credentials, $token, $payload, $response;

    public static function send(){
        $args = func_get_args();

        self::$payload = array(
            'Amount' => $args[1], 
            'RefNo' => $args[0],
            'TrxCode' => 'PB',
            'CPI' => 174379,
            'MerchantName' => 'Daraja Sandbox',
        );   

        self::curlPost();
    }

    public static function load() : void
    {
        self::$credentials = array(
            'consumer_key' => '', // add your own
            'consumer_secret' => '' // add your own
        );
    }

    public static function curlPost()
    {
        self::AccessToken();
        $url = "https://sandbox.safaricom.co.ke/mpesa/qrcode/v1/generate";
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => $url,
                CURLINFO_HEADER_OUT => true,
                CURLOPT_HTTPHEADER =>  array('Content-Type: application/json', 'Authorization:Bearer ' . self::$token),
                CURLOPT_POST =>  1,
                CURLOPT_POSTFIELDS =>  json_encode(self::$payload),
                CURLOPT_RETURNTRANSFER =>  true,
                CURLOPT_SSL_VERIFYPEER =>  false,
                CURLOPT_SSL_VERIFYHOST =>  false
            )
        );
        self::$response = curl_exec($ch);
        curl_close($ch);
        return;
    }

    public static function AccessToken()
    {
        self::load();

        $curl = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_HTTPHEADER => ['Content-Type:application/json; charset=utf8'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_USERPWD => self::$credentials['consumer_key'] . ':' . self::$credentials['consumer_secret']
            )
        );
        $result = json_decode(curl_exec($curl));
        curl_close($curl);
        self::$token = $result->access_token;
    }
}
