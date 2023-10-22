/**
 * External dependencies
 */
import classnames from "classnames";

/**
 * Internal dependencies
 */
import "./styles/editor.scss";
import "./styles/style.scss";
import Edit from "./components/edit";

/**
 * WordPress dependencies
 */
const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { RichText, getColorClassName, getFontSizeClass } = wp.blockEditor;

/**
 * Block constants
 */

const blockAttributes = {
  title: {
    type: "string",
    selector: ".wp-block-energetic-core-parts-accordion__title"
  },
  content: {
    type: "array",
    selector: ".wp-block-energetic-core-parts-accordion-item__text",
    source: "children"
  },
  open: {
    type: "boolean",
    default: false
  },
  backgroundColor: {
    type: "string"
  },
  textColor: {
    type: "string"
  },
  customBackgroundColor: {
    type: "string"
  },
  customTextColor: {
    type: "string"
  }
};

const name = 'accordion-item';

const title = __( 'Accordion item' );

const icon = "align-center";

const keywords = [
  __( 'tabs' ),
  __("list"),
  __( 'energetic core parts' ),
];

const settings = {

	title: title,

	description: __( 'Add Authors list.' ),

  keywords: keywords,

  parent: ["energetic-core-parts/accordion"],

  supports: {
    reusable: false,
    html: false
  },

  attributes: blockAttributes,

	edit: Edit,

	save({ attributes }) {
    const {
      backgroundColor,
      content,
      customBackgroundColor,
      customTextColor,
      open,
      textColor,
      title
    } = attributes;

    const backgroundColorClass = getColorClassName(
      "background-color",
      backgroundColor
    );
    const textColorClass = getColorClassName("color", textColor);
    const borderColorClass = getColorClassName("color", backgroundColor);

    const backgroundClasses = classnames(
      "wp-block-energetic-core-parts-accordion-item",
      open ? "wp-block-energetic-core-parts-accordion-item--open" : null,
      {}
    );

    const titleClasses = classnames("wp-block-energetic-core-parts-accordion-item__title", {
      "has-background": backgroundColor || customBackgroundColor,
      [backgroundColorClass]: backgroundColorClass,
      "has-text-color": textColor || customTextColor,
      [textColorClass]: textColorClass
    });

    const titleStyles = {
      backgroundColor: backgroundColorClass ? undefined : customBackgroundColor,
      color: textColorClass ? undefined : customTextColor
    };

    const contentClasses = classnames(
      "wp-block-energetic-core-parts-accordion-item__content",
      {
        "has-border-color": borderColorClass || customBackgroundColor,
        [borderColorClass]: borderColorClass
      }
    );

    return (
      <div>
        {!RichText.isEmpty(title) && (
          <details open={open}>
            <RichText.Content
              tagName="summary"
              className={titleClasses}
              value={title}
              style={titleStyles}
            />
            {!RichText.isEmpty(content) && (
              <div
                className={contentClasses}
                style={{ color: textColorClass ? undefined : customTextColor }}
              >
                <RichText.Content
                  tagName="p"
                  className="wp-block-energetic-core-parts-accordion-item__text"
                  value={content}
                />
              </div>
            )}
          </details>
        )}
      </div>
    );

  },
  
};

export { name, title, icon, settings };
