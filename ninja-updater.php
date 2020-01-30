<?php
/*
 * Plugin name: Ninja-Updater
 * Author: Nathan Foley
 * Author URI: https://github.com/stingray82
 * Version: 0.01
 */

/* Check For Updates */
require dirname(__FILE__) . '/updates/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'location to github will evenutally go here',
	__FILE__, //Full path to the main plugin file or functions.php.
	'ninja-updater'
);
