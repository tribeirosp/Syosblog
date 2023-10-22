/**
 * Block dependencies
 */
import './styles/editor.scss';
import './styles/style.scss';

import Edit from './edit';


/**
 * Internal block libraries
 */
const { __ } = wp.i18n;


/**
 * Block constants
 */
const name = 'posts';

const title = __( 'Post' );

const icon = 'admin-post';

const keywords = [
	__( 'posts' ),
  __( 'blog' ),
  __( 'energetic core parts' ),
];

const settings = {

	title: title,

	description: __( 'Add blog post.' ),

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
