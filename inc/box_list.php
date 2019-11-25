<?php
// Create Shortcode mkd_box_list
// Use the shortcode: [mkd_box_list order_by="" order="" number="" number_of_blog="" category=""]
function create_box_list_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'post_type' => 'post',
			'category_name' => '',
			'post_status' => '',
			'orderby' => '',
			'order' => '',
			'posts_per_page' => '',
			'layout' => '',
			'beitragsbild' => '1',
			'beitragsbild_style' => 'cover',
			'titel' => '1',
			'ueberschrift' => 'h1',
			'textauszug' => '1',
			'more_button' => '1',
			'button_text' => 'weiterlesen',
			'button_icon' => '',
		),
		$atts,
		'mkd_box_list'
	);
	// Attributes in var
	$post_type = $atts['post_type'];
	$category_name = $atts['category_name'];
	$post_status = $atts['post_status'];
	$orderby = $atts['orderby'];
	$order = $atts['order'];
	$posts_per_page = $atts['posts_per_page'];
	$layout = $atts['layout'];
	$beitragsbild = $atts['beitragsbild'];
	$beitragsbild_style = $atts['beitragsbild_style'];
	$titel = $atts['titel'];
	$ueberschrift = $atts['ueberschrift'];
	$textauszug = $atts['textauszug'];
	$more_button = $atts['more_button'];
	$button_text = $atts['button_text'];
	$button_icon = $atts['button_icon'];

  $query = new WP_Query(array(
    'post_type' => $post_type,
		'category_name' => $category_name,
  	'post_status' => $post_status,
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => $posts_per_page,
  ));

  // Output Code
	$output = '<div class="mkd_box_list vc_row wpb_row section vc_row-fluid grid_section flexbox" style=" text-align:left;">';
	$output .= '<div class=" section_inner clearfix">';
	$output .= '<div class="section_inner_margin clearfix">';

  while ($query->have_posts())
  {
    $query->the_post();
    $post_id = get_the_ID();

		if($button_icon != "")
		{
			$icon = ' <i class="qode_icon_font_awesome fa '.$button_icon.' qode_button_icon_element"></i>';
		}



		$output .= '<div class="wpb_column vc_column_container vc_col-sm-'.$layout.'">';
		$output .= '<div class="vc_column-inner">';
		$output .= '<div class="wpb_wrapper">';

		if($beitragsbild == "1")
		{
	    $output .= '<div class="wpb_single_image wpb_content_element vc_align_left">';
	    $output .= '<div class="wpb_wrapper">';
	    $output .= '<a href="'.get_the_permalink( $post_id ).'">';
	    $output .= '<div class="vc_single_image-wrapper vc_box_border_grey '.$beitragsbild_style.'" style="background-image: url('.get_the_post_thumbnail_url( $post_id ).')">';
	    $output .= '</div>';
	    $output .= '</a>';
	    $output .= '</div>';
	    $output .= '</div>';
		}
		if($beitragsbild == "0")
		{
	    $output .= '<div class="vc_empty_space" style="height: 25px">';
	    $output .= '<span class="vc_empty_space_inner">';
	    $output .= '<span class="empty_space_image"></span>';
	    $output .= '</span>';
	    $output .= '</div>';
		}
		if($titel == "1")
		{
	    $output .= '<div class="wpb_text_column wpb_content_element">';
	    $output .= '<div class="wpb_wrapper">';
	    $output .= '<a href="'.get_the_permalink( $post_id ).'"><' . $ueberschrift . '>' . get_the_title($post_id) . '</' . $ueberschrift . '></a>';
	    $output .= '</div>';
	    $output .= '</div>';
		}
    if($textauszug == "1")
		{
			$output .= '<div class="wpb_text_column wpb_content_element">';
	    $output .= '<div class="wpb_wrapper">';
			$output .= '<p>'.get_the_excerpt( $post_id ).'</p>';
			$output .= '</div>';
	    $output .= '</div>';
		}
		if($more_button == "1")
		{
    	$output .= '<a itemprop="url" href="'.get_the_permalink( $post_id ).'" class="qbutton  small default">'.$button_text.''.$icon.'</a>';
		}
		if(mkd_portfolio_video_get_meta( 'mkd_portfolio_video_video_link' ))
		{
			$output .= '<a itemprop="url" href="'.mkd_portfolio_video_get_meta( 'mkd_portfolio_video_video_link' ).'" alt="'.get_the_title($post_id).'" title="'.get_the_title($post_id).'" class="qbutton  default video">Video<i class="qode_icon_font_awesome fa fa-play qode_button_icon_element" style=""></i></a>';
		}
		if(($more_button == "1" && $textauszug == "1") || ($more_button == "1" && $titel == "1"))
		{
			$output .= '<span class="qbutton  small default">&nbsp;</span>';
		}
		$output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
  }

	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';


	return $output;
}
add_shortcode( 'mkd_box_list', 'create_box_list_shortcode' );

