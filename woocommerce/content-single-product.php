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
?>

<div class="section-horizontal section-horizontal-purple">
    <div class="section-horizontal-content">
        <h1 class="mb-5">
            Congratulations! For completing your puzzle!
        </h1>
        <h2>
            Once you've finished oohing! and aahing! over your puzzle — it's time to decide on your puzzle's trim color.
        </h2>
        <br />
        <h2 class="mb-5">
            Do you want to:
        </h2>
        <div class="section-color-bullets">
            <div class="color-bullet color-bullet-purple">
                blend the trim with the puzzles's picture?
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

            <div class="section-horizontal-text">
                With 29 color choices, you're sure to find the one! (Don't worry, if down
                the road you decide to switch colors, we can do that too!)
            </div>

            <div class="swatches-color">
                TODO
            </div>
        </div>
    </div>
</div>

<div class="section-horizontal">
    <div class="section-horizontal-content">
        <div class="header-numbered">
            <div class="header-numbered-number header-numbered-number-yellow">
                2
            </div>
            <h3> Select your puzzle's sizing to calculate pricing </h3>
        </div>

        <div class="swatches-size">
            TODO
        </div>

        <div class="section-horizontal-text-small">
            <p>
                Don't see your size? We do custom-sized puzzles too!
            </p>
            <p>
                To price your custom size -> <a href="#">Contact Us</a>
            </p>
        </div>
    </div>
</div>

<div class="section-horizontal">
    <div class="section-horizontal-content">
        <h3 class="mb-4">
            Calculated price:
        </h3>

        <div class="swatches-price">
            <div class="swatches-price-number-holder">
                <span class="swatches-price-number">
                    $48
                </span>
            </div>
            <div class="swatches-price-button-holder">
                <a href="#" class="swatches-price-button">
                    Add to cart
                </a>
            </div>
        </div>
    </div>
</div>

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
