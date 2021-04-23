<?php

namespace Oxygen\WooElements;

class ProductCartButton extends \OxyWooEl {

    function name() {
        return 'Product Cart Button';
    }
    
    function wooTemplate() {
        return 'woocommerce_template_single_add_to_cart';
    }

    function woo_button_place() {
        return "single";
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }
    
    function controls() {

        $label_section = $this->typographySection(__("Labels"),"tr td label",$this);

        $inputs_section = $this->addControlSection("input", __("Inputs"), "assets/icon.png", $this);
        $inputs_selector = 'form.cart .variations select, .quantity .qty';
        $inputs_focus_selector = 'form.cart .variations select:focus, .quantity .qty:focus';

            $inputs_section->typographySection(
                __("Typography"),
                $inputs_selector,
                $this
            ); 
            $inputs_section->borderSection(
                __("Borders"), 
                $inputs_selector, 
                $this
            );
            $inputs_section->borderSection(
                __("Focused Borders"), 
                $inputs_focus_selector, 
                $this
            );
            $inputs_section->boxShadowSection(
                __("Focused Shadows"),
                $inputs_focus_selector,
                $this
            );


        $clearlink_section = $this->addControlSection("clear-link", __("Clear Link"), "assets/icon.png", $this);
        $clearlink_selector = 'table.variations tr td a';

        $clearlink_section->addStyleControls(
            array(
                array(
                    "name" => 'Color',
                    "selector" => $clearlink_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => 'Hover Color',
                    "selector" => $clearlink_selector.":hover",
                    "property" => 'color',
                ),
                array(
                    "name" => 'Font Size',
                    "selector" => $clearlink_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => 'Letter Spacing',
                    "selector" => $clearlink_selector,
                    "property" => 'letter-spacing',
                ),
                array(
                    "name" => 'Text Decoration',
                    "selector" => $clearlink_selector,
                    "property" => 'text-decoration',
                ),
                array(
                    "name" => 'Text Transform',
                    "selector" => $clearlink_selector,
                    "property" => 'text-transform',
                )
            )
        );


        // this code is copied almost exactly from product-price.php, although one of the selectors is tweaked a bit... isn't there some pattern we can use to
        // prevent re-using the exact same code in two places?
        $price_section = $this->addControlSection("price", __("Price Amount"), "assets/icon.png", $this);

        $price_section->typographySection('Color & Typography', '.price, .woocommerce-Price-amount, .price del', $this);
        $strikethrough_section = $price_section->typographySection('Strikethrough On Sale','.price del .woocommerce-Price-amount, .price del', $this);
        
        // how can i put this button list inside the strikethrough_section?
        $stacking_buttonlist = $price_section->addOptionControl(
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

        // In Stock Text
        $in_stock_selector = 'p.stock.in-stock';

        $this->typographySection(
            __("In Stock Text"),
            $in_stock_selector,
            $this);

        // Out of Stock Text
        $out_of_stock_selector = 'p.stock.out-of-stock';

        $this->typographySection(
            __("Out of Stock Text"),
            $out_of_stock_selector,
            $this);

        
        /* add to cart button */
        $button_section = $this->addControlSection("button", __("Add to Cart Button"), "assets/icon.png", $this);
        $button_selector = 'button.button.alt';

        $button_section->addPreset(
            "padding",
            "button_padding",
            __("Button Paddings"),
            $button_selector
        );

        $button_section->addStyleControls(
            array(
                array(
                    "name" => 'Button Background Color',
                    "selector" => $button_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Button Hover Background Color',
                    "selector" => $button_selector.':hover',
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Border Radius',
                    "selector" => $button_selector,
                    "property" => 'border-radius',
                ),
            )
        );


        $button_section->typographySection(
            __("Button Typography"),
            $button_selector,
            $this);


        /* Below controls are only for «Woo Variation Swatches» Plugin only https://wordpress.org/plugins/woo-variation-swatches/ */
        $woo_variations_swatches = class_exists( 'Woo_Variation_Swatches' );
        $woo_variations_swatches = false; // disable for now, we'll come back to this later

        if ($woo_variations_swatches) {
            
            /**
             * Original 
             */

            $woo_variations_original = $this->addControlSection("woo_variations_original", __("Original Swatch"), "assets/icon.png", $this);
            $selector = '.variable-items-wrapper .variable-item';

            // border sub-section
            $woo_variations_original->borderSection(
                __("Border"),
                $selector,
                $this);

            $woo_variations_original->addStyleControls( 
                array(
                    array(
                        "selector" => $selector,
                        "property" => 'color',
                    ),
                    array(
                        "selector" => $selector,
                        "property" => 'font-weight',
                    ),
                    array(
                        "selector" => $selector,
                        "property" => 'text-transform',
                    ),
                    array(
                        "selector" => $selector,
                        "property" => 'letter-spacing',
                    )
                )
            );

            /**
             * Disabled 
             */

            $woo_variations_disabled = $this->addControlSection("woo_variations_disabled", __("Disabled Swatch"), "assets/icon.png", $this);
            $selector = '.variable-items-wrapper .variable-item:not(.radio-variable-item).disabled';

            $woo_variations_disabled->addStyleControls( 
                array(
                    array(
                        "selector" => $selector,
                        "property" => 'opacity',
                    ),
                    array(
                        "selector" => $selector,
                        "property" => 'font-weight',
                    ),
                    array(
                        "selector" => $selector,
                        "property" => 'color',
                    ),
                    array(
                        "selector" => $selector,
                        "property" => 'background-color',
                    )
                )
            );

            // border sub-section
            $woo_variations_disabled->borderSection(
                __("Border"),
                $selector,
                $this);

            // border sub-section
            $woo_variations_disabled->boxShadowSection(
                __("Box Shadow"),
                $selector,
                $this);

            /**
             * Disabled Cross Icon 
             */

            $woo_variations_disabled_cross = $this->addControlSection("woo_variations_disabled_cross", __("Disabled Cross Icon"), "assets/icon.png", $this);
            $selector = '.variable-items-wrapper .variable-item:not(.radio-variable-item).disabled::before, .variable-items-wrapper .variable-item:not(.radio-variable-item).disabled::after';

            $woo_variations_disabled_cross->addStyleControls( 
                array(
                    array(
                        "selector" => $selector,
                        "property" => 'visibility',
                        "default"  => 'hidden'
                    ),
                )
            );

        }

    }
  

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');

    }
    
}

new ProductCartButton();