// Create Blog Box element for Visual Composer
add_action( 'vc_before_init', 'box_list_integrateWithVC' );
function box_list_integrateWithVC() {
	vc_map( array(
		'name' => __( 'Box Liste', 'mkd-text' ),
		'description' => __( 'Zeigt in einer Box eine Liste aller Beträge an.', 'mkd-text' ),
		'base' => 'mkd_box_list',
    'icon' => plugins_url( 'images/favicon.jpg', dirname(__FILE__) ),
		'show_settings_on_create' => true,
		'category' => __( 'MK Design', 'mkd-text'),
		'params' => array(
			array(
				'type' => 'posttypes',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Beitragstyp', 'mkd-text' ),
				'param_name' => 'post_type',
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'textfield',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Kategorie', 'mkd-text' ),
				'param_name' => 'category_name',
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Status des Beitrags', 'mkd-text' ),
				'param_name' => 'post_status',
        'value' => array(
          'Publish' => 'publish',
          'Future' => 'future',
          'Draft' => 'draft',
          'Pending' => 'pending',
          'Private' => 'private',
          'Trash' => 'trash',
          'Auto-Draft' => 'auto-draft',
          'Inherit' => 'inherit',
        ),
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Sortiert nach', 'mkd-text' ),
				'param_name' => 'orderby',
				'value' => array(
					'keine' => 'none',
					'ID' => 'ID',
					'Autor' => 'author',
					'Titel' => 'title',
					'Name' => 'name',
					'Datum' => 'date',
					'Menü-Reihenfolge' => 'menu_order',
				),
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Sortierung', 'mkd-text' ),
				'param_name' => 'order',
        'value' => array(
          'aufsteigend' => 'ASC',
          'absteigend' => 'DESC',
        ),
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'textfield',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Anzahl der Blog-Einträge', 'mkd-text' ),
				'param_name' => 'posts_per_page',
				'description' => __( '-1 sind alle', 'mkd-text' ),
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Layout', 'mkd-text' ),
				'param_name' => 'layout',
        'value' => array(
					'1 Spalten' => '12',
					'2 Spalten' => '6',
          '3 Spalten' => '4',
          '4 Spalten' => '3',
          '5 Spalten' => '1/5',
          '6 Spalten' => '2',
        ),
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Beitragsbild', 'mkd-text' ),
				'param_name' => 'beitragsbild',
        'value' => array(
					'anzeigen' => '1',
					'nicht anzeigen' => '0',
        ),
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Beitragsbild Style', 'mkd-text' ),
				'param_name' => 'beitragsbild_style',
        'value' => array(
					'Cover' => 'cover',
					'Contain' => 'contain',
        ),
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Titel', 'mkd-text' ),
				'param_name' => 'titel',
        'value' => array(
					'anzeigen' => '1',
					'nicht anzeigen' => '0',
        ),
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Überschrift', 'mkd-text' ),
				'param_name' => 'ueberschrift',
        'value' => array(
					'Überschrift 1' => 'h1',
					'Überschrift 2' => 'h2',
					'Überschrift 3' => 'h3',
					'Überschrift 4' => 'h4',
					'Überschrift 5' => 'h5',
					'Überschrift 6' => 'h6',
        ),
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Textauszug', 'mkd-text' ),
				'param_name' => 'textauszug',
        'value' => array(
					'anzeigen' => '1',
					'nicht anzeigen' => '0',
        ),
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Button', 'mkd-text' ),
				'param_name' => 'more_button',
        'value' => array(
					'anzeigen' => '1',
					'nicht anzeigen' => '0',
        ),
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'textfield',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Text', 'mkd-text' ),
				'param_name' => 'button_text',
				"value" => __( "weiterlesen", "mkd-text" ),
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'textfield',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Icon', 'mkd-text' ),
				'param_name' => 'button_icon',
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
		)
	) );
}


/**
 * Generated by the WordPress Meta Box generator
 * at http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function mkd_portfolio_video_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function mkd_portfolio_video_add_meta_box() {
	add_meta_box(
		'mkd_portfolio_video-mkd-portfolio-video',
		__( 'MKD Portfolio Video', 'mkd_portfolio_video' ),
		'mkd_portfolio_video_html',
		'portfolio_page',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'mkd_portfolio_video_add_meta_box' );

function mkd_portfolio_video_html( $post) {
	wp_nonce_field( '_mkd_portfolio_video_nonce', 'mkd_portfolio_video_nonce' ); ?>

	<p>
		<label for="mkd_portfolio_video_video_link"><?php _e( 'Video Link', 'mkd_portfolio_video' ); ?></label><br>
		<input type="text" name="mkd_portfolio_video_video_link" id="mkd_portfolio_video_video_link" value="<?php echo mkd_portfolio_video_get_meta( 'mkd_portfolio_video_video_link' ); ?>">
	</p><?php
}

function mkd_portfolio_video_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['mkd_portfolio_video_nonce'] ) || ! wp_verify_nonce( $_POST['mkd_portfolio_video_nonce'], '_mkd_portfolio_video_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['mkd_portfolio_video_video_link'] ) )
		update_post_meta( $post_id, 'mkd_portfolio_video_video_link', esc_attr( $_POST['mkd_portfolio_video_video_link'] ) );
}
add_action( 'save_post', 'mkd_portfolio_video_save' );

/*
	Usage: mkd_portfolio_video_get_meta( 'mkd_portfolio_video_video_link' )
*/
