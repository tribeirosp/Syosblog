<?php if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}
/*===================================================================*/
/* 1. ADD META BOXES	
/*===================================================================*/
function etmunfarid_etcodes_add_meta_box( $meta_box )
{
    if( !is_array($meta_box) ) return false;
    
    // Create a callback function

	$callback = function ($post,$meta_box) {
		etmunfarid_etcodes_create_meta_box( $post, $meta_box["args"] );
	};


    add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
}

/*===================================================================*/
/* 2. CREATE META BOXES	
/*===================================================================*/
function etmunfarid_etcodes_create_meta_box( $post, $meta_box )
{
	//VERSION FALLBACK
	$wp_version = get_bloginfo('version');
	
    if( !is_array($meta_box) ) return false;
    
	wp_nonce_field( basename(__FILE__), 'etmunfarid_etcodes_meta_box_nonce' );
	echo '<table class="etcodes-meta-table form-table">';
 
	foreach( $meta_box['fields'] as $field ){
		//GET DATA FROM POST
		$meta = get_post_meta( $post->ID, $field['id'], true );
		echo '<tr><th><label for="'. $field['id'] .'" class="'. $field['id'] .'"><strong>'. $field['name'] .'</strong>
			  <span>'. $field['desc'] .'</span></label></th>';
		
		switch( $field['type'] ){	
			case 'text':
				echo '<td><input type="text" name="etmunfarid_etcodes_meta['. $field['id'] .']" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .'" size="30" /></td>';
				break;	
				
			case 'textarea':
				echo '<td><textarea name="etmunfarid_etcodes_meta['. $field['id'] .']" id="'. $field['id'] .'" rows="7" cols="5">'. ($meta ? $meta : $field['std']) .'</textarea></td>';
				break;
				
			case 'file':
				if( version_compare($wp_version, '3.4.2', '>') ) {
			?> 
				<script>
				jQuery(function($) {
					var frame;

					$('#<?php echo esc_js($field['id']); ?>_button').on('click', function(e) {
						e.preventDefault();
						
						var options = {
							state: 'insert',
							frame: 'post'
						};

						frame = wp.media(options).open();
						
						// CUSTOMIZE VIEWS
						frame.menu.get('view').unset('gallery');
						frame.menu.get('view').unset('featured-image');
												
						frame.toolbar.get('view').set({
							insert: {
								style: 'primary',
								text: '<?php esc_html_e("Insert", "munfarid"); ?>',

								click: function() {
									var models = frame.state().get('selection'),
										url = models.first().attributes.url;

									$('#<?php echo esc_js($field['id']); ?>').val( url ); 

									frame.close();
								}
							}
						});
						

					});
					
				});
				</script>
			<?php
				} 
				// VERSION COMPARE
				echo '<td><input type="text" name="etmunfarid_etcodes_meta['. $field['id'] .']" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .'" size="30" class="file" /> <input type="button" class="button" name="'. $field['id'] .'_button" id="'. $field['id'] .'_button" value="Browse" /></td>';
				break;
				
			case 'image':
				if( version_compare($wp_version, '3.4.2', '>') ) {
			?> 
				<script>
				jQuery(function($) {
					var frame;

					$('#<?php echo esc_js($field['id']); ?>_button').on('click', function(e) {
						e.preventDefault();
						
						var options = {
							state: 'insert',
							frame: 'post'
						};

						frame = wp.media(options).open();
						
						// CUSTOMIZE VIEWS
						frame.menu.get('view').unset('gallery');
						frame.menu.get('view').unset('featured-image');
												
						frame.toolbar.get('view').set({
							insert: {
								style: 'primary',
								text: '<?php esc_html_e("Insert", "munfarid"); ?>',

								click: function() {
									var models = frame.state().get('selection'),
										    id = models.first().attributes.id;

										this.el.innerHTML = '<?php esc_html_e("Saving...", "munfarid"); ?>';
										
										$.ajax({
											type: 'POST',
											url: ajaxurl,
											data: { 
												id: id, 
												action: 'etmunfarid_etcodes_grid_feat_image_save', 
												post_id: etmunfarid_etcodes_ajax.post_id, 
												nonce: etmunfarid_etcodes_ajax.nonce 
											},
											success: function(){
    											$('#<?php echo esc_js($field['id']); ?>').val( id );
    											frame.close();
											},
											dataType: 'html'
										}).done( function( data ) {
											$('#<?php echo esc_js($field['id']); ?> ~ .etcodes-meta-thumbnails').html( data );
										}); 
								}
							}
						});
						

					});
					
				});
				</script>
			<?php
				} 
				// VERSION COMPARE
				echo '<td>';
				echo '<input type="hidden" name="etmunfarid_etcodes_meta['. $field['id'] .']" id="'. $field['id'] .'" size="30" value="'. ($meta ? $meta : '') .'" /> <input type="button" class="button" name="'. $field['id'] .'_button" id="'. $field['id'] .'_button" value="Browse" />';

				if ($meta) {
					$thumbnail_output = '<li>' . wp_get_attachment_image( $meta, array(40,40) ) . '</li>';
					echo '<ul class="etcodes-meta-thumbnails">' . $thumbnail_output . '</ul>';
				}

				echo '</td>';
				break;

			case 'images': 
				//WP 3.5 +
				if( version_compare($wp_version, '3.4.2', '>') ) {
			?>
				<script>
				jQuery(function($) {
					var frame,
					    images = '<?php echo get_post_meta( $post->ID, 'etmunfarid_etcodes_image_ids', true ); ?>',
					    selection = loadImages(images);

					$('#etmunfarid_etcodes_images_upload').on('click', function(e) {
						e.preventDefault();
						//FIRST FRAME
						var options = {
							title: '<?php esc_html_e("Create Gallery", "munfarid"); ?>',
							state: 'gallery-edit',
							frame: 'post',
							selection: selection
						};
						//IF FRAME IS THERE
						if( frame || selection ) {
							options['title'] = '<?php esc_html_e("Edit Gallery", "munfarid"); ?>';
						}

						frame = wp.media(options).open();
						
						// CUSTOMIZE VIEWS
						frame.menu.get('view').get('cancel').el.innerHTML = '<?php esc_html_e("Cancel", "munfarid"); ?>';
						frame.menu.get('view').get('gallery-edit').el.innerHTML = '<?php esc_html_e("Edit Gallery", "munfarid"); ?>';
						frame.content.get('view').sidebar.unset('gallery');

						overrideGalleryInsert();
						frame.on( 'toolbar:render:gallery-edit', function() {
    						overrideGalleryInsert();
						});
						
						frame.on( 'content:render:browse', function( browser ) {
						    if ( !browser ) return;
						    // HIDE GALLERY SETTINGS
						    browser.sidebar.on('ready', function(){
						        browser.sidebar.unset('gallery');
						    });
						    // HIDE SEARCH AND FILTER
						    browser.toolbar.on('ready', function(){
    						    if(browser.toolbar.controller._state == 'gallery-library'){
    						        browser.toolbar.$el.hide();
    						    }
						    });
						});
						
						// REMOVE ALL IMAGES FROM LIBRARY
						frame.state().get('library').on( 'remove', function() {
						    var models = frame.state().get('library');
							if(models.length == 0){
							    selection = false;
    							$.post(ajaxurl, { ids: '', action: 'etmunfarid_etcodes_image_save', post_id: etmunfarid_etcodes_ajax.post_id, nonce: etmunfarid_etcodes_ajax.nonce });
							}
						});
						
						// INSERT BUTTON CUSTOM TEXT
						function overrideGalleryInsert() {
    						frame.toolbar.get('view').set({
								insert: {
									style: 'primary',
									text: '<?php esc_html_e("Save Gallery", "munfarid"); ?>',

									click: function() {
										var models = frame.state().get('library'),
										    ids = '';

										models.each( function( attachment ) {
										    ids += attachment.id + ','
										});

										this.el.innerHTML = '<?php esc_html_e("Saving...", "munfarid"); ?>';
										
										$.ajax({
											type: 'POST',
											url: ajaxurl,
											data: { 
												ids: ids, 
												action: 'etmunfarid_etcodes_image_save', 
												post_id: etmunfarid_etcodes_ajax.post_id, 
												nonce: etmunfarid_etcodes_ajax.nonce 
											},
											success: function(){
    											selection = loadImages(ids);
    											$('#etmunfarid_etcodes_image_ids').val( ids );
    											frame.close();
											},
											dataType: 'html'
										}).done( function( data ) {
											$('.etcodes-meta-thumbnails').html( data );
										}); 
									}
								}
							});
						}
					});
					
					// LOAD IMAGES VIA GALLERY
					function loadImages(images) {
						if( images ){
						    var shortcode = new wp.shortcode({
            					tag:    'gallery',
            					attrs:   { ids: images },
            					type:   'single'
            				});
				
						    var attachments = wp.media.gallery.attachments( shortcode );

            				var selection = new wp.media.model.Selection( attachments.models, {
            					props:    attachments.props.toJSON(),
            					multiple: true
            				});
            
            				selection.gallery = attachments.gallery;
            
            				// QUERY ATTACHMENTS
            				// SORTING
            				selection.more().done( function() {
            					selection.props.set({ query: false });
            					selection.unmirror();
            					selection.props.unset('orderby');
            				});
            				
            				return selection;
						}
						
						return false;
					}
					
				});
				</script>
			<?php
				$meta = get_post_meta( $post->ID, 'etmunfarid_etcodes_image_ids', true );
				$thumbnail_output = '';
				$button_text = ($meta) ? esc_html__('Edit Gallery', 'munfarid') : $field['std'];
				if( $meta ) {
					$field['std'] = esc_html__('Edit Gallery', 'munfarid');
					$thumbs = explode(',', $meta);
					$thumbnail_output = '';
					foreach( $thumbs as $thumb ) {
						$thumbnail_output .= '<li>' . wp_get_attachment_image( $thumb, array(40,40) ) . '</li>';
					}
				}

			    echo 
			    	'<td>
			    		<input type="button" class="button" name="' . $field['id'] . '" id="etmunfarid_etcodes_images_upload" value="' . $button_text .'" />
			    		
			    		<input type="hidden" name="etmunfarid_etcodes_meta[etmunfarid_etcodes_image_ids]" id="etmunfarid_etcodes_image_ids" value="' . ($meta ? $meta : 'false') . '" />

			    		<ul class="etcodes-meta-thumbnails">' . $thumbnail_output . '</ul>
			    	</td>';
			    } else {
			    	// PRE 3.5
			    	echo '<td><input type="button" class="button" name="' . $field['id'] . '" id="etmunfarid_etcodes_images_upload" value="' . $field['std'] .'" /></td>';
			    }
			    break;
				
			case 'select':
				echo'<td><select name="etmunfarid_etcodes_meta['. $field['id'] .']" id="'. $field['id'] .'">';
				foreach( $field['options'] as $key => $option ){
					echo '<option value="' . $key . '"';
					if( $meta ){ 
						if( $meta == $key ) echo ' selected="selected"'; 
					} else {
						if( $field['std'] == $key ) echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				}
				echo'</select></td>';
				break;
				
			case 'radio':
				echo '<td>';
				foreach( $field['options'] as $key => $option ){
					echo '<label class="radio-label"><input type="radio" name="etmunfarid_etcodes_meta['. $field['id'] .']" value="'. $key .'" class="radio"';
					if( $meta ){ 
						if( $meta == $key ) echo ' checked="checked"'; 
					} else {
						if( $field['std'] == $key ) echo ' checked="checked"';
					}
					echo ' /> '. $option .'</label> ';
				}
				echo '</td>';
				break;
			
			case 'color':
			    if( array_key_exists('val', $field) ) $val = $field['val'];
			    if( $meta ) $val = $meta;
			    echo '<td class="etcodes-box-'.$field['type'].'">';
			    echo '<input data-default-color="'.$field['std'].'" type="text" id="'. $field['id'] .'" name="etmunfarid_etcodes_meta[' . $field['id'] .']" value="'.$val.'" class="colorpicker">';
			    echo '</div>';
			    echo '</td>';
			    break;
				
			case 'checkbox':
			    echo '<td>';
			    $val = '';
                if( $meta ) {
                    if( $meta == 'on' ) $val = ' checked="checked"';
                } else {
                    if( $field['std'] == 'on' ) $val = ' checked="checked"';
                }

                echo '<input type="hidden" name="etmunfarid_etcodes_meta['. $field['id'] .']" value="off" />
                <input type="checkbox" id="'. $field['id'] .'" name="etmunfarid_etcodes_meta['. $field['id'] .']" value="on"'. $val .' /><span>'. esc_html__("Yes, please do", "munfarid") .'</span>';
			    echo '</td>';
			    break;
		}
		
		echo '</tr>';
	}
 
	echo '</table>';
}

/*===================================================================*/
/* 3. SAVING META BOXES	
/*===================================================================*/
function etmunfarid_etcodes_save_meta_box( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['etmunfarid_etcodes_meta']) || !isset($_POST['etmunfarid_etcodes_meta_box_nonce']) || !wp_verify_nonce( $_POST['etmunfarid_etcodes_meta_box_nonce'], basename( __FILE__ ) ) )
		return;
	
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
	}
 
	foreach( $_POST['etmunfarid_etcodes_meta'] as $key=>$val ){
		//update_post_meta( $post_id, $key, stripslashes(htmlspecialchars($val)) );
		update_post_meta( $post_id, $key, $val );
	}

}
add_action( 'save_post', 'etmunfarid_etcodes_save_meta_box' );

