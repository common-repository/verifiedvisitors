<?php

namespace VerifiedVisitors;

class CookieUtils
{
    public static function delete_vv_vid()
    {
        self::set_vv_vid(null);
    }

    public static function get_vv_vid()
    {
        return isset($_COOKIE[Config::COOKIE_NAME])
            ? sanitize_text_field($_COOKIE[Config::COOKIE_NAME])
            : null;
    }

    public static function set_vv_vid(?string $value)
    {
        $secure = is_ssl() || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && sanitize_text_field($_SERVER['HTTP_X_FORWARDED_PROTO']) == 'https');

        setcookie(
            Config::COOKIE_NAME,
            $value,
            time() + Config::COOKIE_EXPIRATION,
            "/",
            COOKIE_DOMAIN,
            $secure,
            false
        );
    }
}
