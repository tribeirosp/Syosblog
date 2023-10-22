/**
 * Internal dependencies
 */
import './styles/editor.scss';
import './styles/style.scss';
import PricingTable from './components/pricing-table';
import Edit from './components/edit';

/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;

/**
 * Block constants
 */
const name = 'pricing-table-item';

const title = __( 'Pricing Table Item' );

const icon = 'admin-post';

const keywords = [
  __( 'Pricing Table' ),
  __( 'energetic core parts' ),
];

const blockAttributes = {
	title: {
		source: 'children',
		selector: '.pricing-table__title',
	},
	features: {
		source: 'children',
		selector: '.pricing-table__features',
	},
	currency: {
		type: 'array',
		source: 'children',
		selector: '.pricing-table__currency',
	},
	amount: {
		type: 'array',
		source: 'children',
		selector: '.pricing-table__amount',
	},
	button: {
		type: 'array',
		source: 'children',
		selector: '.pricing-table__button',
	},
	url: {
		type: 'string',
		source: 'attribute',
		selector: 'a',
		attribute: 'href',
		selector: '.pricing-table__button',
	},
	tableBackground: {
		type: 'string',
	},
	tableColor: {
		type: 'string',
	},
	buttonBackground: {
		type: 'string',
	},
	buttonColor: {
		type: 'string',
	},
	customTableBackground: {
		type: 'string',
	},
	customTableColor: {
		type: 'string',
	},
	customButtonBackground: {
		type: 'string',
	},
	custombButtonColor: {
		type: 'string',
	},
};

const settings = {

	title: title,

	description: __( 'A column placed within the pricing table block' ),
	
	keywords: keywords,

	parent: [ 'energetic-core-parts/pricing-table' ],

	attributes: blockAttributes,

	transforms: {
		from: [
			{
				type: 'raw',
				selector: 'div.wp-block-energetic-core-parts-pricing-table',
				schema: {
					div: {
						classes: [ 'wp-block-energetic-core-parts-pricing-table' ],
					},
				},
			},
		],
	},

	edit: Edit,

	save: function( props ) {

		const {
			amount,
			button,
			columns,
			currency,
			features,
			title,
			url,
		} = props.attributes;

		return (
			<PricingTable { ...props }
				amount={ amount }
				button={ button }
				currency={ currency }
				features={ features }
				title={ title }
				url={ url }
			>
			</PricingTable>
		);

	},
};

export { name, title, icon, settings };