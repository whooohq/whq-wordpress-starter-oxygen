<?php 

if (class_exists('OxyWooCommerce')) {
    return;
}

Class OxyWooCommerce{

    function __construct() {

        $this->load_files();
        $this->setup_options();

        // Register +Add Woo section
        add_action('oxygen_add_plus_sections', array($this, 'register_add_plus_section'));

        // Register +Add Woo subsections
        // oxygen_add_plus_{$id}_section_content
        add_action('oxygen_add_plus_wooco_section_content', array($this, 'register_add_plus_subsections'));

        // Woo Global Styles UI
        add_action('oxygen_vsb_global_styles_tabs',     array($this, 'global_settings_tab'));
        add_action('oxygen_vsb_settings_content',       array($this, 'global_settings'));

        // Global styles CSS
        add_filter('oxy_global_settings_defaults',      array($this, 'filter_global_settings_defaults'));
        add_filter('oxy_elements_api_page_css_output',  array($this, 'filter_global_settings'));
        add_filter('oxygen_builder_options',            array($this, 'builder_global_styles_css'));
        add_filter('oxygen_header_font_families',       array($this, 'header_font_families'));
        add_action('oxygen_default_classes_output',     array($this, 'global_styles_universal_css'));

        add_action('wp_footer',  array($this, 'flexslider_fix'));
        add_action('init',       array($this, 'init_callback'));
    }


    function setup_options() {

        // Buttons
        $this->buttons_settings = array(
            "--primary-cta"             => __("Primary CTA"),
            "--primary-cta-hover"       => __("Primary CTA Hover"),
            "--primary-cta-text"        => __("Primary CTA Text"),
            "--secondary-cta"           => __("Secondary CTA"),
            "--secondary-cta-hover"     => __("Secondary CTA Hover"),
            "--secondary-cta-text"      => __("Secondary CTA Text"),
            "--tertiary-cta"            => __("Tertiary CTA"),
            "--tertiary-cta-hover"      => __("Tertiary CTA Hover"),
            "--tertiary-cta-background" => __("Tertiary CTA Background"),
            "--disabled-button"         => __("Disabled Button"),
            "--button-radius"           => __("Button Radius"),
        );

        $this->buttons_settings_defaults = array(
            "--primary-cta"             => "#65bec2",
            "--primary-cta-hover"       => "#6799b2",
            "--primary-cta-text"        => "#ffffff",
            "--secondary-cta"           => "#666666",
            "--secondary-cta-hover"     => "#999999",
            "--secondary-cta-text"      => "#ffffff",
            "--tertiary-cta"            => "#65bec2",
            "--tertiary-cta-hover"      => "#6799b2",
            "--tertiary-cta-background" => "#ffffff",
            "--disabled-button"         => "#cccccc",
            "--button-radius"           => "4",
            "--button-radius-unit"      => "px",
        );


        // Links
        $this->links_settings = array(
            "--standard-link"           => __("Standard Link"),
            "--standard-link-hover"     => __("Standard Link Hover"),
        );

        $this->links_settings_defaults = array(
            "--standard-link"           => "#6799b2",
            "--standard-link-hover"     => "#65bec2"
        );
    

        // Inputs
        $this->inputs_settings = array(
            "--input-border"            => __("Input Border"),
            "--input-focus-border"      => __("Input Focus Border"),
            "--input-placeholder-text"  => __("Input Placeholder Text"),
            "--input-background"        => __("Input Background"),
            "--input-radius"            => __("Input Radius"),
        );

        $this->inputs_settings_defaults = array(
            "--input-border"            => "#d3ced2",
            "--input-focus-border"      => "#65bec2",
            "--input-placeholder-text"  => "#d3ced2",
            "--input-background"        => "#ffffff",
            "--input-radius"            => "4",
            "--input-radius-unit"       => "px",
        );


        // Text
        $this->text_settings = array(
            "--text-normal"             => __("Text Normal"),
            "--text-strong"             => __("Text Strong"),
        );

        $this->text_settings_defaults = array(
            "--text-normal"             => "#666666",
            "--text-strong"             => "#000000",
        );

        // Notifications
        $this->notifications_settings = array(
            "--info-color" => __("Info Color"),
            "--error-color" => __("Error Color"),
            "--message-color" => __("Message Color"),
        );

        $this->notifications_settings_defaults = array(
            "--info-color" => "#00adef",
            "--error-color" => "#e96199",
            "--message-color" => "#65bec2",
        );
        
        // Misc
        $this->misc_settings = array(
            "--sale-badge-color"        => __("Sale Badge Color"),
            "--star-rating-primary"     => __("Star Rating Primary"),
            "--star-rating-greyed"      => __("Star Rating Greyed"),
            "--border-normal"           => __("Border Normal"),
            "--border-image"            => __("Border Image"),
            "--box-background"          => __("Box Background"),
        );

        $this->misc_settings_defaults = array(
            "--sale-badge-color"        => "#65bec2",
            "--star-rating-primary"     => "#65bec2",
            "--star-rating-greyed"      => "#d3d3d3",
            "--border-normal"           => "#d3ced2",
            "--border-image"            => "#d3ced2",
            "--box-background"          => "#ffffff",
        );

        // Misc
        $this->widget_settings = array(
            "--widget-title-font-size"      => __("Widget Title Font Size"),
            "--widget-title-font-weight"    => __("Widget Title Font Weight"),
            "--widget-title-font-family"    => __("Widget Title Font Family"),
        );

        $this->widget_settings_defaults = array(
            "--widget-title-font-size"      => "",
            "--widget-title-font-size-unit" => "px",
            "--widget-title-font-weight"    => "",
            "--widget-title-font-family"    => "",
        );
        
    }


    function load_files() {

        // Single Product
        include_once "elements/product-builder.php";
        include_once "elements/product-title.php";
        include_once "elements/product-excerpt.php";
        include_once "elements/product-description.php";
        include_once "elements/product-images.php";
        include_once "elements/product-price.php";
        include_once "elements/product-cart-button.php";
        include_once "elements/product-tabs.php";
        include_once "elements/product-info.php";
        include_once "elements/product-meta.php";
        include_once "elements/product-rating.php";
        include_once "elements/product-stock.php";
        include_once "elements/product-upsells.php";
        include_once "elements/product-related.php";

        // Archive & Product List
        include_once "elements/archive-products.php";
        include_once "elements/archive-categories.php";
        include_once "elements/archive-title.php";
        include_once "elements/archive-description.php";

        // WooCommerce Pages
        include_once "elements/page-shopping-cart.php";
        include_once "elements/page-checkout.php";
        include_once "elements/page-order-tracking.php";
        include_once "elements/page-account.php";

        // Other Elements
        include_once "elements/general-breadcrumb.php";
        include_once "elements/cart-total.php";

        // auto include new elements
        $element_filenames = glob(plugin_dir_path(__FILE__)."elements/*.php");
        foreach ($element_filenames as $filename) {
            include_once $filename;
        }
    }


    function register_add_plus_section() {

        CT_Toolbar::oxygen_add_plus_accordion_section("wooco",__("WooCommerce"));
    }


    function register_add_plus_subsections() { ?>
        
        <h2><?php _e("Single Product", "oxygen");?></h2>
        <?php do_action("oxygen_add_plus_woo_single"); ?>

        <h2><?php _e("Archive & Product List", "oxygen");?></h2>
        <?php do_action("oxygen_add_plus_woo_archive"); ?>

        <h2><?php _e("WooCommerce Pages", "oxygen");?></h2>
        <?php do_action("oxygen_add_plus_woo_page"); ?>

        <h2><?php _e("Other Elements", "oxygen");?></h2>
        <?php do_action("oxygen_add_plus_woo_other"); ?>
    
    <?php }


    function global_settings_tab() {
  
        global $oxygen_toolbar;
        $oxygen_toolbar->settings_tab(__("WooCommerce", "oxygen"), "woo", "panelsection-icons/styles.svg");
    }

    
    function global_settings() { ?>

        <div ng-if="isShowTab('settings','woo')">
            <?php include_once "settings/global-settings.view.php"; ?>
        </div>  

    <?php }

    
    function filter_global_settings_defaults( $defaults ) {

        $defaults['woo'] = array();

        $defaults['woo'] = array_merge($defaults['woo'], $this->buttons_settings_defaults);
        $defaults['woo'] = array_merge($defaults['woo'], $this->links_settings_defaults);
        $defaults['woo'] = array_merge($defaults['woo'], $this->inputs_settings_defaults);
        $defaults['woo'] = array_merge($defaults['woo'], $this->text_settings_defaults);
        $defaults['woo'] = array_merge($defaults['woo'], $this->notifications_settings_defaults);
        $defaults['woo'] = array_merge($defaults['woo'], $this->misc_settings_defaults);
        $defaults['woo'] = array_merge($defaults['woo'], $this->widget_settings_defaults);

        return $defaults;

    }


    function filter_global_settings( $css ) {

        // remove variables definitions
        $css = preg_replace('%\/\*STRIP START\*\/(.*?)\/\*STRIP END\*\/%s', '', $css);

        $global_settings = ct_get_global_settings();

        if (isset($global_settings['woo'])){

            // units
            foreach ($global_settings['woo'] as $key => $value) {
                if (isset($global_settings['woo'][$key."-unit"])) {
                    $global_settings['woo'][$key] = $value.$global_settings['woo'][$key."-unit"];
                }
            }
        
            $options = array_keys  ($global_settings['woo']);
            $values  = array_values($global_settings['woo']);

            $options = array_map(function($value){
                return "var($value)";
            }, $options);

            // global colors
            $values = array_map(function($value){
                return oxygen_vsb_get_global_color_value($value);
            }, $values);
            
            $css = str_replace($options, $values, $css);
        }
      
        return $css;

    }


    function builder_global_styles_css($options) {

        $options["wooGlobalStyles"] = file_get_contents(__DIR__.'/elements/woo-global-styler.css');
        $options["wooAssetsPath"] = OXY_WOO_ASSETS_PATH;

        return $options;
    }


    function header_font_families($fonts) {

        $global_settings = ct_get_global_settings();

        foreach ($global_settings['woo'] as $key => $value) {
            if (strpos($key, "font-family") !== false) {
                $fonts[] = $value;
            }
        }

        return $fonts;
    }

    
    function global_styles_universal_css() {

        $global_css = file_get_contents(__DIR__.'/elements/woo-global-styler.css');
        $global_css = str_replace("%%ASSETS_PATH%%", OXY_WOO_ASSETS_PATH, $global_css);
        $global_css = $this->filter_global_settings($global_css);

        echo $global_css;
    }

    function flexslider_fix() {

        if (!defined("SHOW_CT_BUILDER") || !defined("OXYGEN_IFRAME")) {
            return;
        }

        ?><script type="text/javascript">
            document.addEventListener('oxygen-ajax-element-loaded', function (e) { 
                setTimeout(function() {

                    jQuery(".woocommerce-product-gallery").each(function(){
                        var gallery = jQuery(this);

                        var viewport = gallery.find('.flex-viewport');
                        if (viewport.length > 1){
                            viewport.first().remove();
                        }
                        var thumbs = gallery.find('.flex-control-nav');
                        if (thumbs.length > 1){
                            thumbs.first().remove();
                        }
                        var icon = gallery.find('.woocommerce-product-gallery__trigger');
                        if (icon.length > 1){
                            icon.first().remove();
                        }

                        var flexSlider = gallery.data('flexslider');
                        if (flexSlider) {
                            flexSlider.update();
                            flexSlider.doMath();
                        }
                    });

                }, 100);
            }, false);
        </script><?php

    }

    function init_callback() {

        // we don't want wooco redirects to work when builder is loading
        if ( defined("SHOW_CT_BUILDER") || defined("OXYGEN_IFRAME") ) {
            remove_action( 'template_redirect', 'wc_template_redirect' );
        }

    }

}