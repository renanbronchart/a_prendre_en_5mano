<?php

/*
Plugin Name: Huge IT Share Buttons
Plugin URI: http://huge-it.com/share_buttons/
Description:Huge-IT Share Buttons Plugin gives you ability to easily add Facebook, Twitter, G+ and many other social sharing buttons to your website.
Version: 1.3.3
Author: Huge IT
Author URI: http://huge-it.com/
License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: share-buttons
Domain Path: /languages
*/

add_action( 'plugins_loaded', 'hugeit_share_load_plugin_textdomain' );
function hugeit_share_load_plugin_textdomain() {
	load_plugin_textdomain( 'share-buttons', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

function hugeit_share_my_the_content_filter( $content ) {

	if ( $GLOBALS['post']->post_name == 'debug' ) {
		return var_export( $GLOBALS['post'], true );
	}

	return hugeit_share_buttons( $content );
}

function hugeit_share_buttons($content) {
	require_once("Front_end/share_front_end_view.php");
	require_once("Front_end/share_front_end_func.php");

	if (isset($_GET['product_id'])) {
		if (isset($_GET['view'])) {
			if ($_GET['view'] == 'huge_itshare_buttons') {
				return hugeit_share_show_published_share_buttons_1($id);
			}
		}
	} else {
		global $wpdb;
		$query="SELECT * FROM ".$wpdb->prefix."huge_it_share_params";
		$rowspar = $wpdb->get_results($query);
		$param_values = array();

		foreach ($rowspar as $rowpar) {
			$key = $rowpar->name;
			$value = $rowpar->value;
			$param_values[$key] = $value;
		}

		$id = get_the_ID();
		$query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_share_params_posts where share_post_id = %s ", $id);
		$rowsposts = $wpdb->get_results($query);

		if (count($rowsposts) > 0) {
			$share_position = $rowsposts[0]->share_position;
		} else {
			$share_position = $param_values['huge_it_share_button_position_post'];
		}

		return $share_position == 'left-top' || $share_position == 'center-top' || $share_position == 'right-top'
			? hugeit_share_show_published_share_buttons_1($id) . $content
			: $content . hugeit_share_show_published_share_buttons_1($id);
	}
}
add_filter( 'the_content', 'hugeit_share_my_the_content_filter' );
add_action('media_buttons_context', 'hugeit_share_add_share_buttons_my_custom_button' );

add_action('admin_footer', 'hugeit_share_add_share_buttons_inline_popup_content' );

function hugeit_share_add_share_buttons_my_custom_button( $context ) {

	$img = plugins_url( '/images/post.button.png', __FILE__ );

	$container_id = 'huge_it_share';

	$context .= '<a class="button thickbox" title="Select Share Buttons to insert into post"    href="#TB_inline?width=400&inlineId=' . $container_id . '">
		<span class="wp-media-buttons-icon" style="background: url(' . $img . '); background-repeat: no-repeat; background-position: left bottom;"></span>
	Add Share Buttons
	</a>';

	return $context;
}

function hugeit_share_add_share_buttons_inline_popup_content() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#hugeitshare_buttonsinsert').on('click', function() {
				var id = jQuery('#huge_it_share-select option:selected').val();

				window.send_to_editor('[huge_it_share]');
				tb_remove();
			})
		});
	</script>

	<div id="huge_it_share" style="display:none;">
		<h3><?php echo __( 'Select Huge IT Share Buttons to insert into post', 'share-buttons' ); ?></h3>
		<select id='huge_it_share-select'>
			<option value='1'>Share Buttons</option>
		</select>
		<button class='button primary' id='hugeitshare_buttonsinsert'>Insert Share Buttons</button>
	</div>
	<?php
}
///////////////////////////////////shortcode update/////////////////////////////////////////////

add_action('init', 'hugeit_share_buttons_lang_load' );
function hugeit_share_buttons_lang_load() {
	load_plugin_textdomain('sp_share_buttons', false, basename(dirname(__FILE__)) . '/Languages');
}

