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
	QueryControls,
	RangeControl,
	SelectControl,
	ToggleControl,
	TextControl,
	ServerSideRender
} = wp.components;

const { __ } = wp.i18n;

const apiFetch = wp.apiFetch;
const { addQueryArgs } = wp.url;

const { InspectorControls, BlockAlignmentToolbar, BlockControls } = wp.blockEditor;

const { withSelect } = wp.data;

/**
 * Module Constants
 */
const CATEGORIES_LIST_QUERY = {
	per_page: -1,
};

class PostsEdit extends Component {
	constructor() {
		super(...arguments);
		this.state = {
			categoriesList: [],
		};
	}

	componentDidMount() {
		this.isStillMounted = true;
		this.fetchRequest = apiFetch( {
			path: addQueryArgs( `/wp/v2/categories`, CATEGORIES_LIST_QUERY ),
		} )
			.then( ( categoriesList ) => {
				if ( this.isStillMounted ) {
					this.setState( { categoriesList } );
				}
			} )
			.catch( () => {
				if ( this.isStillMounted ) {
					this.setState( { categoriesList: [] } );
				}
			} );
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
			postListType,
			duration,
			categories,
			postsToShow,
			postStyle,
			featuredImageSizelist,
			isFeaturedImage,
			featuredImageSize,
			isAuthor,
			isDate,
			isCategories,
			isCommentsCounter,
			isExcerpt,
			excerptLength,
			isReadMore,
			readMoreText,
			postStyleList,
			isNav,
			isDots,
			isVariableWidth,
			perSlideItems,
			isLoop,
			smartSpeed,
			isAutoplay,
			autoplayTimeout
		} = attributes;


		const updateCarousel = () => {

				let $isCarousel = null;
				if ($isCarousel) {
					jQuery(".slider-call.slick-initialized").slick('unslick')
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
						label={__("Select Sort Type", "energetic-core-parts")}
						value={postListType || "recent"}
						onChange={value => setAttributes({ postListType: value })}
						options={[
							{
								value: "recent",
								label: __("Recent Posts", "energetic-core-parts")
							},
							{
								value: "popular",
								label: __("Popular Posts", "energetic-core-parts")
							},
							{
								value: "commented",
								label: __("Most Commented Posts", "energetic-core-parts")
							}
						]}
					/>
					<SelectControl
						label={__("Select Duration", "energetic-core-parts")}
						value={duration || ""}
						onChange={value => setAttributes({ duration: value })}
						options={[
							{ value: "", label: __("All time", "energetic-core-parts") },
							{ value: "7", label: __("1 Week", "energetic-core-parts") },
							{ value: "30", label: __("1 Month", "energetic-core-parts") },
							{ value: "90", label: __("2 Month", "energetic-core-parts") },
							{ value: "180", label: __("6 Month", "energetic-core-parts") },
							{ value: "360", label: __("1 Year", "energetic-core-parts") }
						]}
					/>
					<SelectControl
						label={__("Select Post Style", "energetic-core-parts")}
						value={postStyle || "card-post-carousel-style"}
						onChange={value => setAttributes({ postStyle: value })}
						options={postStyleList.map(({ value, label }) => ({
							value: value,
							label: label
						}))}
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
						label={__("Display author name")}
						checked={isAuthor}
						onChange={value => setAttributes({ isAuthor: value })}
					/>
					<ToggleControl
						label={__("Display post Date")}
						checked={isDate}
						onChange={value => setAttributes({ isDate: value })}
					/>
					<ToggleControl
						label={__("Display categories")}
						checked={isCategories}
						onChange={value => setAttributes({ isCategories: value })}
					/>
					<ToggleControl
						label={__("Display comments counter")}
						checked={isCommentsCounter}
						onChange={value => setAttributes({ isCommentsCounter: value })}
					/>
					<ToggleControl
						label={__("Display Post Excerpt")}
						checked={isExcerpt}
						onChange={value => setAttributes({ isExcerpt: value })}
					/>
					{isExcerpt && (
						<RangeControl
							label={__("Excerpt length")}
							value={excerptLength}
							onChange={value => setAttributes({ excerptLength: value })}
							min={10}
						/>
					)}
					<ToggleControl
						label={__("Display read more button")}
						checked={isReadMore}
						onChange={value => setAttributes({ isReadMore: value })}
					/>
					{isReadMore && (
						<TextControl
							label={__("Customize Read More Text")}
							type="text"
							value={readMoreText}
							onChange={value => setAttributes({ readMoreText: value })}
						/>
					)}
				</PanelBody>
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
					block="energetic-core-parts/posts-carousel"
					attributes={attributes}
				/>
			</Fragment>
		);
	}
}

export default PostsEdit;