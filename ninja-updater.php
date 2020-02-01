<?php
/*
 * Plugin name: Ninja-Updater
 * Author: Nathan Foley
 * Author URI: https://github.com/stingray82 / https://www.wordpressninja.co.uk
 * Version: 0.1.2
 */

// This works with The location of your ZIP File repo using: https://github.com/YahnisElsts/wp-update-server
// Themes - Edit Style.css in base directory with your new version number and upload to your repo
// Plugins -Edit Main plugin file with your new version number and upload to your repo

// No need to edit below this line //
require dirname(__FILE__) . '/updates/plugin-update-checker.php';
add_filter( 'auto_update_plugin', 'auto_update_specific_plugins', 10, 2 );
Check_Plugins();
Check_Themes();

function Check_Plugins(){
    $next_slugs = get_plugin_update_slugs();
    foreach($next_slugs as $k=>$var){
        try {
            extract($var);
            $key_use = $key_carry;
            $slug_use = $slug_carry;
            $update = rand() . $slug_use;
            ${$update} = Puc_v4_Factory::buildUpdateChecker(
            'Your_Server_Goes_Here'.$slug_use,
            WP_PLUGIN_DIR."/".$key_use, //Full path to the main plugin file or functions.php.
            $slug_use       
            );
        } catch (exception $e) {
    //code to handle the exception
        }
    };
}

function Check_Themes(){
    $next_slugs = get_themes_update_slugs();
    foreach($next_slugs as $k=>$var){
        try {
            extract($var);
            $theme = $find_theme;
            $update = rand() . $theme;
            ${$update} = Puc_v4_Factory::buildUpdateChecker(
            'Your_Server_Goes_Here'.$theme,
            get_theme_root()."/".$theme, //Full path to the main plugin file or functions.php.
            $theme       
            );
        } catch (exception $e) {
    //code to handle the exception
        }
    };
}

function auto_update_specific_plugins ( $update, $item ) {
    $plugins = array ( // Plugins to  auto-update
        'ninja-updater',
    );
    if ( in_array( $item->slug, $plugins ) )
        return true; // Auto-update specified plugins
    else return false; // Don't auto-update all other plugins
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

 function get_themes_update_slugs(){
    require_once ABSPATH . 'wp-includes/theme.php';
    $theme_array = wp_get_themes();
    file_put_contents(dirname(__FILE__) . '/logs/theme_array.txt', print_r($theme_array, true));
    if (empty($theme_array)) {return array();}
    $results2 = print_r($theme_array, true); // $results now contains output from print_r
    $themeX = array();
    foreach ($theme_array as $theme_array) {
        # code...
          
        foreach($theme_array as $key => $theme){
            $find_theme = $theme_array->get( 'TextDomain' );
            $themeX[] = compact ("find_theme");         
        }
        
    }
    return $themeX;
}