add_shortcode('huge_it_share', 'hugeit_share_images_list_shotrcode' );
function hugeit_share_images_list_shotrcode($atts) {
	extract(shortcode_atts(array(
		'id' => 'no huge_it share_buttons',
	), $atts));

	return hugeit_share_images_list();
}

add_filter('posts_request', 'hugeit_share_after_search_results' );
function hugeit_share_after_search_results($query) {
	global $wpdb;

	if (isset($_REQUEST['s']) && $_REQUEST['s']) {
		$search_word = htmlspecialchars(($_REQUEST['s']));
		$query = str_replace($wpdb->prefix . "posts.post_content", hugeit_share_gen_string_share_buttons_search($search_word, $wpdb->prefix . 'posts.post_content') . " " . $wpdb->prefix . "posts.post_content", $query);
	}

	return $query;
}

function hugeit_share_show_hide_shares_count() {
	global $wpdb;

	$query = "SELECT shares_count FROM " . $wpdb->prefix . "huge_it_share_params LIMIT 1";
	$shares_counts1 = $wpdb->get_results($query, ARRAY_N);
	$shares_counts = $shares_counts1[0][0];

	return $shares_counts;
}

function hugeit_share_gen_string_share_buttons_search($search_word, $wordpress_query_post) {
	$string_search = '';

	global $wpdb;

	if ($search_word) {
		$rows_share_buttons = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_itshare_buttons_share_buttonss WHERE (description LIKE %s) OR (name LIKE %s)", '%' . $search_word . '%', "%" . $search_word . "%"));

		$count_cat_rows = count($rows_share_buttons);

		for ($i = 0; $i < $count_cat_rows; $i++) {
			$string_search .= $wordpress_query_post . ' LIKE \'%[huge_it_share id="' . $rows_share_buttons[$i]->id . '" details="1" %\' OR ' . $wordpress_query_post . ' LIKE \'%[huge_it_share id="' . $rows_share_buttons[$i]->id . '" details="1"%\' OR ';
		}

		$rows_share_buttons = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_itshare_buttons_share_buttonss WHERE (name LIKE %s)","'%" . $search_word . "%'"));
		$count_cat_rows = count($rows_share_buttons);
		for ($i = 0; $i < $count_cat_rows; $i++) {
			$string_search .= $wordpress_query_post . ' LIKE \'%[huge_it_share id="' . $rows_share_buttons[$i]->id . '" details="0"%\' OR ' . $wordpress_query_post . ' LIKE \'%[huge_it_share id="' . $rows_share_buttons[$i]->id . '" details="0"%\' OR ';
		}

		$rows_single = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_itshare_buttons_images WHERE name LIKE %s","'%" . $search_word . "%'"));

		$count_sing_rows = count($rows_single);

		if ($count_sing_rows) {
			for ($i = 0; $i < $count_sing_rows; $i++) {
				$string_search .= $wordpress_query_post . ' LIKE \'%[huge_it_share_Product id="' . $rows_single[$i]->id . '"]%\' OR ';
			}

		}
	}

	return $string_search;
}

function hugeit_share_images_list() {
	require_once( "Front_end/share_front_end_view.php" );
	require_once( "Front_end/share_front_end_func.php" );

	$id = 'on';

	if ( isset( $_GET['product_id'] ) ) {
		if ( isset( $_GET['view'] ) ) {
			if ( $_GET['view'] == 'huge_itshare_buttons' ) {
				return hugeit_share_show_published_share_buttons_1( $id );
			}
		}
	} else {
		return hugeit_share_show_published_share_buttons_1( $id );
	}
}

add_filter('admin_head', 'hugeit_share_show_tinyMCE' );
function hugeit_share_show_tinyMCE() {
	wp_enqueue_script('common');
	wp_enqueue_script('jquery-color');
	wp_print_scripts('editor');

	if ( function_exists( 'add_thickbox' ) ) {
		add_thickbox();
	}

	wp_print_scripts('media-upload');
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
}


