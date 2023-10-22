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
const name = 'portfolio';

const title = __( 'Portfolio' );

const icon = 'admin-post';

const keywords = [
	__( 'portfolio' ),
  __( 'work' ),
  __( 'energetic core parts' ),
];

const settings = {

	title: title,

	description: __( 'Add Portfolio.' ),

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
