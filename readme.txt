=== My Mobypictures ===
Contributors: chillez
Tags: mobypicture, widget, photos, pictures
Requires at least: 2.2
Tested up to: 2.8
Stable tag: 1.2.2

This simple widget allows you to display your recently added Mobypicture items.

== Description ==

The My Mobypictures plugin allows you to show your recently added items to Mobypicture.com on your WordPress powered website. This simple widget automatically displays them in your sidebar or add the code manually to sidebar if you don't use widgets.

= Features =

Version 1.2.2: bug fix - the option 'Use linked images' now also works without 'Use cropped images' being selected and visa versa

New in version 1.2.1: as per request includes optional PHP code that retrieves only the 'raw' original images from Mobypicture.com and lets the theme style.css format the images. See Installation for details.

* Simple
* Customizable widget title
* Supports Mobypicture user accounts, groups and public timeline
* Change the number of images displayed (up to 20 images supported)
* Adjust thumbnail size (default value in v1 was 70 x 70)
* Adjust thumbnail padding (default value in v1 was 5)
* Select image format (orginal thumbnail or square thumbnail)
* Link to Mobypicture images on/off

== Installation ==

= Themes with widget support: =
1. Upload `my-mobypictures.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add the widget to the sidebar
4. Setup the widget
5. Enjoy!

= Themes without widget support: =
1. Upload `my-mobypictures.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Insert and edit the PHP code listed below in your `sidebar.php` at the desired location:

`< ?php mobypicture($public = false, $group = false, $username = chillez73, $num = 4, $w = 70, $h = 70, $p = 2, $square = true, $linked = true); ?>`

* `$public = false` >> replace with `true` to shown images from public timeline;
* `$group = false` >> replace with `true`  to show images from a group (only use `$group` when `$public = true`);
* `$username = chillez73` >> replace with your own Mobypicture username or group name (only use `$username` when `$public = true`);
* `$num = 4` >> replace with the number of thumbnails you wish to display;
* `$w = 70` >> replace with desired width of the thumbnail in number of pixels;
* `$h = 70` >> replace with desired height of the thumbnail in number of pixels; 
* `$p = 2` >> replace with desired padding between the thumbails;
* `$square = true` >> replace with `false`  to use original thumbnail format (typically when width and height are not equal);
* `$linked = true` >> replace with `false` when you do not wish to link thumbnails to the image on Mobypicture.com

= Total style control =
Alternatively you can also use below string of PHP code to only extract the 'raw' images from Mobypicture.com and let the image formatting be decided by your theme stylesheet (style.css):

1. Upload `my-mobypictures.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Insert and edit the PHP code listed below in your `sidebar.php` at the desired location:

`< ?php mobypicture_raw($public = false, $group = false, $username = chillez73, $num = 4, $square = true, $linked = true); ?>`

* `$username = chillez73` >> replace with your own Mobypicture username or group name (only use `$username` when `$public = true`);
* Add img.mobypicture_raw { <style settings> } to your theme stylesheet style.css

Example settings (see Screenshots for result):

img.mobypicture_raw {
	padding: 0px;
	margin: 0 2px 3px 0;
	border: 4px ridge #2772B3;
	width: 50px;
	height: 50px;
	}


You can also insert this code in a page or post if you want (see also Screenshots). However this requires the ability to run PHP in your post and/or page. This feature is not included in WordPress by default. You will need a plugin to enable this. For example: [runPHP](http://wordpress.org/extend/plugins/runphp/)

== Screenshots ==

1. Administration interface of the widget
2. Adding Mobypicture items in a post (requires ability to run PHP in posts; see Installation)
3. My Mobypictures plugin in action in WordPress Default theme
4. Result of PHP string mobypicture_raw added to sidebar.php and img.mobypicture settings in style.css

== Frequently Asked Questions ==

= How many images can be displayed with this plugin? =

The plugin uses the Mobypicture RSS feed to collect path to the images. Currently the RSS feeds supports up to 20 images, this means it can show a maximum of 20 images.

= What do I have to fill in by "User or Group name"? =

The username of your Mobypicture account or the name of the Mobypicture group you wish to use. When you use a group name please don't forget to tick the groupname box in the widget settings or set `$group = true` in the code.

= I get an error when using the code for displaying the public timeline. How can I fix this? =
Make sure that the first part of the code starts with this: "`< ?php mobypicture($public = true, $group, $username, $num = ...`" 

= What does the option "Use cropped images" do? =

Mobypicture crops images to a 90 pixel square format which is used by the Mobypicture public timeline. This option forces the plugin to use this cropped image as the source instead of the thumbnail of the original image.

== Version History ==
= Version 1.2.1 =
* Added raw image extraction via PHP string mobypicture_raw requiring style settings via style.css (see Installation)
* Added image class="mobypicture"  to widget function allowing optional extra style settings via style.css (e.g. border)

= Version 1.2 =
* Added group support
* Added public timeline support
* Added optional use of square (cropped) thumbnail
* Added show Mobypicture image title on mouseover
* Added widget description shown on Widgets admin page
* Inserted additional functions for backwards capability with plugin v1.1
* Changed references to Mobypicture photo's into Mobypicture items

= Version 1.1 =
* Added custom image sizing (width and height)
* Added custom padding (spacing around images)

= Version 1.0 =
* Original My Mobypicture plugin based on My Twitpics plugin from Pepijn de Koning

== Licence ==

This plugin is free for everyone! Since it's released under the GPL, you can use it free of charge on your personal or commercial blog.