<?php

/*
Plugin Name: My Mobypictures
Version: 1.2.2
Plugin URI: http://www.chillez.com/projects/mobypicture/
Description: This simple widget displays your recently added Mobypicture items. 
Author: Gilles van der Have
Author URI: http://www.chillez.com/
*/

/*  My Mobypictures - Copyright 2009 Gilles van der Have

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* 	Version History
	v1.2.2
	- Bug fix: Option 'Use linked images' now also works without 'Use cropped images' being selected and visa versa.

	v1.2.1
	- Changed and added imgage class to widget function consistently
	- Added additonal function allowing image formatting to be decided by WP theme style.css

	v1.2
	- Added group support
	- Added public timeline support
	- Added optional use of square (cropped) image
	- Added show Mobypicture image title on mouseover
	- Added widget description shown on Widgets admin page
	- Changed references to Mobypicture photo's into Mobypicture items
	
	v1.1
	- Added custom image sizing (width and height)
	- Added custom padding (spacing around images)
	
	v1.0
	- Original My Mobypicture plugin based on My Twitpics plugin from Pepijn de Koning
	
*/	

define('MAGPIE_CACHE_ON', 0); //2.7 Cache Bug

$mobypic_options['widget_fields']['title'] = array('label'=>'Title:', 'type'=>'text', 'default'=>'Mobypicture');
$mobypic_options['widget_fields']['username'] = array('label'=>'User or Group name:', 'type'=>'text', 'default'=>'');
$mobypic_options['widget_fields']['group'] = array('label'=>'Tick box when above name is a group name:', 'type'=>'checkbox', 'default'=>false);
$mobypic_options['widget_fields']['public'] = array('label'=>'Tick box to use Mobypicture public timeline:', 'type'=>'checkbox', 'default'=>false);
$mobypic_options['widget_fields']['num'] = array('label'=>'Number of images (1-20):', 'type'=>'text', 'default'=>4);
$mobypic_options['widget_fields']['w'] = array('label'=>'Image width:', 'type'=>'text', 'default'=>70);
$mobypic_options['widget_fields']['h'] = array('label'=>'Image height:', 'type'=>'text', 'default'=>70);
$mobypic_options['widget_fields']['p'] = array('label'=>'Image padding:', 'type'=>'text', 'default'=>2);
$mobypic_options['widget_fields']['square'] = array('label'=>'Use cropped images (recommended if Width = Height):', 'type'=>'checkbox', 'default'=>true);
$mobypic_options['widget_fields']['linked'] = array('label'=>'Use linked images:', 'type'=>'checkbox', 'default'=>true);

$mobypic_options['prefix'] = 'mobypic';

//Display Mobypicture last added items
function mobypicture($public, $group, $username, $num, $w, $h, $p, $square, $linked) {
	
	if($public == true) {
	$file = @file_get_contents("http://www.mobypicture.com/rss/public.rss");}
	
	elseif ($group == true) {
	$file = @file_get_contents("http://www.mobypicture.com/rss/".$username."/group.rss");
	} else {
	$file = @file_get_contents("http://www.mobypicture.com/rss/".$username."/user.rss");
	}

	for($i = 1; $i <= $num; ++$i) {
		$pic = explode('<media:thumbnail url="', $file);
		$pic = explode('thumbnail.jpg"/>', $pic[$i]);
		$pic = trim($pic[0]);

		$url = explode('<guid isPermaLink="true">', $file);
		$url = explode('</guid>', $url[$i]);
		$url = trim($url[0]);
		
		$mediatitle = explode('<media:title>', $file);
		$mediatitle = explode('</media:title>', $mediatitle[$i]);
		$mediatitle = trim($mediatitle[0]);

		
		if($square == true && $linked == true) {
		echo '<a href="'.$url.'" target="_new"><img src="'.$pic.'square.jpg" title="'.$mediatitle.'" width="'.$w.'" height="'.$h.'" style="padding: '.$p.'px;" class="mobypicture"></a>'; }
		
		elseif ($square == true && $linked == false) {
		echo '<img src="'.$pic.'square.jpg" title="'.$mediatitle.'" width="'.$w.'" height="'.$h.'" style="padding: '.$p.'px;" class="mobypicture">'; }
				
		elseif ($square == false && $linked == true) {
		echo '<a href="'.$url.'" target="_new"><img src="'.$pic.'thumbnail.jpg" title="'.$mediatitle.'" width="'.$w.'" height="'.$h.'" style="padding: '.$p.'px;" class="mobypicture"></a>'; }		
				
		else {
		echo '<img src="'.$pic.'thumbnail.jpg" title="'.$mediatitle.'" width="'.$w.'" height="'.$h.'" style="padding: '.$p.'px;" class="mobypicture">'; }
		
	 }	
	}

