<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Prestige_Puzzles
 */

$theme_uri = get_template_directory_uri();
?>

    <?php if(1==0): ?>
	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'prestige-puzzles' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'prestige-puzzles' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'prestige-puzzles' ), 'prestige-puzzles', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
    <?php endif;?>

    <footer>
        <div class="footer-row">
            <div class="footer-column">
                <img src="<?=$theme_uri?>/img/f-logo.svg" alt="logo">
                <ul>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Prestige puzzles</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h5>Plaque process</h5>
                <ul>
                    <li><a href="#">Gluing process</a></li>
                    <li><a href="#">Packaging process</a></li>
                    <li><a href="#">Shipping process</a></li>
                    <li><a href="#">Mounting process</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h5>Get in touch</h5>
                <ul>
                    <li>718-686-7411</li>
                    <li>4208 14th Ave</li>
                    <li>Brooklyn NY 11219</li>
                    <li>PreserveyourPuzzle@gmail.com</li>
                </ul>
            </div>
            <div class="footer-column">
                <h5>Newsletter</h5>
                <p>Join our mailing list and receive 10% off your first order!</p>
                <form action="">
                    <input type="text" placeholder="Email">
                    <button type="submit" class="btn-purple">Sign up</button>
                </form>
            </div>
        </div>
    </footer>


</div><!-- #page -->

<?php wp_footer(); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
<script src="<?=$theme_uri?>/js/script.js"></script>

</body>
</html>
