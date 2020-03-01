<?php
// Create Shortcode mk_post_overlay_list
// Use the shortcode: [mk_post_overlay_list kategorie="" anzahl=""]
function create_mkd_blog_overlay_box_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'kategorie' => '',
			'anzahl' => '',
			'hintergrund' => '',
		),
		$atts,
		'mk_post_overlay_list'
	);
	// Attributes in var
	$kategorie = $atts['kategorie'];
	$anzahl = $atts['anzahl'];
	$hintergrund = $atts['hintergrund'];


	// Output Code

  $output = '';

  $attachments = get_posts( array(
      'post_type'      => 'post',
      'posts_per_page' => $anzahl,
      'post_status'    => 'publish',
      'post_parent'    => null,
			'cat' => $kategorie,
  ) );

  $count = 1;

  foreach ( $attachments as $post )
  {
    if($count % 2 != 0)
    {
			$output .= '<div class="mkd_blog_overlay_box vc_row wpb_row section vc_row-fluid vc_inner " style=" text-align:left;">';
			$output .= '	<div class=" full_section_inner clearfix">';
			$output .= '		<div class="wpb_column vc_column_container vc_col-sm-12">';
			$output .= '			<div class="vc_column-inner">';
			$output .= '				<div class="wpb_wrapper">';
			$output .= '					<div class="q_elements_holder two_columns eh_two_columns_33_66 responsive_mode_from_1000">';
			$output .= '						<div class="mkd_elements_item_textbox left q_elements_item " data-animation="no" data-item-class="q_elements_holder_custom_827460" style="background-image: url('.wp_get_attachment_url($hintergrund).');">';
			$output .= '							<div class="q_elements_item_inner">';
			$output .= '								<div class="q_elements_item_content q_elements_holder_custom_827460" style="padding:50px">';
			$output .= '									<div class="wpb_text_column wpb_content_element ">';
			$output .= '										<div class="wpb_wrapper">';
			$output .= '											<h3 class="h1">' . $post->post_title . '</h3>';
			$output .= '										</div>';
			$output .= '									</div>';
			$output .= '									<div class="vc_empty_space" style="height: 32px">';
			$output .= '										<span class="vc_empty_space_inner">';
			$output .= '											<span class="empty_space_image" style="background-image:url(http://demo.your-own-design.de/vvv/wp-content/uploads/2018/06/separator.png);background-repeat:no-repeat;"></span>';
			$output .= '										</span>';
			$output .= '									</div>';
			$output .= '									<div class="wpb_text_column wpb_content_element ">';
			$output .= '										<div class="wpb_wrapper">';
			$output .= '											<p>'.get_the_excerpt($post->ID).'</p>';
			$output .= '										</div>';
			$output .= '									</div>';
			$output .= '									<div class="vc_empty_space" style="height: 25px">';
			$output .= '										<span class="vc_empty_space_inner">';
			$output .= '											<span class="empty_space_image"></span>';
			$output .= '										</span>';
			$output .= '									</div>';
			$output .= '									<a itemprop="url" href="'.get_permalink($post->ID).'" target="_self" class="qbutton  small default" style="" title="' . $post->post_title . '">weiterlesen</a>';
			$output .= '								</div>';
			$output .= '							</div>';
			$output .= '						</div>';
			$output .= '						<div class="q_elements_item " data-animation="no" data-item-class="q_elements_holder_custom_226314" style="vertical-align:middle;">';
			$output .= '							<div class="q_elements_item_inner">';
			$output .= '								<div class="q_elements_item_content q_elements_holder_custom_226314">';
			$output .= '									<div class="wpb_single_image wpb_content_element vc_align_left  qode_image_hover_zoom_in">';
			$output .= '										<div class="wpb_wrapper">';
			$output .= '											<a class="qode-prettyphoto qode-single-image-pretty-photo" href="'.get_permalink($post->ID).'" target="_self">';
			$output .= '												<div class="vc_single_image-wrapper   vc_box_border_grey">';
			$output .= '													<img class="vc_single_image-img " src="'.get_the_post_thumbnail_url($post->ID, 'post-overlay-list' ).'" width="820" height="500" alt="' . $post->post_title . '" title="' . $post->post_title . '">';
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
			$output .= '</div>';
			$output .= '<div class="vc_row wpb_row section vc_row-fluid  grid_section" style=" text-align:left;">';
			$output .= '	<div class=" section_inner clearfix">';
			$output .= '		<div class="section_inner_margin clearfix">';
			$output .= '			<div class="wpb_column vc_column_container vc_col-sm-12">';
			$output .= '				<div class="vc_column-inner">';
			$output .= '					<div class="wpb_wrapper">';
			$output .= '						<div class="vc_empty_space" style="height: 100px">';
			$output .= '							<span class="vc_empty_space_inner">';
			$output .= '								<span class="empty_space_image"></span>';
			$output .= '							</span>';
			$output .= '						</div>';
			$output .= '					</div>';
			$output .= '				</div>';
			$output .= '			</div>';
			$output .= '		</div>';
			$output .= '	</div>';
			$output .= '</div>';
		}
    else
		{
			$output .= '<div class="mkd_blog_overlay_box vc_row wpb_row section vc_row-fluid vc_inner " style=" text-align:left;">';
			$output .= '	<div class=" full_section_inner clearfix">';
			$output .= '		<div class="wpb_column vc_column_container vc_col-sm-12">';
			$output .= '			<div class="vc_column-inner">';
			$output .= '				<div class="wpb_wrapper">';
			$output .= '					<div class="q_elements_holder two_columns eh_two_columns_66_33 responsive_mode_from_1000">';
			$output .= '						<div class="q_elements_item " data-animation="no" data-item-class="q_elements_holder_custom_226314" style="vertical-align:middle;">';
			$output .= '							<div class="q_elements_item_inner">';
			$output .= '								<div class="q_elements_item_content q_elements_holder_custom_226314">';
			$output .= '									<div class="wpb_single_image wpb_content_element vc_align_left  qode_image_hover_zoom_in">';
			$output .= '										<div class="wpb_wrapper">';
			$output .= '											<a class="qode-prettyphoto qode-single-image-pretty-photo" href="'.get_permalink($post->ID).'" target="_self">';
			$output .= '												<div class="vc_single_image-wrapper   vc_box_border_grey">';
			$output .= '													<img class="vc_single_image-img " src="'.get_the_post_thumbnail_url($post->ID, 'post-overlay-list' ).'" width="820" height="500" alt="' . $post->post_title . '" title="' . $post->post_title . '">';
			$output .= '												</div>';
			$output .= '											</a>';
			$output .= '										</div>';
			$output .= '									</div>';
			$output .= '								</div>';
			$output .= '							</div>';
			$output .= '						</div>';
			$output .= '						<div class="mkd_elements_item_textbox right q_elements_item" data-animation="no" data-item-class="q_elements_holder_custom_827460" style="background-image: url('.wp_get_attachment_url($hintergrund).');">';
			$output .= '							<div class="q_elements_item_inner">';
			$output .= '								<div class="q_elements_item_content q_elements_holder_custom_827460" style="padding:50px">';
			$output .= '									<div class="wpb_text_column wpb_content_element ">';
			$output .= '										<div class="wpb_wrapper">';
			$output .= '											<h3 class="h1">' . $post->post_title . '</h3>';
			$output .= '										</div>';
			$output .= '									</div>';
			$output .= '									<div class="vc_empty_space" style="height: 32px">';
			$output .= '										<span class="vc_empty_space_inner">';
			$output .= '											<span class="empty_space_image" style="background-image:url(http://demo.your-own-design.de/vvv/wp-content/uploads/2018/06/separator.png);background-repeat:no-repeat;"></span>';
			$output .= '										</span>';
			$output .= '									</div>';
			$output .= '									<div class="wpb_text_column wpb_content_element ">';
			$output .= '										<div class="wpb_wrapper">';
			$output .= '											<p>'.get_the_excerpt($post->ID).'</p>';
			$output .= '										</div>';
			$output .= '									</div>';
			$output .= '									<div class="vc_empty_space" style="height: 25px">';
			$output .= '										<span class="vc_empty_space_inner">';
			$output .= '											<span class="empty_space_image"></span>';
			$output .= '										</span>';
			$output .= '									</div>';
			$output .= '									<a itemprop="url" href="'.get_permalink($post->ID).'" target="_self" class="qbutton  small default" style="" title="' . $post->post_title . '">weiterlesen</a>';
			$output .= '								</div>';
			$output .= '							</div>';
			$output .= '						</div>';
			$output .= '					</div>';
			$output .= '				</div>';
			$output .= '			</div>';
			$output .= '		</div>';
			$output .= '	</div>';
			$output .= '</div>';
			$output .= '<div class="vc_row wpb_row section vc_row-fluid  grid_section" style=" text-align:left;">';
			$output .= '	<div class=" section_inner clearfix">';
			$output .= '		<div class="section_inner_margin clearfix">';
			$output .= '			<div class="wpb_column vc_column_container vc_col-sm-12">';
			$output .= '				<div class="vc_column-inner">';
			$output .= '					<div class="wpb_wrapper">';
			$output .= '						<div class="vc_empty_space" style="height: 100px">';
			$output .= '							<span class="vc_empty_space_inner">';
			$output .= '								<span class="empty_space_image"></span>';
			$output .= '							</span>';
			$output .= '						</div>';
			$output .= '					</div>';
			$output .= '				</div>';
			$output .= '			</div>';
			$output .= '		</div>';
			$output .= '	</div>';
			$output .= '</div>';
		}

    $count=$count+1;
  }

  return $output;

}




add_shortcode( 'mkd_blog_overlay_box', 'create_mkd_blog_overlay_box_shortcode' );

// Create Post Overlay List element for Visual Composer
add_action( 'vc_before_init', 'mkd_blog_overlay_box_integrateWithVC' );
function mkd_blog_overlay_box_integrateWithVC() {
  $categories_array = array();
  $categories = get_categories(array('taxonomy' => 'category',));
  foreach( $categories as $category ) {
      $categories_array[$category->name] = $category->term_id;
  }

	vc_map( array(
		'name' => __( 'Blog Overlay Box', 'mk_design' ),
		'base' => 'mkd_blog_overlay_box',
    'icon' => plugins_url( 'images/favicon.jpg', dirname(__FILE__) ),
		'show_settings_on_create' => true,
		'category' => __( 'MK Design', 'mk_design'),
		'params' => array(
			array(
        'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Kategorie', 'mk_design' ),
				'param_name' => 'kategorie',
        "value" => $categories_array,
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Anzahl', 'mk_design' ),
				'param_name' => 'anzahl',
			),
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'admin_label' => false,
				'heading' => __( 'Hintergrund', 'mk_design' ),
				'param_name' => 'hintergrund',
			),
		)
	) );
}
