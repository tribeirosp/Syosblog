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
 * Block registration
 */

const name = 'accordion';

const title = __( 'Accordion' );

const icon = "align-center";

const keywords = [
  __( 'tabs' ),
  __( 'list' ),
  __( 'energetic core parts' ),
];

const settings = {

	title: title,

	description: __( 'Add Authors list.' ),

  keywords: keywords,
  
  supports: {
    align: ["wide", "full"],
    html: false
  },

	edit: Edit,

  save() {
    return (
      <div>
        <InnerBlocks.Content />
      </div>
    );
  }
  
};

export { name, title, icon, settings };
