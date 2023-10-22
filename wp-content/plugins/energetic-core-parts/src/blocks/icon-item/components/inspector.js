/**
 * Internal dependencies
 */
import FontIcon from "./fonticon";

/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { InspectorControls, PanelColorSettings } = wp.blockEditor;
const { TabPanel, Button, RangeControl } = wp.components;
const { MediaUpload, URLInput } = wp.blockEditor;

/**
 * Inspector controls
 */

export default class Inspector extends Component {
  constructor(props) {
    super(...arguments);
  }

  render() {
    const { attributes, setAttributes, isSelected } = this.props;

    const {
      fonticon,
      iconImgID,
      iconImgURL,
      iconImgALT,
      url,
      iconSize,
      iconColor
    } = attributes;

    let currentIconType = iconImgID ? "customicon" : "fonticon";

    return (
      <Fragment>
        <InspectorControls>
          <TabPanel
            className="eticons-tab-panel"
            activeClass="active-tab"
            initialTabName={iconImgID ? "customicon" : "fonticon"}
            tabs={[
              {
                name: "fonticon",
                title: "Font Icons",
                className: "tab-one"
              },
              {
                name: "customicon",
                title: "Custom Icon",
                className: "tab-two"
              }
            ]}
          >
            {tabName => {
              return tabName.name == "fonticon" ? (
                <FontIcon {...this.props} />
              ) : !iconImgID ? (
                <MediaUpload
                  onSelect={img =>
                    setAttributes({
                      iconImgID: img.id,
                      iconImgURL: img.url,
                      iconImgALT: img.alt,
                      fonticon: undefined
                    })
                  }
                  type="image"
                  value={iconImgID}
                  render={({ open }) => (
                    <Button onClick={open}>
                      {__("Upload Icon", "energetic-core-parts")}
                    </Button>
                  )}
                />
              ) : (
                <div class="mediaUpload-img-selected">
                  <img src={iconImgURL} alt={iconImgALT} />
                  {isSelected ? (
                    <Button
                      className="mediaUpload-img-remove"
                      onClick={() =>
                        setAttributes({
                          iconImgID: undefined,
                          iconImgURL: undefined,
                          iconImgALT: undefined
                        })
                      }
                    >
                      <span class="dashicons dashicons-no-alt" />
                    </Button>
                  ) : null}
                </div>
              );
            }}
          </TabPanel>
          <div className={"et-icon-link"}>
            {__("Icon Link", "energetic-core-parts")}
            <URLInput
              value={url}
              autoFocus={false}
              onChange={value => setAttributes({ url: value })}
            />
          </div>

          <RangeControl
            label={__("Icon Size", "energetic-core-parts")}
            className="mt-10px"
            min={0}
            max={300}
            value={iconSize}
            onChange={value => setAttributes({ iconSize: value })}
          />

          {!iconImgID && (
            <PanelColorSettings
              title={__("Icon Color", "energetic-core-parts")}
              colorValue={iconColor}
              initialOpen={false}
              colorSettings={[
                {
                  value: iconColor,
                  onChange: Value => {
                    setAttributes({ iconColor: Value });
                  },
                  label: __("Icon Color")
                }
              ]}
            />
          )}
        </InspectorControls>
      </Fragment>
    );
  }
}
