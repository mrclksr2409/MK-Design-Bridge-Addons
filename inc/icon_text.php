<?php
// Create Shortcode mkd_icon_text
// Use the shortcode: [mkd_icon_text icon="" title="" description="" link=""]
function create_mkdicontext_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'icon' => '',
			'icon_image' => '',
			'title' => '',
			'description' => '',
			'link' => '',
		),
		$atts,
		'mkd_icon_text'
	);
	// Attributes in var
	$icon = $atts['icon'];
	$icon_image = wp_get_attachment_image_src($atts['icon_image'], "thumbnail");
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
	$output = '<div class="mkd_icon_text q_icon_with_title small circle left_from_title ">';
	$output .= '<div class="icon_text_holder">';
	$output .= '<div class="icon_text_inner">';
	$output .= '<div class="icon_title_holder">';
	$output .= '<div class="icon_holder">';
	if(isset($link['url']))
	{
		$output .= '<a itemprop="url"'.$build_link.' class="anchor">';
	}

	if(isset($icon_image[0]))
	{
		$output .= '<span class="qode_iwt_icon_holder fa-stack fa-2x">';
		$output .= '<img src="'.$icon_image[0].'">';
		$output .= '</span>';
	}
	else {
		$output .= '<span class="qode_iwt_icon_holder fa-stack fa-2x" style="border-color: #f28c19;background-color: #f28c19;">';
		$output .= '<i class="qode_icon_font_awesome fa '.$icon.' qode_iwt_icon_element" style="color: #ffffff;"></i>';
		$output .= '</span>';
	}
	if(isset($link['url']))
	{
		$output .= '</a>';
	}
	$output .= '</div>';
	$output .= '<h3 class="icon_title">';
	if(isset($link['url']))
	{
		$output .= '<a itemprop="url"'.$build_link.' class="icon_title anchor">';
	}
	$output .= $title;
	if(isset($link['url']))
	{
		$output .= '</a>';
	}
	$output .= '</h3>';
	$output .= '</div>';
	if($description != "")
	{
	$output .= '<p>'.$description;
	if(isset($link['url']))
	{
		$output .= ' … <a itemprop="url"'.$build_link.'>mehr</a>';
	}
	$output .= '</p>';
	}
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';


	return $output;
}
add_shortcode( 'mkd_icon_text', 'create_mkdicontext_shortcode' );

// Create Icon With Text element for Visual Composer
add_action( 'vc_before_init', 'mkdicontext_integrateWithVC' );
function mkdicontext_integrateWithVC() {
	vc_map( array(
		'name' => __( 'Icon With Text', 'mkd-text' ),
		'base' => 'mkd_icon_text',
		'icon' => plugins_url( 'images/favicon.jpg', dirname(__FILE__) ),
		'show_settings_on_create' => true,
		'category' => __( 'MK Design', 'mkd-text'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Icon', 'mkd-text' ),
				'param_name' => 'icon',
				'description' => __( 'https://fontawesome.com/v4.7.0/icons/', 'mkd-text' )
			),
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Icon', 'mkd-text' ),
				'param_name' => 'icon_image',
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
