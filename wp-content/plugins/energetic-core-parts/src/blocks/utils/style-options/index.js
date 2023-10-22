/**
 * Block dependencies
 */
import "./editor.scss";
import "./style.scss";
import columnIcon from "./../../../../assets/js/plugins/columns-icons";

const { __ } = wp.i18n;
const {
	MediaUpload,
	InspectorControls,
	AlignmentToolbar,
	BlockControls,
	PanelColorSettings
} = wp.blockEditor;
const {
	Button,
	RangeControl,
	RadioControl,
	PanelBody,
	IconButton,
	ButtonGroup,
	SelectControl,
	Toolbar
} = wp.components;
const { Fragment } = wp.element;
const { createHigherOrderComponent } = wp.compose;
const {
	hasBlockSupport,
	parseWithAttributeSchema,
	getSaveContent,
	getBlockSupport
} = wp.blocks;

var el = wp.element.createElement;

function addAttribute(settings) {
	// Use Lodash's assign to gracefully handle if attributes are undefined

	settings.attributes = lodash.assign(settings.attributes, {
		paddingTop: {
			type: "number"
		},
		paddingBottom: {
			type: "number"
		},
		paddingLeft: {
			type: "number"
		},
		paddingRight: {
			type: "number"
		},
		marginTop: {
			type: "number"
		},
		marginBottom: {
			type: "number"
		},
		backgroundImage: {
			type: "string"
		},
		backgroundImageID: {
			type: "number"
		},
		bgImgSize: {
			type: "string"
		},
		bgImgPosition: {
			type: "string"
		},
		bgImgAttachment: {
			type: "string"
		},
		bgImgRepeat: {
			type: "string"
		},
		bgImgOpacity: {
			type: "number"
		},
		backgroundColor: {
			type: "string"
		},
		columnsLayout: {
			type: "string"
		},
		columnsGutter: {
			type: "string"
		},
		verticalAlign: {
			type: "string"
		}
	});
	
	return settings;
}

