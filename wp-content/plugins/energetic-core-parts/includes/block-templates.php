<?php
function ecp_add_template_to_post_type( $args, $post_type ) {

	if ( 'post' !== $post_type ) {
		return $args;
	}

	$args['template_lock'] = true;
	$args['template']      = [
		[
			'core/image',
			[
				'align' => 'left',
			],
		],
		[
			'core/paragraph',
			[
				'placeholder' => 'The only thing you can add',
			],
		],
	];

	return $args;
}
