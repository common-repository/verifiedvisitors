<?php

namespace VerifiedVisitors;

class Config
{
    public const VV_API_KEY_OPTION = 'vv_api_key';
    public const API_URL = 'https://api.verifiedvisitors.com/vac/verify';
    public const FINGERPRINT_URL = 'https://resources.verifiedvisitors.com/vvfp.min.js';
    public const COOKIE_NAME = 'vv_vid';
    public const COOKIE_EXPIRATION = 30 * DAY_IN_SECONDS;
    public const VERSION = '1.1.2';
    public const H_CAPTCHA_RESPONSE_KEY = "hCaptchaResponse";
}
