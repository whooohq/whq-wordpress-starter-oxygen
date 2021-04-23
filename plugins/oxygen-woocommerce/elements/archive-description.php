<?php

namespace Oxygen\WooElements;

class ArchiveDescription extends \OxyWooEl {

    function name() {
        return 'Archive Description';
    }

    function slug() {
        return 'woo-archive-description';
    }

    function tag() {
        return $this->textTagChoices();
    }

    function woo_button_place() {
        return "archive";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function render($options, $defaults, $content) {
        do_action('woocommerce_archive_description');
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

new ArchiveDescription();
