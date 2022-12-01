<?php

namespace Mvdgeijn\Halon;

use Iterator;
use Mvdgeijn\Halon\Exceptions\HalonException;
use Mvdgeijn\Halon\Requests\TimeRequest;
use Mvdgeijn\Halon\Responses\TimeResponse;

class Cluster implements Iterator
{
    private array $nodes = [];

    private $index = 0;

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

    /**
     * @return mixed
     */
    public function current(): mixed
    {
        if( count($this->nodes) > $this->index )
            return $this->nodes[$this->index];
        else
            return null;
    }

    /**
     * @return void
     */
    public function next(): void
    {
        $this->index++;
    }

    /**
     * @return mixed
     */
    public function key(): mixed
    {
        if( count( $this->nodes ) > $this->index )
            return $this->index;
        else
            return null;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return( count( $this->nodes ) > $this->index );
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->index = 0;
    }
}
