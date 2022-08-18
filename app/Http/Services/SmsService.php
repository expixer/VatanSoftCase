<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;

class SmsService
{

    private $apiLink;
    private $accessToken;
    private $accessEmail;
    private $accessPassword;

    public function __construct()
    {
        $this->accessEmail = "mail@adresi";
        $this->accessPassword = "parola";
        $this->apiLink = "smsservisi.com/api";
        $this->accessToken = null;
    }

    public function __call($method, $parameters){
        if (is_null($this->accessToken)){
            $this->accessToken = $this->getToken();
        }

        return call_user_func_array([$this, $method], $parameters);
    }

    private function getToken()
    {

        $response = $this->smsApiClient("POST", "login", [], ["email" => $this->accessEmail, "password" => $this->accessPassword ]);
        return $response->access_token;

    }

    private function smsApiClient($method, $apiReference, $queryString = [], $body = [])
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
            ],
            'query'   => $queryString,
        ];

        if ($method === 'POST' && count($body) > 0) {
            $options['json'] = $body;
            $options['headers']['content-type'] = 'application/json';
        }

        try{
            $client = new \GuzzleHttp\Client();
            $response = $client->request($method, $this->apiLink . $apiReference, $options);

            $result = $response->getBody()->getContents();

            return json_decode($result);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }
        return false;
    }

}
