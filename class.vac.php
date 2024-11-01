<?php

namespace VerifiedVisitors;

use Exception;

class VAC
{
    function check()
    {
        try {
            $vv_vid = CookieUtils::get_vv_vid();
            $vac_request = RequestUtils::build_vac_request($vv_vid);
            $response = RequestUtils::query_vac($vac_request);

            if ($response->visitorId != null) {
                CookieUtils::set_vv_vid($response->visitorId);
            }

            $_SESSION['SiteKey'] = $response->captchaSiteKey;

            switch ($response->action) {
                case 'captcha':
                    include VERIFIED_VISITORS_PLUGIN_DIR . 'templates/captcha.php';
                    die;
                case 'block':
                    status_header(403, "Forbidden");
                    include VERIFIED_VISITORS_PLUGIN_DIR . 'templates/blocked.php';
                    die;
            }
        } catch (Exception $ex) {
            error_log($ex->getMessage(), $ex->getCode());
        }
    }
}
