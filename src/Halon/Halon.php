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
    private Node $connection;

    protected string $url = "";

    public function __construct( )
    {
        $this->connection = \App::get( Node::class );
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

    public function uptime(): ?int
    {
        $response = $this->request('/system/uptime');

        if( $response->getStatusCode() == 200 ) {
            $json = json_decode($response->getBody());

            return $json->uptime;
        }

        return null;
    }

    public function currentVersion(): ?string
    {
        $response = $this->request('/system/versions/current');

        if( $response->getStatusCode() == 200 ) {
            $json = json_decode($response->getBody());

            return $json->version;
        }

        return null;
    }

    public function latestVersion(): ?string
    {
        $response = $this->request('/system/versions/latest');

        if( $response->getStatusCode() == 200 ) {
            $json = json_decode($response->getBody());

            return $json->version;
        }

        return null;
    }

}
