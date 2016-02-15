<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta http-equiv="cleartype" content="on">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon-1.ico">

	<title><?php wp_title( '|', true, 'right' ); ?></title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic|Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,800,700,600&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/css/libs/jquery.fancybox.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/css/main.css">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <?php the_page_color(get_the_ID()); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <div class="background-wrapper">
        <div class="background-icon-top"></div>
        <div class="background-icon-bottom"></div>
    </div>
    <header id="header" class="header">
        <div class="container clearfix">

    		<a class="header--logo" href="<?php echo get_site_url();?>/homepage">
                <img src="http://moralcourage.org/wp-content/themes/moralcourage/images/mc_logo_rect2.png">
            </a>
            <nav id="navMenu" class="nav-menu">

                <a class="menu-mobile" href="">Menu <i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i></a>
				<?php wp_nav_menu(array('theme_location' => 'primary')); ?>

            </nav>
        </div>
    </header>
