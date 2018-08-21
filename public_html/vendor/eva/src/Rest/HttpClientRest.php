<?php
/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 13/10/2017
 * Time: 23:24
 */

namespace Eva\Rest;


use Eva\Core\Configure\Config;

class HttpClientRest
{

    private $verbo;

    private $url;

    private $config;

    private $body;

    public function __construct(Config $config)
    {
        $this->config = $config->get();
    }

    public function get()
    {
        $this->verbo = "GET";
        return $this;
    }

    public function post()
    {
        $this->verbo = "POST";
        return $this;
    }

    public function service($service)
    {
        $this->url = $this->config['url'] . $service;
        return $this;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function execute()
    {
        if(empty($this->verbo) || empty($this->url)) die('Processo inválido.');

        $params = array(
            CURLOPT_PORT => $this->config['port'],
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->verbo,
            CURLOPT_HTTPHEADER => $this->getAuthentication()
        );
        if(in_array($this->verbo, ['POST']))
        {
            $params[CURLOPT_POSTFIELDS] = $this->body;
        }

        $curl = curl_init();
        curl_setopt_array($curl, $params);
        $responseCurl = curl_exec($curl);
        $err = curl_error($curl);
        $response = new HttpResponse();
        $response->statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $response->response = ($err) ? $err : $responseCurl;
        curl_close($curl);
        
        return $response;
    }

    protected function getAuthentication()
    {
        return $this->config['header'];
    }


}