add_action('admin_menu', 'hugeit_share_options_panel' );
function hugeit_share_options_panel() {
	$page_cat = add_menu_page('Theme page title', 'Share Buttons', 'manage_options', 'huge_it_share_buttons', 'hugeit_share_buttons_2', plugins_url('images/huge_it_share_logo.png', __FILE__));
	$featured = add_submenu_page('huge_it_share_buttons', 'Featured Plugins', 'Featured Plugins', 'manage_options', 'huge_it_share_buttons_featured_plugins', 'hugeit_share_featured_plugins' );
	$licensing = add_submenu_page('huge_it_share_buttons', 'Licensing', 'Licensing', 'manage_options', 'huge_it_share_buttons_licensing', 'huge_it_share_buttons_licensing' );

	add_action('admin_print_styles-' . $page_cat, 'hugeit_share_admin_script' );
	add_action('admin_print_styles-' . $featured, 'hugeit_share_featured_script_style' );
	add_action('admin_print_styles-' . $licensing, 'hugeit_share_licensing_script_style' );
}

function hugeit_share_featured_plugins() {
	if ( isset( $_GET['task'] ) ) {
		include_once( "admin/huge_it_featured_plugins.php" );
	} else {
		include_once( "admin/huge_it_featured_plugins.php" );
	}
}

function hugeit_share_featured_script_style(){
	wp_register_style("hugeit_share_featured", plugins_url("style/featured.css", __FILE__), FALSE);
	wp_enqueue_style("hugeit_share_featured");
}

function huge_it_share_buttons_licensing() {
	if ( isset( $_GET['task'] ) ) {
		include_once( "admin/huge_it_licensing.php" );
	} else {
		include_once( "admin/huge_it_licensing.php" );
	}
}

function hugeit_share_licensing_script_style(){
	wp_register_style("hugeit_share_licensing", plugins_url("style/licensing.css", __FILE__), FALSE);
	wp_enqueue_style("hugeit_share_licensing");
}

add_action( 'wp_enqueue_scripts', 'hugeit_share_add_stylesheet' );

/**
 * Add stylesheet to the page
 */
function hugeit_share_add_stylesheet() {
	wp_enqueue_style( 'prefix-style', plugins_url( '/style/front.end.css', __FILE__ ) );
}

function hugeit_share_admin_script() {
	wp_enqueue_media();
	wp_enqueue_script("admin_js", plugins_url("js/admin.js", __FILE__), FALSE);
	wp_enqueue_style("admin_css", plugins_url("style/admin.style.css", __FILE__), FALSE);
	wp_enqueue_script('param_block2', plugins_url("elements/jscolor/jscolor.js", __FILE__));
}

function hugeit_share_option_admin_script() {
	wp_enqueue_media();
	wp_enqueue_style("admin_css", plugins_url("style/admin.style.css", __FILE__), FALSE);
}

function hugeit_share_buttons_2() {
	require_once( "admin/share_buttons_func.php" );
	require_once( "admin/share_buttons_view.php" );

	if ( isset( $_GET['task'] ) && $_GET['task'] === 'save' ) {
		if (!isset($_REQUEST['hugeit_share_save_settings_nonce']) || !wp_verify_nonce($_REQUEST['hugeit_share_save_settings_nonce'], 'save_settings')) {
			wp_die('Security check failure');
		}
		hugeit_share_save_styles_options();
	}

	hugeit_share_show_styles();
}


