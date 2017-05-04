<?php 

Class save_events {


	public function __construct() {
		add_action ('save_post', 'save_events');
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








 ?>