<?php

namespace VerifiedVisitors;

class VisitorId
{
    public $ip;
    public $ua;
    public $vid;

    function __construct(string $ip, string $ua, ?string $vid)
    {
        $this->ip = $ip;
        $this->ua = $ua;
        $this->vid = $vid;
    }
}
