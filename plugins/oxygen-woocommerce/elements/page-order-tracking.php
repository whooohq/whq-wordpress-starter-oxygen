<?php

namespace Oxygen\WooElements;

class OrderTracking extends \OxyWooEl {

    function name() {
        return 'Order Tracking';
    }

    function slug() {
        return 'woo-order-tracking';
    }

    function woo_button_place() {
        return "page";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function render($options, $defaults, $content) {
        echo do_shortcode('[woocommerce_order_tracking]');
    }

    function controls() {

        /* Message */
        $message_section = $this->typographySection(
            __("Message"),
            ".woocommerce-form-track-order p:not(.form-row)",
            $this
        );

        /* Labels */
        $labels_section = $this->typographySection(
            __("Labels"),
            ".woocommerce-form-track-order label",
            $this
        );

        /* Textfields */
        $textfields_section = $this->addControlSection("textfields_section", __("Textfields"), "assets/icon.png", $this);
        $textfields_selector = '.woocommerce-form-track-order input';

        $textfields_section->borderSection(
            __("Normal Borders"),
            $textfields_selector,
            $this
        );

        $textfields_section->boxShadowSection(
            __("Normal Box Shadow"),
            $textfields_selector,
            $this
        );

        $textfields_section->borderSection(
            __("Focus Borders"),
            $textfields_selector.":focus",
            $this
        );

        $textfields_section->boxShadowSection(
            __("Focus Box Shadow"),
            $textfields_selector.":focus",
            $this
        );

        $textfields_section->addPreset(
            "padding",
            "textfield_padding",
            __("Textfields Paddings"),
            $textfields_selector
        );

        $textfields_section->addStyleControls(
            array(
                array(
                    "name" => 'Placeholder Color',
                    "selector" => $textfields_selector."::placeholder",
                    "property" => 'color',
                ),
                array(
                    "name" => 'Font Size',
                    "selector" => $textfields_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => 'Background Color',
                    "selector" => $textfields_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Font Family',
                    "selector" => $textfields_selector,
                    "property" => 'font-family',
                )
            )
        );

        /* Submit */
        $submit_section = $this->addControlSection("categories_typography", __("Submit"), "assets/icon.png", $this);
        $submit_selector = 'button.button';

        $submit_section->addPreset(
            "padding",
            "button_padding",
            __("Button Paddings"),
            $submit_selector
        );

        $submit_section->addStyleControls(
            array(
                array(
                    "name" => 'Background Color',
                    "selector" => $submit_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Background Hover Color',
                    "selector" => $submit_selector.":hover",
                    "property" => 'background-color',
                )
            )
        );

        $submit_section->typographySection(
            __("Typography"),
            $submit_selector,
            $this
        );

        $submit_section->borderSection(
            __("Borders"),
            $submit_selector,
            $this
        );

        $submit_section->borderSection(
            __("Hover Borders"),
            $submit_selector.":hover",
            $this
        );

        $submit_section->boxShadowSection(
            __("Box Shadow"),
            $submit_selector,
            $this
        );

        $submit_section->boxShadowSection(
            __("Hover Box Shadow"),
            $submit_selector.":hover",
            $this
        );

    }

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

    }
    
}

new OrderTracking();
