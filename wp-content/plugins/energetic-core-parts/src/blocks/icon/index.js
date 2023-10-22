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
const { InnerBlocks } = wp.blockEditor;

/**
 * Block attributes
 */

const name = 'icon';

const title = __( 'Icon' );

const icon = "star-filled";

const keywords = [
	__( 'Icon' ),
  __( 'energetic core parts' ),
];

const blockAttributes = {
  count: {
    type: "number",
    default: 1
  },
  contentAlign: {
    type: "string",
    default: "left"
  }
};

const settings = {

	title: title,

	description: __( 'Add Authors list.' ),

  keywords: keywords,
  
  attributes: blockAttributes,

	edit: Edit,

  save: function(props) {
    const { contentAlign, count } = props.attributes;

    const classes = classnames(
      props.className,
      `has-${count}-icons`,
      `text-${contentAlign}`
    );

    return (
      <div
        className={classes}
      >
        <div className="wp-block-energetic-core-parts-icon__inner">
          <InnerBlocks.Content />
        </div>
      </div>
    );
  },
  
};

export { name, title, icon, settings };
