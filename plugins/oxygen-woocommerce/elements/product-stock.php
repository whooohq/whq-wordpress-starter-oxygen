<?php

namespace Oxygen\WooElements;

class ProductStock extends \OxyWooEl {

    function name() {
        return 'Product Stock';
    }

    function woo_button_place() {
        return "single";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function render($options, $defaults, $content) {

        global $product;
        $product = wc_get_product();

        if ($product != false) {
            echo wc_get_stock_html($product);
        }

    }

    function controls() {

        $in_stock_selector = 'p.stock.in-stock';
        $out_of_stock_selector = 'p.stock.out-of-stock';

        $this->typographySection(
            __("In Stock Typography"),
            $in_stock_selector,
            $this);

        $this->typographySection(
            __("Out Of Stock Typography"),
            $out_of_stock_selector,
            $this);

            /*
        $this->addStyleControls(
        	array(
                array(
                    "name" => __('Font Family'),
                    "selector" => $in_stock_selector,
                    "property" => 'font-family',
                ),
                array(
                    "name" => __('Color'),
                    "selector" => $in_stock_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Font Size'),
                    "selector" => $in_stock_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => __('Font Weight'),
                    "selector" => $in_stock_selector,
                    "property" => 'font-weight',
                ),
            )
        );

        */


    }

    function defaultCSS() {
        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');
    }

}

new ProductStock();
