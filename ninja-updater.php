<?php
/*
 * Plugin name: Ninja-Updater
 * Author: Nathan Foley
 * Author URI: https://github.com/stingray82
 * Version: 0.1
 */
require dirname(__FILE__) . '/updates/plugin-update-checker.php';
Check_Self();
$next_slugs = get_plugin_update_slugs();
Check_Others();



function Check_Others(){
    $next_slugs = get_plugin_update_slugs();
    foreach($next_slugs as $k=>$var){
        try {
            extract($var);
            $key_use = $key_carry;
            $slug_use = $slug_carry;
            $update = "" . $slug_use;
            ${$update} = Puc_v4_Factory::buildUpdateChecker(
            'yourrepohere'.$slug_use,
            WP_PLUGIN_DIR."/".$key_use, //Full path to the main plugin file or functions.php.
            $slug_use       
            );
        } catch (exception $e) {
    //code to handle the exception
        }
    };
}

/* Enable Automatic Updates for the Base Plugin - Ninja-Updater*/ //this is still work in progress
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
function Check_Self() {<?php

/*

 * Plugin name: ninja-updater

 * Author: Wordpressninja.co.uk

 * Author URI: https://wordpressninja.co.uk

 * Version: 0.1

 */
require dirname(__FILE__) . '/updates/plugin-update-checker.php';
//Check_Self();
Check_Others();



function Check_Others(){
    $next_slugs = get_plugin_update_slugs();
    foreach($next_slugs as $k=>$var){
        try {
            extract($var);
            $key_use = $key_carry;
            $slug_use = $slug_carry;
            $update = rand() . $slug_use;
            ${$update} = Puc_v4_Factory::buildUpdateChecker(
            'http://thedevshed.com/repo/?action=get_metadata&slug='.$slug_use,
            WP_PLUGIN_DIR."/".$key_use, //Full path to the main plugin file or functions.php.
            $slug_use       
            );
        } catch (exception $e) {
    //code to handle the exception
        }
    };
}

/* Enable Automatic Updates for the Base Plugin - Ninja-Updater*/ //this is still work in progress
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
/*function Check_Self() {
    //require dirname(__FILE__) . '/updates/plugin-update-checker.php';
    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'http://thedevshed.com/repo/?action=get_metadata&slug=ninja-updater',
    __FILE__, //Full path to the main plugin file or functions.php.
    'ninja-updater'
);
}*/

 function get_plugin_update_slugs(){
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
    $plugin_array = get_plugins();
    if (empty($plugin_array)) {return array();}
    $results2 = print_r($plugin_array, true); // $results now contains output from print_r
    //$ar = array_column($plugin_array, 0);
    $plugnsX = array();
    foreach($plugin_array as $key => $plugin){
        $key_carry = $key;
        $slug_carry = sanitize_title($plugin['Name']);
        $plugnsX[] = compact ("key_carry","slug_carry");
    }
    return $plugnsX;
 }

    //require dirname(__FILE__) . '/updates/plugin-update-checker.php';
    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'http://thedevshed.com/repo/?action=get_metadata&slug=ninja-updater',
    __FILE__, //Full path to the main plugin file or functions.php.
    'ninja-updater'
);
}

 function get_plugin_update_slugs(){
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
    $plugin_array = get_plugins();
    if (empty($plugin_array)) {return array();}
    $results2 = print_r($plugin_array, true); // $results now contains output from print_r
    //$ar = array_column($plugin_array, 0);
    $plugnsX = array();
    foreach($plugin_array as $key => $plugin){
        $key_carry = $key;
        $slug_carry = sanitize_title($plugin['Name']);
        $plugnsX[] = compact ("key_carry","slug_carry");
    }
    return $plugnsX;
 }
