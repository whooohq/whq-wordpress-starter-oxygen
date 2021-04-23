<?php

namespace Oxygen\WooElements;

class ProductInfo extends \OxyWooEl {

    function name() {
        return 'Product Info';
    }

    function wooTemplate() {
        return 'woocommerce_product_additional_information_tab';
    }

    function woo_button_place() {
        return "single";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function controls() {

        $headingSection = $this->typographySection(
            __("Heading"),
            'h2',
            $this);

        $headingSection->addStyleControls(
            array(
                array(
                    "property" => 'display',
                    "selector" => "h2"
                ),
            )
        );

        $this->typographySection(
            __("Table Headers"),
            'table.shop_attributes th',
            $this);

        $this->typographySection(
            __("Table Values"),
            'table.shop_attributes td p', /* could just use table.shop_attributes td, but th + td is a more specific selector */
            $this);

        $cellSection = $this->addControlSection("cells", __("Table Cells"), "assets/icon.png", $this);

        $cellSection->addPreset(
            "padding",
            "table_cell_padding",
            __("Padding"),
            "table.shop_attributes th, table.shop_attributes td"
        );

        $cellSection->addStyleControls(
            array(
                array(
                    "name" => __('Background'),
                    "property" => 'background-color',
                    "selector" => "table.shop_attributes tr"
                ),
                array(
                    "name" => __('Alternating Background'),
                    "property" => 'background-color',
                    "selector" => "table.shop_attributes tr:nth-child(even)"
                ),
                array(
                    "name" => __('Border Color'),
                    "property" => 'border-color',
                    "selector" => "table.shop_attributes th, table.shop_attributes td"
                ),
            )
        );
          
    }

        
    function defaultCSS() {
        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');
    }

}

new ProductInfo();
