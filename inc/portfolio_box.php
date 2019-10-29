<?php
// Create Shortcode mkd_portfolio_box
// Use the shortcode: [mkd_portfolio_box image="" title="" description="" link="" video=""]
function create_mkdportfoliobox_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
      'design' => '',
      'image' => '',
			'title' => '',
			'description' => '',
			'link' => '',
			'video' => '',
		),
		$atts,
		'mkd_portfolio_box'
	);
	// Attributes in var
  $design = $atts['design'];
	$image = $atts['image'];
	$title = $atts['title'];
	$description = $atts['description'];
	$link = vc_build_link($atts['link']);
	$video = vc_build_link($atts['video']);


	// Output Code
  if($design == "")
  {
    $output = '<div class="mkd_portfolio_box q_elements_holder two_columns eh_two_columns_25_75 responsive_mode_from_768">';

    $output .= '<div class="q_elements_item ">';
    $output .= '<div class="q_elements_item_inner">';
    $output .= '<div class="q_elements_item_content q_elements_holder_custom_663626" style="padding:0px 50px">';
    $output .= '<div class="wpb_single_image wpb_content_element vc_align_right">';
    $output .= '<div class="wpb_wrapper">';
    if(isset($link['url']))
    {
      $output .= '<a href="'.$link['url'].'" target="'.$link['target'].'" alt="'.$link['title'].'" title="'.$link['title'].'" rel="'.$link['rel'].'">';
    }
    $output .= '<div class="vc_single_image-wrapper vc_box_border_grey"><img src="'.wp_get_attachment_url( $image ).'" class="vc_single_image-img attachment-full" alt="" style="max-height: 150px;"></div>';
    if(isset($link['url']))
    {
      $output .= '</a>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    $output .= '<div class="q_elements_item ">';
    $output .= '<div class="q_elements_item_inner">';
    $output .= '<div class="q_elements_item_content q_elements_holder_custom_182353" style="padding:30px">';
    $output .= '<div class="wpb_text_column wpb_content_element ">';
    $output .= '<div class="wpb_wrapper">';
    if(isset($link['url']))
    {
      $output .= '<a itemprop="url" href="'.$link['url'].'" target="'.$link['target'].'" alt="'.$link['title'].'" title="'.$link['title'].'" rel="'.$link['rel'].'"><h3>'.$title.'</h3></a>';
    }
    else {
      $output .= '<h3>'.$title.'</h3>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="vc_empty_space" style="height: 10px">';
    $output .= '<span class="vc_empty_space_inner">';
    $output .= '<span class="empty_space_image"></span>';
    $output .= '</span>';
    $output .= '</div>';
    $output .= '<div class="wpb_text_column wpb_content_element ">';
    $output .= '<div class="wpb_wrapper">';
    $output .= '<div>'.$description.'</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="vc_empty_space" style="height: 25px">';
    $output .= '<span class="vc_empty_space_inner">';
    $output .= '<span class="empty_space_image"></span>';
    $output .= '</span>';
    $output .= '</div>';
    if(isset($link['url']))
    {
			$output .= '<div class="wpb_text_column wpb_content_element ">';
			$output .= '<div class="wpb_wrapper">';
			$output .= '<a itemprop="url" href="'.$link['url'].'" target="'.$link['target'].'" alt="'.$link['title'].'" title="'.$link['title'].'" rel="'.$link['rel'].'">Vollständige Rezension lesen</a>';
			$output .= '</div>';
			$output .= '</div>';
    }
    $output .= '<div class="vc_empty_space" style="height: 10px">';
    $output .= '<span class="vc_empty_space_inner">';
    $output .= '<span class="empty_space_image"></span>';
    $output .= '</span>';
    $output .= '</div>';
    if(isset($video['url']))
    {
      $output .= '<a itemprop="url" href="'.$video['url'].'" target="'.$video['target'].'" alt="'.$video['title'].'" title="'.$video['title'].'" rel="'.$video['rel'].'" class="qbutton  small default">Video<i class="qode_icon_font_awesome fa fa-play qode_button_icon_element" style=""></i></a>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    $output .= '</div>';

  }
  if($design == "eh_two_columns_75_25")
  {
    $output = '<div class="mkd_portfolio_box q_elements_holder two_columns eh_two_columns_75_25 responsive_mode_from_768">';

    $output .= '<div class="q_elements_item ">';
    $output .= '<div class="q_elements_item_inner">';
    $output .= '<div class="q_elements_item_content q_elements_holder_custom_182353" style="padding:30px">';
    $output .= '<div class="wpb_text_column wpb_content_element ">';
    $output .= '<div class="wpb_wrapper">';
    if(isset($link['url']))
    {
      $output .= '<a itemprop="url" href="'.$link['url'].'" target="'.$link['target'].'" alt="'.$link['title'].'" title="'.$link['title'].'" rel="'.$link['rel'].'"><h3>'.$title.'</h3></a>';
    }
    else {
      $output .= '<h3>'.$title.'</h3>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="vc_empty_space" style="height: 10px">';
    $output .= '<span class="vc_empty_space_inner">';
    $output .= '<span class="empty_space_image"></span>';
    $output .= '</span>';
    $output .= '</div>';
    $output .= '<div class="wpb_text_column wpb_content_element ">';
    $output .= '<div class="wpb_wrapper">';
    $output .= '<div>'.$description.'</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="vc_empty_space" style="height: 25px">';
    $output .= '<span class="vc_empty_space_inner">';
    $output .= '<span class="empty_space_image"></span>';
    $output .= '</span>';
    $output .= '</div>';
    if(isset($link['url']))
    {
			$output .= '<div class="wpb_text_column wpb_content_element ">';
			$output .= '<div class="wpb_wrapper">';
			$output .= '<a itemprop="url" href="'.$link['url'].'" target="'.$link['target'].'" alt="'.$link['title'].'" title="'.$link['title'].'" rel="'.$link['rel'].'">Vollständige Rezension lesen</a>';
			$output .= '</div>';
			$output .= '</div>';
    }
    $output .= '<div class="vc_empty_space" style="height: 10px">';
    $output .= '<span class="vc_empty_space_inner">';
    $output .= '<span class="empty_space_image"></span>';
    $output .= '</span>';
    $output .= '</div>';
		if(isset($video['url']))
    {
      $output .= '<a itemprop="url" href="'.$video['url'].'" target="'.$video['target'].'" alt="'.$video['title'].'" title="'.$video['title'].'" rel="'.$video['rel'].'" class="qbutton  small default">Video<i class="qode_icon_font_awesome fa fa-play qode_button_icon_element" style=""></i></a>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    $output .= '<div class="q_elements_item ">';
    $output .= '<div class="q_elements_item_inner">';
    $output .= '<div class="q_elements_item_content q_elements_holder_custom_663626" style="padding:0px 50px">';
    $output .= '<div class="wpb_single_image wpb_content_element vc_align_left">';
    $output .= '<div class="wpb_wrapper">';
    if(isset($link['url']))
    {
      $output .= '<a href="'.$link['url'].'" target="'.$link['target'].'" alt="'.$link['title'].'" title="'.$link['title'].'" rel="'.$link['rel'].'">';
    }
    $output .= '<div class="vc_single_image-wrapper vc_box_border_grey"><img src="'.wp_get_attachment_url( $image ).'" class="vc_single_image-img attachment-full" alt="" style="max-height: 150px;"></div>';
    if(isset($link['url']))
    {
      $output .= '</a>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    $output .= '</div>';
  }

	return $output;
}
add_shortcode( 'mkd_portfolio_box', 'create_mkdportfoliobox_shortcode' );

// Create Portfolio Box element for Visual Composer
add_action( 'vc_before_init', 'mkdportfoliobox_integrateWithVC' );
function mkdportfoliobox_integrateWithVC() {
	vc_map( array(
		'name' => __( 'Portfolio Box', 'mkd-text' ),
		'base' => 'mkd_portfolio_box',
    'icon' => plugins_url( 'images/favicon.jpg', dirname(__FILE__) ),
		'show_settings_on_create' => true,
		'category' => __( 'MK Design', 'mkd-text'),
		'params' => array(
      array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Design', 'mkd-text' ),
				'param_name' => 'design',
				'value' => array(
          '1/4 + 3/4' => 'eh_two_columns_25_75',
          '3/4 + 1/4' => 'eh_two_columns_75_25',
        ),
			),
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Bild', 'mkd-text' ),
				'param_name' => 'image',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Titel', 'mkd-text' ),
				'param_name' => 'title',
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Beschreibung', 'mkd-text' ),
				'param_name' => 'description',
			),
			array(
				'type' => 'vc_link',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Link', 'mkd-text' ),
				'param_name' => 'link',
			),
			array(
				'type' => 'vc_link',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Video', 'mkd-text' ),
				'param_name' => 'video',
			),
		)
	) );
}
?>
