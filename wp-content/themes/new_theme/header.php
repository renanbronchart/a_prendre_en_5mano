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
<!-- debut nav -->
<div class="navigation">
    <ul>
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Portfolio</a>
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Join us</a>
        </li>
    </ul>
</div>

<!-- fin nav -->

<div id="header-wrap">
    <div id="header" class="clear">

        <div class="burger">
        <div class="btn-navigation">
            <div class="barre"></div>
            <div class="barre"></div>
            <div class="barre"></div>
        </div>

        <div id="close"></div>
        </div>

        <nav>
            <img src="<?= get_stylesheet_directory_uri(); ?>/images/logo_ALEM.png" alt="" class="logo">
            <div class="menu">
            <ul>
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Join us</a>
                </li>
            </ul></div>
        </nav>
    </div>
</div>

    <div class='cb'></div>
            <div class='wrap'>
                <div class='container'>
