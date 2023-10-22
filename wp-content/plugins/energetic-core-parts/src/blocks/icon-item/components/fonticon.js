import faregular from "./fontawesome/regular";
import fabrands from "./fontawesome/brands";
import fasolid from "./fontawesome/solid";

const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;

let faregularicons = faregular.map(icon => ({
  key: icon,
  value: icon.replace(/-/g, " "),
  prefix: "far"
}));

let fabrandsicons = fabrands.map(icon => ({
  key: icon,
  value: icon.replace(/-/g, " "),
  prefix: "fab"
}));

let fasolidicons = fasolid.map(icon => ({
  key: icon,
  value: icon.replace(/-/g, " "),
  prefix: "fas"
}));

let icons = faregularicons.concat(fabrandsicons, fasolidicons);

function searchingFor(term) {
  return function(x) {
    return x.value.toLowerCase().includes(term.toLowerCase()) || !term;
  };
}

export default class FontIcon extends Component {
  constructor(props) {
    super(...arguments);
  }

  render() {
    const { attributes, setAttributes } = this.props;

    const { term, fonticon } = attributes;

    return (
      <Fragment>
        <from>
          <input
            type="text"
            class="etsearchiconfrom"
            onChange={event => setAttributes({ term: event.target.value })}
            value={term}
            placeholder={__("Eg:google", "energetic-core-parts")}
            title={__("Search Icon", "energetic-core-parts")}
          />
        </from>
        <div className="etfonticons">
          {icons.filter(searchingFor(term)).map(icon => (
            <a
              role="button"
              href="#"
              onClick={event =>
                setAttributes({
                  fonticon: event.target.className,
                  iconImgID: null,
                  iconImgURL: null,
                  iconImgALT: null
                })
              }
              className={`${icon.prefix} fa-${icon.key}`}
              title={`${icon.prefix}  ${icon.value}`}
            >
              <i key={icon.key}> </i>
            </a>
          ))}
        </div>
      </Fragment>
    );
  }
}
