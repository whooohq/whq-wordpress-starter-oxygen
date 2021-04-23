<?php

namespace Oxygen\WooElements;

class ProductMeta extends \OxyWooEl {

    function name() {
        return 'Product Meta';
    }
    
    function wooTemplate() {
        return 'woocommerce_template_single_meta';
    }

    function woo_button_place() {
        return "single";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }
    
    function controls() {

        $this->typographySection(
        	__("Label Typography"), 
            ".product_meta span",
            // previously, this selector was ".product_meta span, .posted_in a, .tagged_as a"
            // was there a reason for this? .product_meta span is better.
            $this
        );

        $stacking_buttonlist = $this->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => __("Layout"),
                "slug" => 'stacking_list'
            )
        )->setValue(array('vertical', 'horizontal'))->setValueCSS(
            array(
                "vertical"  => ".product_meta {
                    flex-direction: column;
                }",
                "horizontal" => ".product_meta {
                    flex-direction: row;
                    flex-wrap: wrap;
                }
                .product_meta > span:not(:last-child) {
                    margin-right: 1em;
                }",
            )
        );

        /* font weight works, but the rest of these controls output nonsensical css */
        $value_typography_section = $this->addControlSection("value_typography", __("Value Typography"), "assets/icon.png", $this);
        $value_typography_section->addStyleControls(
        	array(
                array(
                    "name" => __('Font Size'),
                    "selector" => ".product_meta > span > span, .product_meta > span > a",
                    "property" => 'font-size',
                ),
                array(
                    "name" => __('Color'),
                    "selector" => ".product_meta > span > span",
                    "property" => 'color',
                ),
                array(
                    "name" => __('Font Weight'),
                    "selector" => ".product_meta > span > span, .product_meta > span > a",
                    "property" => 'font-weight',
                ),
            )
        );
            
        $Link_section = $this->addControlSection("links", __("Links"), "assets/icon.png", $this);

        $Link_section->addStyleControls(
        	array(
                array(
                    "name" => __('Link Color'),
                    "selector" => ".posted_in a, .tagged_as a",
                    "property" => 'color',
                ),
                array(
                    "name" => __('Link Hover Color'),
                    "selector" => ".posted_in a:hover, .tagged_as a:hover",
                    "property" => 'color',
                ),
                array(
                    "name" => __('Text Decoration'),
                    "selector" => ".posted_in a, .tagged_as a",
                    "property" => 'text-decoration',
                )
            )
        );
	
	}
    
    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

    }
}

new ProductMeta();
