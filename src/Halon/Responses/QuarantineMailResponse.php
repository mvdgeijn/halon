<?php

namespace Mvdgeijn\Halon\Responses;

use Mvdgeijn\Halon\Commands\MailAddress;
use Mvdgeijn\Halon\Response;

class QuarantineMailResponse extends Response
{
    public array $id;

    public array $freeze;

    public string $hqfpath;

    public float $ts;

    public bool $hold;

    public array $metadata;

    public string $serverid;

    public string $subject;

    public MailAddress $sender;

    public MailAddress $recipient;

    public string $size;

    public string $senderip;

    /**
     * @param string|\stdClass $response
     */
    public function __construct( $response = null )
    {
    }
}
