/**
 * Internal dependencies
 */
import "./styles/editor.scss";
import "./styles/style.scss";
import Edit from "./components/edit";

/**
 * Internal block libraries
 */
const { __ } = wp.i18n;

/**
 * Block constants
 */
const name = 'instagram';

const title = __( 'Instagram' );

const icon = 'instagram';

const keywords = [
	__( 'instagram' ),
  __( 'energetic core parts' ),
];

const settings = {

	title: title,

	description: __( 'Add Instagram feed.' ),

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
