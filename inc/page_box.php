<?php
// Create Shortcode mkd_page_box
// Use the shortcode: [mkd_page_box image="" title="" description="" link=""]
function create_mkdpagebox_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'image' => '',
			'title' => '',
			'description' => '',
			'link' => '',
		),
		$atts,
		'mkd_page_box'
	);
	// Attributes in var
	$image = $atts['image'];
	$title = $atts['title'];
	$description = $atts['description'];
	$link = vc_build_link($atts['link']);

	$build_link = ' href="'.$link['url'].'"';
	if($link['target'] != "")
	{
		$build_link .= ' target="'.$link['target'].'"';
	}
	if($link['title'] != "")
	{
		$build_link .= ' title="'.$link['title'].'"';
	}
	if($link['rel'] != "")
	{
		$build_link .= ' rel="'.$link['rel'].'"';
	}



	// Output Code
  $output = '<div class="mkd_page_box wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill">';
  $output .= '<div class="vc_column-inner">';
  $output .= '<div class="wpb_wrapper">';
  $output .= '<div class="wpb_single_image wpb_content_element vc_align_left">';
  $output .= '<div class="wpb_wrapper">';
  $output .= '<a'.$build_link.'>';
  $output .= '<div class="vc_single_image-wrapper vc_box_border_grey" style="background-image: url('.wp_get_attachment_url( $image ).')">';
  $output .= '</div>';
  $output .= '</a>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '<div class="wpb_text_column wpb_content_element">';
  $output .= '<div class="wpb_wrapper">';
  $output .= '<a'.$build_link.'><span>'.$title.'</span></a>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '<div class="wpb_text_column wpb_content_element">';
  $output .= '<div class="wpb_wrapper">';
  $output .= '<p>'.$description.'</p>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '<a itemprop="url"'.$build_link.' class="qbutton  small default">mehr</a>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';

	return $output;
}
add_shortcode( 'mkd_page_box', 'create_mkdpagebox_shortcode' );

// Create Page Box element for Visual Composer
add_action( 'vc_before_init', 'mkdpagebox_integrateWithVC' );
function mkdpagebox_integrateWithVC() {
	vc_map( array(
		'name' => __( 'Page Box', 'mkd-text' ),
		'base' => 'mkd_page_box',
		'icon' => plugins_url( 'images/favicon.jpg', dirname(__FILE__) ),
		'show_settings_on_create' => true,
		'category' => __( 'MK Design', 'mkd-text'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Bild', 'mkd-text' ),
				'param_name' => 'image',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Titel', 'mkd-text' ),
				'param_name' => 'title',
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Beschreibung', 'mkd-text' ),
				'param_name' => 'description',
			),
			array(
				'type' => 'vc_link',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Link', 'mkd-text' ),
				'param_name' => 'link',
			),
		)
	) );
}
?>
