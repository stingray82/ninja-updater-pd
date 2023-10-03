<?php
/**
* Plugin Name: Ninja Updater
* Description: A custom updater that prioritizes updates from WordPress.org and plugin authors unless explicitly overwritten to check a private repo.
* Author: Nathan Foley / Thanet.Digital
* Author URI: https://thanet.digital
* Version: 1.15
*/

// Require Update checker
require dirname(__FILE__) . '/updates/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
// Define your custom update server URL here
$custom_server_url = 'REPOGOESHERE';

// Define your custom SVG icon data here (base64-encoded)
$custom_svg_icon_data = 'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiBmaWxsPSIjMDAwMDAwIiBoZWlnaHQ9IjI2cHgiIHdpZHRoPSIyNnB4IiB2ZXJzaW9uPSIxLjEiIGlkPSJfeDMxXyIgdmlld0JveD0iMCAwIDMwMyAyNTYiIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8cGF0aCBpZD0iX3gzM18iIGQ9Ik0yOTUuMywxMzAuMmMtMTUuNC00LjgtMTcuMi0xMy41LTIyLjctMTguOGMtMTEuNy0xMS43LTI3LjEtMS40LTMzLjIsMy40Yy02LjYtMzcuNC0zMy41LTY1LjEtODMuMi02NS4xICBjLTU4LjIsMC04NS4zLDM4LjEtODUuMyw4NS4zczI4LDExMS45LDg1LjMsMTExLjlzODUuMy02NC42LDg1LjMtMTExLjljMC0wLjUsMC0xLjEsMC0xLjZjMTAuNSwzLDExLjIsMTQuOSwxMS4yLDE0LjkgIHMwLDI0LjEsMjEuMywyNC4xYy03LjgtMTQuNC0yLjgtMjEuOC0yLjgtMjkuM2MwLTQuOC0xLjYtOC4zLTMuNy0xMS4yQzI3Mi44LDEzNS43LDI4NC43LDE0MS4yLDI5NS4zLDEzMC4yeiBNMjIxLjIsMTQ1LjUgIGMwLDExLjctOS42LDIxLjUtMjEuMywyNC4xYy01LDEuMS0yNC41LDIuOC00NCwyLjhsMCwwbDAsMGMtMTkuNSwwLTM5LTEuNi00NC0yLjhjLTExLjctMi4zLTIxLjMtMTIuMi0yMS4zLTI0LjF2LTYgIGMwLTYsNS0xMC41LDEwLjUtMTAuNWMxOC42LDAsMjUuNCw1LjMsNTQuNiw1LjNzMzYtNS4zLDU0LjYtNS4zYzUuNSwwLDEwLjUsNC44LDEwLjUsMTAuNXY2SDIyMS4yeiI+PC9wYXRoPgo8cGF0aCBpZD0iX3gzMl9fMV8iIGQ9Ik0xMzYuOSwxNTcuOWMtMC41LDAtMC43LDAtMS40LTAuMmwtMzAuMy0xMWMtMi4xLTAuNy0zLjItMy0yLjMtNWMwLjctMi4xLDMtMy4yLDUtMi4zbDMwLjMsMTEgIGMyLjEsMC43LDMuMiwzLDIuMyw1QzE0MC4xLDE1NywxMzguNSwxNTcuOSwxMzYuOSwxNTcuOXoiPjwvcGF0aD4KPHBhdGggaWQ9Il94MzJfIiBkPSJNMTc1LjEsMTU3LjljLTEuNiwwLTMuMi0xLjEtMy43LTIuOGMtMC43LTIuMSwwLjItNC40LDIuMy01bDMwLjMtMTFjMi4xLTAuNyw0LjQsMC4yLDUsMi4zICBjMC43LDIuMS0wLjIsNC40LTIuMyw1bC0zMC4zLDExQzE3Ni4zLDE1Ny45LDE3NS44LDE1Ny45LDE3NS4xLDE1Ny45eiI+PC9wYXRoPgo8cGF0aCBpZD0iX3gzMV9fMV8iIGQ9Ik05MC41LDQ4LjZjLTIuMS0yLjEtNS4zLTIuMS03LjYsMGwtNi42LDYuNkwyOS42LDhjLTMtMy03LjYtMy0xMC4zLDBMMTEsMTYuMmMtMywzLTMsNy42LDAsMTAuM2w0Ni44LDQ2LjggIEw1MS4xLDgwYy0yLjEsMi4xLTIuMSw1LjMsMCw3LjZjMS4xLDEuNCwyLjMsMS44LDMuNywxLjhzMi44LTAuNSwzLjctMS42bDYuNi02LjZsOS40LDkuNGMwLjctMS42LDEuNi0zLjQsMi4zLTVsLTgtOEw4MCw2Ni4yICBsNi4yLDYuMmMxLjEtMS40LDIuMy0yLjgsMy43LTMuOWwtNi02bDYuNi02LjZDOTIuNiw1My44LDkyLjYsNTAuNiw5MC41LDQ4LjZ6IE0zNS44LDMzLjJIMjUuMlYyMi43aDEwLjVWMzMuMnogTTQ5LjEsNDYuNUgzOC41VjM2ICBoMTAuNVY0Ni41eiBNNTEuNiw1OS44VjQ5LjNoMTAuNXYxMC41SDUxLjZ6Ij48L3BhdGg+Cjwvc3ZnPg=='; // Replace with your SVG data

