<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

add_action('add_meta_boxes', 'ecp_metabox_etcodes_footer');

function ecp_metabox_etcodes_footer(){

$prefix = 'energetic_core_parts_';
/*===================================================================*/
/*  1 - Page Settings							   			          							
/*===================================================================*/
$meta_box = array(
    'id' => 'ecp-meta-box-etcodes-footer',
    'title' =>  esc_html__('Footer Options', 'sada'),
    'page' => 'etcodes-footer',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => esc_html__('Footer Background Color:', 'sada'),
            'id' => $prefix.'footer_background',
            'type' => 'color',
            'desc' => esc_html__('Adjust the color for this Footer background.', 'sada'),
            'std' => '',
            'val' => ' '
        ),
        array(
            'name' => esc_html__('Display Bottom Footer area:', 'sada'),
            'id' => $prefix . 'is_bottom_footer',
            'type' => 'checkbox',
            'desc' => esc_html__('Select to display the bottom footer area.', 'sada'),
            'std' => false,
        ),
        array(
            'name' => esc_html__('Bottom Footer area Background Color:', 'sada'),
            'id' => $prefix.'bottom_footer_background',
            'type' => 'color',
            'desc' => esc_html__('Adjust the color for this Bottom Footer background.', 'sada'),
            'std' => '',
            'val' => ' '
        ),
    )
);
ecp_add_meta_box( $meta_box );

}