const withInspectorControls = createHigherOrderComponent(BlockEdit => {
	function spacing_options(props) {
		if (props.name !== "energetic-core-parts/icon-item") {
			return (
				<PanelBody
					title={__("Spacing Options", "energetic-core-parts")}
					initialOpen={false}
				>
					<RangeControl
						label={__("Padding Top", "energetic-core-parts")}
						value={props.attributes.paddingTop || ""}
						onChange={paddingTop => {
							props.setAttributes({
								paddingTop: paddingTop
							});
						}}
						initialPosition={1}
						max={1000}
					/>
					<RangeControl
						label={__("Padding Bottom", "energetic-core-parts")}
						value={props.attributes.paddingBottom || ""}
						onChange={paddingBottom => {
							props.setAttributes({
								paddingBottom: paddingBottom
							});
						}}
						initialPosition={1}
						max={1000}
					/>
					<RangeControl
						label={__("Padding Left", "energetic-core-parts")}
						value={props.attributes.paddingLeft || ""}
						onChange={paddingLeft => {
							props.setAttributes({
								paddingLeft: paddingLeft
							});
						}}
						initialPosition={1}
						max={1000}
					/>
					<RangeControl
						label={__("Padding Right", "energetic-core-parts")}
						value={props.attributes.paddingRight || ""}
						onChange={paddingRight => {
							props.setAttributes({
								paddingRight: paddingRight
							});
						}}
						initialPosition={1}
						max={1000}
					/>
					<RangeControl
						label={__("Margin Top", "energetic-core-parts")}
						value={props.attributes.marginTop || ""}
						onChange={marginTop => {
							props.setAttributes({
								marginTop: marginTop
							});
						}}
						initialPosition={1}
						max={1000}
					/>
					<RangeControl
						label={__("Margin Bottom", "energetic-core-parts")}
						value={props.attributes.marginBottom || ""}
						onChange={marginBottom => {
							props.setAttributes({
								marginBottom: marginBottom
							});
						}}
						initialPosition={1}
						max={1000}
					/>
				</PanelBody>
			);
		}
	}

	function background_options(props) {
		var allowedBlocks = [
			"woocommerce/columns",
			"woocommerce/column",
			"core/media-text",
			"core/paragraph",
			"core/cover"
		];

		if (allowedBlocks.indexOf(props.name) === -1) {
			return (
				<PanelBody
					title={__("Background Options", "energetic-core-parts")}
					initialOpen={false}
				>
					<p>{__("Select a background image:", "energetic-core-parts")}</p>
					{!props.attributes.backgroundImageID ? (
						<MediaUpload
							onSelect={img => {
								console.log(img);
								props.setAttributes({
									backgroundImage: img.url,
									backgroundImageID: img.id
								});
							}}
							type="image"
							value={props.attributes.backgroundImageID}
							render={({ open }) => (
								<Button
									className={
										"button button-large dashicons-before dashicons-format-image mb-15px"
									}
									onClick={open}
								>
									{__(" Select Image", "energetic-core-parts")}
								</Button>
							)}
						/>
					) : (
						<div class="bgimg-wrapper">
							<img src={props.attributes.backgroundImage} />

							{props.attributes.backgroundImage ? (
								<Fragment>
									<Button
										className="remove-image"
										onClick={() => {
											props.setAttributes({
												backgroundImageID: null,
												backgroundImage: null
											});
										}}
									>
										<span class="dashicons dashicons-no-alt" />
									</Button>
									{/* <RangeControl
										min={0}
										max={100}
										label={__('Bg Image Opacity', 'energetic-core-parts')}
										value={props.attributes.bgImgOpacity || ''}
										onChange={bgImgOpacity => {
											props.setAttributes({
												bgImgOpacity: bgImgOpacity
											});
										}}
									/> */}
									<SelectControl
										label={__("Background Image Size")}
										value={props.attributes.bgImgSize}
										options={[
											{ value: "", label: __("Initial") },
											{ value: "cover", label: __("Cover") },
											{ value: "contain", label: __("Contain") },
											{ value: "auto", label: __("Auto") }
										]}
										onChange={value =>
											props.setAttributes({ bgImgSize: value })
										}
									/>
									<SelectControl
										label={__("Background Image Position")}
										value={props.attributes.bgImgPosition}
										options={[
											{ value: "", label: __("Initial") },
											{ value: "center top", label: __("Center Top") },
											{ value: "center center", label: __("Center Center") },
											{ value: "center bottom", label: __("Center Bottom") },
											{ value: "left top", label: __("Left Top") },
											{ value: "left center", label: __("Left Center") },
											{ value: "left bottom", label: __("Center Bottom") },
											{ value: "right top", label: __("Right Top") },
											{ value: "right center", label: __("Right Center") },
											{ value: "right bottom", label: __("Right Bottom") }
										]}
										onChange={value =>
											props.setAttributes({ bgImgPosition: value })
										}
									/>
									<SelectControl
										label={__("Background Image Repeat")}
										value={props.attributes.bgImgRepeat}
										options={[
											{ value: "", label: __("Initial") },
											{ value: "no-repeat", label: __("No Repeat") },
											{ value: "repeat", label: __("Repeat") },
											{ value: "repeat-x", label: __("Repeat-x") },
											{ value: "repeat-y", label: __("Repeat-y") }
										]}
										onChange={value =>
											props.setAttributes({ bgImgRepeat: value })
										}
									/>
									<SelectControl
										label={__("Background Image Attachment")}
										value={props.attributes.bgImgAttachment}
										options={[
											{ value: "", label: __("Initial") },
											{ value: "scroll", label: __("Scroll") },
											{ value: "fixed", label: __("Fixed") }
										]}
										onChange={value =>
											props.setAttributes({ bgImgAttachment: value })
										}
									/>
								</Fragment>
							) : null}
						</div>
					)}

					<PanelColorSettings
						title={__("Background Color", "energetic-core-parts")}
						colorValue={props.attributes.backgroundColor || ""}
						initialOpen={false}
						colorSettings={[
							{
								value: props.attributes.backgroundColor || "",
								onChange: Value => {
									props.setAttributes({ backgroundColor: Value });
								},
								label: __("Background Color")
							}
						]}
					/>
				</PanelBody>
			);
		}
	}

	function column_options(props) {
		if (props.name == "core/columns") {
			const columnsLayout = props.attributes.columnsLayout;
			let columnsLayoutOptions = "";
			if (props.attributes.columns == 2) {
				props.setAttributes({
					columnsLayout:
						columnsLayout == "twoEqual" ||
						columnsLayout == "two_66_33" ||
						columnsLayout == "two_33_66"
							? columnsLayout
							: "twoEqual"
				});

				columnsLayoutOptions = (
					<ButtonGroup className="et-column-btns">
						<IconButton
							icon={columnIcon.twoEqual}
							label="Two Equal"
							className={
								columnsLayout == "twoEqual"
									? "twoEqual selected-columns-layout"
									: "twoEqual "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "twoEqual"
								});
							}}
						/>

						<IconButton
							icon={columnIcon.two_66_33}
							label="Two 66/33"
							className={
								columnsLayout == "two_66_33"
									? "two_66_33 selected-columns-layout"
									: "two_66_33 "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "two_66_33"
								});
							}}
						/>

						<IconButton
							icon={columnIcon.two_33_66}
							label="Two 33/66"
							className={
								columnsLayout == "two_33_66"
									? "two_33_66 selected-columns-layout"
									: "two_33_66 "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "two_33_66"
								});
							}}
						/>
					</ButtonGroup>
				);
			} else if (props.attributes.columns == 3) {
				props.setAttributes({
					columnsLayout:
						columnsLayout == "threeEqual" ||
						columnsLayout == "three_50_25_25" ||
						columnsLayout == "three_25_25_50" ||
						columnsLayout == "three_25_50_25" ||
						columnsLayout == "three_20_60_20"
							? columnsLayout
							: "threeEqual"
				});

				columnsLayoutOptions = (
					<ButtonGroup className="et-column-btns">
						<IconButton
							icon={columnIcon.threeEqual}
							label="Three Equal"
							className={
								columnsLayout == "threeEqual"
									? "threeEqual selected-columns-layout"
									: "threeEqual "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "threeEqual"
								});
							}}
						/>

						<IconButton
							icon={columnIcon.three_50_25_25}
							label="Three 50/25/25"
							className={
								columnsLayout == "three_50_25_25"
									? "three_50_25_25 selected-columns-layout"
									: "three_50_25_25 "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "three_50_25_25"
								});
							}}
						/>

						<IconButton
							icon={columnIcon.three_25_25_50}
							label="Three 25/25/50"
							className={
								columnsLayout == "three_25_25_50"
									? "three_25_25_50 selected-columns-layout"
									: "three_25_25_50 "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "three_25_25_50"
								});
							}}
						/>

						<IconButton
							icon={columnIcon.three_25_50_25}
							label="Three 25/50/25"
							className={
								columnsLayout == "three_25_50_25"
									? "three_25_50_25 selected-columns-layout"
									: "three_25_50_25 "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "three_25_50_25"
								});
							}}
						/>

						<IconButton
							icon={columnIcon.three_20_60_20}
							label="Three 20/60/20"
							className={
								columnsLayout == "three_20_60_20"
									? "three_20_60_20 selected-columns-layout"
									: "three_20_60_20 "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "three_20_60_20"
								});
							}}
						/>
					</ButtonGroup>
				);
			} else if (props.attributes.columns == 4) {
				props.setAttributes({
					columnsLayout:
						columnsLayout == "fourEqual" ||
						columnsLayout == "four_40_20_20_20" ||
						columnsLayout == "four_20_20_20_40"
							? columnsLayout
							: "fourEqual"
				});

				columnsLayoutOptions = (
					<ButtonGroup className="et-column-btns">
						<IconButton
							icon={columnIcon.fourEqual}
							label="Four Equal"
							className={
								columnsLayout == "fourEqual"
									? "fourEqual selected-columns-layout"
									: "fourEqual "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "fourEqual"
								});
							}}
						/>

						<IconButton
							icon={columnIcon.four_40_20_20_20}
							label="Four 40/20/20/20"
							className={
								columnsLayout == "four_40_20_20_20"
									? "four_40_20_20_20 selected-columns-layout"
									: "four_40_20_20_20 "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "four_40_20_20_20"
								});
							}}
						/>

						<IconButton
							icon={columnIcon.four_20_20_20_40}
							label="Four 20/20/20/40"
							className={
								columnsLayout == "four_20_20_20_40"
									? "four_20_20_20_40 selected-columns-layout"
									: "four_20_20_20_40 "
							}
							onClick={() => {
								props.setAttributes({
									columnsLayout: "four_20_20_20_40"
								});
							}}
						/>
					</ButtonGroup>
				);
			} else {
				props.setAttributes({
					columnsLayout: undefined
				});
			}

			return (
				<Fragment>
					{columnsLayoutOptions}
					<SelectControl
						label={__("Column Gutter", "energetic-core-parts")}
						value={props.attributes.columnsGutter || "30"}
						onChange={value => props.setAttributes({ columnsGutter: value })}
						options={[
							{
								value: "0",
								label: __("No Gutters", "energetic-core-parts")
							},
							{
								value: "5",
								label: __("Extra small gutters 5px", "energetic-core-parts")
							},
							{
								value: "10",
								label: __("Small gutters 10px", "energetic-core-parts")
							},
							{
								value: "30",
								label: __("Predefined gutters 30px", "energetic-core-parts")
							},
							{
								value: "50",
								label: __("large gutters 50px", "energetic-core-parts")
							}
						]}
					/>
				</Fragment>
			);
		}
	}

	function vertical_align_options(props) {
		if (props.name == "core/columns") {
			return (
				<Toolbar>
					<ButtonGroup className="et-vertical-align-btns">
						<IconButton
							icon={columnIcon.verticalAlignTop}
							label="Vertical Align Top"
							className={
								props.attributes.verticalAlign == "verticalAlignTop"
									? "components-toolbar__control is-active"
									: "components-toolbar__control"
							}
							onClick={() => {
								props.setAttributes({
									verticalAlign:
										props.attributes.verticalAlign == "verticalAlignTop"
											? undefined
											: "verticalAlignTop"
								});
							}}
						/>
						<IconButton
							icon={columnIcon.verticalAlignMiddle}
							label="Vertical Align Middle"
							className={
								props.attributes.verticalAlign == "verticalAlignMiddle"
									? "components-toolbar__control is-active"
									: "components-toolbar__control"
							}
							onClick={() => {
								props.setAttributes({
									verticalAlign:
										props.attributes.verticalAlign == "verticalAlignMiddle"
											? undefined
											: "verticalAlignMiddle"
								});
							}}
						/>
						<IconButton
							icon={columnIcon.verticalAlignBottom}
							label="Vertical Align Bottom"
							className={
								props.attributes.verticalAlign == "verticalAlignBottom"
									? "components-toolbar__control is-active"
									: "components-toolbar__control"
							}
							onClick={() => {
								props.setAttributes({
									verticalAlign:
										props.attributes.verticalAlign == "verticalAlignBottom"
											? undefined
											: "verticalAlignBottom"
								});
							}}
						/>
					</ButtonGroup>
				</Toolbar>
			);
		}
	}

	return props => {
		return (
			<Fragment>
				<BlockEdit {...props} />

				<BlockControls>{vertical_align_options(props)}</BlockControls>

				<InspectorControls>
					<PanelBody>
						{column_options(props)}
						{spacing_options(props)}
						{background_options(props)}
					</PanelBody>
				</InspectorControls>
			</Fragment>
		);
	};
}, "withInspectorControl");

