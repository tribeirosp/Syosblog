/**
 * Internal dependencies
 */
/**
 * WordPress dependencies
 */
const { Component, Fragment } = wp.element;
const { AlignmentToolbar, BlockControls } = wp.blockEditor;

export default class Controls extends Component {

	constructor( props ) {
		super( ...arguments );
	}

	render() {

		const {
			attributes,
			setAttributes,
		} = this.props;

		const {
			count,
			contentAlign,
		} = attributes;

		return (
			<Fragment>
				<BlockControls>
					<AlignmentToolbar
						value={ contentAlign }
						onChange={ ( nextContentAlign ) => setAttributes( { contentAlign: nextContentAlign } ) }
					/>
				</BlockControls>
			</Fragment>
		);
	}
}
