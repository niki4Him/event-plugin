<?php 


		add_filter('post_updated_messages', 'events_updated_messages');
 
			function events_updated_messages( $messages ) {
				 
				  global $post, $post_ID;
				 
				  $messages['events'] = array(
				    0 => '', 
				    1 => sprintf( __('Event updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
				    2 => __('Custom field updated.'),
				    3 => __('Custom field deleted.'),
				    4 => __('Event updated.'),
				    /* translators: %s: date and time of the revision */
				    5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
				    6 => sprintf( __('Event published. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
				    7 => __('Event saved.'),
				    8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
				    9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>'),
				      // translators: Publish box date format, see http://php.net/date
				      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
				    10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
				  );



		 		return $messages;
		}




















 ?>