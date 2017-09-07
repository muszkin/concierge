<?php

use GuzzleHttp\Client;

abstract class ApiAbstract
{

    private $config;

    protected $url;

    protected $method;

    protected $form_params;

    protected $serializer;

    public function __construct(ThuliumConfig $config)
    {
        $this->config = $config;
        $this->serializer = JMS\Serializer\SerializerBuilder::create()->build();
    }

    public function doRequest()
    {
        $client = new Client();
        if ($this->getFormParams()){
            $request = $client->request($this->getMethod(),$this->getUrl(),["form_params" => $this->getFormParams()]);
        }else{
            $request = $client->request($this->getMethod(),$this->getUrl());
        }

        return $request->getBody()->getContents();
    }


    public function getUrl()
    {
        if (substr($this->config->getUrl(),-1) == "/"){
            $url = substr($this->config->getUrl(),0,-1).$this->url;
        }else{
            $url = $this->config->getUrl().$this->url;
        }
        return $url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getFormParams()
    {
        return $this->form_params;
    }

    /**
     * @param mixed $form_params
     */
    public function setFormParams($form_params)
    {
        $this->form_params = $form_params;
    }
}