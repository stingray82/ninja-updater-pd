# Ninja Updater - Wordpress Plugin Updater
A simple WordPress plugin to allow single access to update themes and plugins, based on the self-hosted version of https://github.com/YahnisElsts/plugin-update-checker

Works with https://github.com/YahnisElsts/wp-update-server to supply updated files

This is an alpha at best a proof of concept, I wish to build a full self-hosted repository for all my plugins and themes both made by me and commercial and this is the important first step


## Build the Plugin

Download file and zip into a folder with the following file structure

-ninja-updater

--logs

--updates

--ninja-updater.php

## Installation

As per any other WordPress Plugin once installed you then need to upload
update.php to your plugin and make sure it's in future versions

Change the following two lines

-- (Link to Location)  will be your json file or your wp-update-server

-- (Slug) The Plugins slug i.e pods
```php
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'Linktolocation',
	__FILE__, //Full path to the main plugin file or functions.php.
	'SLUG'
);
```

 and then add the following single line to the plugin to require it

```php
require plugin_dir_path(__FILE__) . '/update.php'; // 
```

## Future Dev

- Make it update all plugins - Even commercial ones overriding there in build updates, which will make new site deployment so much faster
- I will activate the GitHub updater for this plugin currently it checks is set up for a repository as its easier to test while I experiment with the code.
- Update all plugins without the addition to the plugin



## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)

## Thanks

YahnisElsts - It's your code I am just playing with it