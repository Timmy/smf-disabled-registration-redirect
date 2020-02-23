<?php

if (!defined('SMF')) {
    die('Hacking attempt...');
}

function disable_registration_redirect_pre_load()
{
    global $modSettings;

    if (
        isset($_REQUEST['action']) && $_REQUEST['action'] === 'register' && // If a user attempts to register an account
        !empty($modSettings['registration_method']) && $modSettings['registration_method'] == 3 && // but registration is disabled
        !empty($modSettings['disabled_registration_redirect_url']) // and a redirect url was provided
    ) {
        header('Location: ' . str_replace(' ', '%20', $modSettings['disabled_registration_redirect_url'])); // Redirect
        obExit(false); // Stop execution
    }
}

function disable_registration_redirect_general_mod_settings(&$config_vars)
{
    global $txt;

    loadLanguage('DisabledRegistrationRedirect');

    $config_vars = array_merge($config_vars, array(
        $txt['disabled_registration_redirect_title'],
        array(
            'text',
            'disabled_registration_redirect_url',
            'subtext' => $txt['disabled_registration_redirect_url_info'],
            'postinput' => $txt['disabled_registration_redirect_url_example'],
        ),
    ));
}
