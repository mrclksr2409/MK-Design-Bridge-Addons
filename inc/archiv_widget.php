<?php
class dgs_events_widget extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'dgsevent',
			__( 'Simple Event Listing', 'text_domain' ),
			array(
				'classname'   => 'simple-event-list',
			)
		);

	}

	public function widget( $args, $instance ) {

    echo '<div id="archives-3" class="widget widget_archive">';
      echo '<h5>Archiv</h5>';

      // get years that have posts
      $years = $wpdb->get_results( "SELECT YEAR(post_date) AS year FROM wp_posts WHERE post_type = 'encontros' AND post_status = 'publish' GROUP BY year DESC" );

      foreach ( $years as $year ) {
         // get posts for each year
         $posts_this_year = $wpdb->get_results( "SELECT post_title FROM wp_posts WHERE post_type = 'encontros' AND post_status = 'publish' AND YEAR(post_date) = '" . $year->year . "'" );
         //get permalinks for each post
             $post_link = $wpdb->get_results( "SELECT get_the_permalink() FROM wp_posts WHERE post_type = 'encontros' AND post_status = 'publish' ");

             foreach ( $posts_this_year as $post ) {

               echo '<ul>' . $post->post_title . '</ul>';
             }
               echo '<li><a href ="'.$posts_this_year.'">' . $year->year . '</a></li><ul>';
               echo '</ul>';
      }

    echo '</div>';

	}

	public function form( $instance ) {

		// Set default values
		$instance = wp_parse_args( (array) $instance, array(
			'dgs_simpleeventlisting' => '',
		) );

		// Retrieve an existing value from the database
		$dgs_simpleeventlisting = !empty( $instance['dgs_simpleeventlisting'] ) ? $instance['dgs_simpleeventlisting'] : '';

		// Form fields
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'dgs_simpleeventlisting' ) . '" class="dgs_simpleeventlisting_label">' . __( 'How many events to list?', 'text_domain' ) . '</label>';
		echo '	<select id="' . $this->get_field_id( 'dgs_simpleeventlisting' ) . '" name="' . $this->get_field_name( 'dgs_simpleeventlisting' ) . '" class="widefat">';
		echo '		<option value="event1" ' . selected( $dgs_simpleeventlisting, 'event1', false ) . '> ' . __( '1', 'text_domain' ) . '</option>';
		echo '		<option value="event2" ' . selected( $dgs_simpleeventlisting, 'event2', false ) . '> ' . __( '2', 'text_domain' ) . '</option>';
		echo '		<option value="event3" ' . selected( $dgs_simpleeventlisting, 'event3', false ) . '> ' . __( '3', 'text_domain' ) . '</option>';
		echo '		<option value="event4" ' . selected( $dgs_simpleeventlisting, 'event4', false ) . '> ' . __( '4', 'text_domain' ) . '</option>';
		echo '		<option value="event5" ' . selected( $dgs_simpleeventlisting, 'event5', false ) . '> ' . __( '5', 'text_domain' ) . '</option>';
		echo '		<option value="event6" ' . selected( $dgs_simpleeventlisting, 'event6', false ) . '> ' . __( '6', 'text_domain' ) . '</option>';
		echo '		<option value="event7" ' . selected( $dgs_simpleeventlisting, 'event7', false ) . '> ' . __( '7', 'text_domain' ) . '</option>';
		echo '		<option value="event8" ' . selected( $dgs_simpleeventlisting, 'event8', false ) . '> ' . __( '8', 'text_domain' ) . '</option>';
		echo '		<option value="event9" ' . selected( $dgs_simpleeventlisting, 'event9', false ) . '> ' . __( '9', 'text_domain' ) . '</option>';
		echo '		<option value="event10" ' . selected( $dgs_simpleeventlisting, 'event10', false ) . '> ' . __( '10', 'text_domain' ) . '</option>';
		echo '	</select>';
		echo '</p>';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['dgs_simpleeventlisting'] = !empty( $new_instance['dgs_simpleeventlisting'] ) ? strip_tags( $new_instance['dgs_simpleeventlisting'] ) : '';

		return $instance;

	}

}

function dgs_register_widgets() {
	register_widget( 'dgs_events_widget' );
}
add_action( 'widgets_init', 'dgs_register_widgets' );


 ?>