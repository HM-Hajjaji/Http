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
}