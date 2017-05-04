<?php 

class events_create {


puclic function __construct() {
	add_action('admin_init', 'events_create');
}

	public function events_create() {
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
			</div>
		<?php

	}


}

		?>




	<script>
		jQuery(document).ready(function($){
			$(".tfdate").datepicker({
			dateFormat: 'D, M d, yy',
			showOn: 'button',
			buttonImage: '/yourpath/icon-datepicker.png',
			buttonImageOnly: true,
			numberOfMonths: 3

			});
		});
	</script>









 ?>