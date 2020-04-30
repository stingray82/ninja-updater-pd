# Ninja Updater - Wordpress Plugin Updater V0.1.8

A simple WordPress plugin to allow single access to update themes and plugins.

It utilises the self-hosted version of https://github.com/YahnisElsts/plugin-update-checker

With a Backend of https://github.com/YahnisElsts/wp-update-server to supply updated files

This is was a **Beta at best a proof of concept**, I wished to build a full self-hosted repository for all my plugins and themes both made by me and commercial and this is the important first step

It now is working and I am updating it so others can build on it and use it

### Donations Welcome:
If this helps you, saves you time or allows your business to run better feel free to buy me a Coffee/Beer/Plugin

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=RZVELH3TQQMUW&item_name=Ninja+Updater+Donations&currency_code=USD&source=url)

## Build the Plugin

Download file and zip into a folder with the following file structure

-ninja-updater

--logs

--updates

--ninja-updater.php

## Installation

As per any other WordPress Plugin 

You need to edit Lines 28 and 46 so they point to your server so they read from this
```PHP
'Your_Server_Goes_Here'.$slug_use,

```
TO THIS
```PHP
'http://www.myservergoeshere.com'.$slug_use,

```

## Usage
Once installed and activated you should be able to check for updates in the plugin screen as it adds a check plugin option for all plugins and you can also check all by going to the WordPress updates ('https://yoursite.co.uk/wp-admin/update-core.php'

**Before installation of Ninja Updater**
![Before Activation](https://i.ibb.co/3BBPkMb/Before.png "Before Activation")

**After installation of Ninja Updater**
![After Activation](https://i.ibb.co/3BBPkMb/Before.png "After Activation")



## Future Development

- ~~Make it update all plugins - Even commercial ones overriding there in build updates, which will make new site deployment so much faster~~
- ~~I will activate the GitHub updater for this plugin currently it checks is set up for a repository as its easier to test while I experiment with the code.~~ **Now Updates from the repository above no issues**
- ~~Update all plugins without the addition to the plugin~~ **See Exceptions**

### Additional Future Development
- Experiment with authorisation and api’s
- Speed Improvements
- Confirm automatic self-updating works
- Fix overridge of Wordpress.org



## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

**Please make sure to test as appropriate.**

## Exceptions!
It now does themes, and plugins directly without modification to the plugins, there are some exceptions such as wp-smush-pro and I'd guess other WPMU DEV projects and other providers of commercial plugins who force login for updates.

**wp-smush-pro fix - just remove the WPMU DEV dashboard and then rename or remove plugins/wp-smush-pro/core/external/dash-notice/wpmudev-dash-notification.php**


## License
Work by YahnisElsts [MIT](https://choosealicense.com/licenses/mit/)

## Thanks

**YahnisElsts - It's your code I am just playing with it and thanks for the help!**


PHP is not a language I really know so StackOverflow and php.net has been very helpful

![Wordpress Ninja Wordpress Hosting and Website Design](https://wordpressninja.co.uk/wp-content/uploads/2020/01/Wordpres_Ninja_Logo_RET-300x120-1.png "Wordpress Ninja Wordpress Hosting and Website Design")

[Wordpress Website Design and Wordpress Hosting](https://www.wordpressninja.co.uk/)

Thanks for supplying the domains and hosting to work on this project at no cost to myself!