// Hook the Check_Plugins and Check_Themes functions to admin_init action
add_action('admin_init', 'Check_Plugins');
add_action('admin_init', 'Check_Themes');

function Check_Plugins() {
    // Get all installed plugins
    include_once(ABSPATH . 'wp-admin/includes/plugin.php'); // Include plugin.php to access get_plugins() function
    $plugins = get_plugins();

    global $custom_server_url;

    // Retrieve selected plugins
    $selected_plugins = get_option('ninja_updater_selected_plugins', array());

    foreach ($plugins as $plugin_file => $plugin_data) {
        // Check if the plugin is in the selected plugins list
        if (in_array($plugin_file, $selected_plugins)) {
            // Check for updates from WordPress.org
            $repo_update = get_repo_plugin_update($plugin_data['TextDomain']);

            // Check for updates from your custom server
            $custom_update = check_for_custom_update($plugin_data['TextDomain'], $custom_server_url);

            if ($repo_update) {
                // If an update is found on WordPress.org, allow it
                ${$plugin_file} = PucFactory::buildUpdateChecker(
                    'https://api.wordpress.org/plugins/info/1.0/' . $plugin_data['TextDomain'] . '.json',
                    WP_PLUGIN_DIR . '/' . $plugin_file
                );
            } elseif ($custom_update) {
                // If an update is found on your custom server, allow it
                ${$plugin_file} = PucFactory::buildUpdateChecker(
                    $custom_server_url . '?action=get_metadata&slug=' . $plugin_data['TextDomain'],
                    WP_PLUGIN_DIR . '/' . $plugin_file
                );
            }
        }
	}
}

// Check if the constant is defined in wp-config.php or default to true
if (!defined('NINJA_UPDATER_DISPLAY_MENU') || NINJA_UPDATER_DISPLAY_MENU) {
	add_action('admin_menu', 'ninja_updater_submenu');
}

function ninja_updater_submenu() {
	global $custom_svg_icon_data; // Make the variable global
	// Check if the current user is an administrator
	if (current_user_can('administrator')) {
		add_menu_page(
			'Ninja Updater Settings',
			'Ninja Updater',
			'manage_options',
			'ninja-updater',
			'ninja_updater_plugins_page', // Callback function here
			'data:image/svg+xml;base64,' . $custom_svg_icon_data, // Custom icon URL
			2 // Set a position for the menu item
		);

		add_submenu_page(
			'ninja-updater',
			'Plugins',
			'Plugins',
			'manage_options',
			'ninja-updater-plugins',
			'ninja_updater_plugins_page' // Changed the callback function here
		);

		add_submenu_page(
			'ninja-updater',
			'Themes',
			'Themes',
			'manage_options',
			'ninja-updater-themes',
			'ninja_updater_themes_page' // Changed the callback function here
		);

		// Remove the extra submenu page under "Ninja Updater"
		remove_submenu_page('ninja-updater', 'ninja-updater');
	}
}

function ninja_updater_custom_menu_icon() {
    global $custom_svg_icon_data; // Make the variable global
    echo '<style>
        #adminmenu #toplevel_page_ninja-updater .wp-menu-image {
            background: url("data:image/svg+xml;base64,' . $custom_svg_icon_data . '") no-repeat center center !important;
        }
    </style>';
}

// Add an action hook to call the function
add_action('admin_head', 'ninja_updater_custom_menu_icon');

// Create a settings page for selecting plugins to check
function ninja_updater_plugins_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    // Check for form submission and save selected plugins
    if (isset($_POST['submit'])) {
        $selected_plugins = isset($_POST['selected_plugins']) ? $_POST['selected_plugins'] : array();

        update_option('ninja_updater_selected_plugins', $selected_plugins);
    }

    // Retrieve selected plugins
    $selected_plugins = get_option('ninja_updater_selected_plugins', array());

    // Get all installed plugins
    $plugins = get_plugins();

    // Output the settings form for plugins
    ?>
    <div class="wrap">
        <h2>Ninja Updater Settings - Plugins</h2>
        <form method="post">
            <ul>
                <?php foreach ($plugins as $plugin_file => $plugin_data) : ?>
                    <li>
                        <label>
                            <input type="checkbox" name="selected_plugins[]" value="<?php echo esc_attr($plugin_file); ?>" <?php checked(in_array($plugin_file, $selected_plugins)); ?> />
                            <?php echo esc_html($plugin_data['Name']); ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p class="submit">
                <input type="submit" class="button-primary" name="submit" value="Save Settings" />
            </p>
        </form>
    </div>
    <?php
}

