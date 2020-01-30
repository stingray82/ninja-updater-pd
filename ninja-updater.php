<?php
/*
 * Plugin name: Ninja-Updater
 * Author: Nathan Foley
 * Author URI: https://github.com/stingray82
 * Version: 0.02
 */

require dirname(__FILE__) . '/updates/plugin-update-checker.php';
Check_Self();
$next_slugs = get_plugin_update_slugs();
array_walk($next_slugs,"Check_Others");
/* allows to print to a log file ---- Delete or close off to view output/*
$results2 = print_r($next_slugs, true); // $results now contains output from print_r
file_put_contents(dirname(__FILE__) . '/logs/next_slugs.txt', print_r($next_slugs, true));  
/* Allows to print to a log file */


function Check_Others($value,$key){
    require dirname(__FILE__) . '/updates/plugin-update-checker.php';
    $location = WP_PLUGIN_DIR."/".$value."/";
    $location2 =__FILE__;
    //$results = print_r($location, true); // $results now contains output from print_r
    //file_put_contents(dirname(__FILE__) . '/logs/location.txt', print_r($location, true));
    //$results2 = print_r($location2, true); // $results now contains output from print_r
    //file_put_contents(dirname(__FILE__) . '/logs/location2.txt', print_r($location2, true));  
    ${"update" . $value} = Puc_v4_Factory::buildUpdateChecker(
    'http://thedevshed.com/repo/?action=get_metadata&slug='.$value,
    __FILE__, //Full path to the main plugin file or functions.php.
    //$location, //Full path to the main plugin file or functions.php.
    $value
    );
}



/* Enable Automatic Updates for the Base Plugin - Ninja-Updater*/
function auto_update_specific_plugins ( $update, $item ) {
    // Array of plugin slugs to always auto-update
    $plugins = array (      
        'ninja-updater',
    );
    if ( in_array( $item->slug, $plugins ) ) {
        return true; // Always update plugins in this array
    } else {
        return $update; // Else, use the normal API response to decide whether to update or not
    }
}


/* This Checks for the Updates to this Plugin to make sure this gets any updates out side of code changes */
function Check_Self() {
    //require dirname(__FILE__) . '/updates/plugin-update-checker.php';
    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'http://domain.com/repo/?action=get_metadata&slug=ninja-updater',
    __FILE__, //Full path to the main plugin file or functions.php.
    'ninja-updater'
);
}


 function get_plugin_update_slugs(){
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
    $all_plugins = get_plugins();
    if (empty($plugin_array)) {return array();}
    $results2 = print_r($plugin_array, true); // $results now contains output from print_r
    file_put_contents(dirname(__FILE__) . '/logs/plugin_array.txt', print_r($plugin_array, true));
    $ar = array_column($plugin_array, 0);
    foreach($all_plugins as $key => $plugin){
        $key_carry = $key;
        $slug_carry = sanitize_title($plugin['Name']);
        $plugnsX = compact ("key_carry","slug_carry");
    }
    return $plugnsX;
 }