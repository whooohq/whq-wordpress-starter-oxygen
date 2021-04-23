<?php

namespace Oxygen\WooElements;

class Breadcrumb extends \OxyWooEl {

    function name() {
        return 'Breadcrumb';
    }

    function render($options, $defaults, $content) {
        woocommerce_breadcrumb();
    }

    function woo_button_place() {
        return "other";
    }
    
    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function controls() {

        //Typography//
        $headings_section = $this->typographySection(
            __("Typography"),
            "nav.woocommerce-breadcrumb",
            $this
        ); 

        $links_section = $this->addControlSection("links_section", __("Links"), "assets/icon.png", $this);
        $links_selector = '.woocommerce-breadcrumb a';

        $links_section->addStyleControls(
            array(
                array(
                    "name" => 'Normal Color',
                    "selector" => $links_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => 'Hover Color',
                    "selector" => $links_selector.":hover",
                    "property" => 'color',
                ),
                array(
                    "name" => 'Hover Text Decoration',
                    "selector" => $links_selector.":hover",
                    "property" => 'text-decoration',
                )
            )
        );
    }

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

    }

}

new Breadcrumb();



