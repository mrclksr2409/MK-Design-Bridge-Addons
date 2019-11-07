<?php
// Create Shortcode mkd_portfolio_list
// Use the shortcode: [mkd_portfolio_list order_by="" order="" number="" number_of_blog="" category=""]
function create_portfolio_list_shortcode($atts) {
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
			'show_beitragsbild' => '1',
			'show_ueberschrift' => '1',
			'tag_ueberschrift' => 'h1',
			'show_textauszug' => '1',
			'show_button' => '1',
			'value_button' => __( 'weiterlesen', 'mkd-text' ),
			'icon_button' => '',
		),
		$atts,
		'mkd_portfolio'
	);
	// Attributes in var
	$post_type = $atts['post_type'];
	$category_name = $atts['category_name'];
	$post_status = $atts['post_status'];
	$orderby = $atts['orderby'];
	$order = $atts['order'];
	$posts_per_page = $atts['posts_per_page'];
	$layout = $atts['layout'];
	$show_beitragsbild = $atts['show_beitragsbild'];
	$show_ueberschrift = $atts['show_ueberschrift'];
	$tag_ueberschrift = $atts['tag_ueberschrift'];
	$show_textauszug = $atts['show_textauszug'];
	$show_button = $atts['show_button'];
	$value_button = $atts['value_button'];
	$icon_button = $atts['icon_button'];

  $query = new WP_Query(array(
		'post_type' => $post_type,
		'category_name' => $category_name,
  	'post_status' => $post_status,
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => $posts_per_page,
  ));

	// Output Code
	$output = '<div class="mkd_portfolio_list vc_row wpb_row section vc_row-fluid grid_section flexbox" style=" text-align:left;">';
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

		$output .= 'test';

		$output .= '<div class="wpb_column vc_column_container vc_col-sm-'.$layout.'">';
		$output .= '<div class="vc_column-inner">';
		$output .= '<div class="wpb_wrapper">';

		if($show_beitragsbild == "1")
		{
	    $output .= '<div class="wpb_single_image wpb_content_element vc_align_left">';
	    $output .= '<div class="wpb_wrapper">';
	    $output .= '<a href="'.get_the_permalink( $post_id ).'">';
	    $output .= '<div class="vc_single_image-wrapper vc_box_border_grey" style="background-image: url('.get_the_post_thumbnail_url( $post_id ).')">';
	    $output .= '</div>';
	    $output .= '</a>';
	    $output .= '</div>';
	    $output .= '</div>';
		}
		if($show_ueberschrift == "1")
		{
	    $output .= '<div class="wpb_text_column wpb_content_element">';
	    $output .= '<div class="wpb_wrapper">';
	    $output .= '<a href="'.get_the_permalink( $post_id ).'"><' . $ueberschrift . '>' . get_the_title($post_id) . '</' . $ueberschrift . '></a>';
	    $output .= '</div>';
	    $output .= '</div>';
		}
    if($show_textauszug == "1")
		{
			$output .= '<div class="wpb_text_column wpb_content_element">';
	    $output .= '<div class="wpb_wrapper">';
			$output .= '<p>'.get_the_excerpt( $post_id ).'</p>';
			$output .= '</div>';
	    $output .= '</div>';
		}
		if($show_button == "1")
		{
    	$output .= '<a itemprop="url" href="'.get_the_permalink( $post_id ).'" class="qbutton  small default">'.$button_text.''.$icon.'</a>';
		}
		if($show_button == "1")
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
add_shortcode( 'mkd_portfolio_list', 'create_portfolio_list_shortcode' );

// Create Blog Box element for Visual Composer
add_action( 'vc_before_init', 'portfolio_integrateWithVC' );
function portfolio_integrateWithVC() {
	vc_map( array(
		'name' => __( 'Portfolio Liste', 'mkd-text' ),
		'description' => __( 'Zeigt in einer Box eine verlinkte Seite an.', 'mkd-text' ),
		'base' => 'mkd_portfolio',
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
				'value' => array(
					'anzeigen' => '1',
					'nicht anzeigen' => '0',
        ),
				'param_name' => 'show_beitragsbild',
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Überschrift', 'mkd-text' ),
				'value' => array(
					'anzeigen' => '1',
					'nicht anzeigen' => '0',
        ),
				'param_name' => 'show_ueberschrift',
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Überschrift', 'mkd-text' ),
				'value' => array(
					'Überschrift 1' => 'h1',
					'Überschrift 2' => 'h2',
					'Überschrift 3' => 'h3',
					'Überschrift 4' => 'h4',
					'Überschrift 5' => 'h5',
					'Überschrift 6' => 'h6',
        ),
				'param_name' => 'tag_ueberschrift',
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Textauszug', 'mkd-text' ),
				'value' => array(
					'anzeigen' => '1',
					'nicht anzeigen' => '0',
        ),
				'param_name' => 'show_textauszug',
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Button', 'mkd-text' ),
				'value' => array(
					'anzeigen' => '1',
					'nicht anzeigen' => '0',
        ),
				'param_name' => 'show_button',
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'textfield',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Button Text', 'mkd-text' ),
				'value' => __( 'weiterlesen', 'mkd-text' ),
				'param_name' => 'value_button',
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'textfield',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Button Icon', 'mkd-text' ),
				'param_name' => 'icon_button',
				'group' => __( 'Designeinstellungen', 'mkd-text' ),
			),
		))
	);
}
