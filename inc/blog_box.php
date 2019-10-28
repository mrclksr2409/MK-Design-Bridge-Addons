<?php
// Create Shortcode mkd_blog_box
// Use the shortcode: [mkd_blog_box order_by="" order="" number="" number_of_blog="" category=""]
function create_mkdblogbox_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'order_by' => '',
			'order' => '',
			'number' => '',
			'number_of_blog' => '',
			'category' => '',
		),
		$atts,
		'mkd_blog_box'
	);
	// Attributes in var
	$orderby = $atts['orderby'];
	$order = $atts['order'];
	$number = $atts['number'];
	$number_of_blog = $atts['number_of_blog'];
	$category = $atts['category'];
	$post_status = $atts['post_status'];



  $query = new WP_Query(array(
    'post_type' => array('post'),
  	'post_status' => array('publish'),
  	'posts_per_page' => $number,
  	'order' => $order,
  	'orderby' => $orderby,
  	'cat' => $category,
  ));

  // Output Code
	$output = '<div class="mkd_blog_box vc_row wpb_row section vc_row-fluid grid_section" style=" text-align:left;">';
	$output .= '<div class=" section_inner clearfix">';
	$output .= '<div class="section_inner_margin clearfix">';

  while ($query->have_posts())
  {
    $query->the_post();
    $post_id = get_the_ID();

		$output .= '<div class="wpb_column vc_column_container '.$number_of_blog.'">';
		$output .= '<div class="vc_column-inner">';
		$output .= '<div class="wpb_wrapper">';

    $output .= '<div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill">';
    $output .= '<div class="vc_column-inner">';
    $output .= '<div class="wpb_wrapper">';
    $output .= '<div class="wpb_single_image wpb_content_element vc_align_left">';
    $output .= '<div class="wpb_wrapper">';
    $output .= '<a href="'.get_the_permalink( $post_id ).'">';
    $output .= '<div class="vc_single_image-wrapper vc_box_border_grey" style="background-image: url('.get_the_post_thumbnail_url( $post_id ).')">';
    $output .= '</div>';
    $output .= '</a>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="wpb_text_column wpb_content_element">';
    $output .= '<div class="wpb_wrapper">';
    $output .= '<a href="'.get_the_permalink( $post_id ).'"><span>'.get_the_title($post_id).'</span></a>';
    $output .= '</div>';
    $output .= '</div>';
    if(isset($description))
		{
			$output .= '<div class="wpb_text_column wpb_content_element">';
	    $output .= '<div class="wpb_wrapper">';
			$output .= '<p>'.$description.'</p>';
			$output .= '</div>';
	    $output .= '</div>';
		}
    $output .= '<a itemprop="url" href="'.get_the_permalink( $post_id ).'" class="qbutton  small default">mehr</a>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

		$output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
  }

	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';


	return $output;
}
add_shortcode( 'mkd_blog_box', 'create_mkdblogbox_shortcode' );

// Create Blog Box element for Visual Composer
add_action( 'vc_before_init', 'mkdblogbox_integrateWithVC' );
function mkdblogbox_integrateWithVC() {
  $categories_array = array();
  $categories = get_categories(array('taxonomy' => 'category',));
  foreach( $categories as $category ) {
      $categories_array[$category->name] = $category->term_id;
  }

vc_map(
	array(
		'name' => __( 'Blog Box', 'mkd-text' ),
		'base' => 'mkd_blog_box',
		'icon' => plugins_url( 'images/favicon.jpg', dirname(__FILE__) ),
		'show_settings_on_create' => true,
		'category' => __( 'MK Design', 'mkd-text'),
		'params' => array(
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Category', 'mkd-text' ),
				'param_name' => 'category',
				"value" => $categories_array,
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'admin_label' => false,
					'heading' => __( 'Post Status', 'mkd-text' ),
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
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'admin_label' => false,
					'heading' => __( 'Sortierung', 'mkd-text' ),
					'param_name' => 'order',
					'value' => array(
						'aufsteigend' => 'ASC',
						'absteigend' => 'DESC',
					),
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'admin_label' => false,
					'heading' => __( 'Sortiert nach', 'mkd-text' ),
					'param_name' => 'orderby',
					'value' => array(
						'none' => 'none',
						'ID' => 'ID',
						'author' => 'author',
						'title' => 'title',
						'name' => 'name',
						'date' => 'date',
						'menu_order' => 'menu_order',
					),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'admin_label' => false,
					'heading' => __( 'Number', 'mkd-text' ),
					'param_name' => 'number',
					'description' => __( 'Number of blog posts on page (-1 is all)', 'mkd-text' )
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'admin_label' => false,
					'heading' => __( 'Number of Blog Posts Shown', 'mkd-text' ),
					'param_name' => 'number_of_blog',
					'value' => array(
						'' => '',
						'3 Spalten' => 'vc_col-sm-4',
						'4 Spalten' => 'vc_col-sm-3',
						'5 Spalten' => 'vc_col-sm-1/5',
						'6 Spalten' => 'vc_col-sm-2',
					),
				),
			),
		)
	)
);
}
