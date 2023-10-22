/**
 * WordPress dependencies
 */
const { getCategories, setCategories } = wp.blocks;

setCategories( [
	// Add a ET blocks block category
	{
		slug: 'etblocks',
		title: 'ET Blocks',
		icon: '',
	},
	...getCategories().filter( ( { slug } ) => slug !== 'etblocks' ),
] );
