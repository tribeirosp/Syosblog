<?php if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

/**
 * Range Customizer Control
 *
 * This class is for the toggle control in the Customizer.
 *
 * @access public
 */
class Etcodes_Range_Control extends WP_Customize_Control {

	/**
	 * The type of customize control.
	 *
	 * @access public
	 * @since  1.1.7
	 * @var    string
	 */
	public $type = 'etcodes-range';

	/**
	 * Enqueue neccessary custom control scripts.
	 */
	public function enqueue() {
		wp_enqueue_script( 'etcodes-customize-control-range', get_parent_theme_file_uri( 'theme-includes/customizer/customizer-controls/js/control-range.js' ), array( 'customize-controls' ), '1.0.0', true );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// The setting value.
		$this->json['id']                  = $this->id;
		$this->json['value']               = $this->value();
		$this->json['link']                = $this->get_link();
		$this->json['defaultValue']        = $this->setting->default;
		$this->json['input_attrs']['min']  = ( isset( $this->input_attrs['min'] ) ) ? $this->input_attrs['min'] : '0';
		$this->json['input_attrs']['max']  = ( isset( $this->input_attrs['max'] ) ) ? $this->input_attrs['max'] : '100';
		$this->json['input_attrs']['step'] = ( isset( $this->input_attrs['step'] ) ) ? $this->input_attrs['step'] : '1';
	}

	/**
	 * Don't render the content via PHP.  This control is handled with a JS template.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function render_content() {}

	/**
	 * An Underscore (JS) template for this control's content.
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see    WP_Customize_Control::print_template()
	 *
	 * @access protected
	 * @since  1.0
	 * @return void
	 */
	protected function content_template() {
		?>

		<div class="etcodes-range">

			<# if ( data.label ) { #>
				<label class="etcodes-range__label">
					<span class="customize-control-title">{{ data.label }}</span>
				</label>
			<# } #>

			<div class="etcodes-range__value">
				<span>{{ data.value }}</span>
				<input id="range-{{ data.id }}" type="number" class="etcodes-range__number-input" value="{{ data.value }}" data-default-value="{{ data.defaultValue }}" {{{ data.link }}} <# if ( data.value ) { #> checked="checked" <# } #> />
				<# if ( data.description ) { #>
					<em>{{ data.description }}</em>
				<# } #>
			</div>

			<input type="range" data-input-type="range" class="etcodes-range__track" value="{{ data.value }}" data-default-value="{{ data.defaultValue }}"  min="{{ data.input_attrs['min'] }}" max="{{ data.input_attrs['max'] }}" step="{{ data.input_attrs['step'] }}" {{{ data.link }}} />

			<a type="button" value="reset" class="etcodes-range__reset"></a>

		</div>
		<?php
	}
}