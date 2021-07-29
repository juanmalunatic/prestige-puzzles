<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Prestige_Puzzles
 */

get_header();
$dirname = dirname(__FILE__);
?>

	<main id="primary" class="site-main">

        <?php
        // Decide which kind of template the current page uses
        global $pagename;
        $pagesStatic  = ["about", "ship-to-us", "contact"];

        // Homepage uses a static template
        if (is_home() || is_front_page()) {
            require $dirname . '/pages/homepage.php';

        // Template-based (i.e. non-user editable, live inside pages/)
        } else if (in_array($pagename, $pagesStatic)) {
            $filename = $dirname . "/pages/{$pagename}.php";
            if (is_file($filename))
                require $filename;
            else
                echo "Please create a template for this page under <tt>pages/{$pagename}.php</tt>
                      or convert it to editable by removing this page's slug from <tt>\$pagesStatic</tt> on <tt>page.php</tt>. <br />
                      Base directory: <tt>/wp-content/themes/prestige-puzzles/</tt>";

        // Content-based (i.e. user editable, useful for shortcodes like [woocommerce_cart] and
        } else {
            get_template_part( 'template-parts/content', 'page' );
        }
        ?>
		<?php
        if (1==0):
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
        endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
