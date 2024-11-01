<?php

namespace VerifiedVisitors;

class ValidateUtils
{
    static function validate_request_method(string $request_method)
    {
        if (
            $request_method != 'CONNECT' &&
            $request_method != 'DELETE' &&
            $request_method != 'GET' &&
            $request_method != 'HEAD' &&
            $request_method != 'OPTIONS' &&
            $request_method != 'PATCH' &&
            $request_method != 'POST' &&
            $request_method != 'PUT' &&
            $request_method != 'TRACE'
        ) {
            return null;
        }

        return $request_method;
    }
}