//Display Mobypicture last added items without formatting - formatting relies on WP theme css
//Include class img.mobypic in your style.css setting image width, height, padding, border etc.
function mobypicture_raw($public, $group, $username, $num, $square, $linked) {
	
	if($public == true) {
	$file = @file_get_contents("http://www.mobypicture.com/rss/public.rss");}
	
	elseif ($group == true) {
	$file = @file_get_contents("http://www.mobypicture.com/rss/".$username."/group.rss");
	} else {
	$file = @file_get_contents("http://www.mobypicture.com/rss/".$username."/user.rss");
	}

	for($i = 1; $i <= $num; ++$i) {
		$pic = explode('<media:thumbnail url="', $file);
		$pic = explode('thumbnail.jpg"/>', $pic[$i]);
		$pic = trim($pic[0]);

		$url = explode('<guid isPermaLink="true">', $file);
		$url = explode('</guid>', $url[$i]);
		$url = trim($url[0]);
		
		$mediatitle = explode('<media:title>', $file);
		$mediatitle = explode('</media:title>', $mediatitle[$i]);
		$mediatitle = trim($mediatitle[0]);

		
		if($square == true && $linked == true) {
		echo '<a href="'.$url.'" target="_new"><img src="'.$pic.'square.jpg" title="'.$mediatitle.'" class="mobypicture_raw"></a>'; }
		
		elseif ($square == true && $linked == false) {
		echo '<img src="'.$pic.'square.jpg" title="'.$mediatitle.'" class="mobypicture_raw">'; }
		
		elseif ($square == false && $linked == true) {
		echo '<a href="'.$url.'" target="_new"><img src="'.$pic.'thumbnail.jpg" title="'.$mediatitle.'" class="mobypicture_raw"></a>'; }
		
		else {
		echo '<img src="'.$pic.'thumbnail.jpg" title="'.$mediatitle.'" class="mobypicture_raw">'; }
		
	 }	
	}



// Below function is purely for to support backwards compatabilty with v1.1
// It is not used by the plugin and can be removed safely
function mobypic_pics($username, $num, $width, $height, $padding, $linked) {
	$file = @file_get_contents("http://www.mobypicture.com/rss/".$username."/user.rss");

	for($i = 1; $i <= $num; ++$i) {
		$pic = explode('<media:thumbnail url="', $file);
		$pic = explode('"/>', $pic[$i]);
		$pic = trim($pic[0]);

		$url = explode('<guid isPermaLink="true">', $file);
		$url = explode('</guid>', $url[$i]);
		$url = trim($url[0]);
		
		$mediatitle = explode('<media:title>', $file);
		$mediatitle = explode('</media:title>', $mediatitle[$i]);
		$mediatitle = trim($mediatitle[0]);

		if($linked == true) {
			echo '<a href="'.$url.'" target="_new"><img src="'.$pic.'" title="'.$mediatitle.'" width="'.$width.'" height="'.$height.'" style="padding: '.$padding.'px; border: 0px;" class="mobypic-pic"></a>';
		} else {
			echo '<img src="'.$pic.'" title="'.$mediatitle.'" width="'.$width.'" height="'.$height.'" style="padding: '.$padding.'px;" class="mobypic-pic">';
		}
	}
}

