<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
    <meta charset='<?php bloginfo( 'charset' ); ?>' />
    <link rel='profile' href='http://gmpg.org/xfn/11' />
    <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Playfair+Display|Source+Sans+Pro" rel="stylesheet">

    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='pingback' href='<?php bloginfo( 'pingback_url' ); ?>' />

    <!-- vendor script js -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- script js -->

    <!-- vendor script css -->
</head>
<body>

<div id="header-wrap">
    <div id="header" class="clear">
        <nav>
            <img src="<?= get_stylesheet_directory_uri(); ?>/images/logo_ALEM.png" alt="" class="logo">
                <?php wp_nav_menu(array(
                    'theme_location' => 'nav'
                )); ?>
        </nav>
    </div>
</div>
    <div class='cb'></div>
            <div class='wrap'>
                <div class='container'>
