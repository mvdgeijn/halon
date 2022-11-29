<?php

namespace Mvdgeijn\Halon;

use Mvdgeijn\Halon\Exceptions\HalonException;
use Mvdgeijn\Halon\Requests\TimeRequest;
use Mvdgeijn\Halon\Responses\TimeResponse;

class Cluster
{
    private array $nodes = [];

    /**
     * @return Cluster
     */
    public static function get(): Cluster
    {
        return new Cluster();
    }

    /**
     *
     */
    public function __construct()
    {
        $config = config('halon');

        foreach( $config['nodes'] as $nodeConfig ) {
            $this->nodes[] = ( new Node( $nodeConfig, $config['endpoints'] ) );
        }
    }

    /**
     * @return Node
     */
    public function getFirstNode(): Node
    {
        return reset( $this->nodes );
    }
}