//  withDivStyle editor
const withDivStyle = createHigherOrderComponent(BlockListBlock => {
	return props => {
		let divStyle = {
			paddingTop: props.block.attributes.paddingTop,
			paddingBottom: props.block.attributes.paddingBottom,
			paddingLeft: props.block.attributes.paddingLeft,
			paddingRight: props.block.attributes.paddingRight,
			marginTop: props.block.attributes.marginTop,
			marginBottom: props.block.attributes.marginBottom,
			backgroundColor: props.block.attributes.backgroundColor,
			backgroundImage: props.block.attributes.backgroundImage
				? 'url("' + props.block.attributes.backgroundImage + '")'
				: undefined,
			backgroundSize: props.block.attributes.bgImgSize
				? props.block.attributes.bgImgSize
				: undefined,
			backgroundPosition: props.block.attributes.bgImgPosition
				? props.block.attributes.bgImgPosition
				: undefined,
			backgroundRepeat: props.block.attributes.bgImgRepeat
				? props.block.attributes.bgImgRepeat
				: undefined,
			backgroundAttachment: props.block.attributes.bgImgAttachment
				? props.block.attributes.bgImgAttachment
				: undefined
		};

		let wrapperProps = props.wrapperProps;

		if (props.block.name !== "core/columns") {
			wrapperProps = {
				...wrapperProps,
				style: divStyle
			};
		} else {
			wrapperProps = {
				...wrapperProps,
				style: divStyle,
				"data-columns-layout": props.block.attributes.columnsLayout,
				"data-vertical-align-layout": props.block.attributes.verticalAlign,
				"data-columns-gutter":
					props.block.attributes.columnsGutter !== "30"
						? props.block.attributes.columnsGutter
						: undefined
			};
		}

		return <BlockListBlock {...props} wrapperProps={wrapperProps} />;
	};
}, "withDivStyle");

