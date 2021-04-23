<?php

namespace Oxygen\WooElements;

class ArchiveCategories extends \OxyWooEl {

    function name() {
        return 'Categories List';
    }

    function slug() {
        return 'woo-product-categories';
    }

    function woo_button_place() {
        return "archive";
    }
    
    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }
    
    function render($options, $defaults, $content) {

        /*
        ids – Specify specific category ids to be listed
        limit – The number of categories to display
        columns – The number of columns to display. Defaults to 4
        hide_empty – The default is “1” which will hide empty categories. Set to “0” to show empty categories
        parent – Set to a specific category ID if you would like to display all the child categories
        orderby – The default is to order by “name”, can be set to “id”, “slug”, or “menu_order”. If you want to order by the ids you specified then you can use orderby="include"
        order – States whether the category ordering is ascending (ASC) or descending (DESC), using the method set in orderby. Defaults to ASC.
        */

    	$defaults = array(
    		'ids' => "",  
    		'limit' => "",
    		'columns' => "",
    		'hide_empty' => "",
    		'parent' => "",
    		'orderby' => "",
    		'order' => "",
    	);
    	$shortcode_props = shortcode_atts($defaults, $options);

		$atts_string = '';

		foreach ($shortcode_props as $name => $value) {
			if ($value) {
				$atts_string .= ' '.$name.'='.$value;
			}
		}

		$shortcode = '[product_categories '.$atts_string.']';

		echo do_shortcode($shortcode);


	}
	
    function controls() {

        /* Images */
        $categories_images = $this->addControlSection("categories_images", __("Images"), "assets/icon.png", $this);
        $categories_images_selector = '.product-category a img';

        $categories_images->borderSection(
            __("Borders"),
            $categories_images_selector,
            $this
        );
        
        $categories_images->boxShadowSection(
            __("Box Shadow"),
            $categories_images_selector,
            $this,
            null,
            false //remove inset control
        );

        /* Typography */
        $categories_typography = $this->addControlSection("categories_typography", __("Typography"), "assets/icon.png", $this);

        $links_section = $categories_typography->typographySection(
            __("Links"),
            ".woocommerce-loop-category__title",
            $this
        );

        $links_section->addStyleControl(
            array(
                "name" => __('Hover Color'),
                "selector" => '.woocommerce-loop-category__title:hover',
                "property" => 'color',
            )
        );
            

        $qty_section = $categories_typography->typographySection(
            __("Quantity"),
            ".count",
            $this
        ); 


        /* Categories Query Section */

        $categories_query = $this->addControlSection("categories_query", __("Categories Query"), "assets/icon.png", $this);

        
        $categories_query->addOptionControl(
			array(
                "type" => 'textfield',
				"name" => 'IDs',
				"slug" => 'ids'
            )
		);

		$categories_query->addOptionControl(
			array(
                "type" => 'textfield',
				"name" => 'Limit',
				"slug" => 'limit'
            )
		);

		$categories_query->addOptionControl(
			array(
                "type" => 'textfield',
                "name" => 'Columns',
                "slug" => 'columns',
            )
		);

        $categories_query->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => 'Hide Empty',
                "slug" => 'hide_empty',
            )
		)->setValue(array('true', 'false'));


		$categories_query->addOptionControl(
			array(
                "type" => 'textfield',
                "name" => 'Parent',
                "slug" => 'parent'
            )
		);

		$categories_query->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => 'Order',
                "slug" => 'order'
            )
		)->setValue(array('ASC', 'DESC'));

		$categories_query->addOptionControl(
			array(
                "type" => 'dropdown',
                "name" => 'Order By',
                "slug" => 'orderby'
            )
		)->setValue(array('name', 'id', 'slug', 'menu_order', 'include'));


	}

	function defaultCSS() {
        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');
    }
    
}

new ArchiveCategories();


