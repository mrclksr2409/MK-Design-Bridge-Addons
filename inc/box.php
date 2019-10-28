<?php
// Create Shortcode mkd_box
// Use the shortcode: [mkd_box image="" title="" description="" link=""]
function create_mkd_box_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'beitragsbild' => '1',
			'titel' => '1',
			'ueberschrift' => 'h1',
			'textauszug' => '1',
			'more_button' => '1',
			'button_text' => 'weiterlesen',
			'button_icon' => '',
		),
		$atts,
		'mkd_box'
	);
	// Attributes in var
	$beitragsbild = $atts['beitragsbild'];
	$titel = $atts['titel'];
	$ueberschrift = $atts['ueberschrift'];
	$textauszug = $atts['textauszug'];
	$more_button = $atts['more_button'];
	$button_text = $atts['button_text'];
	$button_icon = $atts['button_icon'];





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


	if($button_icon != "")
	{
		$icon = ' <i class="qode_icon_font_awesome fa '.$button_icon.' qode_button_icon_element"></i>';
	}

	// Output Code
	/*
	$output .= '<div class="mkd_box wpb_column vc_column_container vc_col-sm-12">';
	$output .= '<div class="vc_column-inner">';
	$output .= '<div class="wpb_wrapper">';

	if($beitragsbild == "1")
	{
    $output .= '<div class="wpb_single_image wpb_content_element vc_align_left">';
    $output .= '<div class="wpb_wrapper">';
    $output .= '<a'.$build_link.'>';
    $output .= '<div class="vc_single_image-wrapper vc_box_border_grey" style="background-image: url('.get_the_post_thumbnail_url( $post_id ).')">';
    $output .= '</div>';
    $output .= '</a>';
    $output .= '</div>';
    $output .= '</div>';
	}
	if($titel == "1")
	{
    $output .= '<div class="wpb_text_column wpb_content_element">';
    $output .= '<div class="wpb_wrapper">';
    $output .= '<a'.$build_link.'><' . $ueberschrift . '>' . get_the_title($post_id) . '</' . $ueberschrift . '></a>';
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
  	$output .= '<a itemprop="url"'.$build_link.' class="qbutton  small default">'.$button_text.''.$icon.'</a>';
	}

	$output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';*/



	$output = '<div class="mkd_box wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill">';
	$output .= '<div class="vc_column-inner">';
	$output .= '<div class="wpb_wrapper">';
	if($beitragsbild == "1")
	{
    $output .= '<div class="wpb_single_image wpb_content_element vc_align_left">';
    $output .= '<div class="wpb_wrapper">';
    $output .= '<a'.$build_link.'>';
    $output .= '<div class="vc_single_image-wrapper vc_box_border_grey" style="background-image: url('.get_the_post_thumbnail_url( $post_id ).')">';
    $output .= '</div>';
    $output .= '</a>';
    $output .= '</div>';
    $output .= '</div>';
	}
	if($titel == "1")
	{
    $output .= '<div class="wpb_text_column wpb_content_element">';
    $output .= '<div class="wpb_wrapper">';
    $output .= '<a'.$build_link.'><' . $ueberschrift . '>' . get_the_title($post_id) . '</' . $ueberschrift . '></a>';
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
  	$output .= '<a itemprop="url"'.$build_link.' class="qbutton  small default">'.$button_text.''.$icon.'</a>';
	}
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';


	return $output;
}
add_shortcode( 'mkd_box', 'create_mkd_box_shortcode' );

// Create Blog Box element for Visual Composer
add_action( 'vc_before_init', 'box_integrateWithVC' );
function box_integrateWithVC() {
	vc_map( array(
		'name' => __( 'Box', 'mkd-text' ),
		'description' => __( 'Zeigt in einer Box eine Liste aller Beträge an.', 'mkd-text' ),
		'base' => 'mkd_box',
    'icon' => plugins_url( 'images/favicon.jpg', dirname(__FILE__) ),
		'show_settings_on_create' => true,
		'category' => __( 'MK Design', 'mkd-text'),
		'params' => array(
			array(
				'type' => 'textfield',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Titel', 'mkd-text' ),
				'param_name' => 'titel_value',
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'textarea',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Textauszug', 'mkd-text' ),
				'param_name' => 'textauszug_value',
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'vc_link',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Link', 'mkd-text' ),
				'param_name' => 'link',
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
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
