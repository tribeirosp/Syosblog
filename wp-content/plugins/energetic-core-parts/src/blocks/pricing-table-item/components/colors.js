/**
 * WordPress dependencies
 */
const { withColors } = wp.blockEditor;

/**
 * Generate block colors.
 */
const Colors = withColors(
	'backgroundColor',
	{ buttonBackground: 'background-color' },
	{ buttonColor: 'color' },
	{ tableBackground: 'background-color' },
	{ tableColor: 'color' },
);

export default Colors;