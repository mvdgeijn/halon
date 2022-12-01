<?php

namespace Mvdgeijn\Halon\Commands;

class Smtpd
{
    public string $program = "smtpd";

    public string $command = "F";

    public Payload $payload;

    public function __construct( ?string $command = "F" )
    {
        $this->payload = new Payload();

        if( $command !== null )
            $this->command = $command;
    }
}
