<?php
/*
Plugin Name: Freshbooks Widget
Plugin URI: http://www.steele-agency.com/2010/06/freshbooks-wordpress-widget/
Description: A widget that displays your team's total billed hours as recorded in Freshbooks
Version: 1.0.1
Author: Richard Royal
Author URI: http://www.steele-agency.com/author/rroyal/
License: GPL2
*/
?>
<?php

class Freshbooks_Widget extends WP_Widget {

	/* Constructor */
	function Freshbooks_Widget() {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Freshbooks_Widget', 'description' => __('A widget that displays your team\'s total billed hours as recorded in Freshbooks') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350);

		/* Create the widget. */
		$this->WP_Widget( 'Freshbooks_Widget', __('Freshbooks Widget'), $widget_ops, $control_ops );
	}
	

	/** @see WP_Widget::widget - displays widget */
	function widget($args, $instance) {		
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
		$API_URL	= strip_tags(stripslashes($instance['API_URL']));
		$API_token	= strip_tags(stripslashes($instance['API_token']));
		$txtB4Hours 	= htmlspecialchars($instance['txtB4Hours']);
		$txtAfterHours	= htmlspecialchars($instance['txtAfterHours']);
		
		echo $before_widget;
		
		if ( $title ) { echo $before_title . $title . $after_title; }	
		
		echo '<p>' . $txtB4Hours;

		//include particular file for entity you need (Client, Invoice, Category...)
		echo getHours($API_URL,$API_token);
		
		echo $txtAfterHours . '</p>';
		
		echo $after_widget; 
	}	

	/** @see WP_Widget::update - Saves the widgets settings */
	function update($new_instance, $old_instance) {	

		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['API_URL'] = strip_tags(stripslashes($new_instance['API_URL']));
		$instance['API_token'] = strip_tags(stripslashes($new_instance['API_token']));
		$instance['txtB4Hours']		= htmlspecialchars($new_instance['txtB4Hours']);
		$instance['txtAfterHours']	= htmlspecialchars($new_instance['txtAfterHours']);

		return $instance;	
		
	}

	/** @see WP_Widget::form - Creates the edit form for the widget */
	function form($instance) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'') );

		$title 		= htmlspecialchars($instance['title']);
		$API_URL 	= htmlspecialchars($instance['API_URL']);
		$API_token 	= htmlspecialchars($instance['API_token']);	
		$txtB4Hours 	= htmlspecialchars($instance['txtB4Hours']);
		$txtAfterHours	= htmlspecialchars($instance['txtAfterHours']);
		
		# Output the options
		// Title
		echo '<p style="text-align:left;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <br /><input style="width: 100%;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';		
		// URL
		echo '<p style="text-align:left;"><label for="' . $this->get_field_name('API_URL') . '">' . __('API_URL:') . ' <br /><input style="width: 100%;" id="' . $this->get_field_id('API_URL') . '" name="' . $this->get_field_name('API_URL') . '" type="text" value="' . $API_URL . '" /></label></p>';
		
		// Token
		echo '<p style="text-align:left;"><label for="' . $this->get_field_name('API_token') . '">' . __('API_token:') . ' <br /><input style="width: 100%;" id="' . $this->get_field_id('API_token') . '" name="' . $this->get_field_name('API_token') . '" type="text" value="' . $API_token . '" /></label></p>';
		
		// Before Hours
		echo '<p style="text-align:left;"><label for="' . $this->get_field_name('txtB4Hours') . '">' . __('Text Before Hours:') . ' <br /><input style="width: 100%;" id="' . $this->get_field_id('txtB4Hours') . '" name="' . $this->get_field_name('txtB4Hours') . '" type="text" value="' . $txtB4Hours . '" /></label></p>';
		
		// After Hours
		echo '<p style="text-align:left;"><label for="' . $this->get_field_name('txtAfterHours') . '">' . __('Text After Hours:') . ' <br /><input style="width: 100%;" id="' . $this->get_field_id('txtAfterHours') . '" name="' . $this->get_field_name('txtAfterHours') . '" type="text" value="' . $txtAfterHours . '" /></label></p>';
		
		
	}

}

function getHours($url,$main_token){
	include_once("library/FreshBooks/TimeEntry.php");

	$total_time = 0;
	/* originally setup to sum all users
	   unnecessary because all hours 
	   are recorded in root account   */
	$tokens = array($main_token);
	foreach($tokens as $token){

		//init singleton FreshBooks_HttpClient
		FreshBooks_HttpClient::init($url,$token);

		//new Time Entry object
		$time_client = new FreshBooks_TimeEntry();

		// row object containing number of pages
		// of results to be summed
		$m;

		if(!$time_client->listing($n,$m,'',100)){
			//no data - read error
			echo $time_client->lastError;
		}
		else{
			//investigate populated data

			$numPages = $m['pages'];
			$i = 1;

			// sums hours for each page of result
			while( $i <= $numPages ){
		
				// fills $x object with time listings
				// for page $i
				$time_client->listing($x,$y,$i,100);
	
				// sums hours in $x for page $i
				foreach($x as $val){

					$total_time = $total_time + $val->hours;
				}
				$i++;
			}
		}
	}

	return $total_time;

}

// register Freshbooks_Widget widget
add_action('widgets_init', create_function('', 'return register_widget("Freshbooks_Widget");'));
?>