// addDivStyle to save content
export function addDivStyle(props, blockType, attributes) {
	if (blockType.name == "core/more") {
		return null;
	}

	let divStyle = {
		paddingTop: attributes.paddingTop,
		paddingBottom: attributes.paddingBottom,
		paddingLeft: attributes.paddingLeft,
		paddingRight: attributes.paddingRight,
		marginTop: attributes.marginTop,
		marginBottom: attributes.marginBottom,
		backgroundColor: attributes.backgroundColor,
		backgroundImage: attributes.backgroundImage
			? 'url("' + attributes.backgroundImage + '")'
			: undefined,
		backgroundImage: attributes.backgroundImage
			? 'url("' + attributes.backgroundImage + '")'
			: undefined,
		backgroundSize: attributes.bgImgSize ? attributes.bgImgSize : undefined,
		backgroundPosition: attributes.bgImgPosition
			? attributes.bgImgPosition
			: undefined,
		backgroundRepeat: attributes.bgImgRepeat
			? attributes.bgImgRepeat
			: undefined,
		backgroundAttachment: attributes.bgImgAttachment
			? attributes.bgImgAttachment
			: undefined
	};
	if (blockType.name == "core/media-text") {
		divStyle["backgroundColor"] = attributes.customBackgroundColor;
	}
	if (blockType.name == "core/cover") {
		divStyle["backgroundImage"] = 'url("' + attributes.url + '")';
	}
	const divStyleConcat = { ...props.style, ...divStyle };

	if (blockType.name !== "core/columns") {
		return lodash.assign(props, {
			style: divStyleConcat
		});
	} else {
		return lodash.assign(props, {
			style: divStyleConcat,
			"data-columns-layout": attributes.columnsLayout,
			"data-vertical-align-layout": attributes.verticalAlign,
			"data-columns-gutter":
				attributes.columnsGutter !== "30" ? attributes.columnsGutter : undefined
		});
	}
}

wp.hooks.addFilter(
	"blocks.registerBlockType",
	"energetic-core-parts/etcodes-div-style/attribute",
	addAttribute
);

wp.hooks.addFilter(
	"editor.BlockEdit",
	"energetic-core-parts/etcodes-div-style/with-inspector-control",
	withInspectorControls
);

wp.hooks.addFilter(
	"editor.BlockListBlock",
	"energetic-core-parts/etcodes-div-style/with-div-style",
	withDivStyle
);

wp.hooks.addFilter(
	"blocks.getSaveContent.extraProps",
	"energetic-core-parts/etcodes-div-style/save-props",
	addDivStyle
);

// Custom supports settings
function addCustomSupportSettings(settings, name) {
	var allowedBlocks = ["woocommerce/products", "core/shortcode"];

	if (allowedBlocks.indexOf(name) === -1) {
		return settings;
	}

	return lodash.assign({}, settings, {
		supports: lodash.assign({}, settings.supports, {
			align: ["wide", "full"]
		})
	});
}

wp.hooks.addFilter(
	"blocks.registerBlockType",
	"my-plugin/class-names/list-block",
	addCustomSupportSettings
);
