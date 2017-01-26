<?php
/*
* Plugin Name: Simple Google reCAPTCHA
* Description: Simply protect your WordPress against spam comments and brute-force attacks, thanks to Google reCAPTCHA!
* Version: 1.8
* Author: Michal Nov&aacute;k
* Author URI: https://www.novami.cz
* License: GPL3
* Text Domain: sgr
*/

function sgr_add_plugin_action_links($links) {
	return array_merge(array("settings" => "<a href=\"options-general.php?page=sgr-options\">".__("Settings", "sgr")."</a>"), $links);
}
add_filter("plugin_action_links_".plugin_basename(__FILE__), "sgr_add_plugin_action_links");

function sgr_options_page() {
	echo "<div class=\"wrap\">
	<h1>".__("reCAPTCHA Options", "sgr")."</h1>
	<form method=\"post\" action=\"options.php\">";
	settings_fields("sgr_header_section");
	do_settings_sections("sgr-options");
	submit_button();
	echo "</form>
	</div>";
}

function sgr_menu() {
	add_submenu_page("options-general.php", "reCAPTCHA", "reCAPTCHA", "manage_options", "sgr-options", "sgr_options_page");
}
add_action("admin_menu", "sgr_menu");

function sgr_display_options() {
	add_settings_section("sgr_header_section", __("What first?", "sgr"), "sgr_display_content", "sgr-options");
	add_settings_field("sgr_site_key", __("Site Key", "sgr"), "sgr_display_site_key_element", "sgr-options", "sgr_header_section");
	add_settings_field("sgr_secret_key", __("Secret Key", "sgr"), "sgr_display_secret_key_element", "sgr-options", "sgr_header_section");
	add_settings_field("sgr_logged_users_comments_disable", __("Disable reCAPTCHA in comment form for logged in users", "sgr"), "sgr_display_logged_users_comments_disable", "sgr-options", "sgr_header_section");
	add_settings_field("sgr_comment_form_disable", __("Disable reCAPTCHA for comments", "sgr"), "sgr_display_comment_form_disable", "sgr-options", "sgr_header_section");
	add_settings_field("sgr_login_form_disable", __("Disable reCAPTCHA for login page", "sgr"), "sgr_display_login_form_disable", "sgr-options", "sgr_header_section");
	add_settings_field("sgr_register_form_disable", __("Disable reCAPTCHA for registration page", "sgr"), "sgr_display_register_form_disable", "sgr-options", "sgr_header_section");
	add_settings_field("sgr_forgot_form_disable", __("Disable reCAPTCHA for forgot password page", "sgr"), "sgr_display_forgot_form_disable", "sgr-options", "sgr_header_section");
	add_settings_field("sgr_buddy_form_disable", __("Disable reCAPTCHA for BuddyPress registration page", "sgr"), "sgr_display_buddy_form_disable", "sgr-options", "sgr_header_section");
	
	register_setting("sgr_header_section", "sgr_site_key");
	register_setting("sgr_header_section", "sgr_secret_key");
	register_setting("sgr_header_section", "sgr_logged_users_comments_disable");
	register_setting("sgr_header_section", "sgr_comment_form_disable");
	register_setting("sgr_header_section", "sgr_login_form_disable");
	register_setting("sgr_header_section", "sgr_register_form_disable");
	register_setting("sgr_header_section", "sgr_forgot_form_disable");
	register_setting("sgr_header_section", "sgr_buddy_form_disable");
}

function sgr_display_content() {
	echo __("<p>You have to <a href=\"https://www.google.com/recaptcha/admin\" rel=\"external\">register your domain</a> first, get required keys from Google and save them bellow.</p>", "sgr");
}

function sgr_display_site_key_element() {
	echo "<input type=\"text\" name=\"sgr_site_key\" class=\"regular-text\" id=\"sgr_site_key\" value=\"".get_option("sgr_site_key")."\" />";
}

function sgr_display_secret_key_element() {
	echo "<input type=\"text\" name=\"sgr_secret_key\" class=\"regular-text\" id=\"sgr_secret_key\" value=\"".get_option("sgr_secret_key")."\" />";
}

function sgr_display_logged_users_comments_disable() {
	echo "<input type=\"checkbox\" name=\"sgr_logged_users_comments_disable\" id=\"sgr_logged_users_comments_disable\" value=\"1\" ".checked(1, get_option("sgr_logged_users_comments_disable"), false)." />";
}

