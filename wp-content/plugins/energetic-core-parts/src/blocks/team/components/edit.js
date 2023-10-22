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
      isCategories,
      isDescription,
      columns,
      titleColor,
      tagColor,
      textColor,
      backgroundColor
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
            label={__("Select Style", "energetic-core-parts")}
            value={postStyle || "stander-team-style"}
            onChange={value => setAttributes({ postStyle: value })}
            options={[
              {
                value: "stander-team-style",
                label: __("Stander Style", "energetic-core-parts")
              },
              {
                value: "card-style",
                label: __("Card Style", "energetic-core-parts")
              }
            ]}
          />
          <RangeControl
            label={__("Columns")}
            value={columns}
            onChange={value => setAttributes({ columns: value })}
            min={2}
            max={4}
          />
          <ToggleControl
            label={__("Display categories")}
            checked={isCategories}
            onChange={value => setAttributes({ isCategories: value })}
          />
          <ToggleControl
            label={__("Display Description")}
            checked={isDescription}
            onChange={value => setAttributes({ isDescription: value })}
          />
        </PanelBody>
        <PanelColorSettings
          title={__("Name Color", "energetic-core-parts")}
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
          title={__("Role Color", "energetic-core-parts")}
          colorValue={tagColor}
          initialOpen={false}
          colorSettings={[
            {
              value: tagColor,
              onChange: Value => {
                setAttributes({ tagColor: Value });
              },
              label: __("Role Color")
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

        {postStyle === "card-style" && (
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
          block="energetic-core-parts/team"
          attributes={{
            align,
            order,
            orderBy,
            categories,
            postsToShow,
            postStyle,
            isCategories,
            isDescription,
            columns,
            titleColor,
            tagColor,
            textColor,
            backgroundColor
          }}
        />
      </Fragment>
    );
  }
}

export default Edit;