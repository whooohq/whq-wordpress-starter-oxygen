<?php

namespace Oxygen\WooElements;

class ProductRating extends \OxyWooEl {

    function name() {
        return 'Product Rating';
    }
    
    function wooTemplate() {
        return 'woocommerce_template_single_rating';
    }

    function woo_button_place() {
        return "single";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }
    
    function controls() {


		$stacking_buttonlist = $this->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => __("Layout"),
				"slug" => 'stacking_list'
			)
		)->setValue(array('horizontal', 'vertical'))->setValueCSS(
			array(
				"vertical"  => ".woocommerce-product-rating {
					flex-direction: column;
					margin-left: 0px;
				}",
				"horizontal" => "
				a.woocommerce-review-link {
					margin-left: 6px;
				}
				",
			)
		);

		/**
		 * Stars Section
		 */

        $stars_section = $this->addControlSection("stars", __("Stars"), "assets/icon.png", $this);
		$selector = "";
		
		$stars_section->addPreset(
			"margin",
			"stars_margin",
			__("Stars Margin"),
			'.star-rating'
		);

        $stars_section->addStyleControls(
        	array(
        		array(
	                "name" => __('Stars Size'),
	                "selector" => ".woocommerce-product-rating .star-rating",
	                "property" => 'font-size',
	            ),
	            array(
	                "name" => __('Filled Stars Color'),
	                "selector" => ".star-rating span",
	                "property" => 'color',
	            ),
	            array(
	                "name" => __('Empty Stars Color'),
	                "selector" => ".star-rating::before",
	                "property" => 'color',
	            ),
        	)
        );

    	/**
    	 * Text Link Section
    	 */

		$links_section = $this->addControlSection("link", __("Link"), "assets/icon.png", $this);

		/* Normal */
		
        $links_section->typographySection(
            __("Normal"),
            "a.woocommerce-review-link",
			$this);
			

		/* Hover */

		$links_hover_section = $links_section->addControlSection("hover", __("Hover"), "assets/icon.png", $this);
		$links_hover_section->addStyleControls(
			array(
				array(
                	"name" => __('Hover Color'),
                	"selector" => "a.woocommerce-review-link:hover",
					"property" => 'color',
				),
				array(
					"name" => __('Hover Text Decoration'),
					"selector" => "a.woocommerce-review-link:hover",
					"property" => 'text-decoration',
				),
			)
		);

    }

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');
 
    }
    
}

new ProductRating();
