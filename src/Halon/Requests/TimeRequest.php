<?php

namespace Mvdgeijn\Halon\Requests;

use Carbon\Carbon;
use Mvdgeijn\Halon\SingleNodeRequest;
use Mvdgeijn\Halon\Exceptions\HalonException;
use Mvdgeijn\Halon\Responses\TimeResponse;

class TimeRequest extends SingleNodeRequest
{
    /**
     * @return Carbon|null
     * @throws HalonException
     */
    public function get(): ?TimeResponse
    {
        return $this->node->request('/system/time', TimeResponse::class );
    }
}
