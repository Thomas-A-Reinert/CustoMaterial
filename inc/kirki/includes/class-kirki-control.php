<?php

if ( ! class_exists( 'Kirki_Control' ) ) {

	class Kirki_Control {

		/**
		 * @access protected
		 * @var WP_Customize_Manager
		 */
		protected $wp_customize;

		/**
		 * @access protected
		 * @var array
		 */
		protected $control_types = array();

		/**
		 * The class constructor.
		 * Creates the actual controls in the customizer.
		 *
		 * @access public
		 * @param $args    array    the field definition as sanitized in Kirki_Field
		 */
		public function __construct( $args ) {

			// Set the $wp_customize property
			global $wp_customize;
			if ( ! $wp_customize ) {
				return;
			}
			$this->wp_customize = $wp_customize;

			// Set the control types
			$this->set_control_types();
			// Add the control
			$this->add_control( $args );

		}

		/**
		 * Get the class name of the class needed to create tis control.
		 *
		 * @access private
		 * @param $args    array    the field definition as sanitized in Kirki_Field
		 *
		 * @return         string   the name of the class that will be used to create this control
		 */
		final private function get_control_class_name( $args ) {

			// Set a default class name
			$class_name = 'WP_Customize_Control';
			// Get the classname from the array of control classnames
			if ( array_key_exists( $args['type'], $this->control_types ) ) {
				$class_name = $this->control_types[ $args['type'] ];
			}
			return $class_name;

		}

		/**
		 * Adds the control.
		 *
		 * @access protected
		 * @param $args    array    the field definition as sanitized in Kirki_Field
		 *
		 * @return         void
		 */
		final protected function add_control( $args ) {

			// Get the name of the class we're going to use
			$class_name = $this->get_control_class_name( $args );
			// Add the control
			$this->wp_customize->add_control( new $class_name( $this->wp_customize, $args['settings'], $args ) );

		}

		/**
		 * Sets the $this->control_types property.
		 * Makes sure the kirki/control_types filter is applied
		 * and that the defined classes actually exist.
		 * If a defined class does not exist, it is removed.
		 */
		final private function set_control_types() {

			$this->control_types = apply_filters( 'kirki/control_types', array(
				'checkbox'         => 'Kirki_Controls_Checkbox_Control',
				'code'             => 'Kirki_Controls_Code_Control',
				'color-alpha'      => 'Kirki_Controls_Color_Alpha_Control',
				'custom'           => 'Kirki_Controls_Custom_Control',
				'dimension'        => 'Kirki_Controls_Dimension_Control',
				'editor'           => 'Kirki_Controls_Editor_Control',
				'multicheck'       => 'Kirki_Controls_MultiCheck_Control',
				'number'           => 'Kirki_Controls_Number_Control',
				'palette'          => 'Kirki_Controls_Palette_Control',
				'preset'           => 'Kirki_Controls_Preset_Control',
				'kirki-radio'      => 'Kirki_Controls_Radio_Control',
				'radio-buttonset'  => 'Kirki_Controls_Radio_ButtonSet_Control',
				'radio-image'      => 'Kirki_Controls_Radio_Image_Control',
				'repeater'         => 'Kirki_Controls_Repeater_Control',
				'kirki-select'     => 'Kirki_Controls_Select_Control',
				'slider'           => 'Kirki_Controls_Slider_Control',
				'sortable'         => 'Kirki_Controls_Sortable_Control',
				'spacing'          => 'Kirki_Controls_Spacing_Control',
				'switch'           => 'Kirki_Controls_Switch_Control',
				'kirki-generic'    => 'Kirki_Controls_Generic_Control',
				'toggle'           => 'Kirki_Controls_Toggle_Control',
				'typography'       => 'Kirki_Controls_Typography_Control',
				'image'            => 'WP_Customize_Image_Control',
				'upload'           => 'WP_Customize_Upload_Control',
			) );

			// Make sure the defined classes actually exist
			foreach ( $this->control_types as $key => $classname ) {

				if ( ! class_exists( $classname ) ) {
					unset( $this->control_types[ $key ] );
				}

			}

		}

	}

}
