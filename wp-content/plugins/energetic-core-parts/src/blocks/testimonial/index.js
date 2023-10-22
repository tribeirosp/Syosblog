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

/**
 * Block constants
 */
const name = 'testimonial';

const title = __( 'Testimonial' );

const icon = 'testimonial';

const keywords = [
	__( 'testimonial' ),
  __( 'feedback' ),
  __( 'energetic core parts' ),
];

const settings = {

	title: title,

	description: __( 'Add testimonial.' ),

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
