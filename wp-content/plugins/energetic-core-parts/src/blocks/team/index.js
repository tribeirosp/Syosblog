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
const name = 'team';

const title = __( 'Team' );

const icon = 'groups';

const keywords = [
	__( 'members' ),
  __( 'team' ),
  __( 'energetic core parts' ),
];

const settings = {

	title: title,

	description: __( 'Add team members.' ),

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
