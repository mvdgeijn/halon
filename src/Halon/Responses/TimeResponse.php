<?php

namespace Mvdgeijn\Halon\Responses;

use Carbon\Carbon;
use Mvdgeijn\Halon\Response;

class TimeResponse extends Response
{
    private Carbon $time;

    public function __construct( \stdClass $response )
    {
        $this->time = new Carbon($response->time );
    }

    /**
     * @return Carbon
     */
    public function getTime(): Carbon
    {
        return $this->time;
    }
}
