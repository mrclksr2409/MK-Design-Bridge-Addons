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
    //List archives by year, then month
    function wp_custom_archive($args = '') {
        global $wpdb, $wp_locale;

        $defaults = array(
            'limit' => '',
            'format' => 'html',
            'before' => '',
            'after' => '',
            'show_post_count' => true,
            'echo' => 1
        );

        $r = wp_parse_args( $args, $defaults );
        extract( $r, EXTR_SKIP );

        if ( '' != $limit ) {
            $limit = absint($limit);
            $limit = ' LIMIT '.$limit;
        }

        // over-ride general date format ? 0 = no: use the date format set in Options, 1 = yes: over-ride
        $archive_date_format_over_ride = 0;

        // options for daily archive (only if you over-ride the general date format)
        $archive_day_date_format = 'Y/m/d';

        // options for weekly archive (only if you over-ride the general date format)
        $archive_week_start_date_format = 'Y/m/d';
        $archive_week_end_date_format   = 'Y/m/d';

        if ( !$archive_date_format_over_ride ) {
            $archive_day_date_format = get_option('date_format');
            $archive_week_start_date_format = get_option('date_format');
            $archive_week_end_date_format = get_option('date_format');
        }

        //filters
        $where = apply_filters('customarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'", $r );
        $join = apply_filters('customarchives_join', "", $r);

        $output = '<ul>';

            $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC $limit";
            $key = md5($query);
            $cache = wp_cache_get( 'wp_custom_archive' , 'general');
            if ( !isset( $cache[ $key ] ) ) {
                $arcresults = $wpdb->get_results($query);
                $cache[ $key ] = $arcresults;
                wp_cache_set( 'wp_custom_archive', $cache, 'general' );
            } else {
                $arcresults = $cache[ $key ];
            }
            if ( $arcresults ) {
                $afterafter = $after;
                foreach ( (array) $arcresults as $arcresult ) {
                    $url = get_month_link( $arcresult->year, $arcresult->month );
                    $year_url = get_year_link($arcresult->year);
                    /* translators: 1: month name, 2: 4-digit year */
                    $text = sprintf(__('%s'), $wp_locale->get_month($arcresult->month));
                    $year_text = sprintf('%d', $arcresult->year);
                    if ( $show_post_count )
                        $after = '&nbsp;('.$arcresult->posts.')' . $afterafter;
                    $year_output = get_archives_link($year_url, $year_text, $format, $before, $after);
                    $output .= ( $arcresult->year != $temp_year ) ? $year_output : '';
                    $output .= get_archives_link($url, $text, $format, $before, $after);

                    $temp_year = $arcresult->year;
                }
            }

        $output .= '</ul>';

        if ( $echo )
            echo $output;
        else
            return $output;
    }

    echo '<div id="archives-3" class="widget widget_archive">';
      echo '<h5>Archiv</h5>';
wp_custom_archive();

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
