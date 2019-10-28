<?php
// Create Shortcode mkd_overlay_box
// Use the shortcode: [mkd_overlay_box =""]
function create_mkdoverlaybox_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'value_beitragsbild' => '',
			'value_ueberschrift' => '',
			'value_textauszug' => '',
			'value_link' => '',
			'layout' => '1',
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
	$layout = $atts['layout'];
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
	if($layout == "1")
	{
		$output = '<div class="mkd_blog_overlay_box vc_row wpb_row section vc_row-fluid vc_inner " style=" text-align:left;">';
		$output .= '	<div class=" full_section_inner clearfix">';
		$output .= '		<div class="wpb_column vc_column_container vc_col-sm-12">';
		$output .= '			<div class="vc_column-inner">';
		$output .= '				<div class="wpb_wrapper">';
		$output .= '					<div class="q_elements_holder two_columns eh_two_columns_33_66 responsive_mode_from_768">';
		$output .= '						<div class="mkd_elements_item_textbox left q_elements_item " data-animation="no" data-item-class="q_elements_holder_custom_827460" style="background-image: url();">';
		$output .= '							<div class="q_elements_item_inner">';
		$output .= '								<div class="q_elements_item_content q_elements_holder_custom_827460" style="padding:50px">';
		if($show_ueberschrift == "1")
		{
			$output .= '									<div class="wpb_text_column wpb_content_element ">';
			$output .= '										<div class="wpb_wrapper">';
			$output .= '											<' . $tag_ueberschrift . '>' . $value_ueberschrift . '</' . $tag_ueberschrift . '>';
			$output .= '										</div>';
			$output .= '									</div>';
			$output .= '									<div class="vc_empty_space" style="height: 25px">';
			$output .= '										<span class="vc_empty_space_inner">';
			$output .= '											<span class="empty_space_image" style="background-image:url();background-repeat:no-repeat;"></span>';
			$output .= '										</span>';
			$output .= '									</div>';
		}
		if($show_textauszug == "1")
		{
			$output .= '									<div class="wpb_text_column wpb_content_element ">';
			$output .= '										<div class="wpb_wrapper">';
			$output .= '											<p>'.$value_textauszug.'</p>';
			$output .= '										</div>';
			$output .= '									</div>';
			$output .= '									<div class="vc_empty_space" style="height: 25px">';
			$output .= '										<span class="vc_empty_space_inner">';
			$output .= '											<span class="empty_space_image"></span>';
			$output .= '										</span>';
			$output .= '									</div>';
		}
		if($show_button == "1")
		{
			$output .= '									<a href="'.$value_link['url'].'" title="'.$value_link['title'].'" target="'.$value_link['target'].'" itemprop="url" class="qbutton  small default">'.$value_button.''.$icon.'</a>';
		}
		$output .= '								</div>';
		$output .= '							</div>';
		$output .= '						</div>';
		$output .= '						<div class="q_elements_item " data-animation="no" data-item-class="q_elements_holder_custom_226314" style="vertical-align:middle;">';
		$output .= '							<div class="q_elements_item_inner">';
		$output .= '								<div class="q_elements_item_content q_elements_holder_custom_226314">';
		$output .= '									<div class="wpb_single_image wpb_content_element vc_align_left  qode_image_hover_zoom_in">';
		$output .= '										<div class="wpb_wrapper">';
		$output .= '											<a href="'.$value_link['url'].'" title="'.$value_link['title'].'" target="'.$value_link['target'].'" class="qode-prettyphoto qode-single-image-pretty-photo>';
		$output .= '												<div class="vc_single_image-wrapper   vc_box_border_grey">';
		$output .= '													<img class="vc_single_image-img " src="'.wp_get_attachment_url($value_beitragsbild).'" width="820" height="500" alt="' . $post->post_title . '" title="' . $post->post_title . '">';
		$output .= '												</div>';
		$output .= '											</a>';
		$output .= '										</div>';
		$output .= '									</div>';
		$output .= '								</div>';
		$output .= '							</div>';
		$output .= '						</div>';
		$output .= '					</div>';
		$output .= '				</div>';
		$output .= '			</div>';
		$output .= '		</div>';
		$output .= '	</div>';
		//$output .= '</div>';
	}

	if($layout == "0")
	{
		$output = '<div class="mkd_blog_overlay_box vc_row wpb_row section vc_row-fluid vc_inner " style=" text-align:left;">';
		$output .= '	<div class=" full_section_inner clearfix">';
		$output .= '		<div class="wpb_column vc_column_container vc_col-sm-12">';
		$output .= '			<div class="vc_column-inner">';
		$output .= '				<div class="wpb_wrapper">';
		$output .= '					<div class="q_elements_holder two_columns eh_two_columns_66_33 responsive_mode_from_768">';
		$output .= '						<div class="q_elements_item " data-animation="no" data-item-class="q_elements_holder_custom_226314" style="vertical-align:middle;">';
		$output .= '							<div class="q_elements_item_inner">';
		$output .= '								<div class="q_elements_item_content q_elements_holder_custom_226314">';
		$output .= '									<div class="wpb_single_image wpb_content_element vc_align_left  qode_image_hover_zoom_in">';
		$output .= '										<div class="wpb_wrapper">';
		$output .= '											<a href="'.$value_link['url'].'" title="'.$value_link['title'].'" target="'.$value_link['target'].'" class="qode-prettyphoto qode-single-image-pretty-photo">';
		$output .= '												<div class="vc_single_image-wrapper   vc_box_border_grey">';
		$output .= '													<img class="vc_single_image-img " src="'.wp_get_attachment_url($value_beitragsbild).'" width="820" height="500" alt="' . $post->post_title . '" title="' . $post->post_title . '">';
		$output .= '												</div>';
		$output .= '											</a>';
		$output .= '										</div>';
		$output .= '									</div>';
		$output .= '								</div>';
		$output .= '							</div>';
		$output .= '						</div>';
		$output .= '						<div class="mkd_elements_item_textbox right q_elements_item " data-animation="no" data-item-class="q_elements_holder_custom_827460" style="background-image: url();">';
		$output .= '							<div class="q_elements_item_inner">';
		$output .= '								<div class="q_elements_item_content q_elements_holder_custom_827460" style="padding:50px">';
		if($show_ueberschrift == "1")
		{
			$output .= '									<div class="wpb_text_column wpb_content_element ">';
			$output .= '										<div class="wpb_wrapper">';
			$output .= '											<' . $tag_ueberschrift . '>' . $value_ueberschrift . '</' . $tag_ueberschrift . '>';
			$output .= '										</div>';
			$output .= '									</div>';
			$output .= '									<div class="vc_empty_space" style="height: 25px">';
			$output .= '										<span class="vc_empty_space_inner">';
			$output .= '											<span class="empty_space_image" style="background-image:url();background-repeat:no-repeat;"></span>';
			$output .= '										</span>';
			$output .= '									</div>';
		}
		if($show_textauszug == "1")
		{
			$output .= '									<div class="wpb_text_column wpb_content_element ">';
			$output .= '										<div class="wpb_wrapper">';
			$output .= '											<p>'.$value_textauszug.'</p>';
			$output .= '										</div>';
			$output .= '									</div>';
			$output .= '									<div class="vc_empty_space" style="height: 25px">';
			$output .= '										<span class="vc_empty_space_inner">';
			$output .= '											<span class="empty_space_image"></span>';
			$output .= '										</span>';
			$output .= '									</div>';
		}
		if($show_button == "1")
		{
			$output .= '									<a href="'.$value_link['url'].'" title="'.$value_link['title'].'" target="'.$value_link['target'].'" itemprop="url" class="qbutton  small default">'.$value_button.''.$icon.'</a>';
		}
		$output .= '								</div>';
		$output .= '							</div>';
		$output .= '						</div>';
		$output .= '					</div>';
		$output .= '				</div>';
		$output .= '			</div>';
		$output .= '		</div>';
		$output .= '	</div>';
		//$output .= '</div>';
	}

	return $output;
}
add_shortcode( 'mkd_overlay_box', 'create_mkdoverlaybox_shortcode' );

// Create Overlay Box element for Visual Composer
add_action( 'vc_before_init', 'mkdoverlaybox_integrateWithVC' );
function mkdoverlaybox_integrateWithVC() {
	vc_map( array(
		'name' => __( 'Overlay Box', 'mkd-text' ),
		'description' => __( 'Zeigt in einer Box eine verlinkte Seite an.', 'mkd-text' ),
		'icon' => plugins_url( 'images/favicon.jpg', dirname(__FILE__) ),
		'base' => 'mkd_overlay_box',
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
				'type' => 'dropdown',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Layout', 'mkd-text' ),
				'value' => array(
					'Bild rechts' => '1',
					'Bild links' => '0',
        ),
				'param_name' => 'layout',
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
