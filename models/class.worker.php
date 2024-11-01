<?php

namespace VerifiedVisitors;

class Worker
{
    public $version;

    function __construct(string $version)
    {
        $this->version = $version;
    }
}
