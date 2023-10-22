/**
 * Internal dependencies
 */
import './styles/editor.scss';
import './styles/style.scss';
import Edit from './components/edit';
import classnames from 'classnames';
/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;

/**
 * Block attributes
 */

const name = 'icon-item';

const title = __( 'Icon Item' );

const icon = "star-filled";

const keywords = [
	__( 'Icon' ),
	__( 'image icon' ),
	__( 'energetic core parts' ),
];

const blockAttributes = {
	url: {
		type: 'string',
		source: 'attribute',
		selector: 'a',
		attribute: 'href',
	},
	term: {
		type: 'string',
		default: '',
	},
	fonticon: {
		type: 'string',
	},
	iconImgID: {
        type: "number"
	},
	iconImgURL: {
        type: "string",
        source: "attribute",
        attribute: "src",
        selector: "img"
	},
	iconImgALT: {
        type: "string",
        source: "attribute",
        attribute: "alt",
        selector: "img"
    },
	iconSize: {
		type: "number",
		default: 50,
	},
	iconColor: {
		type: 'string',
	},
};

const settings = {

	title: title,

	description: __( 'Add Authors list.' ),

  keywords: keywords,
  
  parent: [ 'energetic-core-parts/icon' ],

  attributes: blockAttributes,

  edit: Edit,

  save: function( props ) {

	const {
		fonticon,
		iconImgID,
		iconImgURL,
		iconImgALT,
		iconSize,
		iconColor,
		url,
		className,
	} = props.attributes;

	if(url) { 
		return (
			<span className={ classnames( className, 'et-icon' ) }>
				<a href={url} >
					{ iconImgID ? (
						<img src={iconImgURL} alt={iconImgALT} style={ { width: iconSize } } />
					) : (
						<i className={ fonticon || "far fa-smile-beam" } style={ { fontSize: iconSize, color: iconColor } }></i>
					)}
				</a>
			</span>
		)
	} else {
		return (
			<span className={ classnames( className, 'et-icon' ) }>
				{ iconImgID ? (
					<img src={iconImgURL} alt={iconImgALT} style={ { width: iconSize } } />
				) : (
					<i className={ fonticon || "far fa-smile-beam" } style={ { fontSize: iconSize, color: iconColor } }></i>
				)}
			</span>
		)
	}

	},
  
};

export { name, title, icon, settings };
