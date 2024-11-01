<?php

namespace VerifiedVisitors;

class VACRequest
{
    public $timestamp;
    public $visitorId;
    public $host;
    public $uri;
    public $method;
    public $headers;
    public $connection;
    public $referer;
    public $origin;
    public $pragma;
    public $xForwardedFor;
    public $xForwardedProto;
    public $xRequestedWith;
    public $xRealIp;
    public $trueClientIp;
    public $via;
    public $accept;
    public $acceptEncoding;
    public $acceptLanguage;
    public $acceptCharset;
    public $contentType;
    public $contentLength;
    public $cacheControl;
    public $hCaptchaToken;
    public $worker;

    function __construct(
        string $timestamp,
        VisitorId $visitorId,
        string $host,
        string $uri,
        string $method,
        ?array $headers,
        ?string $connection,
        ?string $referer,
        ?string $origin,
        ?string $pragma,
        ?string $xForwardedFor,
        ?string $xForwardedProto,
        ?string $xRequestedWith,
        ?string $xRealIp,
        ?string $trueClientIp,
        ?string $via,
        ?string $accept,
        ?string $acceptEncoding,
        ?string $acceptLanguage,
        ?string $acceptCharset,
        ?string $contentType,
        ?string $contentLength,
        ?string $cacheControl,
        ?string $hCaptchaToken,
        Worker $worker
    ) {
        $this->timestamp = $timestamp;
        $this->visitorId = $visitorId;
        $this->host = $host;
        $this->uri = $uri;
        $this->method = $method;
        $this->headers = $headers;
        $this->connection = $connection;
        $this->referer = $referer;
        $this->origin = $origin;
        $this->pragma = $pragma;
        $this->xForwardedFor = $xForwardedFor;
        $this->xForwardedProto = $xForwardedProto;
        $this->xRequestedWith = $xRequestedWith;
        $this->xRealIp = $xRealIp;
        $this->trueClientIp =  $trueClientIp;
        $this->via =  $via;
        $this->accept =  $accept;
        $this->acceptEncoding =  $acceptEncoding;
        $this->acceptLanguage =  $acceptLanguage;
        $this->acceptCharset =  $acceptCharset;
        $this->contentType =  $contentType;
        $this->contentLength =  $contentLength;
        $this->cacheControl =  $cacheControl;
        $this->hCaptchaToken = $hCaptchaToken;
        $this->worker = $worker;
    }
}
