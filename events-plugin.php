<?php 

/*
	Plugin Name: My First Plugin
	Plugin URI: http://www.example.com
	Description: A first event plugin
	Author: Nikolai
	Version: 1:0

*/

	Class create_event_postype {


	
	public function __construct() {
		add_action('init', array($this, 'create_event_postype'));

	}


	

	 public function create_event_postype() {

	 	

		$labels = array(

		'name' => _x('Events', 'post type general name'),
	    'singular_name' => _x('Event', 'post type singular name'),
	    'add_new' => _x('Add New', 'events'),
	    'add_new_item' => __('Add New Event'),
	    'new_item' => __('New Event'),
	    'view_item' => __('View Event'),
	    'search_items' => __('Search Events'),
	    'not_found' =>  __('No events found'),
	    'not_found_in_trash' => __('No events found in Trash'),
	  
	    );

		$args = array(
		    'label' => __('Events'),
		    'labels' => $labels,
		    'public' => true,
		    'can_export' => true,
		    'show_ui' => true,
		    '_builtin' => false,
		    'capability_type' => 'post',
		    'menu_icon' => get_bloginfo('template_url').'/functions/images/event_16.png',
		    'hierarchical' => false,
		    'rewrite' => array( "slug" => "events" ),
		    'supports'=> array('title', 'thumbnail', 'excerpt', 'editor') ,
		    'show_in_nav_menus' => true,
		    'taxonomies' => array( 'eventcategory', 'post_tag')

		    );


			add_filter ("manage_columns", "events_edit_columns");
			add_action ("manage_posts_column", "events_custom_columns");
		}

		public function events_edit_columns($columns) {
 
				$columns = array(
				    "col_ev_date" => "Dates",
				    "col_ev_times" => "Times",
				    "title" => "Event",
				    "col_ev_loc" => "Locations",
				    );
				return $columns;
				}


		public function events_custom_columns($column)
				{
				global $post;
				$custom = get_post_custom();
				switch ($column) {
				case "col_ev_date":
				   
				    $start = $custom["events_startdate"][0];
				    $end = $custom["events_enddate"][0];
				    $startdate = date("F j, Y", $startd);
				    $enddate = date("F j, Y", $endd);
				    echo $startdate . '<br /><em>' . $enddate . '</em>';
				break;

				case "col_ev_times":
				    $start = $custom["events_startdate"][0];
				    $end = $custom["events_enddate"][0];
				    $time_format = get_option('time_format');
				    $starttime = date($time_format, $startt);
				    $endtime = date($time_format, $endt);
				    echo $starttime . ' - ' .$endtime;
				break;

				case "col_ev_loc";
					the_excerpt();
				break;


		}
	}



}





















 ?>