<?php

namespace VerifiedVisitors;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Verify</title>
    <script src="https://hcaptcha.com/1/api.js?recaptchacompat=off" async defer></script>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
        }

        .container {
            margin-top: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 45px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>We've detected something unusual about your visit.</h1>
            <p>Please complete the CAPTCHA to continue.</p>
        </header>
        <form id="challenge-form" action="" method="POST">
            <div class="h-captcha" data-sitekey="<?php echo esc_html($_SESSION['SiteKey']) ?>" data-callback="onComplete"></div>
        </form>
        <script>
            async function onComplete(response) {
                try {
                    const r = await fetch('/', {
                        method: 'POST',
                        body: JSON.stringify({
                            '<?php echo Config::H_CAPTCHA_RESPONSE_KEY ?>': response
                        }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                } catch (error) {
                    console.error(error)
                }

                <?php
                if (esc_js($_SERVER['REQUEST_METHOD']) == 'POST') {
                    echo "history.go(-1)";
                } else {
                    echo "location.href = location.search";
                }
                ?>
            }
        </script>
    </div>
</body>

</html>