<?php
// Adds widget: MKD - Portfolio
class Ptcportfolio_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'mkdportfolio_widget',
			esc_html__( 'MKD - Portfolio', 'mkd-text' ),
			array( 'description' => esc_html__( 'Auflisten aller Portfolio Einträge ', 'mkd-text' ), ) // Args
		);
	}

  private $widget_fields = array(
		array(
			'label' => 'post_type',
			'id' => 'posttype_text',
			'type' => 'text',
		),
		array(
			'label' => 'post_status',
			'id' => 'poststatus_text',
			'default' => 'publish',
			'type' => 'text',
		),
		array(
			'label' => 'order',
			'id' => 'order_text',
			'default' => 'ASC',
			'type' => 'text',
		),
		array(
			'label' => 'orderby',
			'id' => 'orderby_text',
			'default' => 'title',
			'type' => 'text',
		),
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

    // Custom WP query query
    $args_query = array(
    	'post_type' => $instance['posttype_text'],
    	'post_status' => $instance['poststatus_text'],
    	'order' => $instance['order_text'],
    	'orderby' => $instance['orderby_text'],
    );

    $query = new WP_Query( $args_query );

    if ( $query->have_posts() ) {
      echo '<ul>';
    	while ( $query->have_posts() ) {
    		$query->the_post();
        $post_id = get_the_ID();

        echo '<li><a href="'.get_permalink($post_id).'">'.get_the_title($post_id).'</a></li>';
    	}
      echo '</ul>';
    } else {

    }

    wp_reset_postdata();

		echo $args['after_widget'];
	}

  public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset($widget_field['default']) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'mkd-text' );
			switch ( $widget_field['type'] ) {
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'mkd-text' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'mkd-text' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'mkd-text' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}

function register_mkdportfolio_widget() {
	register_widget( 'Ptcportfolio_Widget' );
}
add_action( 'widgets_init', 'register_mkdportfolio_widget' );

?>
