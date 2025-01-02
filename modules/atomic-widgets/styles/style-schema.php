<?php
namespace Elementor\Modules\AtomicWidgets\Styles;

use Elementor\Modules\AtomicWidgets\PropTypes\Background_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Box_Shadow_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Border_Radius_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Border_Width_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Color_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Linked_Dimensions_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Primitives\Number_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Size_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Primitives\String_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Stroke_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Union_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Gap_Prop_Type;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Style_Schema {
	public static function get() {
		return array_merge(
			self::get_size_props(),
			self::get_position_props(),
			self::get_typography_props(),
			self::get_spacing_props(),
			self::get_border_props(),
			self::get_background_props(),
			self::get_effects_props(),
			self::get_layout_props(),
			self::get_alignment_props(),
		);
	}

	private static function get_size_props() {
		return array(
			'width' => Size_Prop_Type::make(),
			'height' => Size_Prop_Type::make(),
			'min-width' => Size_Prop_Type::make(),
			'min-height' => Size_Prop_Type::make(),
			'max-width' => Size_Prop_Type::make(),
			'max-height' => Size_Prop_Type::make(),
			'overflow' => String_Prop_Type::make()->enum(array(
				'visible',
				'hidden',
				'auto',
			)),
		);
	}

	private static function get_position_props() {
		return array(
			'position' => String_Prop_Type::make()->enum(array(
				'static',
				'relative',
				'absolute',
				'fixed',
			)),
			'top' => Size_Prop_Type::make(),
			'right' => Size_Prop_Type::make(),
			'bottom' => Size_Prop_Type::make(),
			'left' => Size_Prop_Type::make(),
			'z-index' => Number_Prop_Type::make(),
		);
	}

	private static function get_typography_props() {
		return array(
			'font-family' => String_Prop_Type::make(),
			'font-weight' => String_Prop_Type::make()->enum(array(
				'100',
				'200',
				'300',
				'400',
				'500',
				'600',
				'700',
				'800',
				'900',
				'normal',
				'bold',
				'bolder',
				'lighter',
			)),
			'font-size' => Size_Prop_Type::make(),
			'color' => Color_Prop_Type::make(),
			'letter-spacing' => Size_Prop_Type::make(),
			'word-spacing' => Size_Prop_Type::make(),
			'text-align' => String_Prop_Type::make()->enum(array(
				'left',
				'center',
				'right',
				'justify',
			)),
			'font-style' => String_Prop_Type::make()->enum(array(
				'normal',
				'italic',
				'oblique',
			)),
			// TODO: validate text-decoration in more specific way [EDS-524]
			'text-decoration' => String_Prop_Type::make(),
			'text-transform' => String_Prop_Type::make()->enum(array(
				'none',
				'capitalize',
				'uppercase',
				'lowercase',
			)),
			'direction' => String_Prop_Type::make()->enum(array(
				'ltr',
				'rtl',
			)),
			'-webkit-text-stroke' => Stroke_Prop_Type::make(),
		);
	}

	private static function get_spacing_props() {
		return array(
			'padding' => Linked_Dimensions_Prop_Type::make(),
			'margin' => Linked_Dimensions_Prop_Type::make(),
		);
	}

	private static function get_border_props() {
		return array(
			'border-radius' => Union_Prop_Type::make()->add_prop_type(
				Size_Prop_Type::make()
			)->add_prop_type(
				Border_Radius_Prop_Type::make()
			),
			'border-width' => Union_Prop_Type::make()->add_prop_type( Size_Prop_Type::make() )->add_prop_type( Border_Width_Prop_Type::make() ),
			'border-color' => Color_Prop_Type::make(),
			'border-style' => String_Prop_Type::make()->enum(array(
				'none',
				'hidden',
				'dotted',
				'dashed',
				'solid',
				'double',
				'groove',
				'ridge',
				'inset',
				'outset',
			)),
		);
	}

	private static function get_background_props() {
		return array(
			'background' => Background_Prop_Type::make(),
		);
	}

	private static function get_effects_props() {
		return array(
			'box-shadow' => Box_Shadow_Prop_Type::make(),
		);
	}

	private static function get_layout_props() {
		return array(
			'display' => String_Prop_Type::make()->enum(array(
				'block',
				'inline',
				'inline-block',
				'flex',
				'inline-flex',
				'grid',
				'inline-grid',
				'flow-root',
				'none',
				'contents',
			)),
			'flex-direction' => String_Prop_Type::make()->enum(array(
				'row',
				'row-reverse',
				'column',
				'column-reverse',
			)),
			'gap' => Gap_Prop_Type::make(),
			'flex-wrap' => String_Prop_Type::make()->enum(array(
				'wrap',
				'nowrap',
				'wrap-reverse',
			)),
			'flex-grow' => Number_Prop_Type::make(),
			'flex-shrink' => Number_Prop_Type::make(),
			'flex-basis' => Size_Prop_Type::make(),
		);
	}

	private static function get_alignment_props() {
		return array(
			'justify-content' => String_Prop_Type::make()->enum(array(
				'center',
				'start',
				'end',
				'flex-start',
				'flex-end',
				'left',
				'right',
				'normal',
				'space-between',
				'space-around',
				'space-evenly',
				'stretch',
			)),
			'align-items' => String_Prop_Type::make()->enum(array(
				'normal',
				'stretch',
				'center',
				'start',
				'end',
				'flex-start',
				'flex-end',
				'self-start',
				'self-end',
				'anchor-center',
			)),
			'align-self' => String_Prop_Type::make()->enum(array(
				'auto',
				'normal',
				'center',
				'start',
				'end',
				'self-start',
				'self-end',
				'flex-start',
				'flex-end',
				'anchor-center',
				'baseline',
				'first baseline',
				'last baseline',
				'stretch',
			)),
			'order' => Number_Prop_Type::make(),
		);
	}
}
