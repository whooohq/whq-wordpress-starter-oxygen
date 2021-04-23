<?php

namespace Oxygen\WooElements;

class Checkout extends \OxyWooEl {

    function name() {
        return 'Checkout';
    }
    
    function slug() {
        return 'woo-checkout';
    }

    function woo_button_place() {
        return "page";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }
    
    function render($options, $defaults, $content) {
        echo do_shortcode('[woocommerce_checkout]');
    }

    function controls() {

        /**
         * Main Boxes
         */

        $mainboxes_section = $this->addControlSection("mainboxes_section", __("Main Boxes"), "assets/icon.png", $this);

        $mainboxes_section->addStyleControls(
            array(
                array(
                    "name" => __('Background Color'),
                    "selector" => "table.shop_table, div#customer_details, .woocommerce-info, form.checkout_coupon, section.addresses, ul.order_details",
                    "property" => 'background-color',
                ),
            )
        );

        $mainboxes_section->borderSection(
            __("Borders"),
            'table.shop_table, div#customer_details, .woocommerce-info, form.checkout_coupon, section.addresses, ul.order_details',
            $this
        );

        $mainboxes_box_shadow = $mainboxes_section->addControlSection("mainboxes_box_shadow", __("Box Shadow"), "assets/icon.png", $this);
		
		$mainboxes_box_shadow->addPreset(
            "box-shadow",
            "original_thumb_shadow",
            __("Main Boxes Shadow"),
            "table.shop_table, div#customer_details, .woocommerce-info, form.checkout_coupon, section.addresses, ul.order_details"
        );


        /**
         * Headings
         */

        $headings_selector = ".woocommerce-billing-fields h3, .woocommerce-shipping-fields h3, .woocommerce-checkout h3, h2.woocommerce-column__title, h2.woocommerce-order-details__title, h2.woocommerce-order-downloads__title";
        $headings_section = $this->typographySection(__("Headings"), $headings_selector, $this);

        $headings_section->addStyleControls(
            array(
                array(
                    "selector" => $headings_selector,
                    "property" => 'margin-bottom',
                ),
            )
        );

        /**
         * Table Headings
         */
            
        $table_headingsSection = $this->typographySection(__("Table Headings"), "table.shop_table th", $this);


        /**
         * Table Contents
         */
            
        $table_contentsSection = $this->typographySection(__("Table Contents"), ".woocommerce table.shop_table td, .woocommerce form.checkout_coupon p, .woocommerce-notice.woocommerce-notice--success.woocommerce-thankyou-order-received, .woocommerce .woocommerce-customer-details address, .woocommerce table.shop_table td, .woocommerce table.shop_table tfoot td", $this);

        /**
         * Labels
         */

        $labels_section = $this->typographySection(__("Labels"), "label", $this);

        $labels_selector = ".required";

        // required label sub-section
        $required_labels_section = $labels_section->addControlSection("required_labels", __("Required Labels"), "assets/icon.png", $this);

        $required_labels_section->addStyleControls(
            array(
                array(
                    "name"     => __("Text color"),
                    "selector" => $labels_selector,
                    "property" => 'color',
                ),
                array(
                    "selector" => $labels_selector,
                    "property" => 'font-weight',
                ),
            )
        );

        /**
         * Inputs
         */

        $inputs_section = $this->addControlSection("inputs", __("Inputs"), "assets/icon.png", $this);
        $inputs_selector = ".woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea, label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox span::before, .select2-container--default .select2-selection--single, .select2-container--default .select2-search--dropdown .select2-search__field";
        $inputs_selector_focus = ".woocommerce form .form-row input.input-text:focus, .woocommerce form .form-row textarea:focus, label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox:hover span::before, .select2-container--default .select2-selection--single:focus, .select2-container--default .select2-search--dropdown .select2-search__field:focus";
        $inputs_selector_placeholder = ".woocommerce form .form-row input.input-text::placeholder, .woocommerce form .form-row textarea::placeholder, label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox:hover span::before, .select2-container--default .select2-selection--single::placeholder, .select2-container--default .select2-search--dropdown .select2-search__field::placeholder";

        $inputs_section->addStyleControls(
            array(
                array(
                    "selector" => $inputs_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name"     => __("Placeholder Text Color"),
                    "selector" => $inputs_selector_placeholder,
                    "property" => 'color',
                ),
            )
        );

        $paddingPreset = $inputs_section->addPreset(
            "padding",
            "inputs_padding",
            __("Inputs Padding"),
            $inputs_selector
        );

        // typography sub-section
        $inputs_section->typographySection(__("Typography"), $inputs_selector, $this);

        // border sub-section
        $inputs_section->borderSection(__("Border"), $inputs_selector, $this);
        $inputs_section->borderSection(__("Focus Border"), $inputs_selector_focus, $this);

        // box shadow sub-sections
        $inputs_section->boxShadowSection(__("Box Shadow"), $inputs_selector, $this);
        $inputs_section->boxShadowSection(__("Focus Box Shadow"), $inputs_selector_focus, $this);

        /**
         * Prices and Quantity
         */

        $prices_quantity_section = $this->addControlSection("prices_quantity", __("Prices and Quantity"), "assets/icon.png", $this);
        $prices_quantity_selector = ".woocommerce-Price-amount, .product-quantity";

        $prices_quantity_section->addStyleControls(
            array(
                array(
                    "name"     => __("Text color"),
                    "selector" => $prices_quantity_selector,
                    "property" => 'color',
                ),
                array(
                    "selector" => $prices_quantity_selector,
                    "property" => 'font-family',
                ),
                array(
                    "selector" => $prices_quantity_selector,
                    "property" => 'font-size',
                ),
            )
        );


        /**
         * Primary Button
         */

        $primary_button = $this->addControlSection("primary_button", __("Primary Button"), "assets/icon.png", $this);
        $primary_selector       = ".woocommerce #payment #place_order, .woocommerce-page #payment #place_order";
        $primary_selector_hover = ".woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover";

        $primary_button->addStyleControls(
            array(
                array(
                    "selector" => $primary_selector,
                    "property" => 'background-color',
                ),
                array(
                    "selector" => $primary_selector,
                    "property" => 'border-color',
                ),
                array(
                    "name" => __('Hover Background Color'),
                    "selector" => $primary_selector_hover,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Hover Border Color'),
                    "selector" => $primary_selector_hover,
                    "property" => 'border-color',
                ),
            )
        );

        $paddingPreset = $primary_button->addPreset(
            "padding",
            "secondary_button_padding",
            __("Button Padding"),
            $primary_selector
        );

        // typography sub-section
        $primary_button_typography = $primary_button->typographySection(__("Typography"), $primary_selector, $this);

        $primary_button_typography->addStyleControls(
            array(
                array(
                    "name" => __('Hover Color'),
                    "selector" => $primary_selector_hover,
                    "property" => 'color',
                ),
            )
        );


        /**
         * Secondary Buttons
         */

        $secondary_buttons = $this->addControlSection("secondary_buttons", __("Secondary Buttons"), "assets/icon.png", $this);
        $secondary_selector       = ".woocommerce button.button:not(#place_order), .woocommerce a.button.alt:not(#place_order)";
        $secondary_selector_hover = ".woocommerce button.button:not(#place_order):hover, .woocommerce a.button.alt:not(#place_order):hover";

        $secondary_buttons->addStyleControls(
            array(
                array(
                    "selector" => $secondary_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Hover Background Color'),
                    "selector" => $secondary_selector_hover,
                    "property" => 'background-color',
                ),
            )
        );

        $paddingPreset = $secondary_buttons->addPreset(
            "padding",
            "secondary_button_padding",
            __("Button Padding"),
            $secondary_selector
        );

        // typography sub-section
        $secondary_button_typography = $secondary_buttons->typographySection(__("Typography"), $secondary_selector, $this);

        $secondary_button_typography->addStyleControls(
            array(
                array(
                    "name" => __('Hover Color'),
                    "selector" => $secondary_selector_hover,
                    "property" => 'color',
                ),
            )
        );

        // border sub-sections
        $secondary_buttons->borderSection(__("Border"), $secondary_selector, $this);
        $secondary_buttons->borderSection(__("Hover Border"), $secondary_selector_hover, $this);

        /**
         * Info Messages
         */

        $info_messages = $this->addControlSection("info_messages", __("Info Messages"), "assets/icon.png", $this);
        $info_selector = ".woocommerce-info, .woocommerce ul.order_details";
    
        // texts sub-section
        $info_messages_typography = $info_messages->typographySection(__("Typography"), $info_selector, $this);

        $info_messages_typography->addStyleControls(
            array(
                array(
                    "name" => __('Icon Color'),
                    "selector" => ".woocommerce-info::before",
                    "property" => 'color',
                ),
            )
        );

        // links sub-section
        $info_messages_links = $info_messages->addControlSection("info_messages_links", __("Links"), "assets/icon.png", $this);
        $info_selector = ".woocommerce-info a";

        $info_messages_links->addStyleControls(
            array(
                array(
                    "name"     => __("Text color"),
                    "selector" => $info_selector,
                    "property" => 'color',
                ),
                array(
                    "name"     => __("Hover color"),
                    "selector" => $info_selector.":hover",
                    "property" => 'color',
                ),
                array(
                    "selector" => $info_selector,
                    "property" => 'font-family',
                ),
                array(
                    "selector" => $info_selector,
                    "property" => 'font-weight',
                ),
            )
        );

        // Payment Methods Section //
        $payment_methods = $this->addControlSection("payment_methods", __("Payment Methods"), "assets/icon.png", $this);

        $payment_typography = $payment_methods->typographySection(__("Typography"), '.payment_box p', $this);

        $bubble_box = $payment_methods->addControlSection("bubble_box", __("Bubble Box"), "assets/icon.png", $this);
        $bubble_selector = "#payment div.payment_box";

        $bubble_box->addPreset(
            "padding",
            "padding",
            __("Paddings"),
            $bubble_selector
        );

        $bubble_box->addStyleControls(
            array(
                array(
                    "selector" => $bubble_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name"     => __("Arrow Color"),
                    "selector" => '#payment div.payment_box::before',
                    "property" => 'border-color',
                ),
                array(
                    "selector" => $bubble_selector,
                    "property" => 'border-radius',
                ),
            )
        );

        $bubble_box->addPreset(
            "box-shadow",
            "box-shadow",
            __("Box Shadow"),
            $bubble_selector
        );

        /**
         * Payments Background
         */

        $payments_background = $this->addControlSection("payments_background", __("Payments Background"), "assets/icon.png", $this);
        $payments_selector = ".woocommerce-checkout #payment";

        $payments_background->addPreset(
            "padding",
            "payments_background_padding",
            __("Payments Background Paddings"),
            $payments_selector
		);

        $payments_background->addStyleControls(
            array(
                array(
                    "selector" => $payments_selector,
                    "property" => 'background-color',
                ),
            )
        );

        $payments_background_box_shadow = $payments_background->addControlSection("order_background_box_shadow", __("Box Shadow"), "assets/icon.png", $this);
		
		$payments_background_box_shadow->addPreset(
            "box-shadow",
            "payments_background_shadow",
            __("Payments Background Shadow"),
            $payments_selector
        );

        // border sub-section
        $payments_background->borderSection(
            __("Borders"),
            $payments_selector,
            $this);


    }

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

 
    }
    
}

new Checkout();
