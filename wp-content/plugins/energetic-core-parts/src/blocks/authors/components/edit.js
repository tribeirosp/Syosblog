/**
 * WordPress dependencies
 */
const { Component, Fragment } = wp.element;
const {
	PanelBody,
	RangeControl,
	SelectControl,
	ToggleControl,
	TextControl,
	ServerSideRender
} = wp.components;

const { __ } = wp.i18n;
const {
	InspectorControls,
	BlockAlignmentToolbar,
	PanelColorSettings,
	BlockControls
} = wp.blockEditor;
const { withSelect } = wp.data;

class Edit extends Component {
	constructor() {
		super(...arguments);
	}

	render() {
		const { attributes, authorsList, setAttributes } = this.props;
		const {
			align,
			isFeaturedImage,
			isDescription,
			authorsToShow,
			authorsOffset,
			entryStyle,
			isTopauthors,
			isPostCounts,
			readMoreText,
			columns
		} = attributes;

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={__("Latest Posts Settings", "energetic-core-parts")}>
					<SelectControl
						label={__("Select Style", "energetic-core-parts")}
						value={entryStyle || "simple-style"}
						onChange={value => setAttributes({ entryStyle: value })}
						options={[
							{
								value: "simple-style",
								label: __("Simple", "energetic-core-parts")
							},
							{
								value: "list-style",
								label: __("List", "energetic-core-parts")
							}
						]}
					/>
					<RangeControl
						label={__("Columns")}
						value={columns}
						onChange={value => setAttributes({ columns: value })}
						min={1}
						max={4}
					/>
					<RangeControl
						label={__("Number of items")}
						value={authorsToShow}
						onChange={value => setAttributes({ authorsToShow: value })}
						min={1}
					/>
					<RangeControl
						label={__("authors Offset")}
						value={authorsOffset}
						onChange={value => setAttributes({ authorsOffset: value })}
						min={0}
					/>
					<ToggleControl
						label={__("Order By author with higher No of post")}
						checked={isTopauthors}
						onChange={value => setAttributes({ isTopauthors: value })}
					/>
					<ToggleControl
						label={__("Display Author Picture")}
						checked={isFeaturedImage}
						onChange={value => setAttributes({ isFeaturedImage: value })}
					/>
					<ToggleControl
						label={__("Show Description")}
						checked={isDescription}
						onChange={value => setAttributes({ isDescription: value })}
					/>
					<ToggleControl
						label={__("Show Post Counts")}
						checked={isPostCounts}
						onChange={value => setAttributes({ isPostCounts: value })}
					/>
					{isPostCounts && (
						<TextControl
							label={__("Customize Post published label")}
							type="text"
							value={readMoreText}
							onChange={value => setAttributes({ readMoreText: value })}
						/>
					)}
					<ToggleControl
						label={__("Show Author Website URL")}
						checked={isPostCounts}
						onChange={value => setAttributes({ isAuthorWebsite: value })}
					/>
				</PanelBody>
			</InspectorControls>
		);

		return (
			<Fragment>
				{inspectorControls}
				<BlockControls>
					<BlockAlignmentToolbar
						value={align}
						onChange={nextAlign => {
							setAttributes({ align: nextAlign });
						}}
						controls={["wide", "full"]}
					/>
				</BlockControls>

				<ServerSideRender
					block="energetic-core-parts/authors"
					attributes={attributes}
				/>
			</Fragment>
		);
	}
}

export default withSelect((select, props) => {})(Edit);