class Hugeit_Share_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'huge_it_share_widget',
			'Huge IT Share Buttons',
			array( 'description' => __( 'Huge IT Share Buttons', 'huge_it_share' ), )
		);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		extract($args);

		/**
		 * @var string $before_widget
		 * @var string $before_title
		 * @var string $after_title
		 * @var string $after_widget
		 */

		if (isset($instance['share_buttons_id'])) {
			$share_buttons_id = $instance['share_buttons_id'];

			$title = apply_filters( 'widget_title', $instance['title'] );

			echo $before_widget;
			if ( ! empty( $title ) )
				echo $before_title . $title . $after_title;

			echo do_shortcode("[huge_it_share id={$share_buttons_id}]");
			echo $after_widget;
		}
	}


	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['share_buttons_id'] = strip_tags( $new_instance['share_buttons_id'] );
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}


	public function form( $instance ) {
		global $wpdb;

		$title = "";

		if (isset($instance['title'])) {
			$title = $instance['title'];
		}

		$query="SELECT * FROM ".$wpdb->prefix . "huge_itshare_buttons_share_buttonss ";
		$rowwidget=$wpdb->get_results($query);
		?>
		<p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<label for="<?php echo $this->get_field_id('share_buttons_id'); ?>"><?php _e('Select share_buttons:', 'huge_it_share'); ?></label>
		<select id="<?php echo $this->get_field_id('share_buttons_id'); ?>" name="<?php echo $this->get_field_name('share_buttons_id'); ?>">
			<?php foreach ($rowwidget as $rowwidgetecho) : ?>
				<option <?php if ($rowwidgetecho->id == $instance['share_buttons_id']) echo 'selected'; ?> value="<?php echo $rowwidgetecho->id; ?>"><?php echo $rowwidgetecho->name; ?></option>
			<?php endforeach; ?>
		</select>
		</p>
		<?php
	}
}

