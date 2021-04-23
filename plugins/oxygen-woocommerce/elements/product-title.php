<?php

namespace Oxygen\WooElements;

class ProductTitle extends \OxyWooEl {

    function name() {
        return 'Product Title';
    }
    function tag() {
        return $this->headingTagChoices();
    }

    function woo_button_place() {
        return "single";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function render($options, $defaults, $content) {
        // how does this magically work even with these lines commented out:
        // global $post;
        // setup_postdata($post->ID);

        the_title();
    }
    /*
    function wooTemplate() {
        return 'woocommerce_template_single_title';
    }

    // rather than use wooTemplate, we'll manually do the same thing 
    // the WooCommerce template does, which results in a cleaner element
    */


    function class_names() {
        return array('product_title', 'entry-title', 'oxy-woo-element');
    }


    function controls() {

        $this->addStyleControl(
            array(
                "property" => 'font-family',
            )
        );

        $this->addStyleControl(
            array(
                "property" => 'color',
            )
        );

        $this->addStyleControl(
            array(
                "property" => 'font-size',
            )
        );

        $this->addStyleControl(
            array(
                "property" => 'font-weight',
            )
        );

        $this->addTagControl();

    }

}

new ProductTitle();
