<?php

namespace Mvdgeijn\Halon;

class SingleNodeRequest
{
    protected Node $node;

    public function __construct( Node $node = null )
    {
        $this->node = $node ?? ( \App::get( Cluster::class ) )->getFirstNode();
    }
}
