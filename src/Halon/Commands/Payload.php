<?php

namespace Mvdgeijn\Halon\Commands;

class Payload
{
    public Conditions $conditions;

    public $sortings;

    public $paging;

    public function __construct()
    {
        $this->conditions = new Conditions();

        $this->paging = new Paging();
    }
}
