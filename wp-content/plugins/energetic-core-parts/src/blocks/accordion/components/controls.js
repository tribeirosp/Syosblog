
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

		const {textAlign } = attributes;

		return (
			<Fragment>
				<BlockControls>
					<AlignmentToolbar
						value={ textAlign }
						onChange={ ( nextTextAlign ) => setAttributes( { textAlign: nextTextAlign } ) }
					/>
				</BlockControls>
			</Fragment>
		);
	}
}
