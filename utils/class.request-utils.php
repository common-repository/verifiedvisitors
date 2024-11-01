<?php

namespace VerifiedVisitors;

class RequestUtils
{
    private static function get_raw_server_value(string $name)
    {
        if (array_key_exists($name, $_SERVER) && !empty($_SERVER[$name])) {
            $sanitised_value = sanitize_text_field($_SERVER[$name]);
            return $sanitised_value;
        }
        return null;
    }

    private static function get_ip_address(string $name)
    {
        $sanitised_value = self::get_raw_server_value($name);
        $filtered_value = filter_var($sanitised_value, FILTER_VALIDATE_IP);
        if ($filtered_value == false) {
            error_log("{$name} was not a valid IP address");
            $filtered_value = null;
        }
        return $filtered_value;
    }

    private static function get_request_method()
    {
        $sanitised_method = self::get_raw_server_value('REQUEST_METHOD');
        $method = ValidateUtils::validate_request_method($sanitised_method);
        if ($method == null) {
            error_log('REQUEST_METHOD was not a valid HTTP method');
        }
        return $method;
    }

    public static function build_vac_request(?string $vv_vid)
    {
        $headers = getallheaders();

        $request_time = self::get_raw_server_value('REQUEST_TIME_FLOAT') ?? microtime(true);
        $milliseconds = floor($request_time * 1000);

        $sanitised_host = self::get_raw_server_value('HTTP_HOST');
        $sanitised_uri = self::get_raw_server_value('REQUEST_URI');
        $sanitised_url = "{$sanitised_host}{$sanitised_uri}";
        $escaped_url = esc_url($sanitised_url);
        $host = wp_parse_url($escaped_url, PHP_URL_HOST);
        $path = wp_parse_url($escaped_url, PHP_URL_PATH);
        $query_string = wp_parse_url($escaped_url, PHP_URL_QUERY);
        $query_string = empty($query_string) ? "" : "?{$query_string}";
        $uri = "{$host}{$path}{$query_string}";
        $method = self::get_request_method();

        $connection = self::get_raw_server_value('HTTP_CONNECTION');

        $referer = esc_url(self::get_raw_server_value('HTTP_REFERER'));
        $origin = self::get_raw_server_value('HTTP_ORIGIN');
        $pragma = self::get_raw_server_value('HTTP_PRAGMA');

        $user_agent = self::get_raw_server_value('HTTP_USER_AGENT');
        $host = self::get_raw_server_value('HTTP_HOST');

        $client_ip = self::get_ip_address('HTTP_CLIENT_IP');
        $remote_addr = self::get_ip_address('REMOTE_ADDR');
        $ip = $client_ip ?? $remote_addr;

        $x_forwarded_for = self::get_ip_address('HTTP_X_FORWARDED_FOR');
        $x_forwarded_proto = self::get_raw_server_value('HTTP_X_FORWARDED_PROTO');
        $x_requested_with = self::get_raw_server_value('HTTP_X_REQUESTED_WITH');
        $x_real_ip = self::get_ip_address('HTTP_X_REAL_IP');
        $true_client_ip = self::get_ip_address('HTTP_TRUE_CLIENT_IP');
        $via = self::get_raw_server_value('HTTP_VIA');

        $accept_encoding = self::get_raw_server_value('HTTP_ACCEPT_ENCODING');
        $accept = self::get_raw_server_value('HTTP_ACCEPT');
        $accept_language = self::get_raw_server_value('HTTP_ACCEPT_LANGUAGE');
        $accept_charset = self::get_raw_server_value('HTTP_ACCEPT_CHARSET');

        $content_type = $headers['Content-Type'];
        $content_length = $headers['Content-Length'];

        $cache_control = self::get_raw_server_value('HTTP_CACHE_CONTROL');

        $token = null;
        if ($method == 'POST' && StringUtils::str_starts_with($content_type, "application/json")) {
            $post = file_get_contents('php://input');
            $data = json_decode($post);
            $token = $data->hCaptchaResponse;
        }

        $vac_request = new VacRequest(
            $milliseconds,
            new VisitorId($ip, $user_agent, $vv_vid),
            $host,
            $uri,
            $method,
            array_keys($headers),
            $connection,
            $referer,
            $origin,
            $pragma,
            $x_forwarded_for,
            $x_forwarded_proto,
            $x_requested_with,
            $x_real_ip,
            $true_client_ip,
            $via,
            $accept,
            $accept_encoding,
            $accept_language,
            $accept_charset,
            $content_type,
            $content_length,
            $cache_control,
            $token,
            new Worker(Config::VERSION)
        );

        return $vac_request;
    }

    public static function query_vac(VACRequest $request)
    {
        if (is_null($request->visitorId->vid)) {
            unset($request->visitorId->vid);
        }

        $response = wp_remote_post(
            Config::API_URL,
            array(
                'headers' => array(
                    'content-type' => 'application/json',
                    'authorization' => 'bearer ' . get_option(Config::VV_API_KEY_OPTION)
                ),
                'body' => json_encode($request),
                'timeout' => 5
            )
        );

        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            error_log($error_message);
        }

        $body = wp_remote_retrieve_body($response);
        $decoded = json_decode($body, true);

        return new VACResponse(
            $decoded['ruleId'] ?? null,
            $decoded['action'] ?? null,
            $decoded['captchaSiteKey'] ?? null,
            $decoded['error'] ?? null,
            $decoded['vacFetchTimeMs'] ?? null,
            $decoded['rootDomain'] ?? null,
            $decoded['visitorId'] ?? null
        );
    }
}
