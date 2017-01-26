<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function hugeit_share_html_show_styles( $social_buttons, $param_values ) {
	global $wpdb;

	require_once 'free_banner.php';
	$form_action_url = wp_nonce_url('admin.php?page=huge_it_share_buttons&task=save', 'save_settings', 'hugeit_share_save_settings_nonce');
	?>

	<div class="wrap">
		<form action="<?php echo $form_action_url; ?>" method="post" id="adminForm" name="adminForm">
			<div id="poststuff" >
				<div id="post-body" class="metabox-holder columns-2">
					<!-- Content -->
					<div id="post-body-content">
						<?php add_thickbox(); ?>
						<div id="post-body-heading">
							<h3><?php echo __('Share Buttons', 'share-buttons'); ?></h3>
						</div>
						<div id="options-block">
							<?php $path_site = plugins_url("/../images", __FILE__); ?>
							<div>
								<h3><?php echo __('Share Buttons Social Medias', 'share-buttons'); ?></h3>
								<ul id="socials-list">
									<li <?php if($param_values['share_facebook_button'] == 'on') echo 'class="active"'; ?>>
										<label>
											<input type="hidden" name="params[share_facebook_button]" value="" />
											<input class="socials_0 text" type="checkbox" <?php if($param_values['share_facebook_button'] == 'on') echo 'checked="checked"'; ?> name="params[share_facebook_button]" value="on" />Facebook</label>
									</li>
									<li <?php if($param_values['share_twitter_button'] == 'on') echo 'class="active"'; ?>>
										<label>
											<input type="hidden" name="params[share_twitter_button]" value="" />
											<input  class="socials_1 text" type="checkbox" <?php if($param_values['share_twitter_button'] == 'on') echo 'checked="checked"'; ?> name="params[share_twitter_button]" value="on" />Twitter</label>
									</li>
									<li <?php if($param_values['share_pinterest_button'] == 'on') echo 'class="active"'; ?>>
										<input type="hidden" name="params[share_pinterest_button]" value="" />
										<label><input  class="socials_4 text" type="checkbox" <?php if($param_values['share_pinterest_button'] == 'on') echo 'checked="checked"'; ?> name="params[share_pinterest_button]" value="on" />Pinterest</label>
									</li>
									<li <?php if($param_values['share_google_plus_button'] == 'on') echo 'class="active"'; ?>>
										<input type="hidden" name="params[share_google_plus_button]" value="" />
										<label><input  class="socials_2 text" type="checkbox" <?php if($param_values['share_google_plus_button'] == 'on') echo 'checked="checked"'; ?> name="params[share_google_plus_button]" value="on" />Google Plus</label>
									</li>
									<li <?php if($param_values['share_linkedin_button'] == 'on') echo 'class="active"'; ?>>
										<input type="hidden" name="params[share_linkedin_button]" value="" />
										<label><input  class="socials_3 text" type="checkbox" <?php if($param_values['share_linkedin_button'] == 'on') echo 'checked="checked"'; ?> name="params[share_linkedin_button]" value="on" />Linkedin</label>
									</li>
									<li <?php if($param_values['share_tumblr_button'] == 'on') echo 'class="active"'; ?>>
										<input type="hidden" name="params[share_tumblr_button]" value="" />
										<label><input  class="socials_5 text" type="checkbox" <?php if($param_values['share_tumblr_button'] == 'on') echo 'checked="checked"'; ?> name="params[share_tumblr_button]" value="on" />Tumblr</label>
									</li>
									<li <?php if($param_values['share_digg_button'] == 'on') echo 'class="active"'; ?>>
										<input type="hidden" name="params[share_digg_button]" value="" />
										<label><input  class="socials_6 text" type="checkbox" <?php if($param_values['share_digg_button'] == 'on') echo 'checked="checked"'; ?> name="params[share_digg_button]" value="on" />Digg</label>
									</li>
									<li <?php if($param_values['share_stumbleupon_button'] == 'on') echo 'class="active"'; ?>>
										<input type="hidden" name="params[share_stumbleupon_button]" value="" />
										<label><input  class="socials_7 text" type="checkbox" <?php if($param_values['share_stumbleupon_button'] == 'on') echo 'checked="checked"'; ?> name="params[share_stumbleupon_button]" value="on" />StumbleUpon</label>
									</li>
									<li <?php if($param_values['share_myspace_button'] == 'on') echo 'class="active"'; ?>>
										<input type="hidden" name="params[share_myspace_button]" value="" />
										<label><input  class="socials_8 text" type="checkbox" <?php if($param_values['share_myspace_button'] == 'on') echo 'checked="checked"'; ?> name="params[share_myspace_button]" value="on" />MySpace</label>
									</li>
									<li <?php if($param_values['share_vkontakte_button'] == 'on') echo 'class="active"'; ?>>
										<input type="hidden" name="params[share_vkontakte_button]" value="" >
										<label><input class="socials_9 text" type="checkbox" <?php if($param_values['share_vkontakte_button'] == 'on') echo 'checked="checked"'; ?> name="params[share_vkontakte_button]" value="on" >VKontakte</label>
									</li>
								</ul>
							</div>
							<div id="buttons_size_block">
								<h3><?php echo __('Share Buttons size', 'share-buttons'); ?></h3>
								<ul id="buttons_size_list">
									<li class="<?php if($param_values['huge_it_share_size'] == '40') echo 'active'; ?> big"><input type="radio" value="40" name="params[huge_it_share_size]" <?php if($param_values['huge_it_share_size'] == '40') echo 'checked="checked"'; ?>checked="checked" /></li>
									<li class="<?php if($param_values['huge_it_share_size'] == '30') echo 'active'; ?> medium"><input type="radio" value="30" name="params[huge_it_share_size]" <?php if($param_values['huge_it_share_size'] == '30') echo 'checked="checked"'; ?>></li>
									<li class="<?php if($param_values['huge_it_share_size'] == '20') echo 'active'; ?> small"><input type="radio" value="20" name="params[huge_it_share_size]" <?php if($param_values['huge_it_share_size'] == '20') echo 'checked="checked"'; ?>></li>
								</ul>
								<h4>
									<?php
									if ( $param_values['huge_it_share_size'] == '40' ) {
										echo 'Big';
									} else if ( $param_values['huge_it_share_size'] == '30' ) {
										echo 'Medium';
									} else {
										echo 'Small';
									}
									?>
								</h4>
							</div>
							<div id="position_list_block">
								<h3><?php echo __('Button Position', 'share-buttons'); ?></h3>
								<ul id="position_list">
									<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'left-top') echo 'active'; ?> left-top"><input type="radio" value="left-top" id="share_title_top-left" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'left-top') echo 'checked="checked"'; ?>></li>
									<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'center-top') echo 'active'; ?> center-top"><input type="radio" value="center-top" id="share_title_top-center" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'center-top') echo 'checked="checked"'; ?>></li>
									<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'right-top') echo 'active'; ?> right-top"><input type="radio" value="right-top" id="share_title_top-right" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'right-top') echo 'checked="checked"'; ?>></li>
									<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'left-bottom') echo 'active'; ?> left-bottom"><input type="radio" value="left-bottom" id="share_title_bottom-left" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'left-bottom') echo 'checked="checked"'; ?>></li>
									<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'center-bottom') echo 'active'; ?> center-bottom"><input type="radio" value="center-bottom" id="share_title_bottom-center" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'center-bottom') echo 'checked="checked"'; ?>></li>
									<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'right-bottom') echo 'active'; ?> right-bottom"><input type="radio" value="right-bottom" id="share_title_bottom-right" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'right-bottom') echo 'checked="checked"'; ?>></li>
								</ul>
							</div>
							<div class="hugeit_share_pro_section">
								<h3><?php echo __('Share Buttons With Shares Count', 'share-buttons'); ?><img src="<?php echo plugins_url('../images/Share-Buttons.png', __FILE__) ?>" class="hugeit_share_pro_logo"/></h3>
								<div class="other-options">
									<label>
										<span><?php echo __('Show Share Count', 'share-buttons'); ?></span>
										<input type="hidden" name="params[show_hide_shares_count]" value="" />
										<input id="shares_count" type="checkbox" name="params[show_hide_shares_count]" <?php if( hugeit_share_show_hide_shares_count() == 'on') echo 'checked="checked"'; ?>value="on" disabled="disabled"/>
									</label>
								</div>
							</div>
							<div class="hugeit_share_pro_section">
								<h3><?php echo __('Buttons style', 'share-buttons'); ?><img src="<?php echo plugins_url('../images/Share-Buttons.png', __FILE__) ?>" class="hugeit_share_pro_logo"/></h3>
								<ul id="styles_list" class="<?php if( hugeit_share_show_hide_shares_count() == "on"){echo "shares_count";} ?>">
									<li class="social_0 <?php if($param_values['share_button_icons_style'] == '0') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="0" disabled="disabled" /></label></li>
									<li class="social_1 <?php if($param_values['share_button_icons_style'] == '1') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="1" disabled="disabled" /></label></li>
									<li class="social_2 <?php if($param_values['share_button_icons_style'] == '2') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="2" disabled="disabled" /></label></li>
									<li class="social_3 <?php if($param_values['share_button_icons_style'] == '3') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="3" disabled="disabled" /></label></li>
									<li class="social_4 <?php if($param_values['share_button_icons_style'] == '4') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="4" disabled="disabled" checked="checked" /></label></li>
									<li class="social_5 <?php if($param_values['share_button_icons_style'] == '5') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="5" disabled="disabled" /></label></li>
									<li class="social_6 <?php if($param_values['share_button_icons_style'] == '6') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="6" disabled="disabled" /></label></li>
									<li class="social_7 <?php if($param_values['share_button_icons_style'] == '7') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="7" disabled="disabled" /></label></li>
									<li class="social_8 <?php if($param_values['share_button_icons_style'] == '8') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="8" disabled="disabled" /></label></li>
									<li class="social_9 <?php if($param_values['share_button_icons_style'] == '9') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="9" disabled="disabled" /></label></li>
									<li class="social_10 <?php if($param_values['share_button_icons_style'] == '10') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="10" disabled="disabled" /></label></li>
									<li class="social_11 <?php if($param_values['share_button_icons_style'] == '11') echo 'active'; ?>"><label><input type="radio" name="params[share_button_icons_style]" value="11" disabled="disabled" /></label></li>
								</ul>
							</div>
							<div class="other-options hugeit_share_pro_section">
								<h3><?php echo __('Share Buttons Block', 'share-buttons'); ?><img src="<?php echo plugins_url('../images/Share-Buttons.png', __FILE__) ?>" class="hugeit_share_pro_logo"/></h3>
								<label><span><?php echo __('Block Has Background', 'share-buttons'); ?></span><input type="hidden" name="params[share_button_block_has_background]" value="" /><input  id="share_button_block_has_background" type="checkbox" value="on" /></label>
								<label><span><?php echo __('Block Background Color', 'share-buttons'); ?></span><input id="share_button_block_background_color" type="text" class="color" value="3BD8FF" /></label>
								<label><span><?php echo __('Block Border Size', 'share-buttons'); ?></span><input id="share_button_block_border_size" type="number" value="0" /></label>
								<label><span><?php echo __('Block Border Color', 'share-buttons'); ?></span><input id="share_button_block_border_color" type="text" class="color" value="0FB5D6" /></label>
								<label><span><?php echo __('Block Border Radius', 'share-buttons'); ?></span><input id="share_button_block_border_radius" type="number" value="5" /></label>
								<label><span><?php echo __('Margin From Content', 'share-buttons'); ?></span><input id="share_button_margin_from_content" type="number" value="0" /></label>
							</div>
							<div class="other-options hugeit_share_pro_section">
								<h3><?php echo __('Share Buttons Title', 'share-buttons'); ?><img src="<?php echo plugins_url('../images/Share-Buttons.png', __FILE__) ?>" class="hugeit_share_pro_logo"/></h3>
								<label><span><?php echo __('Title Text', 'share-buttons'); ?></span><input id="share_button_title_text" type="text" value="Share This:" disabled="disabled" /></label>
								<label><span><?php echo __('Title Position', 'share-buttons'); ?></span>
									<select id="share_button_title_position" disabled="disabled">
										<option value="left">Left</option>
										<option value="right">Right</option>
										<option selected="selected" value="top">Top</option>
									</select>
								</label>
								<label><span><?php echo __('Title Font Size', 'share-buttons'); ?></span><input id="share_button_title_font_size" type="number" value="25" disabled="disabled"/></label>
								<label><span><?php echo __('Title Color', 'share-buttons'); ?></span><input id="share_button_title_color" type="text" class="color" value="666666" disabled="disabled"/></label>
								<label><span><?php echo __('Title Font Style(Family)', 'share-buttons'); ?></span>
									<select id="share_button_title_font_style_family" disabled="disabled">
										<option value="">Default</option>
										<option value="Arial,Helvetica Neue,Helvetica,sans-serif" selected="selected">Arial *</option>
										<option value="Arial Black,Arial Bold,Arial,sans-serif">Arial Black *</option>
										<option value="Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif">Arial Narrow *</option>
										<option value="Courier,Verdana,sans-serif">Courier *</option>
										<option value="Georgia,Times New Roman,Times,serif">Georgia *</option>
										<option value="Times New Roman,Times,Georgia,serif">Times New Roman *</option>
										<option value="Verdana,sans-serif">Verdana *</option>
										<option value="American Typewriter,Georgia,serif">American Typewriter</option>
										<option value="Bookman Old Style,Georgia,Times New Roman,Times,serif">Bookman Old Style</option>
										<option value="Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif">Calibri</option>
										<option value="Cambria,Georgia,Times New Roman,Times,serif">Cambria</option>
										<option value="Candara,Verdana,sans-serif">Candara</option>
										<option value="Century Gothic,Apple Gothic,Verdana,sans-serif">Century Gothic</option>
										<option value="Century Schoolbook,Georgia,Times New Roman,Times,serif">Century Schoolbook</option>
										<option value="Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif">Consolas</option>
										<option value="Constantia,Georgia,Times New Roman,Times,serif">Constantia</option>
										<option value="Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif">Corbel</option>
										<option value="Tahoma,Geneva,Verdana,sans-serif">Tahoma</option>
										<option value="Rockwell, Arial Black, Arial Bold, Arial, sans-serif">Rockwell</option>
									</select>
								</label>
							</div>
							<div class="other-options hugeit_share_pro_section">
								<h3><?php echo __('Buttons Custom Styles', 'share-buttons'); ?><img src="<?php echo plugins_url('../images/Share-Buttons.png', __FILE__) ?>" class="hugeit_share_pro_logo"/></h3>
								<label><span><?php echo __('Margin Between Buttons', 'share-buttons'); ?></span><input id="share_button_margin_between_buttons" type="number" value="3" disabled="disabled"/></label>
								<label><span><?php echo __('Buttons Has Background', 'share-buttons'); ?></span><input type="hidden" value="" /><input id="share_button_buttons_has_background" type="checkbox" value="on" disabled="disabled" /></label>
								<label><span><?php echo __('Buttons Background Padding', 'share-buttons'); ?></span><input id="share_button_buttons_background_padding" type="number" value="0" disabled="disabled" /></label>
								<label><span><?php echo __('Buttons Background Color', 'share-buttons'); ?></span><input id="share_button_buttons_background_color" type="text" class="color" value="14CC9B" disabled="disabled" /></label>
								<label><span><?php echo __('Buttons Border Size', 'share-buttons'); ?></span><input id="share_button_buttons_border_size" type="number" value="0" disabled="disabled"/></label>
								<label><span><?php echo __('Buttons Border Style', 'share-buttons'); ?></span>
									<select id="share_button_buttons_border_style" disabled="disabled">
										<option value="solid"><?php echo __('Standard', 'share-buttons'); ?></option>
										<option value="dotted"><?php echo __('Dotted', 'share-buttons'); ?></option>
										<option value="double"><?php echo __('Double', 'share-buttons'); ?></option>
										<option value="ridge" selected="selected"><?php echo __('Ridge', 'share-buttons'); ?></option>
									</select>
								</label>
								<label><span><?php echo __('Buttons Border Color', 'share-buttons'); ?></span><input id="share_button_buttons_border_color" type="text"  class="color" value="E6354C" disabled="disabled" /></label>
								<label><span><?php echo __('Buttons Border Radius', 'share-buttons'); ?></span><input id="share_button_buttons_border_radius" type="number" value="11" disabled="disabled" /></label>
							</div>
						</div>
						<!--LIVE PREVIEW-->
						<div id="hugeit-share-buttons-preview-container">
							<div id="hugeit-share-buttons-preview-block" class="<?php if( hugeit_share_show_hide_shares_count() == "on"){echo "shares_count";} ?>">
								<section>
									<?php
									$size=$param_values['huge_it_share_size'];
									$style=$param_values['share_button_icons_style'];

									$position=explode('-',$param_values['huge_it_share_button_position_post']);
									?>
									<style>

										.huge-it-share-buttons {
											border:<?php echo $param_values['share_button_block_border_size']; ?>px solid #<?php echo $param_values['share_button_block_border_color']; ?>;
											border-radius:<?php echo $param_values['share_button_block_border_radius']; ?>px;
											background:#<?php echo $param_values['share_button_block_background_color']; ?>;

										<?php if($position[0]=="left"){?> text-align:left; <?php }?>
										<?php if($position[0]=="right"){?> text-align:right; <?php }?>
										<?php if($position[0]=="center"){?> text-align:center; <?php }?>
										}

										#huge-it-share-buttons-top {margin-bottom:<?php echo $param_values['share_button_margin_from_content']; ?>px;}
										#huge-it-share-buttons-bottom {margin-top:<?php echo $param_values['share_button_margin_from_content']; ?>px;}

										#poststuff .huge-it-share-buttons h3 {
											font-size:<?php echo $param_values['share_button_title_font_size'];?>px ;
											font-family:<?php echo $param_values['share_button_title_font_style_family']; ?>;
											color:#<?php echo $param_values['share_button_title_color'];?>;
										<?php
											if ($param_values['share_button_title_position'] == 'left'){
												echo 'float:left;';
											} elseif ($param_values['share_button_title_position'] == 'right') {
												echo 'float:right;';
											} else {
												echo 'display:block;';
											}
										?>
											line-height:<?php echo $param_values['share_button_title_font_size'];?>px ;
										<?php if($position[0]=="left"){?> text-align:left; <?php }?>
										<?php if($position[0]=="right"){?> text-align:right; <?php }?>
										<?php if($position[0]=="center"){?> text-align:center; <?php }?>
										}

										.huge-it-share-buttons ul {
										<?php if($position[0]=="left"){?> float:left;text-align:left; <?php }?>
										<?php if($position[0]=="right"){?> float:right;text-align:right; <?php }?>
										<?php if($position[0]=="center"){?> margin:0px auto !important;text-align:center; <?php }?>
										}

										.wrap div.updated {
											clear: both;
										}

										.huge-it-share-buttons  ul li {
											margin-left:<?php echo $param_values['share_button_margin_between_buttons']; ?>px;
											margin-right:<?php echo $param_values['share_button_margin_between_buttons']; ?>px;
											padding:<?php echo $param_values['share_button_buttons_background_padding']; ?>px;
											border:<?php echo $param_values['share_button_buttons_border_size']; ?>px <?php echo $param_values['share_button_buttons_border_style']; ?> #<?php echo $param_values['share_button_buttons_border_color']; ?>;
											border-radius:<?php echo $param_values['share_button_buttons_border_radius']; ?>px;
											background-color:#<?php echo $param_values['share_button_buttons_background_color']; ?>;
										}

										.huge-it-share-buttons  ul li a {
											background-image:url(<?php echo $path_site;?>/buttons.<?php echo $size;?>.png);
											width:<?php echo $size;?>px;
											height:<?php echo $size;?>px;
										}
									</style>
									<div id="huge-it-share-buttons-top" class="huge-it-share-buttons <?php if($position[1]=="top") echo 'active'; if($param_values['share_button_block_has_background'] != 'on') echo 'nobackground'; ?>">
										<h3><?php echo stripslashes($param_values['share_button_title_text']); ?></h3>
										<ul class="huge-it-share-buttons-list">
											<?php $i = 0;
											foreach ( $social_buttons as $socials ) { ?>
												<li class="<?php if ( $socials != 'on' ) echo 'none '; if ( $param_values['share_button_buttons_has_background'] != 'on' ) echo 'nobackground '; ?>">
													<a href="#" style="background-position: -<?php echo $size*$i; ?>px -<?php echo $size*$style;?>px "></a>
												</li>
												<?php $i ++;
											} ?>
										</ul>

										<div class="clear"></div>
									</div>
									<h1><?php echo __('This is demo content', 'share-buttons'); ?></h1>
									<span class="date">25 March 2015</span>
									<div class="clear">
										<img src="<?php echo $path_site; ?>/matt.jpg" class="blog-image" alt="Matt Mullenweg" />
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
									</div>
									<div id="huge-it-share-buttons-bottom" class="huge-it-share-buttons <?php if($position[1]=="bottom") echo 'active ';?> <?php if($param_values['share_button_block_has_background'] != 'on'){echo 'nobackground '; } ?>">
										<h3><?php echo stripslashes($param_values['share_button_title_text']); ?></h3>
										<ul class="huge-it-share-buttons-list">
											<?php foreach($social_buttons as $socials) {?>
												<li class="<?php if($socials!='on') echo 'none '; if($param_values['share_button_buttons_has_background'] != 'on') echo 'nobackground '; ?>" ><a href="#" style="background-position: -<?php echo ($size*$i+( 2*$size)); ?>px -<?php echo $size*$style;?>px "></a></li>
												<?php $i++; } ?>
										</ul>
										<div class="clear"></div>
									</div>
								</section>
							</div>
						</div>
					</div>
					<!-- SIDEBAR -->
					<div id="postbox-container-1" class="postbox-container">
						<div id="hugeit_share-buttons-unique-options" class="postbox">
							<h3 class="hndle"><span><?php echo __('Save Options', 'share-buttons'); ?></span></h3>
							<div id="major-publishing-actions">
								<div id="publishing-action">
									<a onclick="document.getElementById('adminForm').submit()" class="save-gallery-options button-primary">Save</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div id="hugeit_share-buttons-shortcode-box" class="postbox shortcode ms-toggle">
							<h3 class="hndle"><span><?php echo __('Shordcodes', 'share-buttons'); ?></span></h3>
							<div class="inside">
								<ul>
									<li rel="tab-1" class="selected">
										<h4><?php echo __('Shortcode for posts/pages/plugins', 'share-buttons'); ?></h4>
										<p><?php echo __('Copy &amp; paste the shortcode directly into any WordPress post or page.', 'share-buttons'); ?></p>
										<textarea class="full" readonly="readonly">[huge_it_share]</textarea>
									</li>
									<li rel="tab-2">
										<h4><?php echo __('Shortcode for templates/themes', 'share-buttons'); ?></h4>
										<p><?php echo __('Copy &amp; paste this code into a template file to include the slideshow within your theme.', 'share-buttons'); ?></p>
										<textarea class="full" readonly="readonly">&lt;?php echo do_shortcode("[huge_it_share]"); ?&gt;</textarea>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- END SIDEBAR -->
				</div>
				<input type="hidden" name="task" value="" />
		</form>
	</div>
	<?php
}