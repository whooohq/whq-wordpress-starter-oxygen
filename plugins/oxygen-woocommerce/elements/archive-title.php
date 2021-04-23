<?php

namespace Oxygen\WooElements;

class ArchiveTitle extends \OxyWooEl {

    function name() {
        return 'Archive Title';
    }

    function tag() {
        return $this->headingTagChoices();
    }

    function class_names() {
        return array('page-title', 'oxy-woo-element');
    }

    function slug() {
        return "woo-archive-title";
    }

    function woo_button_place() {
        return "archive";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function render($options, $defaults, $content) {

        if (apply_filters('woocommerce_show_page_title', true)) {

            woocommerce_page_title();

        }

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

    function defaultCSS() {
        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');
    }

}

new ArchiveTitle();