add_action('admin_enqueue_scripts', 'hugeit_share_enqueue' );
function hugeit_share_enqueue() {
	wp_enqueue_style( 'ajax-script', plugins_url( '/style/global.style.css', __FILE__ ));
	wp_enqueue_script( 'ajax-script', plugins_url( 'js/post.ajax.js', __FILE__ ), array('jquery'));
	wp_localize_script( 'ajax-script', 'hugeit_share_ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => 'email_nonce' ) );
}

add_action('wp_ajax_my_action_free', 'hugeit_share_buttons_action_callback' );
function hugeit_share_buttons_action_callback() {
	global $wpdb;

	if ( $_POST["post_name"] == "sharebuttonspostsidebar" ) {
		$share_post_id  = absint($_POST["post_id"]);
		$table_name     = $wpdb->prefix . "huge_it_share_params_posts";
		$postactive     = ! isset( $_POST["active"] ) ? 'off' : sanitize_text_field( $_POST["active"] );
		$size = absint($_POST["size"]);
		$position = sanitize_text_field($_POST["position"]);

		$allpostid = $wpdb->get_results( $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_it_share_params_posts WHERE share_post_id=%d", $share_post_id) );
		if ( !$allpostid ) {
			$wpdb->insert(
				$table_name,
				array(
					'share_post_id' => $share_post_id,
					'share_medias' => '1',
					'share_button_type' => 'toolbar',
					'share_position' => $position,
					'share_size' => $size,
					'share_button_style' => '1',
					'share_active' => $postactive,
				)
			);
		}

		$wpdb->query( "UPDATE " . $wpdb->prefix . "huge_it_share_params_posts SET share_size = '" . sanitize_text_field($_POST["size"]) . "'  WHERE share_post_id = '" . $share_post_id . "' " );
		$wpdb->query( "UPDATE " . $wpdb->prefix . "huge_it_share_params_posts SET share_position = '" . sanitize_text_field($_POST["position"]) . "'  WHERE share_post_id = '" . $share_post_id . "' " );
		$wpdb->query( "UPDATE " . $wpdb->prefix . "huge_it_share_params_posts SET share_active = '" . $postactive . "'  WHERE share_post_id = '" . $share_post_id . "' " );

		echo json_encode( array(
			"success"  => 1,
			"position" => $position,
			"size"     => $size,
			"active"   => $postactive,
		) );
		die();
	}
}

add_action( "add_meta_boxes", "hugeit_share_buttons_add_meta_boxes_pages" );
function hugeit_share_buttons_add_meta_boxes_pages( $post ) {
	add_meta_box( 'huge_it_share_buttons_post', 'Share buttons', 'hugeit_share_buttons_post', 'post', 'side', 'core' );
}

add_action( "add_meta_boxes", "hugeit_share_buttons_add_meta_boxes_page" );
function hugeit_share_buttons_add_meta_boxes_page( $post ) {
	add_meta_box( 'huge_it_share_buttons_post', 'Share buttons', 'hugeit_share_buttons_post', 'page', 'side', 'core' );
}

function hugeit_share_buttons_post( $post ) {
	global $wpdb;
	$query="SELECT * FROM ".$wpdb->prefix."huge_it_share_params";
	$rowspar = $wpdb->get_results($query);
	$param_values = array();

	foreach ($rowspar as $rowpar) {
		$key = $rowpar->name;
		$value = $rowpar->value;
		$param_values[$key] = $value;
	}

	if (isset($_REQUEST) && (!empty($_REQUEST))) {
		$rowsparpost = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."huge_it_share_params_posts where share_post_id = ". absint($_REQUEST['post']));
	}

	if (isset($rowsparpost) && count($rowsparpost) > 0) {
		$share_position = $rowsparpost[0]->share_position;
		$share_button_size = $rowsparpost[0]->share_size;
		$share_active = $rowsparpost[0]->share_active;
	} else {
		$share_position = $param_values['huge_it_share_button_position_post'];
		$share_button_size = $param_values['huge_it_share_size'];
		$share_active = '';
	}
	?>
	<div id="huge_it_share_post_block" rel="<?php if(isset($_REQUEST) && (!empty($_REQUEST))) esc_attr_e($_REQUEST['post']); ?>">
		<div id="post_active">
			<label>
				<span><?php echo __('Show buttons on this post', 'share-buttons'); ?></span>
				<?php if(isset($share_active) && $share_active == 'off'){ ?>
					<input type="checkbox" value="on" name="huge_it_share_button_active">
				<?php } else { ?>
					<input type="checkbox" value="on" name="huge_it_share_button_active" <?php if($share_active == 'on' || ($share_active == '')) echo ' checked="checked"'; ?>>
				<?php } ?>
			</label>
		</div>
		<div id="post_position_list_block">
			<h3><?php echo __('Button Position', 'share-buttons'); ?></h3>
			<ul id="post_position_list">
				<li class="<?php if($share_position == 'left-top'){echo 'active';} ?> left-top"><input type="radio" value="left-top" id="share_title_top-left" name="huge_it_share_button_position_post" <?php if($share_position == 'left-top'){echo 'checked="checked"';} ?>></li>
				<li class="<?php if($share_position == 'center-top'){echo 'active';} ?> center-top"><input type="radio" value="center-top" id="share_title_top-center" name="huge_it_share_button_position_post" <?php if($share_position == 'center-top'){echo 'checked="checked"';} ?>></li>
				<li class="<?php if($share_position == 'right-top'){echo 'active';} ?> right-top"><input type="radio" value="right-top" id="share_title_top-right" name="huge_it_share_button_position_post" <?php if($share_position == 'right-top'){echo 'checked="checked"';} ?>></li>
				<li class="<?php if($share_position == 'left-bottom'){echo 'active';} ?> left-bottom"><input type="radio" value="left-bottom" id="share_title_bottom-left" name="huge_it_share_button_position_post" <?php if($share_position == 'left-bottom'){echo 'checked="checked"';} ?>></li>
				<li class="<?php if($share_position == 'center-bottom'){echo 'active';} ?> center-bottom"><input type="radio" value="center-bottom" id="share_title_bottom-center" name="huge_it_share_button_position_post" <?php if($share_position == 'center-bottom'){echo 'checked="checked"';} ?>></li>
				<li class="<?php if($share_position == 'right-bottom'){echo 'active';} ?> right-bottom"><input type="radio" value="right-bottom" id="share_title_bottom-right" name="huge_it_share_button_position_post" <?php if($share_position == 'right-bottom'){echo 'checked="checked"';} ?>></li>
			</ul>
		</div>

		<div id="post_buttons_size_block">
			<h3><?php echo __('Share Buttons size', 'share-buttons'); ?></h3>
			<ul id="post_buttons_size_list">
				<li class="<?php if($share_button_size == '40'){echo 'active';} ?> big"><input type="radio" value="40" name="huge_it_share_size" <?php if($share_button_size == '40'){echo 'checked="checked"';} ?>checked="checked" /></li>
				<li class="<?php if($share_button_size == '30'){echo 'active';} ?> medium"><input type="radio" value="30" name="huge_it_share_size" <?php if($share_button_size == '30'){echo 'checked="checked"';} ?>></li>
				<li class="<?php if($share_button_size == '20'){echo 'active';} ?> small"><input type="radio" value="20" name="huge_it_share_size" <?php if($share_button_size == '20'){echo 'checked="checked"';} ?>></li>
			</ul>
			<h4>
				<?php
				if ( $share_button_size == '40' ) {
					echo 'Big';
				} else if ( $share_button_size == '30' ) {
					echo 'Medium';
				} else {
					echo 'Small';
				}
				?>
			</h4>
		</div>
	</div>
	<?php
}

add_action('widgets_init', 'hugeit_share_register_widget' );
function hugeit_share_register_widget() {
	register_widget('Hugeit_Share_Widget');
}

add_action("wp_ajax_as", "hugeit_share_count_ajax_callback" );
function hugeit_share_count_ajax_callback() {
	if ( isset( $_POST['task'] ) ) {
		if ( $_POST['task'] == "tumblr_shares" ) {
			sleep( 40 );

			$id = intval( $_POST['id'] );
			$new_id = $id + 1;
			update_option( "huge_it_tumblr_shares", $new_id );

			echo json_encode( array( "success" => 1, "new_id" => $new_id ) );
			die;
		}

		if ( $_POST['task'] == "mysp_shares" ) {
			sleep( 40 );

			$id_ = intval( $_POST['id'] );
			$new_id = $id_ + 1;
			update_option( "huge_it_mysp_shares", $new_id );

			echo json_encode( array( "success" => 1, "new_id" => $new_id ) );
			die;
		}
	}
}

function hugeit_share_activate() {
	global $wpdb;

	$collate = '';

	if ( $wpdb->has_cap( 'collation' ) ) {
		$collate = $wpdb->get_charset_collate();
	}

	$sql_huge_it_share_params = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_it_share_params`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `social` varchar(200) CHARACTER SET utf8 NOT NULL,
  `ordering` text CHARACTER SET utf8 NOT NULL,
  `value` varchar(200) CHARACTER SET utf8 NOT NULL,
  `shares_count` varchar(50) NOT NULL DEFAULT 'off',
  PRIMARY KEY (`id`)
) " . $collate . " AUTO_INCREMENT=8";

	$sql_huge_it_share_params_posts = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_it_share_params_posts`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `share_post_id` text NOT NULL,
  `share_medias` text NOT NULL,
  `share_button_type` text NOT NULL,
  `share_position` text NOT NULL,
  `share_size` text NOT NULL,
  `share_button_style` text NOT NULL,
  `share_active` text NOT NULL,
  PRIMARY KEY (`id`)
) " . $collate . " AUTO_INCREMENT=8 ";

	$table_name = $wpdb->prefix . "huge_it_share_params";
    $sql_1 = <<<query1
INSERT INTO `$table_name` (`name`, `title`, `social`, `ordering`, `value`) VALUES


('share_facebook_button', 'Share Facebook Button', 'social', '0', 'on'),
('share_twitter_button', 'Share Twitter Button', 'social', '1', 'on'),
('share_pinterest_button', 'Share Pinterest Button', 'social', '3', 'on'),
('share_google_plus_button', 'Share Google Plus Button', 'social', '', 'on'),
('share_linkedin_button', 'Share Linkedin Button', 'social', '2', 'on'),
('share_tumblr_button', 'Share Tumblr button', 'social', '4', 'on'),
('share_digg_button', 'Share Digg button', 'social', '5', 'on'),
('share_stumbleupon_button', 'Share StumbleUpon Button', 'social', '6', 'on'),
('share_myspace_button', 'Share MySpace Button', 'social', '16', 'on'),
('share_vkontakte_button', 'Share VKontakte button', 'social', '7', 'on'),
('share_reddit_button', 'Share Reddit button', 'social', '8', 'off'),
('share_bebo_button', 'Share Bebo button', 'social', '9', 'off'),
('share_delicious_button', 'Share Delicious button', 'social', '10', 'off'),
('share_odnoklassniki_button', 'Share Odnoklassniki button', 'social', '11', 'off'),
('share_qzone_button', 'Share QZone Button', 'social', '12', 'off'),
('share_sina_weibo_button', 'Share Sina Weibo Button', 'social', '13', 'off'),
('share_renren_button', 'Share Renren Button', 'social', '14', 'off'),
('share_n4g_button', 'Share N4G Button', 'social', '15', 'off'),

('huge_it_share_button_position_post', 'Share Button Position', '', '', 'left-bottom'),
('huge_it_share_size', 'Share Button Size', '', '', '30'),
('share_button_type', 'Share Button type', '', '', 'toolbar'),
('share_button_icons_style', 'Share Buttons icons style', '', '', '4'),


('share_button_margin_between_buttons', 'Margin Between Buttons', '', '', '3'),
('share_button_margin_from_content', 'Margin From Content', '', '', '0'),
('share_button_buttons_background_padding', 'Buttons Background padding', '', '', '0'),
('share_button_buttons_background_color', 'Buttons Background color', '', '', '14CC9B'),
('share_button_buttons_border_size', 'Buttons Border Size', '', '', '0'),
('share_button_buttons_border_style', 'Buttons border style', '', '', 'ridge'),
('share_button_buttons_border_radius', 'Buttons border radius', '', '', '11'),
('share_button_buttons_border_color', 'Buttons border color', '', '', 'E6354C'),
('share_button_title_text', 'Title Text', '', '', 'Share This:'),
('share_button_title_position', 'Title position', '', '', 'top'),
('share_button_title_font_size', 'Title font size', '', '', '25'),
('share_button_title_color', 'Title Color', '', '', '666666'),
('share_button_block_background_color', 'Block background color', '', '', '3BD8FF'),
('share_button_block_border_size', 'Block border size', '', '', '0'),
('share_button_block_border_color', 'Block border color', '', '', '0FB5D6'),
('share_button_block_border_radius', 'Block border radius', '', '', '5'),
('share_button_buttons_has_background', 'Buttons has Background', '', '', 'off'),
('share_button_block_has_background', 'Block has background', '', '', 'off'),
('share_button_title_font_style_family', 'Title font style family', '', '', 'Arial,Helvetica Neue,Helvetica,sans-serif');

query1;

    $wpdb->query($sql_huge_it_share_params);
    $wpdb->query($sql_huge_it_share_params_posts);

    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_it_share_params")) {
        $wpdb->query($sql_1);
    }
	
	$wpdb->query("UPDATE `$table_name` SET  value = 'on' WHERE  name = 'share_vkontakte_button'");

        $share_count_check = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_it_share_params", ARRAY_A);
        $fornewUpdateSharebutton = 0;
		
        foreach ($share_count_check as $share_count) {

			if ($share_count['Field'] == 'shares_count') {
			   $fornewUpdateSharebutton=1;
			}
        }
        if($fornewUpdateSharebutton != 1){
            $wpdb->query("ALTER TABLE `".$wpdb->prefix."huge_it_share_params` ADD `shares_count` VARCHAR(50) NOT NULL DEFAULT  'off' AFTER `value`");          
        }
	
}

register_activation_hook(__FILE__, 'hugeit_share_activate');