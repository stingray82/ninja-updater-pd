<?php
try {
	require WP_PLUGIN_DIR."/ninja-updater/updates/plugin-update-checker.php";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'Linktolocation',
	__FILE__, //Full path to the main plugin file or functions.php.
	'SLUG'
);

?>