<?php

namespace Mvdgeijn\Halon;

use GuzzleHttp\Client as GuzzleClient;

class Halon
{
    protected ?GuzzleClient $httpClient = null;

    protected string $url = "";

    public function __construct()
    {
        $this->httpClient = new GuzzleClient([
            'exceptions' => false,
            'handler' => $guzzleHandlerStack,
            'auth' => [config('halon.username'),config('halon.password')]
        ]);

        $this->url = config('halon.url');
    }

    protected function request( string $uri, array $params = [] )
    {
        return $this->httpClient->get( $this->url . $uri );
    }

    public function time()
    {
        return $this->request('/system/time');
    }
}