function sgr_display_comment_form_disable() {
	echo "<input type=\"checkbox\" name=\"sgr_comment_form_disable\" id=\"sgr_comment_form_disable\" value=\"1\" ".checked(1, get_option("sgr_comment_form_disable"), false)." />";
}

function sgr_display_login_form_disable() {
	echo "<input type=\"checkbox\" name=\"sgr_login_form_disable\" id=\"sgr_login_form_disable\" value=\"1\" ".checked(1, get_option("sgr_login_form_disable"), false)." />";
}

function sgr_display_register_form_disable() {
	echo "<input type=\"checkbox\" name=\"sgr_register_form_disable\" id=\"sgr_register_form_disable\" value=\"1\" ".checked(1, get_option("sgr_register_form_disable"), false)." />";
}

function sgr_display_forgot_form_disable() {
	echo "<input type=\"checkbox\" name=\"sgr_forgot_form_disable\" id=\"sgr_forgot_form_disable\" value=\"1\" ".checked(1, get_option("sgr_forgot_form_disable"), false)." />";
}

function sgr_display_buddy_form_disable() {
	echo "<input type=\"checkbox\" name=\"sgr_buddy_form_disable\" id=\"sgr_buddy_form_disable\" value=\"1\" ".checked(1, get_option("sgr_buddy_form_disable"), false)." />";
}

add_action("admin_init", "sgr_display_options");

function frontend_sgr_script() {
	wp_register_script("recaptcha", "https://www.google.com/recaptcha/api.js");
	wp_enqueue_script("recaptcha");
	$plugin_url = plugin_dir_url(__FILE__);
	wp_enqueue_style("style", $plugin_url."style.css");
}
add_action("wp_enqueue_scripts", "frontend_sgr_script");
add_action("login_enqueue_scripts", "frontend_sgr_script");

function load_language_sgr() {
	load_plugin_textdomain("sgr", false, dirname(plugin_basename(__FILE__)) . "/languages/");
}
add_action("plugins_loaded", "load_language_sgr");

function sgr_display() {
	echo "<div class=\"g-recaptcha\" data-sitekey=\"".get_option("sgr_site_key")."\"></div>";
}

function sgr_verify($input) {
	if (isset($_POST["g-recaptcha-response"])) {
		$recaptcha_response = sanitize_text_field($_POST["g-recaptcha-response"]);
		$recaptcha_secret = get_option("sgr_secret_key");
		$response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$recaptcha_response);
		$response = json_decode($response["body"], true);
		
		if ($response["success"] == true) {
			return $input;
		} else {
			wp_die(__("<p><strong>ERROR</strong>: Google reCAPTCHA verification failed.</p>", "sgr")."</p>\n\n<p><a href=".wp_get_referer().">&laquo; ".__("Back", "sgr")."</a>");
			return null;
		}
		
	} else {
		wp_die(__("<p><strong>ERROR</strong>: Google reCAPTCHA verification failed. Do you have JavaScript enabled?</p>", "sgr")."</p>\n\n<p><a href=".wp_get_referer().">&laquo; ".__("Back", "sgr")."</a>");
		return null;
	}
}

function sgr_check() {
	if (get_option("sgr_site_key") != "" && get_option("sgr_secret_key") != "") {
		
		if (get_option("sgr_comment_form_disable") != "1" && ((is_user_logged_in() && get_option("sgr_logged_users_comments_disable") != "1") || !is_user_logged_in())) {
			add_action("comment_form_after_fields", "sgr_display");
			add_action("comment_form_logged_in_after", "sgr_display");
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				add_action("preprocess_comment", "sgr_verify");
			}
		}
		
		if (get_option("sgr_login_form_disable") != "1") {
			add_action("login_form", "sgr_display" );
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				add_action("wp_authenticate_user", "sgr_verify");
			}
			
		}
		
		if (get_option("sgr_register_form_disable") != "1") {
			add_action("register_form", "sgr_display");
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				add_action("registration_errors", "sgr_verify");
			}
		}
		
		if (get_option("sgr_forgot_form_disable") != "1") {
			add_action("lostpassword_form", "sgr_display");
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				add_action("lostpassword_post", "sgr_verify");
			}
		}
		
		if (get_option("sgr_buddy_form_disable") != "1") {
			add_action("bp_before_registration_submit_buttons", "sgr_display");
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				add_action("bp_signup_validate", "sgr_verify");
			}
		}
	}
}
add_action("init", "sgr_check");