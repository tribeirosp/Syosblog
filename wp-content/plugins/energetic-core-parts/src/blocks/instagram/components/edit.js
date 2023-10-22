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
const {
  InspectorControls,
  BlockAlignmentToolbar,
  BlockControls,
  RichText
} = wp.blockEditor;
const { withSelect } = wp.data;

class Edit extends Component {
  constructor() {
    super(...arguments);
  }

  render() {
    const { attributes, setAttributes } = this.props;
    const {
      align,
      username,
      limit,
      isFollowButton,
      followButtonLabel
    } = attributes;

    const inspectorControls = (
      <InspectorControls>
        <PanelBody title={__("Instagram Settings", "energetic-core-parts")}>
          <TextControl
            label="Instagram Username"
            value={username}
            onChange={value => setAttributes({ username: value })}
          />
          <RangeControl
            label={__("Autoplay Timeout")}
            value={limit}
            onChange={value => {
              setAttributes({
                limit: value
              });
            }}
            min={3}
          />
          <ToggleControl
            label={__("Display Follow Button")}
            checked={isFollowButton}
            onChange={value => setAttributes({ isFollowButton: value })}
          />
          {isFollowButton && (
            <TextControl
              label="Follow Button Label"
              value={followButtonLabel}
              onChange={value => setAttributes({ followButtonLabel: value })}
            />
          )}
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
          block="energetic-core-parts/instagram"
          attributes={{
            align,
            username,
            limit,
            isFollowButton,
            followButtonLabel
          }}
        />
      </Fragment>
    );
  }
}

export default withSelect((select, props) => {})(Edit);
