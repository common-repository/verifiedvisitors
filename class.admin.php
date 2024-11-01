<?php

namespace VerifiedVisitors;

class Admin
{
    private $initialised = false;

    function init()
    {
        if (!$this->initialised) {
            $this->init_hooks();
        }
    }

    function init_hooks()
    {
        $this->initialised = true;
        add_action('admin_init', array($this, 'admin_init'));
        add_action('admin_menu', array($this, 'admin_menu'));
    }

    function admin_init()
    {
        register_setting('vv', Config::VV_API_KEY_OPTION);

        add_settings_section(
            'vv_settings_section',
            'Account',
            array($this, 'settings_section_callback'),
            'vv'
        );

        add_settings_field(
            'vv_settings_field',
            'API Key',
            array($this, 'settings_field_callback'),
            'vv',
            'vv_settings_section'
        );
    }

    function settings_section_callback()
    {
?>
        <p>API keys can be generated from your profile settings page in the VerifiedVisitors dashboard.</p>
        <p>Please see the install instructions for more information.</p>
    <?php
    }

    function settings_field_callback()
    {
        $setting = get_option(Config::VV_API_KEY_OPTION);
    ?>
        <input type="text" style="width: 500px" name="<?php echo Config::VV_API_KEY_OPTION ?>" value="<?php echo isset($setting) ? esc_attr($setting) : ''; ?>" />
    <?php
    }

    function admin_menu()
    {
        add_menu_page(
            'Verified Visitors',
            'Verified Visitors',
            'manage_options',
            'vv',
            array($this, 'options_page_html')
            // TODO: Add a custom menu icon...
        );
    }

    function options_page_html()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $option_key = Config::VV_API_KEY_OPTION;

        if (isset($_GET['settings-updated'])) {
            $response = wp_remote_post(
                Config::API_URL,
                array(
                    'headers' => array(
                        'authorization' => 'bearer ' . get_option($option_key)
                    ),
                    'timeout' => 5
                )
            );

            $response_code = wp_remote_retrieve_response_code($response);
            error_log($response_code);

            if ($response_code == 400) {
                add_settings_error(
                    $option_key,
                    "{$option_key}_success",
                    'Settings saved successfully',
                    'updated'
                );
            } else {
                add_settings_error(
                    $option_key,
                    "{$option_key}_failed_to_verify",
                    'Failed to verify API token',
                    'error'
                );
            }
        }

        settings_errors($option_key);
    ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('vv');
                do_settings_sections('vv');
                submit_button('Save');
                ?>
            </form>
        </div>
<?php
    }

    function uninstall()
    {
        delete_option(Config::VV_API_KEY_OPTION);
    }
}
