<?php

namespace Oxygen\WooElements;

class ArchiveProducts extends \OxyWooEl {

   var $query_params = array(
            'columns' => "",
            'paginate' => "",
            'limit' => "",
            'orderby' => "",
            'order' => "",
            'category' => "",
            'cat_operator' => "",
            'on_sale' => "",
            'best_selling' => "",
            'top_rated' => "",
            'ids' => "",
            'skus' => "",
            'attribute' => "",
            'terms' => "",
            'terms_operator' => "",
            'visibility' => "",
        );

    function name() {
        return 'Products List';
    }

    function slug() {
        return "woo-products";
    }

    function woo_button_place() {
        return "archive";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }
    
    function render($options, $defaults, $content) {

    	
        $shortcode_props = shortcode_atts($this->query_params, $options);

		$atts_string = '';

		foreach ($shortcode_props as $name => $value) {
			if ($value) {
				$atts_string .= ' '.$name.'='.$value;
			}
		}

        $shortcode = '[products '.$atts_string.']';
        
//        echo "<br /><br />Raw shortcode: <br /><span style='font-family: monospace;'>".$shortcode."</span><br /><br />";
        
        if ($options['query_type'] == 'custom') {
            echo do_shortcode($shortcode);
        } else {
            woocommerce_content();    
        }


        // ;

		/*

		$options = null;
		$options['limit'] = 24; // number of products to display (-1 is all) - DONE
		$options['columns'] = 4; // number of columns
		$options['paginate'] = true; // true or false

		$options['orderby'] = 'date'; // date, id, menu_order, popularity, rand, rating, title. you can use a space between options to combine, i.e. date and popularity
		$options['order'] = 'DESC'; // DESC or ASC

		$options['category'] = ''; // Comma separated list of category slugs.
		$options['cat_operator'] = ''; //  Operator to compare category terms. Available options are:
		// AND – Will display products that belong in all of the chosen categories.
		// IN – Will display products within the chosen category. This is the default cat_operator value.
		// NOT IN – Will display products that are not in the chosen category.

		$options['on_sale'] = ''; // set to true to retrieve on sale products. Not to be used in conjunction with best_sellingor top_rated.
		$options['best_selling'] = ''; // set to true to retrieve on sale products. Not to be used in conjunction with best_sellingor top_rated.
		$options['top_rated'] = ''; // set to true to retrieve on sale products. Not to be used in conjunction with best_sellingor top_rated.

		$options['ids'] = ''; // Will display products based off of a comma separated list of Post IDs
		$options['skus'] = ''; // Will display products based off of a comma separated list of SKUs

		$options['attribute'] = ''; // Retrieves products using the specified attribute slug.
		$options['terms'] = ''; // Comma separated list of attribute terms to be used with attribute.

		$options['terms_operator'] = ''; // – Operator to compare attribute terms. Available options are:
		// AND – Will display products from all of the chosen attributes.
		// IN – Will display products with the chosen attribute. This is the default terms_operator value.
		// NOT IN – Will display products that are not in the chosen attributes.

		$options['visibility'] = ''; // Will display products based on the selected visibility. Available options are
		// visible – Products visibile on shop and search results. This is the default visibility option.
		// catalog – Products visible on the shop only, but not search results.
		// search – Products visible in search results only, but not on the shop.
		// hidden – Products that are hidden from both shop and search, accessible only by direct URL.
		// featured – Products that are marked as Featured Products.

		*/

	}
	
    function controls() {

        /*
         * Products Query Section
         */

        $products_query = $this->addControlSection("products_query", __("Products Query"), "assets/icon.png", $this);

        $products_query->addOptionControl(
            array(
                "type" => 'buttons-list',
                "name" => __("Query Type"),
                "slug" => 'query_type',
            )
        )->setValue(array('default', 'custom'));

        $query_params = array_keys($this->query_params);
        $query_params = array_map(function($value) {
            return $this->El->prefix_option($value);
        }, $query_params);
        $query_params = implode("','",$query_params);

        $reset_query_control = $products_query->addCustomControl(
            '<div class="oxygen-control-wrapper">
                <div class="oxygen-widget-settings-apply-button"
                    ng-click="iframeScope.unsetOptions([\''.$query_params.'\'])">'.
                        __("Reset Custom Query", "oxygen")
                    .'</div>
                </div>');
        $reset_query_control->setCondition("query_type=custom");

		$products_query->addOptionControl(
			array(
                "type" => 'textfield',
				"name" => 'Limit',
				"slug" => 'limit',
                "condition" => 'query_type=custom',
            )
		);

		$products_query->addOptionControl(
			array(
                "type" => 'textfield',
                "name" => 'Columns',
                "slug" => 'columns',
                "condition" => 'query_type=custom',
            )
		);

		$products_query->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => 'Paginate',
                "slug" => 'paginate',
                "condition" => 'query_type=custom',
            )
		)->setValue(array('true', 'false'));


