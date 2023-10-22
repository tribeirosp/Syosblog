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
const { withSelect } = wp.data;

class PortfolioEdit extends Component {
  constructor() {
    super(...arguments);
  }

  render() {
    const { attributes, categoriesList, setAttributes } = this.props;
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
      portfolioStyle,
      featuredImageSizelist,
      isFeaturedImage,
      featuredImageSize,
      isCategories,
      isMorePortfolioBtn,
      morePortfolioBtnLable,
      morePortfolioBtnURL,
      portfolioStyleList
    } = attributes;

    const inspectorControls = (
      <InspectorControls>
        <PanelBody title={__("Latest Portfolio Settings", "energetic-core-parts")}>
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
                label: __("Recent Portfolio", "energetic-core-parts")
              },
              {
                value: "popular",
                label: __("Popular Portfolio", "energetic-core-parts")
              },
              {
                value: "commented",
                label: __("Most Commented Portfolio", "energetic-core-parts")
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
            value={portfolioStyle || "stander-post-style"}
            onChange={value => setAttributes({ portfolioStyle: value })}
            options={portfolioStyleList.map(({ value, label }) => ({
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
            label={__("Display categories")}
            checked={isCategories}
            onChange={value => setAttributes({ isCategories: value })}
          />
          <ToggleControl
            label={__("More Portfolio Button")}
            checked={isMorePortfolioBtn}
            onChange={value => setAttributes({ isMorePortfolioBtn: value })}
          />
          {isMorePortfolioBtn && (
            <Fragment>
              <TextControl
                label={__("More Portfolio Button Lable")}
                type="text"
                value={morePortfolioBtnLable}
                onChange={value => setAttributes({ morePortfolioBtnLable: value })}
              />
              <div className={"more-posts-btn-link"}>
                {__("More Portfolio Button Link", "energetic-core-parts")}
                <URLInput
                  value={morePortfolioBtnURL}
                  autoFocus={false}
                  onChange={value => setAttributes({ morePortfolioBtnURL: value })}
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
          block="energetic-core-parts/portfolio"
          attributes={attributes}
        />
      </Fragment>
    );
  }
}

export default withSelect((select, props) => {
  const { postsToShow, order, orderBy, categories } = props.attributes;
  const { getEntityRecords } = select("core");

  const categoriesListQuery = {
    per_page: 100
  };
  return {
    postType: "portfolio",
    categoriesList: getEntityRecords(
      "taxonomy",
      "portfolio_category",
      categoriesListQuery
    )
  };
})(PortfolioEdit);
