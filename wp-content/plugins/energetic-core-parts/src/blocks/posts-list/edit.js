/**
 * WordPress dependencies
 */
const { Component, Fragment } = wp.element;
const {
  PanelBody,
  QueryControls,
  SelectControl,
  ToggleControl,
  Toolbar,
  ServerSideRender
} = wp.components;

const { __ } = wp.i18n;
const { InspectorControls, BlockAlignmentToolbar, BlockControls } = wp.blockEditor;
const { withSelect } = wp.data;

class PostsEdit extends Component {
  constructor() {
    super(...arguments);
  }

  render() {
    const { attributes, categoriesList, setAttributes } = this.props;
    const {
      align,
      order,
      orderBy,
      categories,
      postsToShow,
      postListType,
      duration,
      isAuthor,
      isDate,
      isCategories
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
          block="energetic-core-parts/posts-list"
          attributes={attributes}
        />
      </Fragment>
    );
  }
}

export default withSelect((select, props) => {
  const { getEntityRecords } = select("core");

  const categoriesListQuery = {
    per_page: 100
  };
  return {
    postType: "",
    categoriesList: getEntityRecords(
      "taxonomy",
      "category",
      categoriesListQuery
    )
  };
})(PostsEdit);