// Mobypicture widget stuff
function widget_mobypic_init() {
	if (!function_exists('register_sidebar_widget'))
		return;
	
		$check_options = get_option('widget_mobypic');
  		if ($check_options['number']=='') {
    			$check_options['number'] = 1;
    			update_option('widget_mobypic', $check_options);
  		}

	function widget_mobypic($args, $number = 1) {
		extract( $args, EXTR_SKIP );
	if ( is_numeric($widget_args) )
		$widget_args = array( 'number' => $widget_args );
	$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
	extract( $widget_args, EXTR_SKIP );
	
	global $mobypic_options;
		
		extract($args);

		// Each widget can store its own options. Strings are kept here.
		include_once(ABSPATH . WPINC . '/rss.php');
		$options = get_option('widget_mobypic');
		
		// fill options with default values if value is not set
		$item = $options[$number];
		foreach($mobypic_options['widget_fields'] as $key => $field) {
			if (! isset($item[$key])) {
				$item[$key] = $field['default'];
			}
		}
		
		// These lines generate the output.
		echo $before_widget . $before_title . $item['title'] . $after_title;
			echo '<ul style="align: center;">';
			mobypicture($item['public'], $item['group'], $item['username'], $item['num'], $item['w'], $item['h'], $item['p'], $item['square'], $item['linked']);
			echo '</ul>';
		echo $after_widget;
	}


	function widget_mobypic_control($number) {

		global $mobypic_options;

		$options = get_option('widget_mobypic');
		
		if ( isset($_POST['mobypic-submit']) ) {

			foreach($mobypic_options['widget_fields'] as $key => $field) {
				$options[$number][$key] = $field['default'];
				$field_name = sprintf('%s_%s_%s', $mobypic_options['prefix'], $key, $number);

				if ($field['type'] == 'text') {
					$options[$number][$key] = strip_tags(stripslashes($_POST[$field_name]));
				} elseif ($field['type'] == 'checkbox') {
					$options[$number][$key] = isset($_POST[$field_name]);
				}
			}

			update_option('widget_mobypic', $options);
		}

		foreach($mobypic_options['widget_fields'] as $key => $field) {
			
			$field_name = sprintf('%s_%s_%s', $mobypic_options['prefix'], $key, $number);
			$field_checked = '';
			if ($field['type'] == 'text') {
				$field_value = htmlspecialchars($options[$number][$key], ENT_QUOTES);
			} elseif ($field['type'] == 'checkbox') {
				$field_value = 1;
				if (! empty($options[$number][$key])) {
					$field_checked = 'checked="checked"';
				}
			}
			
			printf('<p style="text-align:right;" class="mobypic_field"><label for="%s">%s <input id="%s" name="%s" type="%s" value="%s" class="%s" %s /></label></p>',
				$field_name, __($field['label']), $field_name, $field_name, $field['type'], $field_value, $field['type'], $field_checked);
		}
		echo '<input type="hidden" id="mobypic-submit" name="mobypic-submit" value="1" />';
	}
	

	function widget_mobypic_setup() {
		$options = $newoptions = get_option('widget_mobypic');
		
		if ( isset($_POST['mobypic-number-submit']) ) {
			$number = (int) $_POST['mobypic-number'];
			$newoptions['number'] = $number;
		}
		
		if ( $options != $newoptions ) {
			update_option('widget_mobypic', $newoptions);
			widget_mobypic_register();
		}
	}
	
	function widget_mobypic_register() {
		
		$options = get_option('widget_mobypic');
		$dims = array('width' => 370, 'height' => 370);
		$class = array('classname' => 'widget_mobypic', 'description' => __('Shows recent added Mobypicture items.'));

		for ($i = 1; $i <= 9; $i++) {
			$name = sprintf(__('Mobypicture'), $i);
			$id = "mobypic-$i"; // Never never never translate an id
			wp_register_sidebar_widget($id, $name, $i <= $options['number'] ? 'widget_mobypic' : /* unregister */ '', $class, $i);
			wp_register_widget_control($id, $name, $i <= $options['number'] ? 'widget_mobypic_control' : /* unregister */ '', $dims, $i);
		}
		
		add_action('sidebar_admin_setup', 'widget_mobypic_setup');
	}

	widget_mobypic_register();
}

// Run our code later in case this loads prior to any required plugins.
add_action('widgets_init', 'widget_mobypic_init');

?>