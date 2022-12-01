<?php

namespace Mvdgeijn\Halon;

class MultiNodeCommand
{
    protected Cluster $cluster;

    public function __construct()
    {
        $this->cluster = \App::get( Cluster::class );
    }
}
