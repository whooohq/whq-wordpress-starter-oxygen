<?php

namespace Oxygen\WooElements;

class ProductBuilder extends \OxyWooEl {

    public $has_js = true;

    function name() {
        return 'Product Builder';
    }

    function init() {
        $this->El->useAJAXControls();
        $this->enableNesting();

        add_action("ct_toolbar_component_settings", function() {
            ?>
            <label class="oxygen-control-label oxy-product-builder-elements-label"
                ng-if="isActiveName('oxy-product-builder')&&!hasOpenTabs('oxy-product-builder')">
                <?php _e("Available Product Elements","oxygen"); ?>
            </label>
            <div class="oxygen-control-row oxy-product-builder-elements"
                ng-if="isActiveName('oxy-product-builder')&&!hasOpenTabs('oxy-product-builder')">
                <?php do_action("oxygen_add_plus_woo_single"); ?>
            </div>
        <?php }, 15 );
    }

    function woo_button_place() {
        return "single";
    }

    function controls() {

        $this->addOptionControl(
			array(
                "type" => 'textfield',
				"name" => 'Product ID',
				"slug" => 'product_id'
            )
		);

        $layout = $this->addControlSection("child_element_layout", __("Child Element Layout"), "assets/icon.png", $this);

        $layout->flex('.oxy-product-wrapper-inner', $this);

    }

    function defaultCSS() {
        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');
    }

    function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    }

    function render($options, $defaults, $content) {

        global $product;
        global $post;
        $product = wc_get_product();

        // add body class
        add_filter('body_class', array($this, "woo_body_class"));

        if (isset($options['product_id']) && $options['product_id']) {

            $override_product = wc_get_product($options['product_id']);
            
            if ($override_product) {
                $product = $override_product;

                // update global post
                $post = get_post($options['product_id']);
                setup_postdata( $post );
                
                // enqueue woo gallery scripts
                // taken from WC_Frontend_Scripts::load_scripts
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

        }

        
        if ($content) {

            ?>

            <div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

                <?php do_action('woocommerce_before_single_product'); ?>

                <div class='oxy-product-wrapper-inner oxy-inner-content'>
                    <?php echo do_shortcode($content); ?>
                </div>

                <?php do_action('woocommerce_after_single_product'); ?>

            </div>

            <?php

            // what about handling html structured data, i.e. WC_Structured_Data::generate_product_data?

        } else {

            if ( is_product() || $product) {
                
                global $post;
                setup_postdata($post);
                
                wc_get_template_part( 'content', 'single-product' );
            }
            else {
                _e("No Product found");
            }
        }

        if (defined('OXY_ELEMENTS_API_AJAX') && OXY_ELEMENTS_API_AJAX) : ?>

        <script>jQuery('body').addClass('woocommerce');</script>
        
        <?php endif;

        wp_reset_query();

        global $oxy_vsb_use_query;

        if($oxy_vsb_use_query) {
            $oxy_vsb_use_query->reset_postdata();
        }
    }


    public function woo_body_class($classes) {

        $classes[] = 'woocommerce';
        return $classes;
    }

}

new ProductBuilder();