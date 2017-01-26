<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ( function_exists( 'current_user_can' ) ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        die( 'Access Denied' );
    }
}

if (!function_exists('current_user_can')) {
    die('Access Denied');
}

function hugeit_share_show_styles() {
    global $wpdb;
    $query = "SELECT *  from " . $wpdb->prefix . "huge_it_share_params";

    $rows = $wpdb->get_results($query);

    $param_values = array();
    foreach ($rows as $row) {
        $key = $row->name;
        $value = $row->value;
        $param_values[$key] = $value;
    }

    $btnrows = $wpdb->get_results("SELECT *  from " . $wpdb->prefix . "huge_it_share_params  where social='social'");

    $social_buttons = array();
    foreach ($btnrows as $btnrow) {
        $key = $btnrow->name;
        $value = $btnrow->value;
        $social_buttons[$key] = $value;
    }

    hugeit_share_html_show_styles($social_buttons, $param_values);
}

function hugeit_share_save_styles_options() {
    global $wpdb;
    if ( isset( $_POST['params'] ) ) {
        $free_features = array(
            'share_facebook_button', 'share_google_plus_button', 'share_digg_button', 'share_vkontakte_button', 'share_twitter_button',
            'share_linkedin_button', 'share_stumbleupon_button', 'share_pinterest_button', 'share_tumblr_button', 'share_myspace_button',
            'huge_it_share_size', 'huge_it_share_button_position_post'
        );
        $params = $_POST['params'];
        foreach ( $params as $key => $value ) {
            if (!in_array($key, $free_features)) {
                continue;
            }
            $wpdb->update(
                $wpdb->prefix . 'huge_it_share_params',
                array( 'value' => $value ),
                array( 'name' => $key ),
                '%s'
            );
        }

        ?>
        <div class="updated"><p><strong><?php _e( 'Item Saved', 'share-buttons' ); ?></strong></p></div>
        <?php
    }
}
