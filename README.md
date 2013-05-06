# About Baru CMS 1.0 BETA
Baru CMS is a small webbased content management system, mainly created by a german student.

# Features
* easy to install
* easy to use
* easy to customize
  * you can install your own templates or modify the default
  * you can code your own backend modules
* Usergroups and -rights management
* allround WYSIWYG-editor (tinyMCE)
* ... (just try it and you'll see)

You have an idea for BaruCMS? Just create a new issue. I'm happy about constructive suggestions.

# How to install
1. Copy all files to your webserver
2. Fill out the "db_config.php"
3. open "setup.php" (or "index.php". It'll redirect you to the setup)
4. Follow the instructions on the screen
The installer will add the following user:
 E-Mail: super@user.com
 Password: barucms


__CHANGE YOUR PASSWORD AND E-MAIL, AFTER INSTALLING!__

# Changelog
## Version 0.5
* only uses MySQLi, if the server supports it
* XXS-exploits fixed

## Version 0.4
* MVC (Model, View, Controller) for the frontend
* new template-API

## Version 0.3
* Usergroups and page categories are now deletable
* Flatend-Dropdown-Menu added
* more possibilities for custom modules
 * choose, how they are displayed (main menu, userdropdown or hidden)
* bugfixes
 
## Version 0.2
* new backend
 * add custom modules
 * nice design (Based on: https://github.com/82OderSo/Flatend )
* improved frontend
* ...

# Thanks
Thanks to @janh97 for the new backend design! (https://github.com/82OderSo/Flatend )
