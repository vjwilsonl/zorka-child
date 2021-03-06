<?php
	global $zorka_data;
	$show_login_link = isset($zorka_data['show-login-link']) ? $zorka_data['show-login-link'] : 0;
?>
<?php if ($show_login_link):?>
	<div class="zorka-login-link">
			<?php if ( !is_user_logged_in() ):?>
				<?php esc_html_e('Welcome Guest!','zorka');?>
				<a class="" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php esc_html_e('Log In','zorka'); ?></a>
				<?php esc_html_e('Or','zorka');?>
				<a class="" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php esc_html_e('Register','zorka'); ?></a>
			<?php else:?>
				<?php esc_html_e('Welcome ','zorka');?>
				<?php
					$current_user = wp_get_current_user();
					echo esc_html($current_user->user_login) . '!';
				?>
				<a href="<?php echo esc_url(wp_logout_url(is_home()? home_url() : get_permalink()) ); ?>"><i class="fa fa-power-off"></i> <?php esc_html_e('Logout','zorka'); ?></a>
			<?php endif;?>
	</div>
<?php endif;?>