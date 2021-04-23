<?php

namespace Oxygen\WooElements;

class ProductExcerpt extends \OxyWooEl {

    function name() {
        return 'Product Excerpt';
    }

    function tag() {
        return $this->textTagChoices();
    }

    function wooTemplate() {
        return 'woocommerce_template_single_excerpt';
    }

    function woo_button_place() {
        return "single";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }
    
    function controls() {

        $this->addTagControl();

        $selector = ".woocommerce-product-details__short-description p";

        $this->addStyleControl(
            array(
                "property" => 'font-family',
                "selector" => $selector
            )
        );

        $this->addStyleControl(
            array(
                "property" => 'color',
                "selector" => $selector
            )
        );

        $this->addStyleControl(
            array(
                "property" => 'font-size',
                "selector" => $selector
            )
        );

        $this->addStyleControl(
            array(
                "property" => 'font-weight',
                "selector" => $selector
            )
        );
        
        $this->addTagControl();
    
    }

    function defaultCSS() {
        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');
    }


}

new ProductExcerpt();

