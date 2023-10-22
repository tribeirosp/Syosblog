/**
 * External dependencies
 */
import classnames from "classnames";

/**
 * Internal dependencies
 */
import Inspector from "./inspector";

/**
 * WordPress dependencies
 */

const { Component, Fragment } = wp.element;

/**
 * Block edit function
 */
export default class Edit extends Component {
  constructor() {
    super(...arguments);
  }

  render() {
    const { attributes, className, isSelected } = this.props;

    const {
      fonticon,
      iconImgID,
      iconImgURL,
      iconImgALT,
      iconSize,
      iconColor
    } = attributes;

    return [
      <Fragment>
        {isSelected && <Inspector {...this.props} />}

        <div className={classnames(className, "et-icon")}>
          {iconImgID ? (
            <img
              src={iconImgURL}
              alt={iconImgALT}
              style={{ width: iconSize }}
            />
          ) : (
            <i
              className={fonticon || "far fa-grin"}
              style={{ fontSize: iconSize, color: iconColor }}
            />
          )}
        </div>
      </Fragment>
    ];
  }
}
