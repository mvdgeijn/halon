<?php
/*
 * Copyright (c) 2022 by bHosted.nl B.V.  - All rights reserved
 */

namespace Mvdgeijn\Halon\Commands;

class MailAddress
{
    public array $localpart;

    public array $domain;

    public bool $exclude = false;

    /**
     * @param $domain
     * @return $this
     */
    public function setDomain( string $domain ): static
    {
        $this->domain = ['value' => $domain];

        return $this;
    }

    /**
     * @param string $localPart
     * @return $this
     */
    public function setLocalpart( string $localPart ): static
    {
        $this->localpart = ['value' => $localPart];
        return $this;
    }

    /**
     * @return $this
     */
    public function exclude(): static
    {
        $this->exclude = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function include(): static
    {
        $this->exclude = false;

        return $this;
    }
}

