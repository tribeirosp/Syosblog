<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Get instagram photos
 *
 * @param string $username - instagram username
 * @param integer $items - number of photos
 */
function ecp_get_instagram_images( $username, $items = 9 ) {
	if ( false === ( $instagram = get_transient( 'instagram-photos-' . sanitize_title_with_dashes( $username ) . '-'.$items ) ) ) {
		$connect = wp_remote_get( 'http://instagram.com/' . trim( $username ) );
       
		if ( is_wp_error( $connect ) ) {
			return new \WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'sada' ) );
		}
		if ( 200 != wp_remote_retrieve_response_code( $connect ) ) {
			return new \WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'sada' ) );
		}
		$shared_data     = explode( 'window._sharedData = ', $connect['body'] );
		$instagram_json  = explode( ';</script>', $shared_data[1] );
		$instagram_array = json_decode( $instagram_json[0], true );
		if ( ! $instagram_array ) {
			return new \WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'sada' ) );
		}
        // attention on this array !
		if(isset($instagram_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'])) {
			$images = $instagram_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
		}
		else{
			return;
		}
       
		$instagram = array();
		$etsada_etcodes_count  = 0;
		foreach ( $images as $image ) {
			if ( !$image['node']['is_video']) {
				$instagram[] = array(
					'code'        => $image['node']['shortcode'],
					'link'        => $image['node']['thumbnail_src'],
				);
				$etsada_etcodes_count ++;
			}
			if ( $etsada_etcodes_count == $items ) {
				break;
			}
		};
		
		$instagram = serialize( $instagram );
		set_transient( 'instagram-photos-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
	}
	$instagram = unserialize( $instagram );
   
	return array_slice( $instagram, 0, $items );
}

function ecp_custom_block_css() {
	if(is_singular()) {
		// Custom block CSS
		$custom_css = " ";
		$bgColor = array_key_exists("bgcolor",$code) ? 'background-color:'.$code->bgcolor.';' : false;
		$custom_css .= '.'.$code->uniqueClass.' { '. $paddingTop . $paddingBottom . $paddingRight . $paddingLeft . $marginTop . $marginBottom . $bgColor . ' } ';

		wp_add_inline_style( 'energetic-core-parts', $custom_css );
	}
}

function ecp_get_image_sizes() {
	$sizes = array(
		array( 'value' => '', 'label' => 'Full Size')
	);
	foreach ( get_intermediate_image_sizes() as $_size ) {
		$label = preg_replace('/_/', ' ', $_size);
		$label = ucfirst($label);
		$sizes[] = array( 'value' => $_size, 'label' => $label);
	};
	return $sizes;
}


/********* Get an array of all footers *********/

if (!function_exists('ecp_etcodes_footers_list')):
    function ecp_etcodes_footers_list()
{
        $args = array(
            'post_type' => 'etcodes-footer',
            'numberposts' => -1,
        );
        $pages = get_posts($args);
        $result = array();
        $result['none'] = esc_html__('None', 'dabba');
        foreach ($pages as $page) {
            $result[$page->ID] = $page->post_title;
        }

        return $result;
    }

endif;