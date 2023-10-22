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
  Toolbar,
  ServerSideRender
} = wp.components;

const { __ } = wp.i18n;

const {
  InspectorControls,
  BlockAlignmentToolbar,
  BlockControls,
  URLInput
} = wp.blockEditor;

const apiFetch = wp.apiFetch;
const { addQueryArgs } = wp.url;

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
      postLayout,
      columns,
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
      isMorePostsBtn,
      morePostsBtnLable,
      morePostsBtnURL,
      postStyleList
    } = attributes;
    
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
            value={postStyle || "stander-post-style"}
            onChange={value => setAttributes({ postStyle: value })}
            options={postStyleList.map(({ value, label }) => ({
              value: value,
              label: label
            }))}
          />
          {postLayout === "grid" && (
            <RangeControl
              label={__("Columns")}
              value={columns}
              onChange={value => setAttributes({ columns: value })}
              min={2}
              max={4}
            />
          )}
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
          <ToggleControl
            label={__("More Posts Button")}
            checked={isMorePostsBtn}
            onChange={value => setAttributes({ isMorePostsBtn: value })}
          />
          {isMorePostsBtn && (
            <Fragment>
              <TextControl
                label={__("More Posts Button Lable")}
                type="text"
                value={morePostsBtnLable}
                onChange={value => setAttributes({ morePostsBtnLable: value })}
              />
              <div className={"more-posts-btn-link"}>
                {__("More Posts Button Link", "energetic-core-parts")}
                <URLInput
                  value={morePostsBtnURL}
                  autoFocus={false}
                  onChange={value => setAttributes({ morePostsBtnURL: value })}
                />
              </div>
            </Fragment>
          )}
        </PanelBody>
      </InspectorControls>
    );

    const layoutControls = [
      {
        icon: "list-view",
        title: __("List View"),
        onClick: () => setAttributes({ postLayout: "list" }),
        isActive: postLayout === "list"
      },
      {
        icon: "grid-view",
        title: __("Grid View"),
        onClick: () => setAttributes({ postLayout: "grid" }),
        isActive: postLayout === "grid"
      }
    ];

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
          <Toolbar controls={layoutControls} />
        </BlockControls>

        <ServerSideRender
          block="energetic-core-parts/posts"
          attributes={attributes}
        />
      </Fragment>
    );
  }
}

export default PostsEdit;
