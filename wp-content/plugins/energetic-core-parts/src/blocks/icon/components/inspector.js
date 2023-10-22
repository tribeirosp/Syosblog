/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { InspectorControls } = wp.blockEditor;
const { RangeControl } = wp.components;

/**
 * Inspector controls
 */
export default class Inspector extends Component {

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
		} = attributes;

		return (
			<Fragment>
				<InspectorControls>
					<RangeControl
							label={ __( 'Number of Icons' ) }
							value={ count }
							onChange={ ( nextCount ) => {
								setAttributes( {
									count: nextCount,
								} );
							} }
							min={ 1 }
							max={ 25 }
					/>
				</InspectorControls>
			</Fragment>
		);
	}
};
