<?php

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');
elseif (!defined('SMF'))
	die('<b>Error:</b> Cannot install - please verify you put this file in the same place as SMF\'s SSI.php.');

if (SMF == 'SSI')
	db_extend('packages');

$hook_functions = array(
	'integrate_pre_include' => '$sourcedir/DisabledRegistrationRedirect.php',
	'integrate_pre_load' => 'disable_registration_redirect_pre_load',
	'integrate_general_mod_settings' => 'disable_registration_redirect_general_mod_settings',
);

if (!empty($context['uninstalling']))
	$call = 'remove_integration_function';
else
	$call = 'add_integration_function';

foreach ($hook_functions as $hook => $function)
	$call($hook, $function);

if (SMF == 'SSI')
	echo 'Congratulations! You have successfully installed the mod hooks';
