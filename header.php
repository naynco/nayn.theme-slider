<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _s
 */
global $options;
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta name="google-play-app" content="app-id=co.nayn">
	<meta name="apple-itunes-app" content="app-id=1289503676">
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "url": "https://nayn.co",
  "logo": "https://nayn.co/wp-content/uploads/2018/05/naynco1.jpg"
}
</script>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "NAYN.CO",
  "url": "https://nayn.co",
  "sameAs": [
    "http://www.facebook.com/nayn_co",
    "http://instagram.com/naynco",
    "http://twitter.com/nayn_co",
    "https://www.linkedin.com/company/naynco/"
  ]
}
</script>

	<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  	<![endif]-->
  <?php wp_head(); ?>
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">

</head>

<body <?php body_class(); ?>>

<header class="d-none d-sm-none d-md-block d-lg-block d-xl-block">
  <div class="container header-top">
    <div class="row">
      <div class="col-xl-7">      
        <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>?itm_source=Blog&itm_medium=Logo&itm_campaign=FromBlog" rel="home">
          <img src="<?php echo DION_THEME_URL; ?>/assets/img/naynco.png" alt="<?php bloginfo( 'name' ); ?>">
        </a>
        <?php //wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu' ) ); ?>
      </div>
    </div>
  </div>
</header>

    
<header class="mobile d-block d-sm-block d-md-none d-lg-none d-xl-none">
  <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
    <img src="<?php echo DION_THEME_URL; ?>/assets/img/naynco.png" alt="<?php bloginfo( 'name' ); ?>" class="img-fluid">
  </a>
  <a href="#" class="menuBtn">
    <span class="lines"></span>
  </a>
  <?php //wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'mainMenu', 'container' => 'nav' ) ); ?>
</header>

