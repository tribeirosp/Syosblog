/**
 * External dependencies
 */
import times from "lodash/times";
import classnames from "classnames";
import memoize from "memize";

/**
 * Internal dependencies
 */
import Controls from "./controls";
import Inspector from "./inspector";

/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { InnerBlocks } = wp.blockEditor;

/**
 * Allowed blocks and template constant is passed to InnerBlocks precisely as specified here.
 * The contents of the array should never change.
 * The array should contain the name of each block that is allowed.
 *
 * @constant
 * @type {string[]}
 */
const ALLOWED_BLOCKS = ["energetic-core-parts/icon-item"];

/**
 * Returns the layouts configuration for a given number of items.
 *
 * @param {number} count Number of pricing table items.
 *
 * @return {Object[]} Columns layout configuration.
 */
const getCount = memoize(count => {
  return times(count, () => ["energetic-core-parts/icon-item"]);
});

/**
 * Block edit function
 */
export default class Edit extends Component {
  constructor() {
    super(...arguments);
  }

  render() {
    const {
      attributes,
      className,
      isSelected,
      setAttributes,
      setState
    } = this.props;

    const { count, contentAlign } = attributes;

    const classes = classnames(
      className,
      `has-${count}-icons`,
      `et-icons--${contentAlign}`
    );

    return [
      <Fragment>
        {isSelected && <Controls {...this.props} />}
        {isSelected && <Inspector {...this.props} />}
        <div className={classes} style={{ textAlign: contentAlign }}>
          <InnerBlocks
            template={getCount(count)}
            templateLock="all"
            allowedBlocks={ALLOWED_BLOCKS}
          />
        </div>
      </Fragment>
    ];
  }
}
