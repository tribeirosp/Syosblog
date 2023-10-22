/**
 * External dependencies
 */
//  slick carousel
import "slick-carousel";

/**
 * WordPress dependencies
 */
const { Component, Fragment } = wp.element;
const {
	PanelBody,
	Placeholder,
	QueryControls,
	RangeControl,
	SelectControl,
	ToggleControl,
	TextControl,
	Toolbar,
	ServerSideRender
} = wp.components;

const { __ } = wp.i18n;
const { decodeEntities } = wp.htmlEntities;
const { InspectorControls, BlockAlignmentToolbar, BlockControls } = wp.blockEditor;
const { withSelect } = wp.data;

const apiFetch = wp.apiFetch;

const { addQueryArgs } = wp.url;

const CATEGORIES_LIST_QUERY = {
  per_page: -1,
};

class Edit extends Component {
	constructor() {
		super(...arguments);
		this.state = {
			categoriesList: [],
		};
	}

	componentWillMount() {
		this.isStillMounted = true;
		this.fetchRequest = apiFetch({
		  path: addQueryArgs(`/wp-json/wp/v2/taxonomies/member_category/`, CATEGORIES_LIST_QUERY),
		}).then(
		  (categoriesList) => {
			if (this.isStillMounted) {
			  this.setState({ categoriesList });
			}
		  }
		).catch(
		  () => {
			if (this.isStillMounted) {
			  this.setState({ categoriesList: [] });
			}
		  }
		);
	  }
	
	  componentWillUnmount() {
		this.isStillMounted = false;
	  }

	render() {
		const { attributes, setAttributes } = this.props;
		const { categoriesList } = this.state;
		const {
			align,
			order,
			orderBy,
			categories,
			postsToShow,
			postStyle,
			isAuthorImg,
			testimonialID,
			isNav,
			isDots,
			perSlideItems,
			isLoop,
			isVariableWidth,
			smartSpeed,
			isAutoplay,
			autoplayTimeout
		} = attributes;

		if (testimonialID == undefined || this.props.clientId !== testimonialID) {
			setAttributes({ testimonialID: this.props.clientId });
		}
		const updateCarousel = () => {
			let $isCarousel = null;
			if ($isCarousel) {
				jQuery(".slider-call.slick-initialized").slick("unslick");
				$isCarousel = null;
			} else {
				jQuery(".slider-call:not(.slick-initialized)").slick();
				$isCarousel = true;
			}
		};

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={__("Latest Posts Settings", "energetic-core-parts")}>
					<QueryControls
						{...{ order, orderBy }}
						numberOfItems={postsToShow}
						categoriesList={categoriesList}
						selectedCategoryId={categories}
						onOrderChange={value => setAttributes({ order: value })}
						onOrderByChange={value => setAttributes({ orderBy: value })}
						onCategoryChange={value =>
							setAttributes({ categories: "" !== value ? value : undefined })
						}
						onNumberOfItemsChange={value =>
							setAttributes({ postsToShow: value })
						}
					/>
					<SelectControl
						label={__("Select Testimonial Style", "energetic-core-parts")}
						value={postStyle || "stander-testimonial-style"}
						onChange={value => setAttributes({ postStyle: value })}
						options={[
							{
								value: "stander-testimonial-style",
								label: __("Stander Testimonial Style", "energetic-core-parts")
							}
						]}
					/>
					<ToggleControl
						label={__("Display Author Image")}
						checked={isAuthorImg}
						onChange={value => {
							setAttributes({ isAuthorImg: value });
						}}
					/>
					<ToggleControl
						label={__("Display Nav")}
						checked={isNav}
						onChange={value => setAttributes({ isNav: value })}
					/>
					<ToggleControl
						label={__("Display Pagination")}
						checked={isDots}
						onChange={value => setAttributes({ isDots: value })}
					/>
					<RangeControl
						label={__("Number of Items per slide")}
						value={perSlideItems}
						onChange={value => {
							setAttributes({
								perSlideItems: value
							});
						}}
						min={1}
						max={25}
					/>
					<ToggleControl
						label={__("Auto slide width ")}
						checked={isVariableWidth}
						onChange={value => setAttributes({ isVariableWidth: value })}
					/>
					<ToggleControl
						label={__("Loop")}
						checked={isLoop}
						onChange={value => setAttributes({ isLoop: value })}
					/>
					<RangeControl
						label={__("Number of Items per slide")}
						value={smartSpeed}
						onChange={value => {
							setAttributes({
								smartSpeed: value
							});
						}}
						min={1000}
						max={50000}
					/>
					<ToggleControl
						label={__("Autoplay")}
						checked={isAutoplay}
						onChange={value => setAttributes({ isAutoplay: value })}
					/>
					<RangeControl
						label={__("Autoplay Timeout")}
						value={autoplayTimeout}
						onChange={value => {
							setAttributes({
								autoplayTimeout: value
							});
						}}
						min={1000}
						max={50000}
					/>
				</PanelBody>
			</InspectorControls>
		);
		setTimeout(() => updateCarousel(), 2000);
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
					block="energetic-core-parts/testimonial"
					attributes={attributes}
				/>
			</Fragment>
		);
	}
}

export default Edit;