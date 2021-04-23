<?php

namespace Oxygen\WooElements;

class ProductImages extends \OxyWooEl {

	public $has_js = true;

    function name() {
        return 'Product Images';
    }

    function render($options, $defaults, $content) {

    	global $product, $post;
        $product = wc_get_product();

        if ($product === false) {
        	return;
        }

    	if ( function_exists( 'woocommerce_show_product_sale_flash' ) ) {
			woocommerce_show_product_sale_flash();
    	}

    	if ( function_exists( 'woocommerce_show_product_images' ) ) {
			woocommerce_show_product_images();
    	}
    }

    function woo_button_place() {
        return "single";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function custom_init() {
    	add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    function enqueue_scripts() {
    	
    	if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
			wp_enqueue_script( 'zoom' );
		}
		if ( current_theme_supports( 'wc-product-gallery-slider' ) ) {
			wp_enqueue_script( 'flexslider' );
		}
		if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
			wp_enqueue_script( 'photoswipe-ui-default' );
			wp_enqueue_style( 'photoswipe-default-skin' );
			add_action( 'wp_footer', 'woocommerce_photoswipe' );
		}
		wp_enqueue_script( 'wc-single-product' );
    }

    function controls() {

		$layout_section = $this->addControlSection("layout", __("Layout"), "assets/icon.png", $this);

		$images_align = $layout_section->addControl("buttons-list", "images_align", __("Thumbnails Layout") );
		$images_align->setValue( array(
			"horizontally"	=> "Horizontally Bottom",
			"right" 		=> "Vertically Right", 
			"left" 			=> "Vertically Left",
			"grid" 			=> "Grid" ) 
		);

		$images_align->setValueCSS( array(

			"default" => "",

			"right" => "
			  .flex-viewport {
				display: block;
				width: 100%;
				margin-right: 102px;
			  }
			  div.images.woocommerce-product-gallery {
				display: flex;
				overflow: hidden;
				position: relative;
			  }
			  .woocommerce-product-gallery__wrapper {
				width: 100%;
			  }
			  .flex-control-thumbs {
				flex-direction: column;
				flex-wrap: nowrap;
				height: 100%;
				overflow: auto;
				position: absolute;
				right: 0;
				width: auto;
				align-items: center;
			  }
			  .flex-control-thumbs li {
				width: 100%;
				flex-shrink: 0;
			  }
			  .woocommerce-product-gallery__trigger {
				left: .5em;
			  }
			", 	  
			  
			"left"  => "
			  .flex-viewport {
				display: block;
				width: 100%;
				margin-left: 102px;
			  }
			  div.images.woocommerce-product-gallery {
				display: flex;
				overflow: hidden;
				position: relative;
			  }
			  .woocommerce-product-gallery__wrapper {
				width: 100%;
			  }
			  .flex-control-thumbs {
				display: flex;
				flex-direction: column;
				flex-wrap: nowrap;
				height: 100%;
				overflow: auto;
				position: absolute;
				left: 0;
				width: auto;
				align-items: center;
			  }
			  .flex-control-thumbs li {
				width: 100%;
				flex-shrink: 0;
			  }
			  .woocommerce div.product div.images .woocommerce-product-gallery__trigger {
				right: .5em;
			  }
			",

			"grid" => "
			  .flex-viewport {
				display: none;
			  }
			  .woocommerce-product-gallery__trigger {
				display: none;
			  }
			  .flex-control-thumbs {
				display: flex;
				flex-direction: row;
				flex-wrap: wrap;
				width: 100%;
			  }
			  .flex-control-thumbs li {
				width: 25%;
				flex-shrink: 0;
			  }
			  @media (max-width:768px) {
				.flex-control-thumbs li {
				  width: 33.33%;}
			  }
			  @media (max-width:480px) {
				.flex-control-thumbs li {
				  width: 50%;}
			  }
			"
		));

		$layout_section->addStyleControl(
        	array(
        		"name" => __("Images Border Radius"),
        		"selector" => "div.flex-viewport, div.images .flex-control-thumbs li, .woocommerce-product-gallery__wrapper",
        		"property" => 'border-radius',
        	)
		);

		/**
         * Main Image
         */

		$main_image_section = $this->addControlSection("main_image_section", __("Main Image"), "assets/icon.png", $this);

		$main_image_section->addStyleControls(
            array(
                array(
                    "selector" => ".woocommerce-product-gallery__wrapper img",
                    "property" => 'opacity',
				),
				
				array(
                    "selector" => ".woocommerce-product-gallery__wrapper, div.flex-viewport",
                    "property" => 'border-color',
				),

				array(
                    "selector" => ".woocommerce-product-gallery__wrapper",
                    "property" => 'background-color',
                ),
				
            )
		);

		$main_image_borderWidth = $main_image_section->addStyleControl(
            array(
                "property" => 'border-width',
				"selector" => ".woocommerce-product-gallery__wrapper, div.flex-viewport",
				"control_type" => 'measurebox'
            )
        );

		$main_image_borderWidth->setUnits("px","px,em");
		
		$main_image_section->addPreset(
            "margin",
            "main_image_margins",
            __("Image Margins"),
            ".woocommerce-product-gallery__wrapper, div.flex-viewport"
		);

		$main_image_box_shadow = $main_image_section->addControlSection("main_image_box_shadow", __("Box Shadow"), "assets/icon.png", $this);
		
		$main_image_box_shadow->addPreset(
            "box-shadow",
            "main_image_shadow",
            __("Image Box Shadow"),
            ".woocommerce-product-gallery__wrapper, div.flex-viewport"
        );
        
        /*
         * Original Thumbnail
         */
		
		$original_thumb = $this->addControlSection("origianl_thumb", __("Original Thumbnails"), "assets/icon.png", $this);

		$original_thumb->addStyleControls(
            array(
                array(
                    "selector" => ".flex-control-thumbs li img",
                    "property" => 'opacity',
				),
				
				array(
                    "selector" => ".flex-control-thumbs li",
                    "property" => 'background-color',
                ),
            )
        );
		
		$original_thumb->addStyleControl(
        	array(
				"name" => __("Border Color"),
				"selector" => ".flex-control-thumbs li",
        		"property" => 'border-color',
        	)
		);
		
		$original_thumb_borderWidth = $original_thumb->addStyleControl(
        	array(
				"name" => __("Border Width"),
				"selector" => ".flex-control-thumbs li",
        		"property" => 'border-width',
        	)
		);

		$original_thumb_borderWidth->setUnits("px","px,em");
		
		$original_thumb->addPreset(
            "margin",
            "original_thumb_margins",
            __("Margin Between Thumbs"),
            ".flex-control-thumbs li"
		);

		$original_thumb_box_shadow = $original_thumb->addControlSection("original_thumb_box_shadow", __("Box Shadow"), "assets/icon.png", $this);
		
		$original_thumb_box_shadow->addPreset(
            "box-shadow",
            "original_thumb_shadow",
            __("Original Thumbs Shadow"),
            ".flex-control-thumbs li"
        );

        /**
         * Hovered Thumbnail
         */
		
		$hover_thumb = $this->addControlSection("hover_thumb", __("Hovered Thumbnails"), "assets/icon.png", $this);

		$hover_thumb->addStyleControls(
            array(
                array(
                    "selector" => ".flex-control-thumbs li:hover img",
                    "property" => 'opacity',
				),
				
				array(
                    "selector" => ".flex-control-thumbs li:hover",
                    "property" => 'background-color',
                ),
            )
        );
		
		$hover_thumb->addStyleControl(
        	array(
        		"name" => __("Border Color"),
        		"selector" => ".flex-control-thumbs li:hover",
        		"property" => 'border-color',
        	)
		);
		
		$hover_thumb_borderWidth = $hover_thumb->addStyleControl(
        	array(
        		"name" => __("Border Width"),
        		"selector" => ".flex-control-thumbs li:hover",
        		"property" => 'border-width',
        	)
		);

		$hover_thumb_borderWidth->setUnits("px","px,em");

		$hover_thumb_box_shadow = $hover_thumb->addControlSection("hover_thumb_box_shadow", __("Box Shadow"), "assets/icon.png", $this);
		
		$hover_thumb_box_shadow->addPreset(
            "box-shadow",
            "hover_thumb_shadow",
            __("Hover Thumbs Shadow"),
            ".flex-control-thumbs li:hover"
        );


        /**
         * Active Thumbnail
         */
		
		$active_thumb = $this->addControlSection("active_thumb", __("Active Thumbnails"), "assets/icon.png", $this);

		$active_thumb->addStyleControls(
            array(
                array(
                    "selector" => ".flex-control-thumbs li img.flex-active",
                    "property" => 'opacity',
                ),
            )
		);

		$active_thumb->addStyleControl(
			array(
				"type" => 'textfield',
				"name" => 'Scale Image',
				"selector" => ".flex-control-thumbs li img.flex-active",
				"property" => 'Transform',
				"default" => 'scale(1)',
			)
		);
		
        /** 
         * Zoom Icon Color 
         */

		
		$zoom_icon = $this->addControlSection("zoom_icon", __("Zoom Icon"), "assets/icon.png", $this);
		$zoom_icon->addStyleControl(
            array(
            	"name" => __("Color"),
        		"selectors" => array(
                    array(
                        "selector" => 'div.images .woocommerce-product-gallery__trigger:before',
                        "property" => 'border-color',
                    ),
                    array(
                        "selector" => 'div.images .woocommerce-product-gallery__trigger:after',
                        "property" => 'background',
                    ),
                ),
                "control_type" => 'colorpicker'
            )
        );

		$zoom_icon->addStyleControl(
            array(
            	"name" => __("Hover Color"),
        		"selectors" => array(
                    array(
                        "selector" => 'div.images .woocommerce-product-gallery__trigger:hover:before',
                        "property" => 'border-color',
                    ),
                    array(
                        "selector" => 'div.images .woocommerce-product-gallery__trigger:hover:after',
                        "property" => 'background',
                    ),
                ),
                "control_type" => 'colorpicker'
            )
		);
		
		$zoom_icon->addStyleControl(
        	array(
        		"name" => __("Background Color"),
        		"selector" => '.woocommerce-product-gallery__trigger',
        		"property" => 'background-color',
        	)
		);

		$zoom_icon->addStyleControl(
        	array(
        		"name" => __("Hover Background Color"),
        		"selector" => '.woocommerce-product-gallery__trigger:hover',
        		"property" => 'background-color',
        	)
		);

		$zoom_icon_box_shadow = $zoom_icon->addControlSection("zoom_icon_box_shadow", __("Box Shadow"), "assets/icon.png", $this);

		$zoom_icon_box_shadow->addPreset(
            "box-shadow",
            "zoom_icon_shadow",
            __("Icon Box Shadow"),
            ".woocommerce-product-gallery__trigger"
		);
		
		$zoom_icon->borderSection(
            __("Borders"),
            ".woocommerce-product-gallery__trigger",
            $this
        );

		/** 
         * Sale Badge 
         */

		$sale_badge = $this->addControlSection("sale_badge", __("Sale Badge"), "assets/icon.png", $this);

		$sale_badge_selector = "span.onsale";

		$sale_badge->addPreset(
            "padding",
            "button_padding",
            __("Badge Paddings"),
            $sale_badge_selector
        );

		$sale_badge->addStyleControls(
            array(
                array(
                    "property" => 'background-color',
                    "selector" => $sale_badge_selector
				),
				array(
					"name" => __("Top Offset"),
                    "property" => 'top',
                    "selector" => $sale_badge_selector
				),
				array(
					"name" => __("Bottom Offset"),
                    "property" => 'bottom',
                    "selector" => $sale_badge_selector
				),
				array(
					"name" => __("Left Offset"),
                    "property" => 'left',
                    "selector" => $sale_badge_selector
				),
				array(
					"name" => __("Right Offset"),
                    "property" => 'right',
                    "selector" => $sale_badge_selector
                ),
            )
		);

		$sale_badge->typographySection('Color & Typography', $sale_badge_selector, $this);

		$sale_badge_box_shadow = $sale_badge->addControlSection("sale_badge_box_shadow", __("Box Shadow"), "assets/icon.png", $this);
		
		$sale_badge_box_shadow->addPreset(
            "box-shadow",
            "sale_badge_shadow",
            __("Badge Box Shadow"),
            $sale_badge_selector
		);
		
		$sale_badge->borderSection(
            __("Borders"),
            $sale_badge_selector,
            $this
        );

    }

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

 
    }

}

new ProductImages();
