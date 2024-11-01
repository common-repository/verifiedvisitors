<?php

namespace VerifiedVisitors;

class VACResponse
{
    public $ruleId;
    public $action;
    public $captchaSiteKey;
    public $error;
    public $vacFetchTimeMs;
    public $rootDomain;
    public $visitorId;

    function __construct(
        ?int $ruleId = null,
        ?string $action = null,
        ?string $captchaSiteKey = null,
        ?string $error = null,
        ?int $vacFetchTimeMs = null,
        ?string $rootDomain = null,
        ?string $visitorId = null
    ) {
        $this->ruleId = $ruleId;
        $this->action = $action;
        $this->captchaSiteKey = $captchaSiteKey;
        $this->error = $error;
        $this->vacFetchTimeMs = $vacFetchTimeMs;
        $this->rootDomain = $rootDomain;
        $this->visitorId = $visitorId;
    }
}
