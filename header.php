<?php $blog_title = get_bloginfo('name'); ?>
<?php $site_url = get_home_url(); ?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php echo $blog_title ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<!--STYLING PGA CUSTOM COLORS -->
<?php $main_background_color = get_option('main_background_color'); ?>
<?php $background_color = get_option('background_color'); ?>
<style> #main { background-color:  <?php echo $main_background_color; ?>; opacity: <?php echo get_theme_mod( 'main_opacity_setting', 'default_value' )/100;?>;} </style>
<!--<style> #wrapper { background-color:  <?php echo $main_background_color; ?>; } </style>-->
<style> #header { opacity: <?php echo get_theme_mod( 'header_opacity_setting', 'default_value' )/100;?>;} </style>
<style> #access { opacity: <?php echo get_theme_mod( 'menu_opacity_setting', 'default_value' )/100;?>;} </style>
<style> #footer { opacity: <?php echo get_theme_mod( 'footer_opacity_setting', 'default_value' )/100;?>;} </style>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
	<div id="header">
	    <!-- This line adds the header to the theme -->
	    <a href="<?php echo $site_url; ?>">
	    	<img id="headerimg" src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="Headerimage" />
		</a>
	</div><!--header-->
	
	<nav id="access" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav>