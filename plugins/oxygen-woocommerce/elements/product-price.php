<?php

namespace Oxygen\WooElements;

class ProductPrice extends \OxyWooEl {

    function name() {
        return 'Product Price';
    }

    function wooTemplate() {
        return 'woocommerce_template_single_price';
    }

    function woo_button_place() {
        return "single";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function controls() {

        $this->typographySection('Color & Typography', '.price, .woocommerce-Price-amount, .price del');
        $strikethrough_section = $this->typographySection('Strikethrough On Sale', '.price del .woocommerce-Price-amount, .price del');

        // how can i put this button list inside the strikethrough_section?
        $stacking_buttonlist = $this->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => __("Sale Price Layout"),
                "slug" => 'stacking_list'
            )
        )->setValue(array('horizontal', 'vertical'))->setValueCSS(
            array(
                "vertical"  => ".price > del {
                    display: block;
                }",
                "",
            )
        );

        // future
        // add a font size control for the currency symbol


    }

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

 
    }

}

new ProductPrice();
