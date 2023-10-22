<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

add_action('add_meta_boxes', 'ecp_metabox_testimonial');

function ecp_metabox_testimonial(){

$prefix = 'energetic_core_parts_';
/*===================================================================*/
/*  1 - Page Settings							   			          							
/*===================================================================*/
$meta_box = array(
    'id' => 'ecp-meta-box-testimonial',
    'title' =>  esc_html__('Testimonial Options', 'sada'),
    'page' => 'testimonial',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
			'name'		=> esc_html__('Tag/roll/location:','sada'),
			'id' 		=> $prefix.'tag',
			'type'		=> 'text',
            'desc'		=>'',
            'std' => '',
        ),
    )
);
ecp_add_meta_box( $meta_box );

}