/*===================================================================*/
/* 4. SAVING IMAGES
/*===================================================================*/
function etmunfarid_etcodes_image_save() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['ids']) || !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'etcodes-ajax' ) )
		return;
	
	if ( !current_user_can( 'edit_posts' ) ) return;
 
	$ids = strip_tags(rtrim($_POST['ids'], ','));
	update_post_meta($_POST['post_id'], 'etmunfarid_etcodes_image_ids', $ids);

	$thumbs = explode(',', $ids);
	$thumbnail_output = '';
	foreach( $thumbs as $thumb ) {
		$thumbnail_output .= '<li>' . wp_get_attachment_image( $thumb, array(40,40) ) . '</li>';
	}

	echo do_shortcode($thumbnail_output);

	die();
}
add_action('wp_ajax_etmunfarid_etcodes_image_save', 'etmunfarid_etcodes_image_save');

/*===================================================================*/
/* 5. SAVING GRID FEATURE IMAGE
/*===================================================================*/
function etmunfarid_etcodes_grid_feat_image_save() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['id']) || !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'etcodes-ajax' ) )
		return;
	
	if ( !current_user_can( 'edit_posts' ) ) return;

	$id = strip_tags($_POST['id']);

	if ( !is_numeric( $id ) ) return;

	update_post_meta($_POST['post_id'], 'etmunfarid_etcodes_grid_feat_img', $id);

	$thumbnail_output .= '<li>' . wp_get_attachment_image( $id, array(40,40) ) . '</li>';

	echo do_shortcode($thumbnail_output);

	die();
}
add_action('wp_ajax_etmunfarid_etcodes_grid_feat_image_save', 'etmunfarid_etcodes_grid_feat_image_save');

/*===================================================================*/
/* 6. SCRIPTS
/*===================================================================*/
function etmunfarid_etcodes_metabox_portfolio_scripts() {
    global $post;
    $wp_version = get_bloginfo('version');
    
	wp_enqueue_script('media-upload');
	
	if( isset($post) ) {
		wp_localize_script( 'jquery', 'etmunfarid_etcodes_ajax', array(
		    'post_id' => $post->ID,
		    'nonce' => wp_create_nonce( 'etcodes-ajax' )
		) );
	}
}
add_action('admin_enqueue_scripts', 'etmunfarid_etcodes_metabox_portfolio_scripts');