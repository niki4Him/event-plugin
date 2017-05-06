<?php 

/*
	Plugin Name: My First Plugin
	Plugin URI: http://www.example.com
	Description: A first event plugin
	Author: Nikolai
	Version: 1:0

*/

	class create_event_postype {


	
	public function __construct() {
		add_action('init', array($this, 'create_event_postype'));
		add_filter ('init', array($this, 'events_edit_columns'));
		add_action ('init', array($this, 'events_custom_columns'));
		add_action ('init', array($this, 'save_events'));

	}

	
	

	 

	 public function create_event_postype() {

	 	

		$args = array(
		    'label' => __('Events'),
		    'public' => true,
		    'capability_type' => 'post',
		    'rewrite' => array( "slug" => "events" ),
		    'supports'=> array('title', 'thumbnail', 'excerpt', 'editor')

		    );

			register_post_type('events', $args);


			

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

				break;

		}
	}



	public function events_create_callback() {
		add_meta_box('events_meta', 'Events', 'events_meta', 'events');
	}

	public function events_meta()
	{
		global $post;

		$custom = get_post_custom($post->ID);
		$meta_sd = $custom["events_startdate"][0];
		$meta_ed = $custom["events_enddate"][0];
		$meta_st = $meta_sd;
		$meta_et = $meta_ed;

		$date_format = get_option('date_format'); 
		$time_format = get_option('time_format');

		if ($meta_sd == null) { 
			$meta_sd = time(); $meta_ed = $meta_sd; $meta_st = 0; $meta_et = 0;

			$clean_sd = date("D, M d, Y", $meta_sd);
			$clean_ed = date("D, M d, Y", $meta_ed);
			$clean_st = date($time_format, $meta_st);
			$clean_et = date($time_format, $meta_et);

			}


			echo '<input type="hidden" name="events-nonce" id="events-nonce" value="' .
			wp_create_nonce( 'events-nonce' ) . '" />';

		?>
			<div class="tf-meta">
			<ul>
			<li><label>Start Date</label><input name="events_startdate" class="tfdate" value="<?php echo $clean_sd; ?>" /></li>
			<li><label>Start Time</label><input name="events_starttime" value="<?php echo $clean_st; ?>" /><em>Use 24h format (7pm = 19:00)</em></li>
			<li><label>End Date</label><input name="events_enddate" class="tfdate" value="<?php echo $clean_ed; ?>" /></li>
			<li><label>End Time</label><input name="events_endtime" value="<?php echo $clean_et; ?>" /><em>Use 24h format (7pm = 19:00)</em></li>
			</ul>

			<a href="http://www.google.com/calendar/event?action=TEMPLATE&text=[event-title]
				&dates=[start-custom format='Ymd\\THi00\\Z']/[end-custom format='Ymd\\THi00\\Z']
				&details=[description]
				&location=[location]
				&trp=false
				&sprop=
				&sprop=name:"
				 target="_blank" rel="nofollow">Add to my calendar</a>
			</div>
		<?php

	

		
	}

	public 	function save_events(){
			 
			global $post;
			 
			
			 
			if ( !wp_verify_nonce( $_POST['events-nonce'], 'events-nonce' )) {
			    return $post->ID;
			}
			 
			if ( !current_user_can( 'edit_post', $post->ID ))
			    return $post->ID;


			if(!isset($_POST["events_startdate"])):
					return $post;
					endif;
					$updatestartd = strtotime ( $_POST["events_startdate"] . $_POST["events_starttime"] );
					update_post_meta($post->ID, "events_startdate", $updatestartd );
					 
					if(!isset($_POST["events_enddate"])):
					return $post;
					endif;
					$updateendd = strtotime ( $_POST["events_enddate"] . $_POST["events_endtime"]);
					update_post_meta($post->ID, "events_enddate", $updateendd );
 
			}




	}

		new create_event_postype();

	






	function events_scripts() {
    global $post_type;
    if( 'events' != $post_type )
    return;
    wp_enqueue_script('ui-datepicker' . 'jquery.ui.datepicker.min.js');
    wp_enqueue_script('custom_script', get_bloginfo('template_url').'jquery.js', array('jquery'));


     }





 ?>