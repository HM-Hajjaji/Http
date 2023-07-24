<?php

namespace Http;

use Http\Support\Cookie;
use Http\Support\File;
use Http\Support\Query;
use Http\Support\Server;

class Request
{
    public Server $server;
    public Query $query;
    public File $file;
    public Cookie $cookie;

    public function __construct()
    {
        $this->server = new Server($_SERVER);
        $this->query = new Query($_REQUEST);
        $this->file = new File($_FILES);
        $this->cookie = new Cookie($_COOKIE);
    }

    public function request(string $url,string $method = "GET"|"POST",array $params = []): Response
    {
        if (!filter_var($url,FILTER_VALIDATE_URL))
        {
            throw new \InvalidArgumentException(sprintf('Expected a scalar, or an array as a 2nd argument to "%s()", "%s" given.', __METHOD__, get_debug_type($url)));
        }

        $object = curl_init();

        curl_setopt($object,CURLOPT_URL,$url);
        curl_setopt($object, CURLOPT_RETURNTRANSFER, true);

        if (!empty($params))
        {
            curl_setopt($object,CURLOPT_POSTFIELDS,http_build_query($params));
        }

        if ($method == "GET")
        {
            curl_setopt($object,CURLOPT_HTTPGET,true);
        }else{
            curl_setopt($object,CURLOPT_POST,true);
        }

        $content = curl_exec($object);

        if(curl_errno($object)){
            $error = curl_error($object);
            curl_close($object);
            throw new \HttpRequestException($error);
        }

        curl_close($object);
        return new Response($content);
    }
}