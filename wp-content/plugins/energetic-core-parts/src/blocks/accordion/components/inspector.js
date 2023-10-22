/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { InspectorControls, PanelColorSettings } = wp.blockEditor;
const { PanelBody,  ToggleControl } = wp.components;

/**
 * Inspector controls
 */
export default class Inspector extends Component {
  constructor(props) {
    super(...arguments);
  }

  render() {
    const { attributes, setAttributes } = this.props;

    const {
      open,
      titleBackgroundColor,
      titleColor,
      backgroundColor,
      textColor
    } = attributes;

    return (
      <Fragment>
        <InspectorControls>
          <PanelBody title={__("Accordion Settings")}>
            <ToggleControl
              label={__("Display Open")}
              checked={!!open}
              onChange={() => setAttributes({ open: !open })}
            />
          </PanelBody>

          <PanelColorSettings
            title={__("Title Background Color", "energetic-core-parts")}
            colorValue={titleBackgroundColor}
            initialOpen={false}
            colorSettings={[
              {
                value: titleBackgroundColor,
                onChange: Value => {
                  setAttributes({ titleBackgroundColor: Value });
                },
                label: __("Title Background Color")
              }
            ]}
          />

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
        </InspectorControls>
      </Fragment>
    );
  }
}
