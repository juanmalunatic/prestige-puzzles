<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Prestige_Puzzles
 */

$theme_uri = get_template_directory_uri();
require_once dirname(__FILE__) . '/inc/prestige-puzzles-helpers.php';
global $post;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Initial CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">
    <!--/Initial CSS -->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'prestige-puzzles' ); ?></a>

	<header id="masthead" class="site-header">

        <div class="top-panel">
            <p>FLAT RATE SHIPPING IN CONTINENTAL USA! $10 BACK & FORTH</p>
        </div>

        <?php if (1==0):?>
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$prestige_puzzles_description = get_bloginfo( 'description', 'display' );
			if ( $prestige_puzzles_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $prestige_puzzles_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
        <?php endif;?>

        <div class="menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="logo">
                    <a href="#"><img src="<?=$theme_uri?>/img/Logo1.svg" class="img-fluid" alt=""></a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                    <?php foreach (get_menu_items() as $link): ?>

                            <?php
                            $isActive  = ($link['post_slug'] === $post->post_name);
                            $isClasses = isset($link['classes']);


                            $li_classes =  ($isActive ? "active" : '') . ' '. ($isClasses ? $link['classes'] : '');
                            ?>

                            <li class="nav-item  <?=$li_classes?>">
                                <a class="nav-link" href="<?=$link['post_url']?>">
                                    <?=$link['text']?>
                                </a>
                            </li>

                    <?php endforeach; ?>
                    </ul>
                </div>
            </nav>
        </div>

	</header><!-- #masthead -->
