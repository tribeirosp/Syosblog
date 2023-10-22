/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { BlockControls } = wp.blockEditor;
const { Toolbar } = wp.components;

class Controls extends Component {

	constructor( props ) {
		super( ...arguments );
	}

	render() {

		const {
			attributes,
			setAttributes,
		} = this.props;

		const {
			open,
		} = attributes;

		const customControls = [
			{
				icon: '',
				title: __( 'Display open' ),
				onClick: () => setAttributes( {  open: ! open } ),
				isActive: open === true,
			}
		];

		return (
			<Fragment>
				<BlockControls>
					<Toolbar className="components-toolbar__block-energetic-core-parts-accordion" controls={ customControls } />
				</BlockControls>
			</Fragment>
		);
	}
}

export default Controls;