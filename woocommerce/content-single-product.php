<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
  echo get_the_password_form(); // WPCS: XSS ok.
  return;
}

// This include contains all of the theme's custom functions.
require dirname(__FILE__) . '/../inc/prestige-puzzles-product.php';

// Fetch the relevant attributes for the product's variations and format them
// This is used on the pickers, and only accounts for Sizes as Colors don't affect price.

// Custom attributes Size & Color must be a) filled and b) marked for 'Use with variations'
// However, only variations for price must exist.
$variation_attributes = $product->get_variation_attributes();
$variation_options = format_variation_attributes($variation_attributes);

// Fetch the actual product variations which contain the prices,
// subset it to only get what's needed, and store it in a data attribute.
$available_variations   = $product->get_available_variations();
$variations_with_prices = subset_variations_prices($available_variations);
$var_with_prices_json   = array_to_jsondata($variations_with_prices);

?>

<div class="section-horizontal section-horizontal-purple">
    <div class="section-horizontal-content">
        <h1 class="mb-5">
            Congratulations! For completing your puzzle!
        </h1>
        <h2 class="pt-4">
            Once you've finished oohing! and aahing! over your puzzle — it's time to decide on your puzzle's trim color.
        </h2>
        <br />
        <h2 class="mb-5">
            Do you want to:
        </h2>
        <div class="section-color-bullets">
            <div class="color-bullet color-bullet-purple">
                blend the trim with the puzzle's picture?
            </div>
            <div class="color-bullet color-bullet-blue">
                match the edging to a specific room's decor?
            </div>
            <div class="color-bullet color-bullet-yellow">
                add some classic or vibrant color?
            </div>
        </div>
    </div>
</div>

<div class="section-horizontal">
    <div class="section-horizontal-content">
        <div class="header-numbered">
            <div class="header-numbered-number header-numbered-number-purple">
                1
            </div>
            <h3> Choose your color trim</h3>

            <div class="section-horizontal-text-large mt-5 mb-5">
                With 29 color choices, you're sure to find the one! (Don't worry, if down
                the road you decide to switch colors, we can do that too!)
            </div>

            <div class="swatches-color">
                <?php
                $colors = $variation_options['colors'];
                foreach ($colors as $color):
                ?>
                    <div class="swatches-color-item swatches-color-item-selectable" data-value="<?=$color['value']?>">
                        <div class="swatches-color-item-holder">
                            <div class="swatches-color-item-selected-decorator"></div>
                            <div class="swatches-color-item-image">
                                <!-- Image here -->
                            </div>
                            <div class="swatches-color-item-texts">
                                <div class="swatches-color-item-code">
                                    <?=$color['part_one']?>
                                </div>
                                <div class="swatches-color-item-name">
                                    <?=$color['part_two']?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>

<div class="section-horizontal">
    <div class="section-horizontal-content">
        <div class="header-numbered mb-5">
            <div class="header-numbered-number header-numbered-number-yellow">
                2
            </div>
            <h3> Select your puzzle's sizing to calculate pricing: </h3>
        </div>

        <div class="swatches-size">
            <?php
            $sizes = $variation_options['sizes'];
            $sizes_ordered = sort_sizes_by_area($sizes);
            foreach ($sizes_ordered as $size):
            ?>
                <div class="swatches-size-item swatches-size-item-selectable" data-value="<?=$size['value']?>">
                    <div class="swatches-size-item-holder">
                        <div class="swatches-size-item-selected-decorator"></div>
                        <div class="swatches-size-item-texts">
                            <div class="swatches-size-item-code">
                                <?=$size['part_one']?>
                            </div>
                            <div class="swatches-size-item-size">
                                <?=$size['part_two']?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>

        </div>

        <div class="section-horizontal-text-small mt-5">
            <p>
                Don't see your size? We do custom-sized puzzles too!
            </p>
            <p>
                To price your custom size -> <a href="/contact">Contact Us</a>
            </p>
        </div>
    </div>
</div>

<div class="section-horizontal">
    <div class="section-horizontal-content">
        <h3 class="mb-4">
            Calculated price:
        </h3>

        <?php
        $product_id = absint($product->get_id());
        ?>
        <form
          id="cart_form"
          data-color=""
          data-size=""
          data-prices="<?=$var_with_prices_json?>"
          data-product_id="<?=$product_id?>"
          action="<?=esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
          method="post"
          enctype="multipart/form-data"
        >
            <div class="swatches-price">
                <div class="swatches-price-number-holder">
                    <span class="swatches-price-number">
                        $48
                    </span>
                </div>
                <div class="swatches-price-button-holder">
                    <a href="#" class="swatches-price-button" id="submit_form">
                        Add to cart
                    </a>
                </div>
            </div>

            <input type="hidden" name="quantity"     value="1" />
            <input type="hidden" name="add-to-cart"  value="<?=$product_id?>" />
            <input type="hidden" name="product_id"   value="<?=$product_id?>" />
            <input type="hidden" name="variation_id" value="" id="form_variation_id">

            <input type="hidden" name="attribute_pa_color" value="" id="form_color"/>
            <input type="hidden" name="attribute_pa_size"  value="" id="form_size" />

        </form>
    </div>
</div>


<?php
// Don't run this code, this is just for reference:
if (0 === 1):
?>
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

        <?php
        /**
         * Hook: woocommerce_before_single_product_summary.
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action( 'woocommerce_before_single_product_summary' );
        ?>

        <div class="summary entry-summary">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action( 'woocommerce_single_product_summary' );
            ?>
        </div>

        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
        ?>
    </div>

    <?php do_action( 'woocommerce_after_single_product' ); ?>

<?php
endif;