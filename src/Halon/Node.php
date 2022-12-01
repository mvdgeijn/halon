<?php

namespace Mvdgeijn\Halon;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Mvdgeijn\Halon\Commands\Smtpd;
use Mvdgeijn\Halon\Exceptions\HalonException;
use Mvdgeijn\Halon\Responses\QuarantineMailsResponse;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Node
{
    protected ?GuzzleClient $client = null;

    protected string $id = "";

    protected string $url = "";

    protected array $endPoints = [];

    protected string $username = "";

    protected string $password = "";

    /**
     * @param array $config
     * @param array $endPoints
     */
    public function __construct(array $config, array $endPoints )
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
     * @param Smtpd $data
     * @param string $responseClass
     * @return mixed
     * @throws HalonException
     */
    public function command(Smtpd $data, string $responseClass ): mixed
    {
        $url = $this->url . $this->endPoints['commands'];

        try {
            $response = $this->client()->post($url, [
                'body' => json_encode($data )
            ]);

            if( $response->getStatusCode() == 200 ) {
                $body = $response->getBody()->getContents();

                $encoders = [new JsonEncoder()];
                $normalizers = [
                    new ArrayDenormalizer(),
                    new DateTimeNormalizer(),
                    new ObjectNormalizer(
                        null,
                        null,
                        null,
                        new ReflectionExtractor() )
                ];
                $serializer = new Serializer($normalizers, $encoders);

                return $serializer->deserialize( $body, $responseClass, 'json' );
            } else {
                return null;
            }
        } catch (GuzzleException $e) {
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
