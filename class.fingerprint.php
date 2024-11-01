<?php

namespace VerifiedVisitors;

class Fingerprint
{
    function enqueue_scripts()
    {
        wp_enqueue_script(
            'fingerprint-js',
            Config::FINGERPRINT_URL,
            array(),
            false
        );
    }
}
