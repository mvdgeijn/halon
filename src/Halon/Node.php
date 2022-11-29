<?php

namespace Mvdgeijn\Halon;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Mvdgeijn\Halon\Exceptions\HalonException;

class Node
{
    protected ?GuzzleClient $client = null;

    protected string $id = "";

    protected string $url = "";

    protected array $endPoints = [];

    protected string $username = "";

    protected string $password = "";

    public function __construct( array $config, array $endPoints )
    {
        $this->id       = $config['id'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->url      = $config['url'];

        $this->endPoints = $endPoints;
    }

    /**
     * @return GuzzleClient|null
     */
    private function client(): ?GuzzleClient
    {
        if( $this->client )
            return $this->client;

        $this->client = new GuzzleClient([
            'http_errors' => false,
            'auth' => [$this->username,$this->password],
            'connect_timeout' => 2
        ]);

        return $this->client;
    }

    /**
     * @param string $uri
     * @param array $params
     * @return mixed
     * @throws HalonException
     */
    public function request(string $uri, string $responseClass, array $params = [] ): mixed
    {
        try {
            $response = $this->client()->get( $this->url . $this->endPoints['api'] . $uri );

            if( $response->getStatusCode() == 200 ) {
                return new ($responseClass)( json_decode($response->getBody()) );
            } else {
                return null;
            }
        } catch( GuzzleException $e ) {
            throw new HalonException( $e->getMessage() );
        }
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Node
     */
    public function setUsername(string $username): Node
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Node
     */
    public function setPassword(string $password): Node
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
