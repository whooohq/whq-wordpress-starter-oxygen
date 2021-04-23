<?php

namespace Oxygen\WooElements;

class ShoppingCart extends \OxyWooEl {

    function name() {
        return 'Shopping Cart';
    }
    
    function slug() {
        return 'woo-cart';
    }

    function woo_button_place() {
        return "page";
    }
    
    function render($options, $defaults, $content) {
        echo do_shortcode('[woocommerce_cart]');
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function controls() {

        /**
         * Heading Styles
         */

        $this->typographySection(__("Heading"), ".cart_totals h2", $this);

        /**
         * Main Boxes
         */

        $mainboxes_section = $this->addControlSection("mainboxes_section", __("Main Boxes"), "assets/icon.png", $this);

        $mainboxes_section->addStyleControls(
            array(
                array(
                    "name" => __('Background Color'),
                    "selector" => "table.shop_table",
                    "property" => 'background-color',
                ),
            )
        );

        $mainboxes_section->borderSection(
            __("Borders"),
            'table.shop_table',
            $this
        );

        $mainboxes_box_shadow = $mainboxes_section->addControlSection("mainboxes_box_shadow", __("Box Shadow"), "assets/icon.png", $this);
		
		$mainboxes_box_shadow->addPreset(
            "box-shadow",
            "original_thumb_shadow",
            __("Main Boxes Shadow"),
            "table.shop_table"
        );

		/**
         * Table Subheading
         */

        $tables_section = $this->typographySection(__("Table Headers"), ".woocommerce table.shop_table th, .woocommerce table.shop_table tbody th", $this);

        $tables_section->addStyleControls(
            array(
                array(
                    "name" => __('Table Border Colors'),
                    "selector" => ".woocommerce table.shop_table th, .woocommerce table.shop_table td, .cart_totals h2",
                    "property" => 'border-color',
                ),
            )
        );

        /**
         * Proceed Button
         */

        $proceed_button = $this->addControlSection("proceed_button", __("Primary Button"), "assets/icon.png", $this);
        $proceed_selector 		= ".woocommerce a.button.alt";
        $proceed_selector_hover = ".woocommerce a.button.alt:hover";

        $proceed_button->addStyleControls(
            array(
                array(
                    "selector" => $proceed_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Hover Background Color'),
                    "selector" => $proceed_selector_hover,
                    "property" => 'background-color',
                ),
            )
        );

        $paddingPreset = $proceed_button->addPreset(
            "padding",
            "button_padding",
            __("Button Padding"),
            $proceed_selector
        );

        // typography sub-section
        $button_typography = $proceed_button->typographySection(__("Typography"), $proceed_selector, $this);

        $button_typography->addStyleControls(
            array(
                array(
                    "name" => __('Hover Color'),
                    "selector" => $proceed_selector_hover,
                    "property" => 'color',
                ),
            )
        );

		// border sub-sections
        $proceed_button->borderSection(__("Border"), $proceed_selector, $this);
        $proceed_button->borderSection(__("Hover Border"), $proceed_selector_hover, $this);
		
		// box-shadow sub-sections
        $proceed_button->boxShadowSection(__("Box Shadow"), $proceed_selector, $this);
        $proceed_button->boxShadowSection(__("Hover Box Shadow"), $proceed_selector_hover, $this);


		/**
         * Small Buttons
         */

        $small_buttons = $this->addControlSection("small_buttons", __("Secondary Buttons"), "assets/icon.png", $this);
        $small_buttons_selector 		= ".actions .button:not(:disabled), .shipping-calculator-form .button";
        $small_buttons_selector_hover = ".actions .button:not(:disabled):hover, .shipping-calculator-form .button:hover";

        $small_buttons->addStyleControls(
            array(
                array(
                    "selector" => $small_buttons_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Hover Background Color'),
                    "selector" => $small_buttons_selector_hover,
                    "property" => 'background-color',
                ),
            )
        );

        $paddingPreset = $small_buttons->addPreset(
            "padding",
            "small_button_padding",
            __("Button Padding"),
            $small_buttons_selector
        );

        // typography sub-section
        $small_button_typography = $small_buttons->typographySection(__("Typography"), $small_buttons_selector, $this);

        $small_button_typography->addStyleControls(
            array(
                array(
                    "name" => __('Hover Color'),
                    "selector" => $small_buttons_selector_hover,
                    "property" => 'color',
                ),
            )
        );

		// border sub-sections
        $small_buttons->borderSection(__("Border"), $small_buttons_selector, $this);
        $small_buttons->borderSection(__("Hover Border"), $small_buttons_selector_hover, $this);
		
		// box-shadow sub-sections
        $small_buttons->boxShadowSection(__("Box Shadow"), $small_buttons_selector, $this);
        $small_buttons->boxShadowSection(__("Hover Box Shadow"), $small_buttons_selector_hover, $this);


        /**
         * Disabled Small Buttons
         */

        $disabled_small_buttons = $this->addControlSection("disabled_small_buttons", __("Disabled Button"), "assets/icon.png", $this);
        $disabled_selector 		= "button.button:disabled";

        $disabled_small_buttons->addStyleControls(
            array(
                array(
                    "selector" => $disabled_selector,
                    "property" => 'background-color',
                ),
                array(
                    "selector" => $disabled_selector,
                    "property" => 'opacity',
                )
            )
        );

        $paddingPreset = $disabled_small_buttons->addPreset(
            "padding",
            "disabled_small_button_padding",
            __("Button Padding"),
            $disabled_selector
        );

        // typography sub-section
        $disabled_button_typography = $disabled_small_buttons->typographySection(__("Typography"), $disabled_selector, $this);

		// border sub-sections
        $disabled_small_buttons->borderSection(__("Border"), $disabled_selector, $this);
		
		// box-shadow sub-sections
        $disabled_small_buttons->boxShadowSection(__("Box Shadow"), $disabled_selector, $this);

        /**
         * Inputs Styles
         */

        $inputs_section = $this->addControlSection("inputs_section", __("Inputs"), "assets/icon.png", $this);
        $inputs_selector = ".input-text, .select2-selection--single";
        $inputs_selector_focus = ".input-text:focus, .select2-selection--single:focus";

        // border sub-sections
        $inputs_section->borderSection(__("Border"), $inputs_selector, $this);

		// focus border sub-sections
        $inputs_section->borderSection(__("Focused Border"), $inputs_selector_focus, $this);

        // focus box shadow sub-sections
        $inputs_section->boxShadowSection(__("Focused Box Shadow"), $inputs_selector_focus, $this);


        /*
         * Images Styles
         */

        $images_section = $this->addControlSection("images_section", __("Images"), "assets/icon.png", $this);
        $selector = "table.cart img";

        $images_section->addStyleControls(
            array(
                array(
                    "name" => __('Images Max Width (64px - 300px)'),
                    "selector" => $selector,
                    "property" => 'max-width',
                ),
            )
        );

        // border sub-sections
        $images_section->borderSection(__("Image Border"), $selector, $this);

        // border sub-sections
        $images_section->boxShadowSection(__("Image Box Shadow"), $selector, $this);


        /**
         * Price Styles
         */

        $this->typographySection(__("Prices"), ".woocommerce-Price-amount", $this);


        /**
         * Links Styles
         */

        $links_section = $this->typographySection(__("Links"), ".product-name a, .shipping-calculator-button", $this);

        $links_section->addStyleControls(
            array(
                array(
                    "name" => __('Hover Color'),
                    "selector" => ".product-name a:hover, .shipping-calculator-button:hover",
                    "property" => 'color',
                ),
            )
        );


    }

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

 
    }
    
}

new ShoppingCart();