// Create a settings page for selecting themes to check
function ninja_updater_themes_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    // Check for form submission and save selected themes
    if (isset($_POST['submit'])) {
        $selected_themes = isset($_POST['selected_themes']) ? $_POST['selected_themes'] : array();

        update_option('ninja_updater_selected_themes', $selected_themes);
    }

    // Retrieve selected themes
    $selected_themes = get_option('ninja_updater_selected_themes', array());

    // Get all themes
    $themes = wp_get_themes();

    // Output the settings form for themes
    ?>
    <div class="wrap">
        <h2>Ninja Updater Settings - Themes</h2>
        <form method="post">
            <ul>
                <?php foreach ($themes as $theme) : ?>
                    <li>
                        <label>
                            <input type="checkbox" name="selected_themes[]" value="<?php echo esc_attr($theme->get_stylesheet()); ?>" <?php checked(in_array($theme->get_stylesheet(), $selected_themes)); ?> />
                            <?php echo esc_html($theme->get('Name')); ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p class="submit">
                <input type="submit" class="button-primary" name="submit" value="Save Settings" />
            </p>
        </form>
    </div>
    <?php
}

function Check_Themes() {
    // Retrieve selected themes
    $selected_themes = get_option('ninja_updater_selected_themes', array());

    global $custom_server_url;

    foreach ($selected_themes as $theme_folder) {
        // Check for updates from WordPress.org
        $repo_update = get_repo_theme_update($theme_folder);

        // Check for updates from your custom server
        $custom_update = check_for_custom_theme_update($theme_folder, $custom_server_url);

        if ($repo_update) {
            // If an update is found on WordPress.org, allow it
            ${$theme_folder} = PucFactory::buildUpdateChecker(
                'https://api.wordpress.org/themes/info/1.0/' . $theme_folder . '.json',
                get_theme_root() . '/' . $theme_folder
            );
        } elseif ($custom_update) {
            // If an update is found on your custom server, allow it
            ${$theme_folder} = PucFactory::buildUpdateChecker(
                $custom_server_url . '?action=get_metadata&slug=' . $theme_folder,
                get_theme_root() . '/' . $theme_folder
            );
        }
    }
}

function get_repo_plugin_update($slug) {
    // Implement logic to check for updates from WordPress.org repository
    // Return update information if available, otherwise return false
    // Example: $update_info = array('new_version' => '1.2.3', ...);
    // Return false if no update is available
    $update_info = array();

    // Your logic to check for updates from WordPress.org goes here

    return !empty($update_info) ? $update_info : false;
}

function check_for_custom_update($slug, $custom_server_url) {
    // Create the URL for checking updates
    $update_url = $custom_server_url . '?action=get_metadata&slug=' . $slug;

    // Perform a basic HTTP request to the custom update server
    $response = wp_safe_remote_get($update_url);

    // Check if the response contains update information
    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        // Parse the response to extract update info (you may need to adapt this part)
        $update_info = json_decode(wp_remote_retrieve_body($response), true);

        // Log the response for debugging
        error_log('Custom Update Response: ' . print_r($update_info, true));

        // Return the update info if available
        return !empty($update_info) ? $update_info : false;
    } else {
        // Log any errors for debugging
        error_log('Custom Update Error: ' . print_r($response, true));
    }

    // If there was an error or no update info found, return false
    return false;
}

function get_repo_theme_update($slug) {
    // Implement logic to check for updates from WordPress.org repository
    // Return update information if available, otherwise return false
    // Example: $update_info = array('new_version' => '1.2.3', ...);
    // Return false if no update is available
    $update_info = array();

    // Your logic to check for updates from WordPress.org goes here

    return !empty($update_info) ? $update_info : false;
}

function check_for_custom_theme_update($slug, $custom_server_url) {
    // Create the URL for checking updates
    $update_url = $custom_server_url . '?action=get_metadata&slug=' . $slug;

    // Perform a basic HTTP request to the custom update server
    $response = wp_safe_remote_get($update_url);

    // Check if the response contains update information
    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        // Parse the response to extract update info (you may need to adapt this part)
        $update_info = json_decode(wp_remote_retrieve_body($response), true);

        // Log the response for debugging
        error_log('Custom Theme Update Response: ' . print_r($update_info, true));

        // Return the update info if available
        return !empty($update_info) ? $update_info : false;
    } else {
        // Log any errors for debugging
        error_log('Custom Theme Update Error: ' . print_r($response, true));
    }

    // If there was an error or no update info found, return false
    return false;
}
?>