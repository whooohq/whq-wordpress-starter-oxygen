<?php

namespace Oxygen\WooElements;

class ProductTabs extends \OxyWooEl {

    function name() {
        return 'Product Tabs';
    }

    function woo_button_place() {
        return "single";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function wooTemplate() {
        
        global $post;
        setup_postdata($post);

        return 'woocommerce_output_product_data_tabs';
    }

    function controls() {

        /**
         * Tabs Section
         */

        $tabs_section = $this->addControlSection("tabs", __("Tabs"), "assets/icon.png", $this);

        // Normal sub-section
        $normal_section = $tabs_section->typographySection(
            __("Normal Tabs"), 
            ".woocommerce-tabs ul.tabs li a", 
            $this
        );

        $tabs_layout = $normal_section->addControl("buttons-list", "tabs_layout", __("Tabs Layout") );
        $tabs_layout->setValue(array("Horizontal","Vertical"));
        $tabs_layout->setValueCSS( array(
            "Horizontal"  => "",
            "Vertical"  => "
                .woocommerce-tabs {
                display: flex;
                }
                .woocommerce-tabs ul.tabs {
                flex-direction: column;
                padding: 0;
                margin-right: 40px;
                }
                .woocommerce-tabs ul.tabs li {
                margin: 5px 0;
                text-align: left;
                }
                .woocommerce-tabs ul.tabs::before {
                border-bottom: none;
                }
                .woocommerce-tabs ul.tabs li.active {
                border-bottom-color: var(--border-normal);
                }
                .woocommerce-tabs .panel {
                margin-top: 5px;
                flex-grow: 1;
                }
                @media (max-width:640px) {
                .woocommerce-tabs .panel {
                  margin-top: 0;
                }
                .woocommerce-tabs {
                  flex-direction: column;
                }
                .woocommerce-tabs ul.tabs {
                  margin-right: 0;
                  text-align: center;
                }
              }
            ",
        ) );

        $normal_section->addStyleControls(
            array(
                array(
                    "name" => __('Tab Background Color'),
                    "selector" => '.woocommerce-tabs ul.tabs li',
                    "property" => 'background-color',
                    "control_type" => 'colorpicker',
                ),
                array(
                    "name" => __('Tab Border Color'),
                    "selectors" => 
                    array(
                        array(
                            "selector" => '.woocommerce-tabs ul.tabs li, .woocommerce-tabs ul.tabs::before',
                            "property" => 'border-color',
                        ),
                        array(
                            "selector" => '.woocommerce-tabs ul.tabs li.active.active',
                            "property" => 'border-bottom-color',
                        ),
                        // purposes of below code might be achieved with increasing above selector specificity (two .active) 
                        /*array(
                            "selector" => '.woocommerce-tabs ul.tabs li.active',
                            "property" => 'border-bottom-color',
                            "max_width" => '560' // This doesn't implemented yet in the API, it might be useful to have
                        ),*/
                    ),
                    "control_type" => 'colorpicker',
                )
            )
        );

        $normal_section->addStyleControl(
            array(
                "name" => __('Tab Spacing'),
                "selectors" => 
                array(
                    array(
                        "selector" => '.woocommerce-tabs ul.tabs li',
                        "property" => 'padding-left|padding-right',
                    ),
                    array(
                        "selector" => '.woocommerce-tabs ul.tabs li:after',
                        "property" => 'height',
                    ),
                    array(
                        "selector" => '.woocommerce-tabs ul.tabs li:before',
                        "property" => 'height',
                    ),
                ),
                "control_type" => 'measurebox', // how to make get_control_type_by_css_property() know we need a measurebox?
            )
        );

        // Active Tab sub-section
        $active_tab_section = $tabs_section->addControlSection("active_tab", __("Active Tab"), "assets/icon.png", $this);

        $active_tab_section->addStyleControls(
            array(
                array(
                    "name" => __('Active Tab Text Color'),
                    "selector" => '.woocommerce-tabs ul.tabs li.active a',
                    "property" => 'color',
                ),
                array(
                    "name" => __('Active Tab Background Color'),
                    "selector" => '.woocommerce-tabs ul.tabs li.active',
                    "property" => 'background-color|border-bottom-color',
                    "control_type" => 'colorpicker',
                ),
            )
        );

        $show_arrow = $active_tab_section->addControl("checkbox", "show_arrow", __("Show Active Tab Arrow") );
        $show_arrow->setValueCSS( array(
            "true"  => ".woocommerce-tabs ul.tabs li.active:before {
                          content: '→' ; /* maybe user can select from different simbols? ×©↓ˇ˜• and etc.) */
                          font-family: 'Courier';
                          font-size: 24px;
                          line-height: 0.75;
                          width: 24px;
                          height: 24px;
                          position: relative;
                          color: var(--standard-link); /* variable value */
                          display: block;
                          box-shadow: none;
                          border: none;
                          margin-left: 24px;
                          margin-right: -48px;
                        }",
        ));

        $active_tab_section->addStyleControls(
            array(
                array(
                    "name" => __('Active Tab Arrow Color'),
                    "selector" => '.woocommerce-tabs ul.tabs li.active.active:before',
                    "property" => 'color',
                    "condition" => 'show_arrow=true',
                ),
            )
        );

        // Hovered Tab sub-section
        $hover_tab_section = $tabs_section->addControlSection("hover_tab", __("Hovered Tab"), "assets/icon.png", $this);

        $hover_tab_section->addStyleControls(
            array(
                array(
                    "name" => __('Hover Tab Text Color'),
                    "selector" => '.woocommerce-tabs ul.tabs li:hover a',
                    "property" => 'color',
                ),
                array(
                    "name" => __('Hover Tab Background Color'),
                    "selector" => '.woocommerce-tabs ul.tabs li:hover',
                    "property" => 'background-color|border-bottom-color',
                    "control_type" => 'colorpicker',
                ),
            )
        );

        /*---Headings Section ---*/

        $headings_section = $this->typographySection(
            __("Headings"),
            '.woocommerce-tabs h2, #reviews #comments h2',
            $this);

        /**
         * Content Section
         */

        $content_section = $this->addControlSection("content_section", __("Content"), "assets/icon.png", $this);
        $selector = ".woocommerce-tabs .panel";

        $content_section->addStyleControls(
            array(
                array(
                    "selector" => $selector,
                    "property" => 'background-color',
                ),
            )
        );

        $content_section->addPreset(
            "padding",
            "content_padding",
            __("Content Padding"),
            $selector
        );

        // Border sub-section
        $content_section->borderSection(
            __("Content Border"),
            $selector,
            $this
        );

        $content_section->typographySection(
            __("Content Typography"),
            $selector,
            $this);


        /* additional info  -same exact controls as product-info.php - copied and pasted the code, changed selectors a bit. what's the pattern to re-use the same code? */

        $addtlinfo_section = $this->addControlSection("addtlinfo_section", __("Additional Info"), "assets/icon.png", $this);

        $addtlinfo_section->typographySection(
            __("Typography"),
            '.woocommerce-Tabs-panel--additional_information table.shop_attributes th, table.shop_attributes td',
            $this);

            
        $addtlinfo_section->typographySection(
            __("Value Typography"),
            '.woocommerce-Tabs-panel--additional_information table.shop_attributes th + td', 
            $this);

        $cellSection = $addtlinfo_section->addControlSection("cells", __("Cell Content"), "assets/icon.png", $this);

        $cellSection->addPreset(
            "padding",
            "table_cell_padding",
            __("Padding"),
            ".woocommerce-Tabs-panel--additional_information table.shop_attributes th, .woocommerce-Tabs-panel--additional_information table.shop_attributes td"
        );

        $cellSection->addStyleControls(
            array(
                array(
                    "name" => __('Background'),
                    "property" => 'background-color',
                    "selector" => ".woocommerce-Tabs-panel--additional_information table.shop_attributes tr"
                ),
                array(
                    "name" => __('Alternating Background'),
                    "property" => 'background-color',
                    "selector" => ".woocommerce-Tabs-panel--additional_information table.shop_attributes tr:nth-child(even)"
                ),
                array(
                    "name" => __('Border Color'),
                    "property" => 'border-color',
                    "selector" => ".woocommerce-Tabs-panel--additional_information table.shop_attributes th, .woocommerce-Tabs-panel--additional_information table.shop_attributes td"
                ),
                
            )
        );

        /* Reviews Controls */

        $reviews_section = $this->addControlSection("reviews_section", __("Reviews"), "assets/icon.png", $this);

        $reviews_section->addStyleControls(
            array(
                array(
                    "name" => __('Background Color'),
                    "selector" => '#review_form #respond',
                    "property" => 'background-color',
                    "control_type" => 'colorpicker',
                ),
            )
        );

        $reviews_section->borderSection(
            __("Borders"),
            "#review_form #respond",
            $this
        );

        $review_box_shadow = $reviews_section->addControlSection("reviews_box_shadow", __("Box Shadow"), "assets/icon.png", $this);
		
		$review_box_shadow->addPreset(
            "box-shadow",
            "review_shadow",
            __("Original Thumbs Shadow"),
            "#review_form #respond"
        );

        $reviews_section->typographySection(
            __("Form Heading"),
            "#reply-title",
            $this
        );

        $reviews_section->typographySection(
            __("Labels"),
            "form.comment-form label",
            $this
        );

        $stars_section = $reviews_section->addControlSection("stars_section", __("Stars"), "assets/icon.png", $this);
        
        $stars_section->addStyleControls(
            array(
                array(
                    "name" => __('Color'),
                    "selector" => '.comment-form-rating a',
                    "property" => 'color',
                    "control_type" => 'colorpicker',
                ),
            )
        );

        $inputs_section = $reviews_section->addControlSection("inputs_section", __("Inputs"), "assets/icon.png", $this);

        $inputs_section->addStyleControls(
            array(
                array(
                    "name" => __('Background'),
                    "selector" => '#respond textarea',
                    "property" => 'background-color',
                    "control_type" => 'colorpicker',
                ),
                array(
                    "name" => __('Border Color'),
                    "selector" => '#review_form #respond textarea',
                    "property" => 'border-color',
                    "control_type" => 'colorpicker',
                ),
                array(
                    "name" => __('Focused Border Color'),
                    "selector" => '#review_form #respond textarea:focus',
                    "property" => 'border-color',
                    "control_type" => 'colorpicker',
                ),
                array(
                    "name" => __('Focused Border Color'),
                    "selector" => '#review_form #respond textarea:focus',
                    "property" => 'border-color',
                    "control_type" => 'colorpicker',
                ),
            )
        );

        $inputs_section->addPreset(
            "box-shadow",
            "inputs_shadow",
            __("Focused Box Shadow"),
            "#review_form #respond textarea:focus"
        );

        $submit_section = $reviews_section->typographySection(
            __("Submit"),
            '#review_form #respond .form-submit input',
            $this);

        $submit_section->addStyleControls(
            array(
                array(
                    "name" => __('Background'),
                    "selector" => '#review_form #respond .form-submit input',
                    "property" => 'background-color',
                    "control_type" => 'colorpicker',
                ),
                array(
                    "name" => __('Border Color'),
                    "selector" => '#review_form #respond .form-submit input',
                    "property" => 'border-color',
                    "control_type" => 'colorpicker',
                ),
                array(
                    "name" => __('Border Radius'),
                    "selector" => '#review_form #respond .form-submit input',
                    "property" => 'border-radius',
                ),
                array(
                    "name" => __('Hover Background'),
                    "selector" => '#review_form #respond .form-submit input:hover',
                    "property" => 'background-color',
                    "control_type" => 'colorpicker',
                ),
                array(
                    "name" => __('Hover Border Color'),
                    "selector" => '#review_form #respond .form-submit input:hover',
                    "property" => 'border-color',
                    "control_type" => 'colorpicker',
                ),

            )
        );

    }

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

 
    }

}

new ProductTabs();
