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
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.blockEditor;

/**
 * Block attributes
 */


const name = 'pricing-table';

const title = __( 'Pricing Table' );

const icon = 'cart';

const keywords = [
	__( 'Top Posts' ),
  __( 'Popular post' ),
  __( 'Most commented post' ),
];

const blockAttributes = {
  count: {
    type: "number",
    default: 2
  },
  contentAlign: {
    type: "string",
    default: "left"
  }
};

const settings = {

	title: title,

	description: __( 'Add Pricing Table.' ),

  keywords: keywords,
  
  attributes: blockAttributes,

  supports: {
    align: ["wide", "full"]
  },

  transforms: {
    from: [
      {
        type: "raw",
        selector: "div.wp-block-energetic-core-parts-pricing-table",
        schema: {
          div: {
            classes: ["wp-block-energetic-core-parts-pricing-table"]
          }
        }
      }
    ]
  },

	edit: Edit,

  save: function(props) {
    const { contentAlign, count } = props.attributes;

    const classes = classnames(
      props.className,
      `has-${count}-columns`,
      `pricing-table--${contentAlign}`
    );

    return (
      <div
        className={classes}
        style={{ textAlign: contentAlign ? contentAlign : null }}
      >
        <div className="wp-block-energetic-core-parts-pricing-table__inner">
          <InnerBlocks.Content />
        </div>
      </div>
    );
  },

};

export { name, title, icon, settings };