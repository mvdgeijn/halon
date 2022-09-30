<?php
/*
 * Copyright (c) 2022 by bHosted.nl B.V.  - All rights reserved
 */

namespace Mvdgeijn\Halon;

use Carbon\Carbon;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;

class Halon
{
    protected ?GuzzleClient $httpClient = null;

    protected string $url = "";

    public function __construct()
    {
        $this->httpClient = new GuzzleClient([
            'http_errors' => false,
            'auth' => [config('halon.username'),config('halon.password')]
        ]);

        $this->url = config('halon.url');
    }

    protected function request( string $uri, array $params = [] )
    {
        return $this->httpClient->get( $this->url . $uri );
    }

    public function time(): ?Carbon
    {
        $response = $this->request('/system/time');

        if( $response->getStatusCode() == 200 ) {
            $json = json_decode($response->getBody());

            return new Carbon($json->time);
        }

        return null;
    }
}