		$products_query->addOptionControl(
			array(
                "type" => 'dropdown',
                "name" => 'Order By',
                "slug" => 'orderby',
                "condition" => 'query_type=custom',
            )
		)->setValue(array('date', 'id', 'menu_order', 'popularity', 'rand', 'rating', 'title'));

		$products_query->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => 'Order',
                "slug" => 'order',
                "condition" => 'query_type=custom',
            )
		)->setValue(array('ASC', 'DESC'));

		$products_query->addOptionControl(
			array(
                "type" => 'textfield',
                "name" => 'Category',
                "slug" => 'category',
                "condition" => 'query_type=custom',
            )
		);

		$products_query->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => 'Cat Operator',
                "slug" => 'cat_operator',
                "condition" => 'query_type=custom',
            )
		)->setValue(array('AND', 'IN', 'NOT IN'));

		
		$products_query->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => 'On Sale Only',
                "slug" => 'on_sale',
                "condition" => 'query_type=custom',
            )
		)->setValue(array('true', 'false'))->setDefaultValue('false');

		$products_query->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => 'Best Selling',
                "slug" => 'best_selling',
                "condition" => 'query_type=custom',
            )
		)->setValue(array('true', 'false'))->setDefaultValue('false');

		$products_query->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => 'Top Rated',
                "slug" => 'top_rated',
                "condition" => 'query_type=custom',
            )
		)->setValue(array('true', 'false'))->setDefaultValue('false');


		$products_query->addOptionControl(
			array(
                "type" => 'textfield',
                "name" => 'IDs',
                "slug" => 'ids',
                "condition" => 'query_type=custom',
            )
		);

		$products_query->addOptionControl(
			array(
                "type" => 'textfield',
                "name" => 'SKUs',
                "slug" => 'skus',
                "condition" => 'query_type=custom',
            )
		);

		$products_query->addOptionControl(
			array(
                "type" => 'textfield',
                "name" => 'Attribute',
                "slug" => 'attribute',
                "condition" => 'query_type=custom',
            )
		);
        
        $products_query->addOptionControl(
			array(
                "type" => 'textfield',
                "name" => 'Terms',
                "slug" => 'terms',
                "condition" => 'query_type=custom',
            )
		);

		$products_query->addOptionControl(
			array(
                "type" => 'buttons-list',
                "name" => 'Terms Operator',
                "slug" => 'terms_operator',
                "condition" => 'query_type=custom',
            )
		)->setValue(array('AND', 'IN', 'NOT IN'));

		$products_query->addOptionControl(
			array(
                "type" => 'dropdown',
                "name" => 'Visibility',
                "slug" => 'visibility',
                "condition" => 'query_type=custom',
            )
        )->setValue(array('visible', 'catalog', 'search', 'hidden', 'featured'));

         /* Layout */
         $layout_section = $this->addControlSection("layout", __("Layout"), "assets/icon.png", $this);

         $layout_section->addPreset(
             "padding",
             "columns_inner_padding",
             __("Columns Inner Padding"),
             'li.product'
         );
 
         $items_align = $layout_section->addControl("buttons-list", "items_align", __("Items Align") );
         
         $items_align->setValue( array(
             "left"		=> "Left",
             "center" 	=> "Center", 
             "right" 		=> "Right" ) 
         );
         
         $items_align->setValueCSS( array(
 
             "left" => "
                 .woocommerce-loop-product__link {
                 align-items: flex-start;
                 text-align: left;
             }
             ",
             
             "center" => "
                 .woocommerce-loop-product__link {
                 align-items: center;
                 text-align: center;
             }
             ",
 
             "right" => "
                 .woocommerce-loop-product__link {
                 align-items: flex-end;
                 text-align: right;
             }
             "
             )
         );
 
         $items_columns = $layout_section->addControl("buttons-list", "items_columns", __("Columns") );
         
         $items_columns->setValue( array(
             "one"      => "One",
             "two"		=> "Two",
             "three" 	=> "Three", 
             "four" 		=> "Four",
             "five" 		=> "Five",
              ) 
         );
         
         $items_columns->setValueCSS( array(
             
             "one" => "
                 li.product {
                 width: 100%;
             }
             ",

             "two" => "
                 li.product {
                 width: 50%;
             }
             ",
             
             "three" => "
                 li.product {
                 width: 33.33%;
             }
             ",
 
             "four" => "
                 li.product {
                 width: 25%;
             }
             ",
 
             "five" => "
                 li.product {
                 width: 20%;
             }
             "
             )
         );
         $items_columns->whiteList();

        /*---Heading Typography---*/

        $headings_section = $this->typographySection(
            __("Heading"),
            "h1.page-title",
            $this
        );

        /*---Results Typography ---*/

        $results_section = $this->typographySection(
            __("Results Count"),
            ".woocommerce-result-count",
            $this
        );

        /**
        * Sorting Select
        */

        $sorting_select = $this->addControlSection("sorting_select", __("Sorting Select"), "assets/icon.png", $this);
        $sorting_select_selector = ".woocommerce .woocommerce-ordering select";

        $sorting_select->addPreset(
            "padding",
            "sorting_select_padding",
            __("Select Padding"),
            $sorting_select_selector
        );

        // typography sub-section
        $sorting_select->typographySection(
            __("Typography"),
            $sorting_select_selector,
            $this);

        // border sub-section
        $sorting_select->borderSection(
            __("Border"),
            $sorting_select_selector,
            $this);

        // border sub-section
        $sorting_select->borderSection(
            __("Focus Border"),
            $sorting_select_selector.":focus",
            $this);

        // box-shadow sub-section
        $sorting_select->boxShadowSection(
            __("Box Shadow"),
            $sorting_select_selector,
            $this);

        // box-shadow sub-section
        $sorting_select->boxShadowSection(
            __("Focus Box Shadow"),
            $sorting_select_selector.":focus",
            $this);

        

         /* Sales Badges */

         $sales_badge = $this->addControlSection("sales_badge", __("Sales Badge"), "assets/icon.png", $this);
         $sales_badge_selector = "ul.products li.product .onsale, span.onsale";
         $sales_badge->addStyleControls(
              array(
                 array(
                     "selector" => $sales_badge_selector,
                     "property" => 'background-color',
                 ),
                 array(
                     "name" => __('Top Offset'),
                     "selector" => $sales_badge_selector,
                     "property" => 'top',
                 ),
                 array(
                     "name" => __('Left Offset'),
                     "selector" => $sales_badge_selector,
                     "property" => 'left',
                 ),
                 array(
                     "selector" => $sales_badge_selector,
                     "property" => 'font-size',
                 ),
                 array(
                     "selector" => $sales_badge_selector,
                     "property" => 'font-family',
                 ),
                 array(
                     "selector" => $sales_badge_selector,
                     "property" => 'line-height',
                 ),
                 array(
                     "selector" => $sales_badge_selector,
                     "property" => 'border-radius',
                 ),
                 array(
                     "selector" => $sales_badge_selector,
                     "property" => 'text-transform',
                 )
             )
         );

        /* Images */
        $product_images = $this->addControlSection("categories_images", __("Images"), "assets/icon.png", $this);
        $product_images_selector = 'img.attachment-woocommerce_thumbnail';

        $product_images->borderSection(
            __("Borders"),
            $product_images_selector,
            $this
        );
        
        $product_images->boxShadowSection(
            __("Box Shadow"),
            $product_images_selector,
            $this,
            null,
            false //remove inset control
        );

        /* Headings */
        $product_heading = $this->typographySection(
            __("Links"),
            ".woocommerce-loop-product__title",
            $this
        );

        $product_heading->addStyleControl(
            array(
                "name" => __('Hover Color'),
                "selector" => '.woocommerce-loop-product__title:hover',
                "property" => 'color',
            )
        );

        /* Stars */
        $stars_section = $this->addControlSection("stars", __("Stars"), "assets/icon.png", $this);
        $stars_section->addStyleControls(
        	array(
        		array(
	                "name" => __('Stars Size'),
	                "selector" => ".star-rating",
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

        /* Price */
        $price_section = $this->addControlSection("price_section", __("Price"), "assets/icon.png", $this);

        $price_typography = $price_section->typographySection(__("Current Price"),'.price, .price span', $this);
        $strikethrough_section = $price_section->typographySection(__("Strikethrough Price"),'.price del span, ul.products li.product .price del', $this);
            

        /* Add to Cart Button */
        $submit_section = $this->addControlSection("submit_section", __("Main Buttons"), "assets/icon.png", $this);
        $submit_selector = 'a.button';

        $submit_section->addPreset(
            "padding",
            "submit_padding",
            __("Button Paddings"),
            $submit_selector
        );

        $submit_section->addStyleControls(
            array(
                array(
                    "name" => 'Background Color',
                    "selector" => $submit_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Background Hover Color',
                    "selector" => $submit_selector.":hover",
                    "property" => 'background-color',
                )
            )
        );

        $submit_section->typographySection(
            __("Typography"),
            $submit_selector,
            $this
        );

        $submit_section->borderSection(
            __("Borders"),
            $submit_selector,
            $this
        );

        $submit_section->borderSection(
            __("Hover Borders"),
            $submit_selector.":hover",
            $this
        );

        $submit_section->boxShadowSection(
            __("Shadow"),
            $submit_selector,
            $this
        );

        $submit_section->boxShadowSection(
            __("Hover Shadow"),
            $submit_selector.":hover",
            $this
        );

        /* View Cart Button */
        $view_section = $this->addControlSection("view_section", __("View Cart Buttons"), "assets/icon.png", $this);
        $view_selector = '.added_to_cart';

        $view_section->addPreset(
            "padding",
            "view_padding",
            __("Button Paddings"),
            $view_selector
        );

        $view_section->addStyleControls(
            array(
                array(
                    "name" => 'Background Color',
                    "selector" => $view_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Background Hover Color',
                    "selector" => $view_selector.":hover",
                    "property" => 'background-color',
                )
            )
        );

        $view_section->typographySection(
            __("Typography"),
            $view_selector,
            $this
        );

        $view_section->borderSection(
            __("Borders"),
            $view_selector,
            $this
        );

        $view_section->borderSection(
            __("Hover Borders"),
            $view_selector.":hover",
            $this
        );

        $view_section->boxShadowSection(
            __("Shadow"),
            $view_selector,
            $this
        );

        $view_section->boxShadowSection(
            __("Hover Shadow"),
            $view_selector.":hover",
            $this
        );

        /**
         * Pagination 
         */

        $pagination = $this->addControlSection("pagination", __("Pagination"), "assets/icon.png", $this);

        $pagination_align = $pagination->addControl("buttons-list", "pagination_align", __("Items Align") );
        
		$pagination_align->setValue( array(
			"left"		=> "Left",
			"center" 	=> "Center", 
			"right" 		=> "Right" ) 
        );
        
		$pagination_align->setValueCSS( array(

            "left" => "
                .woocommerce-pagination {
                align-items: flex-start;
                text-align: left;
            }
            ",
            
            "center" => "
                .woocommerce-pagination {
                align-items: center;
                text-align: center;
            }
            ",

            "right" => "
                .woocommerce-pagination {
                align-items: flex-end;
                text-align: right;
            }
            "
            )
        );

        $pagination->addStyleControls(
             array(
                array(
                    "selector" => ".woocommerce-pagination",
                    "property" => 'font-size',
                ),

                array(
                    "name" => __("Links Text Color"),
                    "selector" => "nav.woocommerce-pagination ul li a",
                    "property" => 'color',
                ),
                array(
                    "name" => __("Links Background"),
                    "selector" => "nav.woocommerce-pagination ul li a",
                    "property" => 'background-color',
                ),

                // hover
                array(
                    "name" => __("Hover Text Color"),
                    "selector" => "nav.woocommerce-pagination ul li a:hover",
                    "property" => 'color',
                ),
                array(
                    "name" => __("Hover Background"),
                    "selector" => "nav.woocommerce-pagination ul li a:hover",
                    "property" => 'background-color',
                ),

                // current
                array(
                    "name" => __("Current Text Color"),
                    "selector" => "nav.woocommerce-pagination ul li span.current",
                    "property" => 'color',
                ),
                array(
                    "name" => __("Current Background"),
                    "selector" => "nav.woocommerce-pagination ul li span.current",
                    "property" => 'background-color',
                ),

                array(
                    "selector" => "nav.woocommerce-pagination ul, nav.woocommerce-pagination ul li",
                    "property" => 'border-color',
                ),
                
                array(
                    "selector" => "nav.woocommerce-pagination ul",
                    "property" => 'border-radius',
                ),
            )
        );
	}


	function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

 
    }
    
}

new ArchiveProducts();
