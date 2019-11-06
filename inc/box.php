<?php
// Create Shortcode mkd_box
// Use the shortcode: [mkd_box image="" title="" description="" link=""]
function create_mkd_box_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'value_beitragsbild' => '',
			'value_ueberschrift' => '',
			'value_textauszug' => '',
			'value_link' => '',
			'value_link_class' => '',
			'show_beitragsbild' => '1',
			'show_ueberschrift' => '1',
			'tag_ueberschrift' => 'h1',
			'show_textauszug' => '1',
			'show_button' => '1',
			'value_button' => __( 'weiterlesen', 'mkd-text' ),
			'icon_button' => '',
		),
		$atts,
		'mkd_box'
	);
	// Attributes in var
	$value_beitragsbild = $atts['value_beitragsbild'];
	$value_ueberschrift = $atts['value_ueberschrift'];
	$value_textauszug = $atts['value_textauszug'];
	$value_link = vc_build_link($atts['value_link']);
	$value_link_class = $atts['value_link_class'];
	$show_beitragsbild = $atts['show_beitragsbild'];
	$show_ueberschrift = $atts['show_ueberschrift'];
	$tag_ueberschrift = $atts['tag_ueberschrift'];
	$show_textauszug = $atts['show_textauszug'];
	$show_button = $atts['show_button'];
	$value_button = $atts['value_button'];
	$icon_button = $atts['icon_button'];

	if($icon_button != "")
	{
		$icon = ' <i class="qode_icon_font_awesome fa '.$icon_button.' qode_button_icon_element"></i>';
	}

	// Output Code
	$output = '<div class="mkd_box wpb_column vc_column_container vc_col-sm-12">';
	$output .= '	<div class="vc_column-inner">';
	$output .= '		<div class="wpb_wrapper">';
	if($show_beitragsbild == "1")
	{
    $output .= '			<div class="wpb_single_image wpb_content_element vc_align_left">';
    $output .= '				<div class="wpb_wrapper">';
    $output .= '					<a href="'.$value_link['url'].'" title="'.$value_link['title'].'" target="'.$value_link['target'].'" class="'.$value_link_class.'">';
    $output .= '						<div class="vc_single_image-wrapper vc_box_border_grey" style="background-image: url('.wp_get_attachment_url($value_beitragsbild).')"></div>';
    $output .= '					</a>';
    $output .= '				</div>';
    $output .= '			</div>';
	}
	if($show_ueberschrift == "1")
	{
		$output .= '			<div class="wpb_text_column wpb_content_element">';
		$output .= '				<div class="wpb_wrapper">';
		$output .= '					<a href="'.$value_link['url'].'" title="'.$value_link['title'].'" target="'.$value_link['target'].'" class="'.$value_link_class.'"><' . $tag_ueberschrift . '>' . $value_ueberschrift . '</' . $tag_ueberschrift . '></a>';
		$output .= '				</div>';
		$output .= '			</div>';
	}

	if($show_textauszug == "1")
	{
		$output .= '			<div class="wpb_text_column wpb_content_element ">';
		$output .= '				<div class="wpb_wrapper">';
		$output .= '					<p>'.$value_textauszug.'</p>';
		$output .= '				</div>';
		$output .= '			</div>';
	}
	if($show_button == "1")
	{
		$output .= '		<a href="'.$value_link['url'].'" title="'.$value_link['title'].'" target="'.$value_link['target'].'" itemprop="url" class="qbutton  small default '.$value_link_class.'">'.$value_button.''.$icon.'</a>';
	}

	if($show_button == "1")
	{
		$output .= '		<span class="qbutton  small default">&nbsp;</span>';
	}
	$output .= '		</div>';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'mkd_box', 'create_mkd_box_shortcode' );

// Create Blog Box element for Visual Composer
add_action( 'vc_before_init', 'box_integrateWithVC' );
function box_integrateWithVC() {
	vc_map( array(
		'name' => __( 'Box', 'mkd-text' ),
		'description' => __( 'Zeigt in einer Box eine verlinkte Seite an.', 'mkd-text' ),
		'base' => 'mkd_box',
    'icon' => plugins_url( 'images/favicon.jpg', dirname(__FILE__) ),
		'show_settings_on_create' => true,
		'category' => __( 'MK Design', 'mkd-text'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Beitragsbild', 'mkd-text' ),
				'param_name' => 'value_beitragsbild',
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Überschrift', 'mkd-text' ),
				'param_name' => 'value_ueberschrift',
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'textarea',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Textauszug', 'mkd-text' ),
				'param_name' => 'value_textauszug',
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'vc_link',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Link', 'mkd-text' ),
				'param_name' => 'value_link',
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
			),
			array(
				'type' => 'textfield',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Link Class', 'mkd-text' ),
				'param_name' => 'value_link_class',
				'group' => __( 'Allgemeine Einstellungen', 'mkd-text' ),
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
