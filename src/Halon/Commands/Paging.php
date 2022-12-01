<?php
/*
 * Copyright (c) 2022 by bHosted.nl B.V.  - All rights reserved
 */

namespace Mvdgeijn\Halon\Commands;

class Paging
{
    public string $offset = "0";

    public string $limit = "100";

    public function __construct( ?string $offset = null, ?string $limit = null )
    {
        if( $offset !== null )
            $this->offset = $offset;

        if( $limit !== null )
            $this->limit = $limit;
    }

    /**
     * @param string $offset
     * @return Paging
     */
    public function setOffset(string $offset): Paging
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @param string $limit
     * @return Paging
     */
    public function setLimit(string $limit): Paging
    {
        $this->limit = $limit;

        return $this;
    }
}
