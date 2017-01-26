<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
    <meta charset='<?php bloginfo( 'charset' ); ?>' />
    <link rel='profile' href='http://gmpg.org/xfn/11' />
    <link href="https://fonts.googleapis.com/css?family=EB+Garamond" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='all' href="<?php bloginfo( 'stylesheet_directory' ); ?>/style.min.css" />
    <link rel='pingback' href='<?php bloginfo( 'pingback_url' ); ?>' />

    <!-- vendor script js -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js'></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- script js -->

    <!-- vendor script css -->
</head>
<body>
    <header class='nav-down'>
        <div class='contener-head'>
            <a href='<?php bloginfo('url'); ?>' class='logo'></a>
            <div class='menu'>
                <?php wp_nav_menu(array(
                    'theme_location' => 'nav'
                )); ?>
            </div>
        </div>
    </header>
    <div class='cb'></div>
            <div class='wrap'>
                <div class='container'>
