/**
 * WordPress dependencies
 */
const { Component, Fragment } = wp.element;
const {
	PanelBody,
	RangeControl,
	SelectControl,
	ToggleControl,
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
		const { attributes, categoriesList, setAttributes } = this.props;
		const {
			align,
			featuredImageSizelist,
			isFeaturedImage,
			featuredImageSize,
			isDescription,
			categoriesToShow,
			categoriesOffset,
			cardStyle,
			isTopCategories,
			isPostCounts,
			columns,
			titleColor,
			textColor,
			backgroundColor
		} = attributes;

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={__("Latest Posts Settings", "energetic-core-parts")}>
					<RangeControl
						label={__("Number of items")}
						value={categoriesToShow}
						onChange={value => setAttributes({ categoriesToShow: value })}
						min={1}
					/>
					<RangeControl
						label={__("Categories Offset")}
						value={categoriesOffset}
						onChange={value => setAttributes({ categoriesOffset: value })}
						min={0}
					/>
					<ToggleControl
						label={__("Order By Top Categories")}
						checked={isTopCategories}
						onChange={value => setAttributes({ isTopCategories: value })}
					/>
					<ToggleControl
						label={__("Display Featured Image")}
						checked={isFeaturedImage}
						onChange={value => setAttributes({ isFeaturedImage: value })}
					/>
					{isFeaturedImage && (
						<SelectControl
							label={__("Select Image Size", "energetic-core-parts")}
							value={featuredImageSize}
							onChange={value => setAttributes({ featuredImageSize: value })}
							options={featuredImageSizelist.map(({ value, label }) => ({
								value: value,
								label: label
							}))}
						/>
					)}
					<ToggleControl
						label={__("Show Post Counts")}
						checked={isPostCounts}
						onChange={value => setAttributes({ isPostCounts: value })}
					/>
					<ToggleControl
						label={__("Show Description")}
						checked={isDescription}
						onChange={value => setAttributes({ isDescription: value })}
					/>
					<SelectControl
						label={__("Select Style", "energetic-core-parts")}
						value={cardStyle || "boxed-style"}
						onChange={value => setAttributes({ cardStyle: value })}
						options={[
							{
								value: "simple-style",
								label: __("Simple", "energetic-core-parts")
							},
							{
								value: "boxed-style",
								label: __("Boxed", "energetic-core-parts")
							},
							{
								value: "card-overlay-style",
								label: __("Overlay", "energetic-core-parts")
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
				</PanelBody>
				<PanelColorSettings
					title={__("Title Color", "energetic-core-parts")}
					colorValue={titleColor}
					initialOpen={false}
					colorSettings={[
						{
							value: titleColor,
							onChange: Value => {
								setAttributes({ titleColor: Value });
							},
							label: __("Title Color")
						}
					]}
				/>

				<PanelColorSettings
					title={__("Text Color", "energetic-core-parts")}
					colorValue={textColor}
					initialOpen={false}
					colorSettings={[
						{
							value: textColor,
							onChange: Value => {
								setAttributes({ textColor: Value });
							},
							label: __("Text Color")
						}
					]}
				/>

				{cardStyle === "card-style" && (
					<PanelColorSettings
						title={__("Background Color", "energetic-core-parts")}
						colorValue={backgroundColor}
						initialOpen={false}
						colorSettings={[
							{
								value: backgroundColor,
								onChange: Value => {
									setAttributes({ backgroundColor: Value });
								},
								label: __("Background Color")
							}
						]}
					/>
				)}
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
					block="energetic-core-parts/categories"
					attributes={attributes}
				/>
			</Fragment>
		);
	}
}

export default withSelect((select, props) => {})(Edit);
