<?php

namespace Oxygen\WooElements;

class MyAccount extends \OxyWooEl {

    function name() {
        return 'My Account';
    }
    
    function slug() {
        return "woo-my-account";
    }

    function woo_button_place() {
        return "page";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }
    
    function render($options, $defaults, $content) {
        echo do_shortcode('[woocommerce_my_account]');
    }

    function controls() {

        /**
         * Menu Section
         */

        $horizontal_menu_section = $this->addControlSection("horizontal-menu", __("Account Menu"), "assets/icon.png", $this);

        $navigation 	= ".woocommerce-MyAccount-navigation";
        $navigation_ul 	= ".woocommerce-MyAccount-navigation ul";
        $content 		= ".woocommerce-MyAccount-content";

        $horizontal_menu_section->addStyleControls(
        	array(
        		// navigation
                array(
                    "name" => __('Menu Float'),
                    "selector" => $navigation,
                    "property" => 'float',
                ),
                array(
                    "name" => __('Menu Width'),
                    "selector" => $navigation,
                    "property" => 'width',
                ),
            )
        );
        
        $horizontal_menu_section->addPreset(
            "margin",
            "horizontal_menu_margins",
            __("Menu Margins"),
            $navigation
        );
               
        $horizontal_menu_section->addStyleControls(
        	array(
                // navigation ul
                array(
                    "name" => __('Menu Display'),
                    "selector" => $navigation_ul,
                    "property" => 'display',
                ),
                array(
                    "name" => __('Menu Flex Wrap'),
                    "selector" => $navigation_ul,
                    "property" => 'flex-wrap',
                ),

                // content
                array(
                    "name" => __('Content Float'),
                    "selector" => $content,
                    "property" => 'float',
                ),
                array(
                    "name" => __('Content Width'),
                    "selector" => $content,
                    "property" => 'width',
                ),
                array(
                    "name" => __('Content Max Width'),
                    "selector" => $content,
                    "property" => 'max-width',
                ),
            )
        );
		
		/**
         * Links section
         *
         */

        $links_section = $this->addControlSection("links", __("Menu Links"), "assets/icon.png", $this);
        
        $layout_section = $links_section->borderSection(
            __("Layout"),
            ".woocommerce-MyAccount-navigation ul li",
            $this);

        $layout_section->addPreset(
            "margin",
            "links_margins",
            __("Links Margins"),
            ".woocommerce-MyAccount-navigation ul li"
        );

		// typography sub-section
        $links_section->typographySection(__("Typography"), ".oxy-woo-my-account a, .woocommerce-MyAccount-navigation ul li a", $this);

        // hover sub-section
		$links_hover_section = $links_section->addControlSection("links_hover", __("Hover Link"), "assets/icon.png", $this);

		$selector_hover = ".oxy-woo-my-account a:hover, .woocommerce-MyAccount-navigation ul li:hover a";
        $links_hover_section->addStyleControls(
        	array(
                array(
                    "name" => __('Hover Color'),
                    "selector" => $selector_hover,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Hover Background Color'),
                    "selector" => ".oxy-woo-my-account a:hover, .woocommerce-MyAccount-navigation ul li:not(.is-active):hover",
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Hover Text Decoration'),
                    "selector" => $selector_hover,
                    "property" => 'text-decoration',
                ),
            )
        );

        // active menu link
        $active_link_section = $links_section->borderSection(
            __("Active Link"),
            ".woocommerce-MyAccount-navigation ul li.is-active",
            $this);

        $selector = ".is-active";
        $active_link_section->addStyleControls(
            array(
                array(
                    "selector" => $selector,
                    "property" => 'background-color',
                )
            )
        );

        $selector = ".woocommerce-MyAccount-navigation ul li.is-active a";
        $active_link_section->addStyleControls(
            array(
                array(
                    "name" => __('Text Color'),
                    "selector" => $selector,
                    "property" => 'color',
                ),
                array(
                    "selector" => $selector,
                    "property" => 'text-decoration',
                )
            )
        );

        $active_link_section->addPreset(
            "margin",
            "active_link_margins",
            __("Active Links Margins"),
            ".woocommerce-MyAccount-navigation ul li.is-active"
        );

        /**
         * Texts section
         *
         */

        $texts_section = $this->typographySection(
            __("Plain Texts"), 
            "p:not(.woocommerce-customer-details--email):not(.woocommerce-customer-details--phone):not(.woocommerce-form-row):not(.form-row)",
            $this);

        $selector = "p strong, mark";
        $texts_section->addStyleControl(
                array(
                    "name" => __('Bold Texts Color'),
                    "selector" => $selector,
                    "property" => 'color',
                )
        );

        
        /**
         * Headings section
         *
         */

        $headings_section = $this->typographySection(
            __("Headings"),
            "h2, h3, .woocommerce-EditAccountForm fieldset legend",
            $this); 


        /**
         * Headings section
         *
         */

        $headings_section = $this->typographySection(
            __("Headings"),
            "h2, h3, .woocommerce-EditAccountForm fieldset legend",
            $this); 


        /**
         * Label section
         *
         */

        $label_section = $this->typographySection(
            __("Labels"),
            ".woocommerce form .form-row label",
            $this);

        // required label sub-section
        $required_label_section = $label_section->addControlSection("required_label", __("Required Labels"), "assets/icon.png", $this);
        $selector = ".woocommerce form .form-row .required";
        $required_label_section->addStyleControls(
            array(
                array(
                    "name" => __('Text Color'),
                    "selector" => $selector,
                    "property" => 'color',
                ),
                array(
                    "selector" => $selector,
                    "property" => 'font-weight',
                ),
                array(
                    "selector" => $selector,
                    "property" => 'font-size',
                )
            )
        );


        /**
         * Primary Button
         *
         */

        $primary_button_section = $this->addControlSection("primary_button", __("Primary Button"), "assets/icon.png", $this);
        $selector = "input[type=submit], button[type=submit]";
        $primary_button_section->addStyleControls(
             array(
                array(
                    "selector" => $selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Text Color'),
                    "selector" => $selector,
                    "property" => 'color',
                )
            )
        );

        $primary_button_section->addPreset(
            "padding",
            "primary_button_padding",
            __("Button Padding"),
            $selector
        );

        // border sub-section
        $primary_button_section->borderSection(
            __("Button Border"),
            $selector,
            $this);

        // typography sub-section
        $primary_button_section->typographySection(
            __("Button Typography"),
            $selector,
            $this);

        // hover sub-section
        $hover_sub_section = $primary_button_section->addControlSection("primary_button_hover_section", __("Hover Colors"), "assets/icon.png", $this);
        $selector = ".woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover";
        $hover_sub_section->addStyleControls(
             array(
                array(
                    "selector" => $selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Text Color'),
                    "selector" => $selector,
                    "property" => 'color',
                ),
                array(
                    "selector" => $selector,
                    "property" => 'border-color',
                ),
            )
        );


        /**
         * Secondary Button
         *
         */

        $secondary_button_section = $this->addControlSection("secondary_button", __("Secondary Button"), "assets/icon.png", $this);
        $selector = ".woocommerce-page .woocommerce-info .button, .woocommerce-page .woocommerce-message .button, .woocommerce table.my_account_orders .button, .woocommerce a.button.alt";
        $secondary_button_section->addStyleControls(
             array(
                array(
                    "selector" => $selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Text Color'),
                    "selector" => $selector,
                    "property" => 'color',
                )
            )
        );

        $secondary_button_section->addPreset(
            "padding",
            "secondary_button_padding",
            __("Button Padding"),
            $selector
        );

        // border sub-section
        $secondary_button_section->borderSection(
            __("Button Border"),
            $selector,
            $this);

        // typography sub-section
        $secondary_button_section->typographySection(
            __("Button Typography"),
            $selector,
            $this);

        // hover sub-section
        $hover_sub_section = $secondary_button_section->addControlSection("secondary_button_hover_section", __("Hover Colors"), "assets/icon.png", $this);
        $selector = ".woocommerce-page .woocommerce-info .button:hover, .woocommerce-page .woocommerce-message .button:hover, .woocommerce table.my_account_orders .button:hover, .woocommerce a.button.alt:hover";
        $hover_sub_section->addStyleControls(
             array(
                array(
                    "selector" => $selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Text Color'),
                    "selector" => $selector,
                    "property" => 'color',
                ),
                array(
                    "selector" => $selector,
                    "property" => 'border-color',
                ),
            )
        );


        /**
         * Table
         *
         */

        $table_section = $this->addControlSection("table_section", __("Table"), "assets/icon.png", $this);
        $selector = ".woocommerce table.shop_table th, .woocommerce table.shop_table td, .woocommerce table.shop_table, .woocommerce table.shop_table tfoot th, .woocommerce table.shop_table tfoot td, .woocommerce table tr, .woocommerce .col2-set, .woocommerce-EditAccountForm, form.login, .woocommerce-info, .woocommerce-address-fields";
        $table_section->addStyleControl(
                array(
                    "selector" => $selector,
                    "property" => 'border-color',
                )
        );

        $table_section->addStyleControl(
            array(
                "selector" => $selector,
                "property" => 'background-color',
            )
        );

        // texts sub-section
        $selector = ".woocommerce table.shop_table th, .woocommerce table.shop_table td";
        $table_texts_section = $table_section->typographySection(
            __("Table Texts"),
            $selector,
            $this);

        // texts sub-section
        $selector = ".woocommerce-Price-amount, .product-name strong";
        $table_texts_section = $table_section->typographySection(
            __("Table Bold Texts"),
            $selector,
            $this);

        /**
         * Inputs
         *
         */

        $inputs_section = $this->addControlSection("inputs", __("Inputs"), "assets/icon.png", $this);
        $selector = ".woocommerce form .form-row input.input-text, .select2-container--default .select2-selection--single, .select2-container--default .select2-search--dropdown .select2-search__field, .select2-dropdown";

        $inputs_section->addPreset(
            "padding",
            "input_padding",
            __("Input Padding"),
            $selector
        );
        
        $inputs_section->addStyleControls(
            array(
                array(
                    "selector" => $selector,
                    "property" => 'font-family',
                ),
                 array(
                    "selector" => $selector,
                    "property" => 'font-size',
                ),
            )
        );

        // border sub-section
        $inputs_section->borderSection(
            __("Input Border"),
            $selector,
            $this);

        // focus sub-section
        $focus_section = $inputs_section->addControlSection("inputs_focus", __("Inputs Focus"), "assets/icon.png", $this);
        $selector = ".woocommerce form .form-row input.input-text:focus, .select2-container--default .select2-selection--single:focus, .select2-container--default .select2-search--dropdown .select2-search__field:focus, .select2-dropdown:focus";

        $focus_section->addStyleControls(
            array(
                array(
                    "selector" => $selector,
                    "property" => 'border-color',
                ),
            )
        );

        $focus_section->addPreset(
            "box-shadow",
            "focus_box_shadow",
            __("Box Shadow"),
            $selector
        );
    }

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

 
    }
    
}

new MyAccount();
