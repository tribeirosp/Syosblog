/**
 * Block dependencies
 */
import "./styles/editor.scss";
import "./styles/style.scss";

import Edit from "./edit";

/**
 * Internal block libraries
 */
const { __ } = wp.i18n;

/**
 * Block constants
 */
const name = 'posts-list';

const title = __( 'Simple Post list' );

const icon = 'admin-post';

const keywords = [
	__( 'Top Posts' ),
  __( 'Popular post' ),
  __( 'Most commented post' ),
];

const settings = {

	title: title,

	description: __( 'Add blog post list.' ),

  keywords: keywords,
  
  getEditWrapperProps( attributes ) {
    const { align } = attributes;
    if ('wide' === align || 'full' === align ) {
      return { 'data-align': align };
    }
  },

	edit: Edit,

	save() {
		return null;
	},
};

export { name, title, icon, settings };